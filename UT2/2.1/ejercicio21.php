<?php
function intercambiar(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

$x = 10;
$y = 20;

$xOriginal = $x;
$yOriginal = $y;

intercambiar($x, $y);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 21</title>
</head>
<body>
    <h1>Ejercicio 21</h1>
    <p>Valores iniciales: $x = <?php echo $xOriginal; ?>, $y = <?php echo $yOriginal; ?></p>
    <p>Valores tras intercambiar(&$a, &$b): $x = <?php echo $x; ?>, $y = <?php echo $y; ?></p>
</body>
</html>