<?php
require_once __DIR__ . '/comun.php';

if (usuario_actual() !== null) {
    header('Location: index.php');
    exit;
}

$error = null;
$modo = $_POST['modo'] ?? 'entrar';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!comprobar_token_csrf()) {
            throw new RuntimeException('La sesión del formulario ha caducado. Recarga la página e inténtalo de nuevo.');
        }

        $nombre = trim((string) ($_POST['usuario'] ?? ''));
        $contrasena = (string) ($_POST['contrasena'] ?? '');
        if ($nombre === '' || $contrasena === '') {
            throw new RuntimeException('Completa el nombre de usuario y la contraseña.');
        }

        $usuarios = leer_json(RUTA_USUARIOS);
        if ($modo === 'registrar') {
            if (!preg_match('/^[\p{L}\p{N}_.-]{3,30}$/u', $nombre)) {
                throw new RuntimeException('El usuario debe tener entre 3 y 30 caracteres: letras, números, punto, guion o guion bajo.');
            }
            if (strlen($contrasena) < 8) {
                throw new RuntimeException('La contraseña debe tener al menos 8 caracteres.');
            }

            foreach ($usuarios as $usuario) {
                if (isset($usuario['usuario']) && strcasecmp((string) $usuario['usuario'], $nombre) === 0) {
                    throw new RuntimeException('Ese nombre de usuario ya está registrado.');
                }
            }

            $usuarios[] = [
                'usuario' => $nombre,
                'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
            ];
            guardar_json(RUTA_USUARIOS, $usuarios);
        } elseif ($modo === 'entrar') {
            $encontrado = null;
            foreach ($usuarios as $usuario) {
                if (isset($usuario['usuario'], $usuario['contrasena'])
                    && strcasecmp((string) $usuario['usuario'], $nombre) === 0
                    && password_verify($contrasena, (string) $usuario['contrasena'])) {
                    $encontrado = (string) $usuario['usuario'];
                    break;
                }
            }
            if ($encontrado === null) {
                throw new RuntimeException('Usuario o contraseña incorrectos.');
            }
            $nombre = $encontrado;
        } else {
            throw new RuntimeException('Operación no válida.');
        }

        session_regenerate_id(true);
        $_SESSION['usuario'] = $nombre;
        header('Location: index.php');
        exit;
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
    }
}

mostrar_cabecera('Acceso');
?>
<section class="formulario">
    <p class="etiqueta">Comunidad</p>
    <h1>Comparte una historia</h1>
    <p>Regístrate o inicia sesión para añadir imágenes y descripciones a la galería.</p>
    <?php if ($error !== null): ?>
        <p class="alerta error"><?= escapar($error) ?></p>
    <?php endif; ?>
    <div class="formularios-acceso">
        <form method="post" action="login.php">
            <h2>Iniciar sesión</h2>
            <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
            <input type="hidden" name="modo" value="entrar">
            <label for="usuario-entrar">Usuario</label>
            <input id="usuario-entrar" name="usuario" autocomplete="username" required>
            <label for="contrasena-entrar">Contraseña</label>
            <input id="contrasena-entrar" type="password" name="contrasena" autocomplete="current-password" required>
            <button type="submit">Entrar</button>
        </form>
        <form method="post" action="login.php">
            <h2>Crear cuenta</h2>
            <input type="hidden" name="token_csrf" value="<?= escapar(token_csrf()) ?>">
            <input type="hidden" name="modo" value="registrar">
            <label for="usuario-registro">Usuario</label>
            <input id="usuario-registro" name="usuario" minlength="3" maxlength="30" autocomplete="username" required>
            <label for="contrasena-registro">Contraseña (mínimo 8 caracteres)</label>
            <input id="contrasena-registro" type="password" name="contrasena" minlength="8" autocomplete="new-password" required>
            <button type="submit">Registrarme</button>
        </form>
    </div>
</section>
<?php mostrar_pie(); ?>