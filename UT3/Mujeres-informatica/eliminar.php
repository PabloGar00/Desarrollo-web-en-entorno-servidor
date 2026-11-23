<?php
require_once __DIR__ . '/comun.php';

if (usuario_actual() === null) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Método no permitido.');
}

if (!comprobar_token_csrf()) {
    http_response_code(400);
    exit('La sesión del formulario ha caducado. Recarga la página e inténtalo de nuevo.');
}

$idPublicacion = filter_var($_POST['id_publicacion'] ?? null, FILTER_VALIDATE_INT);
if ($idPublicacion === false || $idPublicacion === null || $idPublicacion < 0) {
    http_response_code(400);
    exit('La publicación seleccionada no es válida.');
}

try {
    $mujeres = leer_json(RUTA_MUJERES);
    if (!isset($mujeres[$idPublicacion]) || !is_array($mujeres[$idPublicacion])) {
        http_response_code(404);
        exit('La publicación no existe.');
    }

    $mujer = $mujeres[$idPublicacion];
    if (!es_autor_publicacion($mujer)) {
        http_response_code(403);
        exit('Solo quien creó esta publicación puede eliminarla.');
    }

    unset($mujeres[$idPublicacion]);
    guardar_json(RUTA_MUJERES, array_values($mujeres));

    if (isset($mujer['imagen'])
        && is_string($mujer['imagen'])
        && preg_match('~^img/[a-f0-9]{32}\.(?:jpg|png|gif|webp)$~', $mujer['imagen'])) {
        $rutaImagen = __DIR__ . '/' . $mujer['imagen'];
        if (is_file($rutaImagen) && !unlink($rutaImagen)) {
            error_log('No se pudo borrar la imagen asociada a la publicación ' . $idPublicacion . '.');
        }
    }

    header('Location: index.php?eliminada=1');
    exit;
} catch (RuntimeException $exception) {
    http_response_code(500);
    exit(escapar($exception->getMessage()));
}
