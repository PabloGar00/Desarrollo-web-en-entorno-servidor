<?php
function factorial($n) {
    if (!is_int($n)) {
        throw new Exception("El valor debe ser un número entero.");
    }
    if ($n < 0) {
        throw new Exception("El número no puede ser negativo.");
    }
    if ($n > 20) {
        throw new Exception("El número excede el límite permitido (máximo 20).");
    }

    if ($n === 0 || $n === 1) {
        return 1;
    }

    return $n * factorial($n - 1);
}

$numero = 5;
$resultado = null;
$error = null;

try {
    $resultado = factorial($numero);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 23</title>
</head>
<body>
    <h1>Ejercicio 23</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php else: ?>
        <p>El factorial de <?php echo $numero; ?> es: <?php echo $resultado; ?></p>
    <?php endif; ?>
</body>
</html>