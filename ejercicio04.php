<?php
    $cadena = "123";
    $cadena2 = "3.14";
    $cadena3 = "abc";

    $numero1 = (int)$cadena;
    $numero2 = (float)$cadena2;
    $numero3 = (int)$cadena3;
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 4
    </title>
</head>
<body>
    <h1>Ejercicio 4</h1>
    <p>Cadena 1: <?= $cadena ?>, convertida a entero: <?= $numero1 ?></p>
    <p>Cadena 2: <?= $cadena2 ?>, convertida a flotante: <?= $numero2 ?></p>
    <p>Cadena 3: <?= $cadena3 ?>, convertida a entero: <?= $numero3 ?></p>
</body>
</html>