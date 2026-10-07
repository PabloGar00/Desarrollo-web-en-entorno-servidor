<?php
$sumaWhile = 0;
$i = 1;
while ($i <= 100) {
    $sumaWhile += $i;
    $i++;
}

$sumaFor = 0;
for ($j = 1; $j <= 100; $j++) {
    $sumaFor += $j;
}

$coinciden = ($sumaWhile === $sumaFor);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 10</title>
</head>
<body>
    <h1>Ejercicio 10</h1>
    <p>Suma con bucle while: <?php echo $sumaWhile; ?></p>
    <p>Suma con bucle for: <?php echo $sumaFor; ?></p>
    <p>
        <?php if ($coinciden): ?>
            Los resultados coinciden correctamente.
        <?php else: ?>
            Los resultados no coinciden.
        <?php endif; ?>
    </p>
</body>
</html>