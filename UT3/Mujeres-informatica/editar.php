<?php
require_once __DIR__ . '/comun.php';

if (usuario_actual() === null) {
    header('Location: login.php');
    exit;
}

$idPublicacion = filter_var($_GET['id'] ?? $_POST['id_publicacion'] ?? null, FILTER_VALIDATE_INT);
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
    if (!es_autor_publicacion($mujeres[$idPublicacion])) {
        http_response_code(403);
        exit('Solo quien creó esta publicación puede modificarla.');
    }
} catch (RuntimeException $exception) {
    http_response_code(500);
    exit(escapar($exception->getMessage()));
}

$error = null;
$imagenSubida = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!comprobar_token_csrf()) {
            throw new RuntimeException('La sesión del formulario ha caducado. Recarga la página e inténtalo de nuevo.');
        }

        $mujeres = leer_json(RUTA_MUJERES);
        if (!isset($mujeres[$idPublicacion]) || !is_array($mujeres[$idPublicacion])) {
            http_response_code(404);
            exit('La publicación ya no existe.');
        }
        if (!es_autor_publicacion($mujeres[$idPublicacion])) {
            http_response_code(403);
            exit('Solo quien creó esta publicación puede modificarla.');
        }

        $nombre = trim((string) ($_POST['nombre'] ?? ''));
        $descripcion = trim((string) ($_POST['descripcion'] ?? ''));
        if ($nombre === '' || mb_strlen($nombre) > 100) {
            throw new RuntimeException('Indica un nombre de hasta 100 caracteres.');
        }
        if ($descripcion === '' || mb_strlen($descripcion) > 3000) {
            throw new RuntimeException('Escribe una descripción de hasta 3000 caracteres.');
        }

        $mujerAnterior = $mujeres[$idPublicacion];
        $mujeres[$idPublicacion]['nombre'] = $nombre;
        $mujeres[$idPublicacion]['descripcion'] = $descripcion;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
            $imagenSubida = guardar_imagen_subida($_FILES['imagen']);
            $mujeres[$idPublicacion]['imagen'] = $imagenSubida;
        }

        guardar_json(RUTA_MUJERES, $mujeres);

        if ($imagenSubida !== null
            && isset($mujerAnterior['imagen'])
            && is_string($mujerAnterior['imagen'])
            && preg_match('~^img/[a-f0-9]{32}\.(?:jpg|png|gif|webp)$~', $mujerAnterior['imagen'])) {
            $imagenAnterior = __DIR__ . '/' . $mujerAnterior['imagen'];
            if (is_file($imagenAnterior)) {
                unlink($imagenAnterior);
            }
        }

        header('Location: index.php?editada=1#publicacion-' . $idPublicacion);
        exit;
    } catch (RuntimeException $exception) {
        if ($imagenSubida !== null && is_file(__DIR__ . '/' . $imagenSubida)) {
            unlink(__DIR__ . '/' . $imagenSubida);
        }
        $error = $exception->getMessage();
    }
}

$mujer = $mujeres[$idPublicacion];
mostrar_cabecera('Editar publicación');
?>
<section class="formulario">
    <p class="etiqueta">Tu publicación</p>
    <h1>Editar historia</h1>
    <p>Puedes cambiar el nombre, la descripción o reemplazar la imagen. Si no eliges otra imagen, se conservará la actual.</p>
    <?php if ($error !== null): ?>
        <p class="alerta error"><?= escapar($error) ?></p>
    <?php endif; ?>
    <form method="post" action="editar.php?id=<?= (int) $idPublicacion ?>" enctype="multipart/form-data">
        <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
        <input type="hidden" name="id_publicacion" value="<?= (int) $idPublicacion ?>">
        <label for="nombre">Nombre de la mujer</label>
        <input id="nombre" name="nombre" maxlength="100" required value="<?= escapar((string) ($_POST['nombre'] ?? $mujer['nombre'])) ?>">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" maxlength="3000" rows="7" required><?= escapar((string) ($_POST['descripcion'] ?? $mujer['descripcion'])) ?></textarea>
        <p>Imagen actual:</p>
        <img class="imagen-actual" src="<?= escapar((string) $mujer['imagen']) ?>" alt="Imagen actual de <?= escapar((string) $mujer['nombre']) ?>">
        <label for="imagen">Cambiar imagen (opcional; JPG, PNG, GIF o WEBP; máximo 5 MB)</label>
        <input id="imagen" type="file" name="imagen" accept="image/jpeg,image/png,image/gif,image/webp">
        <button type="submit">Guardar cambios</button>
        <a href="index.php#publicacion-<?= (int) $idPublicacion ?>">Cancelar</a>
    </form>
</section>
<?php mostrar_pie(); ?>
