<?php
    $Iva = 21;
    $precioSinIva = 100;
    $precioConIva = $precioSinIva + ($precioSinIva * $Iva / 100);
    $importeIva = $precioSinIva * $Iva / 100;
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 5</title>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <p>Precio sin IVA: <?= $precioSinIva ?></p>
    <p>IVA: <?= $Iva ?>%</p>
    <p>Importe del IVA: <?= $importeIva ?></p>
    <p>Precio con IVA: <?= $precioConIva ?></p>
</body>
</html>