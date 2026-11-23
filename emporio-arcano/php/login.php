<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

auth_start_session();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    auth_json_response(200, ['csrf_token' => auth_csrf_token()]);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: GET, POST');
    auth_json_response(405, ['error' => 'Método no permitido.']);
}

if (!auth_has_valid_csrf_token()) {
    auth_json_response(403, ['error' => 'Token CSRF inválido o ausente.']);
}

$username = $_POST['usuario'] ?? '';
$password = $_POST['clave'] ?? '';

if (!is_string($username) || !is_string($password)) {
    auth_json_response(400, ['error' => 'Usuario o contraseña inválidos.']);
}

$username = strtolower(trim($username));
if ($username === '' || strlen($username) > 128 || strlen($password) > 4096) {
    auth_json_response(400, ['error' => 'Usuario o contraseña inválidos.']);
}

try {
    $clients = auth_read_clients();
} catch (RuntimeException $error) {
    auth_json_response(500, ['error' => 'No se pudo procesar el archivo de clientes.']);
}

foreach ($clients as $client) {
    if (
        !is_array($client)
        || !isset($client['usuario'], $client['clave'])
        || !is_string($client['usuario'])
        || !is_string($client['clave'])
    ) {
        continue;
    }

    if (
        hash_equals($client['usuario'], $username)
        && password_verify($password, $client['clave'])
    ) {
        session_regenerate_id(true);
        $_SESSION['cliente'] = [
            'id' => $client['id'] ?? null,
            'usuario' => $client['usuario'],
            'nombre' => $client['nombre'] ?? $client['usuario'],
        ];
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        auth_json_response(200, [
            'message' => 'Sesión iniciada.',
            'cliente' => $_SESSION['cliente'],
            'csrf_token' => $_SESSION['csrf_token'],
        ]);
    }
}

auth_json_response(401, ['error' => 'Usuario o contraseña incorrectos.']);
