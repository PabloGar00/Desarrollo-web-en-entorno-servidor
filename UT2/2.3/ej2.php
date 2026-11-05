<?php
$visitas = 0;

if (isset($_POST['reiniciar'])) {
    setcookie('visitas', '', time() - 3600, '/');
    $visitas = 0;
} else {
    if (isset($_COOKIE['visitas'])) {
        $visitas = (int) $_COOKIE['visitas'] + 1;
    } else {
        $visitas = 1;
    }

    setcookie('visitas', $visitas, time() + (7 * 24 * 60 * 60), '/');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
</head>

<body>

    <h1>Contador de visitas</h1>

    <?php
    if ($visitas == 1) {
        echo "<p>Esta es tu primera visita.</p>";
    } else {
        echo "<p>Has visitado esta página $visitas veces.</p>";
    }
    ?>

    <form method="POST" action="">
        <button type="submit" name="reiniciar">Reiniciar contador</button>
    </form>

</body>

</html>