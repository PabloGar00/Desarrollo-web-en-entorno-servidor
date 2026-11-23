<?php
require_once __DIR__ . '/comun.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'comentar') {
    try {
        if (usuario_actual() === null) {
            header('Location: login.php');
            exit;
        }
        if (!comprobar_token_csrf()) {
            throw new RuntimeException('La sesión del formulario ha caducado. Recarga la página e inténtalo de nuevo.');
        }

        $idPublicacion = filter_var($_POST['id_publicacion'] ?? null, FILTER_VALIDATE_INT);
        $comentario = trim((string) ($_POST['comentario'] ?? ''));
        if ($idPublicacion === false || $idPublicacion === null || $idPublicacion < 0) {
            throw new RuntimeException('La publicación seleccionada no es válida.');
        }
        if ($comentario === '' || mb_strlen($comentario) > 1000) {
            throw new RuntimeException('El comentario debe tener entre 1 y 1000 caracteres.');
        }

        $mujeres = leer_json(RUTA_MUJERES);
        if (!isset($mujeres[$idPublicacion]) || !is_array($mujeres[$idPublicacion])) {
            throw new RuntimeException('La publicación ya no existe.');
        }
        if (!isset($mujeres[$idPublicacion]['comentarios']) || !is_array($mujeres[$idPublicacion]['comentarios'])) {
            $mujeres[$idPublicacion]['comentarios'] = [];
        }
        $mujeres[$idPublicacion]['comentarios'][] = [
            'texto' => $comentario,
            'autor' => usuario_actual(),
            'fecha' => date(DATE_ATOM),
        ];
        guardar_json(RUTA_MUJERES, $mujeres);
        header('Location: index.php?comentado=1#publicacion-' . $idPublicacion);
        exit;
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
    }
}

try {
    $mujeres = leer_json(RUTA_MUJERES);
} catch (RuntimeException $exception) {
    $mujeres = [];
    $error = $exception->getMessage();
}

mostrar_cabecera('Galería');
?>
<section class="intro">
    <p class="etiqueta">Referentes que inspiran</p>
    <h1>Mujeres en la informática</h1>
    <p>Conoce las historias de mujeres que han contribuido al mundo de la tecnología.</p>
    <?php if (usuario_actual() !== null): ?>
        <a class="boton" href="mujeres_fin.php">Compartir una historia</a>
    <?php else: ?>
        <p class="nota">La galería es pública. Para compartir una historia, <a href="login.php">regístrate o inicia sesión</a>.</p>
    <?php endif; ?>
</section>

<?php if (isset($_GET['publicada'])): ?>
    <p class="alerta exito">La historia se ha publicado correctamente.</p>
<?php endif; ?>
<?php if (isset($_GET['editada'])): ?>
    <p class="alerta exito">La publicación se ha actualizado correctamente.</p>
<?php endif; ?>
<?php if (isset($_GET['eliminada'])): ?>
    <p class="alerta exito">La publicación se ha eliminado correctamente.</p>
<?php endif; ?>
<?php if (isset($_GET['comentado'])): ?>
    <p class="alerta exito">Tu comentario se ha publicado correctamente.</p>
<?php endif; ?>
<?php if ($error !== null): ?>
    <p class="alerta error"><?= escapar($error) ?></p>
<?php endif; ?>
<?php if ($mujeres === []): ?>
    <section class="vacio">
        <h2>Aún no hay historias</h2>
        <p>Cuando se publiquen, aparecerán aquí para que todo el mundo pueda verlas.</p>
    </section>
<?php else: ?>
    <section class="galeria" aria-label="Mujeres destacadas">
        <?php foreach (array_reverse($mujeres, true) as $idPublicacion => $mujer): ?>
            <?php if (!is_array($mujer) || !isset($mujer['nombre'], $mujer['descripcion'], $mujer['imagen'])) {
                continue;
            } ?>
            <article class="tarjeta" id="publicacion-<?= (int) $idPublicacion ?>">
                <img src="<?= escapar((string) $mujer['imagen']) ?>" alt="Imagen de <?= escapar((string) $mujer['nombre']) ?>">
                <div class="tarjeta-contenido">
                    <h2><?= escapar((string) $mujer['nombre']) ?></h2>
                    <p><?= nl2br(escapar((string) $mujer['descripcion'])) ?></p>
                    <?php if (!empty($mujer['autor'])): ?>
                        <p class="autor">Compartido por <?= escapar((string) $mujer['autor']) ?></p>
                    <?php endif; ?>
                    <?php if (es_autor_publicacion($mujer)): ?>
                        <div class="acciones-publicacion">
                            <a class="enlace-editar" href="editar.php?id=<?= (int) $idPublicacion ?>">Editar publicación</a>
                            <form method="post" action="eliminar.php" onsubmit="return confirm('¿Seguro que quieres eliminar esta publicación y sus comentarios?');">
                                <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
                                <input type="hidden" name="id_publicacion" value="<?= (int) $idPublicacion ?>">
                                <button class="boton-eliminar" type="submit">Eliminar publicación</button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <section class="comentarios" aria-label="Comentarios">
                        <h3>Comentarios</h3>
                        <?php if (!empty($mujer['comentarios']) && is_array($mujer['comentarios'])): ?>
                            <?php foreach ($mujer['comentarios'] as $comentario): ?>
                                <?php if (!is_array($comentario) || !isset($comentario['texto'], $comentario['autor'])) {
                                    continue;
                                } ?>
                                <article class="comentario">
                                    <p><?= nl2br(escapar((string) $comentario['texto'])) ?></p>
                                    <p class="autor"><?= escapar((string) $comentario['autor']) ?>
                                        <?php if (!empty($comentario['fecha'])): ?>
                                            · <?= escapar((string) $comentario['fecha']) ?>
                                        <?php endif; ?>
                                    </p>
                                </article>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="autor">Todavía no hay comentarios.</p>
                        <?php endif; ?>
                        <?php if (usuario_actual() !== null): ?>
                            <form class="formulario-comentario" method="post" action="index.php#publicacion-<?= (int) $idPublicacion ?>">
                                <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
                                <input type="hidden" name="accion" value="comentar">
                                <input type="hidden" name="id_publicacion" value="<?= (int) $idPublicacion ?>">
                                <label for="comentario-<?= (int) $idPublicacion ?>">Añadir un comentario</label>
                                <textarea id="comentario-<?= (int) $idPublicacion ?>" name="comentario" maxlength="1000" rows="3" required></textarea>
                                <button type="submit">Comentar</button>
                            </form>
                        <?php else: ?>
                            <p class="autor"><a href="login.php">Inicia sesión</a> para comentar.</p>
                        <?php endif; ?>
                    </section>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
<?php mostrar_pie(); ?>