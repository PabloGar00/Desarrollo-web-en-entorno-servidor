<?php
$contador = 0;

function incrementar() {
    global $contador;
    $contador++;
}

incrementar();
incrementar();
incrementar();

function contarLlamadas() {
    static $total = 0;
    $total++;
    return $total;
}

$llamada1 = contarLlamadas();
$llamada2 = contarLlamadas();
$llamada3 = contarLlamadas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 19</title>
</head>
<body>
    <h1>Ejercicio 19</h1>
    <p>Valor final de $contador (global): <?php echo $contador; ?></p>
    <p>Llamadas registradas con static: <?php echo $llamada3; ?></p>
</body>
</html>