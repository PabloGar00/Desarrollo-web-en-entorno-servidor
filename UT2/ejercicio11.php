<?php
$n = 20;
$pares = [];

for ($i = 0; $i <= $n; $i++) {
    if ($i % 2 !== 0) {
        continue;
    }
    $pares[] = $i;
}

$resultado = implode(", ", $pares);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 11</title>
</head>
<body>
    <h1>Ejercicio 11</h1>
    <p>Números pares hasta <?php echo $n; ?>:</p>
    <p><?php echo $resultado; ?></p>
</body>
</html>