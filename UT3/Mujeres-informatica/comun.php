<?php
declare(strict_types=1);

session_start();

const RUTA_USUARIOS = __DIR__ . '/json/usuarios.json';
const RUTA_MUJERES = __DIR__ . '/json/index.json';

function escapar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function leer_json(string $ruta): array
{
    if (!is_file($ruta) || filesize($ruta) === 0) {
        return [];
    }

    $contenido = file_get_contents($ruta);
    if ($contenido === false) {
        throw new RuntimeException('No se pudieron leer los datos.');
    }

    $datos = json_decode($contenido, true);
    if (!is_array($datos)) {
        throw new RuntimeException('El archivo de datos contiene un formato no válido.');
    }

    return $datos;
}

function guardar_json(string $ruta, array $datos): void
{
    $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false || file_put_contents($ruta, $json, LOCK_EX) === false) {
        throw new RuntimeException('No se pudieron guardar los datos.');
    }
}

function usuario_actual(): ?string
{
    return isset($_SESSION['usuario']) && is_string($_SESSION['usuario'])
        ? $_SESSION['usuario']
        : null;
}

function token_csrf(): string
{
    if (!isset($_SESSION['token_csrf'])) {
        $_SESSION['token_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['token_csrf'];
}

function comprobar_token_csrf(): bool
{
    return isset($_POST['token_csrf'], $_SESSION['token_csrf'])
        && is_string($_POST['token_csrf'])
        && hash_equals($_SESSION['token_csrf'], $_POST['token_csrf']);
}

function es_autor_publicacion(array $mujer): bool
{
    $usuario = usuario_actual();
    return $usuario !== null
        && isset($mujer['autor'])
        && is_string($mujer['autor'])
        && hash_equals($mujer['autor'], $usuario);
}

function guardar_imagen_subida(array $archivo): string
{
    if (!isset($archivo['error'], $archivo['size'], $archivo['tmp_name'])
        || !is_int($archivo['error'])
        || !is_int($archivo['size'])
        || !is_string($archivo['tmp_name'])
        || $archivo['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Selecciona una imagen válida para subir.');
    }
    if ($archivo['size'] > 5 * 1024 * 1024) {
        throw new RuntimeException('La imagen no puede superar los 5 MB.');
    }

    $temporal = $archivo['tmp_name'];
    $informacionImagen = @getimagesize($temporal);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipo = $finfo->file($temporal);
    $extensiones = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];
    if ($informacionImagen === false || !is_string($tipo) || !isset($extensiones[$tipo])) {
        throw new RuntimeException('El archivo debe ser una imagen JPG, PNG, GIF o WEBP.');
    }

    $archivoNuevo = bin2hex(random_bytes(16)) . '.' . $extensiones[$tipo];
    if (!move_uploaded_file($temporal, __DIR__ . '/img/' . $archivoNuevo)) {
        throw new RuntimeException('No se pudo guardar la imagen. Comprueba los permisos de la carpeta img.');
    }

    return 'img/' . $archivoNuevo;
}

function mostrar_cabecera(string $titulo): void
{
    $usuario = usuario_actual();
    ?>
    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= escapar($titulo) ?> | Mujeres en la informática</title>
        <link rel="stylesheet" href="css/mujeres.css">
    </head>
    <body>
    <header class="cabecera">
        <a class="marca" href="index.php">Mujeres en la informática</a>
        <nav aria-label="Navegación principal">
            <a href="index.php">Galería</a>
            <?php if ($usuario !== null): ?>
                <a href="mujeres_fin.php">Añadir mujer</a>
                <span class="saludo">Hola, <?= escapar($usuario) ?></span>
                <a href="cerrar_sesion.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar sesión / Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="contenedor">
    <?php
}

function mostrar_pie(): void
{
    ?>
    </main>
    <footer class="pie">Un espacio para descubrir y compartir referentes de la informática.</footer>
    </body>
    </html>
    <?php
}
