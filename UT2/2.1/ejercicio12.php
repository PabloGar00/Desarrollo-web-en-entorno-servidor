<?php
$contador = 10;
$cuentaAtras = [];

do {
    $cuentaAtras[] = $contador;
    $contador--;
} while ($contador >= 1);

$resultado = implode(", ", $cuentaAtras);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 12</title>
</head>
<body>
    <h1>Ejercicio 12</h1>
    <p><?php echo $resultado; ?></p>
    <h2>¡Despegue!</h2>
</body>
</html>