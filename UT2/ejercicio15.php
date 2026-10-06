<?php
$numeros = [12, 45, 7, 23, 89, 34, 56, 3];

$maximo = max($numeros);
$minimo = min($numeros);
$suma = array_sum($numeros);
$totalElementos = count($numeros);
$media = $totalElementos > 0 ? $suma / $totalElementos : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 15</title>
</head>
<body>
    <h1>Ejercicio 15</h1>
    <p>Array original: <?php echo implode(", ", $numeros); ?></p>
    <ul>
        <li>Máximo: <?php echo $maximo; ?></li>
        <li>Mínimo: <?php echo $minimo; ?></li>
        <li>Suma: <?php echo $suma; ?></li>
        <li>Media: <?php echo number_format($media, 2); ?></li>
    </ul>
</body>
</html>