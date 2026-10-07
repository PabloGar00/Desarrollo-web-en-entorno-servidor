<?php
    $nombre = "Pablo";
    $edad = "19";
    $altura = "1.80";
    $esAlumno = true ;
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 02</title>
</head>
<body>
    <h1>Ejercicio 02</h1>
    <ul>
        <li><?= $nombre . " es un " . gettype($nombre) ?></li>
        <li><?= $edad . " es un " . gettype($edad) ?></li>
        <li><?= $altura . " es un " . gettype($altura) ?></li>
        <li><?= $esAlumno . " es un " . gettype($esAlumno) ?></li>
    </ul>
</body>
</html>