<?php
    $numero = 10;
    $numero2 = 4;
    $suma = $numero + $numero2;
    $resta = $numero - $numero2;
    $multiplicacion = $numero * $numero2;
    $division = $numero / $numero2;
    $resto = $numero % $numero2;
    $potencia = pow($numero, $numero2);
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 03</title>
</head>
<body>
    <h1>Ejercicio 03</h1>
    <p>La suma de <?= $numero ?> y <?= $numero2 ?> es: <?= $suma ?></p>
    <p>La resta de <?= $numero ?> y <?= $numero2 ?> es: <?= $resta ?></p>
    <p>La multiplicación de <?= $numero ?> y <?= $numero2 ?> es: <?= $multiplicacion ?></p>
    <p>La división de <?= $numero ?> y <?= $numero2 ?> es: <?= $division ?></p>
    <p>El resto de la división de <?= $numero ?> y <?= $numero2 ?> es: <?= $resto ?></p>
    <p>La potencia de <?= $numero ?> elevado a <?= $numero2 ?> es: <?= $potencia ?></p>
</body>
</html>