<?php
    $nota = 7;

    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 7</title>
</head>
<body>
    <h1>Ejercicio 7</h1>
    <?php if ($nota == 5) {
        echo "<p>el alumno tiene un suficiente</p>";
    } else {
        echo "<p>El alumno ha suspendido con una nota de $nota</p>";
    } ?>
</body>
</html>