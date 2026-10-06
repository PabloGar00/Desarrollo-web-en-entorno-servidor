<?php
function sumar_traza(array $matriz) {
    $filas = count($matriz);
    if ($filas === 0) {
        return 0;
    }

    $suma = 0;
    for ($i = 0; $i < $filas; $i++) {
        if (!isset($matriz[$i][$i])) {
            throw new Exception("La matriz debe ser cuadrada o contener elementos en la diagonal principal.");
        }

        $valor = $matriz[$i][$i];
        if (!is_numeric($valor)) {
            throw new Exception("El elemento en la posición [$i][$i] no es de tipo numérico.");
        }

        $suma += $valor;
    }

    return $suma;
}

$matrizValida = [
    [5, 2, 9],
    [1, 8, 3],
    [4, 7, 6]
];

$matrizInvalida = [
    [5, 2, 9],
    [1, "texto", 3],
    [4, 7, 6]
];

$resultadoValido = null;
$errorValido = null;

try {
    $resultadoValido = sumar_traza($matrizValida);
} catch (Exception $e) {
    $errorValido = $e->getMessage();
}

$resultadoInvalido = null;
$errorInvalido = null;

try {
    $resultadoInvalido = sumar_traza($matrizInvalida);
} catch (Exception $e) {
    $errorInvalido = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 26</title>
</head>
<body>
    <h1>Ejercicio 26</h1>

    <h2>Prueba 1: Matriz Válida</h2>
    <?php if ($errorValido): ?>
        <p style="color: red;"><?php echo $errorValido; ?></p>
    <?php else: ?>
        <p>Suma de la traza diagonal: <?php echo $resultadoValido; ?></p>
    <?php endif; ?>

    <h2>Prueba 2: Matriz con Elemento No Numérico</h2>
    <?php if ($errorInvalido): ?>
        <p style="color: red;"><?php echo $errorInvalido; ?></p>
    <?php else: ?>
        <p>Suma de la traza diagonal: <?php echo $resultadoInvalido; ?></p>
    <?php endif; ?>
</body>
</html>