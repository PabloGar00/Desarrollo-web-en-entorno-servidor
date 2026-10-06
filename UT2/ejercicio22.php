<?php
function estadisticas(array $numeros) {
    if (empty($numeros)) {
        throw new Exception("El array de números no puede estar vacío.");
    }

    $minimo = min($numeros);
    $maximo = max($numeros);
    $suma = array_sum($numeros);
    $media = $suma / count($numeros);

    return [
        "minimo" => $minimo,
        "maximo" => $maximo,
        "suma" => $suma,
        "media" => $media
    ];
}

$datos = [15, 42, 8, 23, 91, 4];
$resultado = null;
$error = null;

try {
    $resultado = estadisticas($datos);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 22</title>
</head>
<body>
    <h1>Ejercicio 22</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php else: ?>
        <p>Datos analizados: <?php echo implode(", ", $datos); ?></p>
        <ul>
            <li>Mínimo: <?php echo $resultado["minimo"]; ?></li>
            <li>Máximo: <?php echo $resultado["maximo"]; ?></li>
            <li>Suma: <?php echo $resultado["suma"]; ?></li>
            <li>Media: <?php echo number_format($resultado["media"], 2); ?></li>
        </ul>
    <?php endif; ?>
</body>
</html>