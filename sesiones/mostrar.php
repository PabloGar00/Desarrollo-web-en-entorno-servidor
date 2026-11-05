<?php
session_start();
$usuario = $_SESSION['usuario'] ?? 'Invitado';
$visitas = $_SESSION['visitas'] ?? 0;
$visitas++;
$_SESSION['visitas'] = $visitas;
$_SESSION = [];

if (isset($_POST['borrar_sesion'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
    $parametros = session_get_cookie_params();
    setcookie(session_name(), '', [
        'expires' => time() - 3600,
        'path' => $parametros['path'],
        'domain' => $parametros['domain'],
        'secure' => $parametros['secure'],
        'httponly' => $parametros['httponly'],
        'samesite' => $parametros['samesite'] ?? 'Lax'
    ]);
}
    session_destroy();
    header('Location: login.php');
    echo 'Sesión borrada';
    die();
}
echo 'Hola ' . htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8');
echo '<br>';
echo 'se ha visitado esta página ' . htmlspecialchars($visitas, ENT_QUOTES, 'UTF-8') . ' veces.';
echo '<br>';
echo '<form method="post">';
echo '<button type="submit" name="borrar_sesion" value="1">Borrar sesion</button>';
echo '</form>';