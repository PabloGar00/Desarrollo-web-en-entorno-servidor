<?php
require_once __DIR__ . '/comun.php';

if (usuario_actual() === null) {
    header('Location: login.php');
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagenSubida = null;
    try {
        if (!comprobar_token_csrf()) {
            throw new RuntimeException('La sesión del formulario ha caducado. Recarga la página e inténtalo de nuevo.');
        }

        $nombre = trim((string) ($_POST['nombre'] ?? ''));
        $descripcion = trim((string) ($_POST['descripcion'] ?? ''));
        if ($nombre === '' || mb_strlen($nombre) > 100) {
            throw new RuntimeException('Indica un nombre de hasta 100 caracteres.');
        }
        if ($descripcion === '' || mb_strlen($descripcion) > 3000) {
            throw new RuntimeException('Escribe una descripción de hasta 3000 caracteres.');
        }
        $imagenSubida = guardar_imagen_subida($_FILES['imagen'] ?? []);

        $mujeres = leer_json(RUTA_MUJERES);
        $mujeres[] = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'imagen' => $imagenSubida,
            'autor' => usuario_actual(),
            'fecha' => date(DATE_ATOM),
        ];
        guardar_json(RUTA_MUJERES, $mujeres);
        header('Location: index.php?publicada=1');
        exit;
    } catch (RuntimeException $exception) {
        if ($imagenSubida !== null && is_file(__DIR__ . '/' . $imagenSubida)) {
            unlink(__DIR__ . '/' . $imagenSubida);
        }
        $error = $exception->getMessage();
    }
}

mostrar_cabecera('Añadir historia');
?>
<section class="formulario">
    <p class="etiqueta">Nueva publicación</p>
    <h1>Añadir una mujer a la galería</h1>
    <p>Comparte una imagen y una descripción para que todas las personas puedan conocer su historia.</p>
    <?php if ($error !== null): ?>
        <p class="alerta error"><?= escapar($error) ?></p>
    <?php endif; ?>
    <form method="post" action="mujeres_fin.php" enctype="multipart/form-data">
        <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
        <label for="nombre">Nombre de la mujer</label>
        <input id="nombre" name="nombre" maxlength="100" required value="<?= escapar((string) ($_POST['nombre'] ?? '')) ?>">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" maxlength="3000" rows="7" required><?= escapar((string) ($_POST['descripcion'] ?? '')) ?></textarea>
        <label for="imagen">Imagen (JPG, PNG, GIF o WEBP; máximo 5 MB)</label>
        <input id="imagen" type="file" name="imagen" accept="image/jpeg,image/png,image/gif,image/webp" required>
        <button type="submit">Publicar en la galería</button>
    </form>
</section>
<?php mostrar_pie(); ?>