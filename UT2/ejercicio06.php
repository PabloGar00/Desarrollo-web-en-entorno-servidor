<?php
    $numero1 = 10;
    $numero2 = 5;

    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 6</title>
</head>
<body>
    <h1>Ejercicio 6</h1>
    <?php if ($numero1 % 2 == 0) {
        echo "<p>El número $numero1 es par</p>";
    } else {
        echo "<p>El número $numero1 es impar</p>";
    }
    if ($numero2 % 2 == 0) {
        echo "<p>El número $numero2 es par</p>";
    } else {
        echo "<p>El número $numero2 es impar</p>";
    } ?>
</body>
</html>