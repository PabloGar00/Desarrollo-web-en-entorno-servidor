<?php
declare(strict_types=1);

function auth_start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');

    $https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $https,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);

    if (!session_start()) {
        throw new RuntimeException('No se pudo iniciar la sesión.');
    }
}

function auth_json_response(int $status, array $data): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function auth_csrf_token(): string
{
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function auth_has_valid_csrf_token(): bool
{
    $provided = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');

    return is_string($provided)
        && isset($_SESSION['csrf_token'])
        && is_string($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $provided);
}

function auth_read_clients(): array
{
    $path = __DIR__ . '/../datos/clientes.json';
    $lock = auth_open_clients_lock(LOCK_SH);

    try {
        $contents = @file_get_contents($path);

        if ($contents === false) {
            error_log('No se pudo leer datos/clientes.json.');
            throw new RuntimeException('No se pudo leer el archivo de clientes.');
        }

        return auth_decode_clients($contents);
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function auth_register_client(array $newClient): bool
{
    $path = __DIR__ . '/../datos/clientes.json';
    $lock = auth_open_clients_lock(LOCK_EX);

    try {
        $contents = @file_get_contents($path);

        if ($contents === false) {
            error_log('No se pudo leer datos/clientes.json para registrar un cliente.');
            throw new RuntimeException('No se pudo leer el archivo de clientes.');
        }

        $clients = auth_decode_clients($contents);
        $nextId = 1;

        foreach ($clients as $client) {
            if (!is_array($client)) {
                continue;
            }

            if (
                isset($client['usuario'])
                && is_string($client['usuario'])
                && strcasecmp($client['usuario'], $newClient['usuario']) === 0
            ) {
                return false;
            }

            if (
                isset($client['email'])
                && is_string($client['email'])
                && strcasecmp($client['email'], $newClient['email']) === 0
            ) {
                return false;
            }

            if (isset($client['id']) && is_int($client['id']) && $client['id'] >= $nextId) {
                $nextId = $client['id'] + 1;
            }
        }

        $newClient['id'] = $nextId;
        $clients[] = $newClient;

        try {
            $updatedContents = json_encode(
                $clients,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            ) . PHP_EOL;
        } catch (JsonException $error) {
            error_log('No se pudo codificar datos/clientes.json: ' . $error->getMessage());
            throw new RuntimeException('No se pudo guardar el cliente.', 0, $error);
        }

        $bytesWritten = @file_put_contents($path, $updatedContents, LOCK_EX);
        if ($bytesWritten !== strlen($updatedContents)) {
            error_log('No se pudo guardar completamente el nuevo cliente en datos/clientes.json.');
            throw new RuntimeException('No se pudo guardar el cliente.');
        }

        return true;
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function auth_decode_clients(string $contents): array
{
    try {
        $clients = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $error) {
        error_log('datos/clientes.json contiene JSON inválido: ' . $error->getMessage());
        throw new RuntimeException('El archivo de clientes no contiene JSON válido.', 0, $error);
    }

    if (!is_array($clients) || !array_is_list($clients)) {
        error_log('datos/clientes.json debe contener una lista de clientes.');
        throw new RuntimeException('El archivo de clientes tiene un formato inválido.');
    }

    return $clients;
}

function auth_open_clients_lock(int $mode)
{
    $lock = @fopen(__DIR__ . '/.clientes.lock', 'c');

    if ($lock === false) {
        error_log('No se pudo abrir el archivo de bloqueo de clientes.');
        throw new RuntimeException('No se pudo acceder al archivo de clientes.');
    }

    if (!flock($lock, $mode)) {
        fclose($lock);
        error_log('No se pudo bloquear el archivo de clientes.');
        throw new RuntimeException('No se pudo acceder al archivo de clientes.');
    }

    return $lock;
}

function auth_clear_session_cookie(): void
{
    $params = session_get_cookie_params();
    $cookieOptions = [
        'expires' => time() - 42000,
        'path' => $params['path'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly'],
        'samesite' => $params['samesite'] ?? 'Strict',
    ];

    if ($params['domain'] !== '') {
        $cookieOptions['domain'] = $params['domain'];
    }

    setcookie(session_name(), '', $cookieOptions);
}
