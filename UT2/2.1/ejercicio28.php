<?php
function extraer(array $matriz, array $coordenadas) {
    if (!isset($coordenadas[0][0], $coordenadas[0][1], $coordenadas[1][0], $coordenadas[1][1])) {
        throw new Exception("Estructura de coordenadas incorrecta.");
    }

    $filaInicio = $coordenadas[0][0];
    $colInicio  = $coordenadas[0][1];
    $filaFin    = $coordenadas[1][0];
    $colFin     = $coordenadas[1][1];

    $numFilas = count($matriz);
    if ($numFilas === 0) {
        throw new Exception("La matriz está vacía.");
    }

    if ($filaInicio < 0 || $filaFin >= $numFilas || $filaInicio > $filaFin) {
        throw new Exception("Coordenadas de filas fuera de rango.");
    }

    $submatriz = [];
    for ($i = $filaInicio; $i <= $filaFin; $i++) {
        $numCols = count($matriz[$i]);
        if ($colInicio < 0 || $colFin >= $numCols || $colInicio > $colFin) {
            throw new Exception("Coordenadas de columnas fuera de rango en la fila $i.");
        }

        $filaResultante = [];
        for ($j = $colInicio; $j <= $colFin; $j++) {
            $filaResultante[] = $matriz[$i][$j];
        }
        $submatriz[] = $filaResultante;
    }

    return $submatriz;
}

$matrizOriginal = [
    [10, 11, 12, 13, 14],
    [15, 16, 17, 18, 19],
    [20, 21, 22, 23, 24],
    [25, 26, 27, 28, 29]
];

$coordenadasValidas = [[0, 2], [2, 4]];
$coordenadasInvalidas = [[0, 2], [5, 4]];

$submatrizValida = null;
$errorValido = null;

try {
    $submatrizValida = extraer($matrizOriginal, $coordenadasValidas);
} catch (Exception $e) {
    $errorValido = $e->getMessage();
}

$submatrizInvalida = null;
$errorInvalido = null;

try {
    $submatrizInvalida = extraer($matrizOriginal, $coordenadasInvalidas);
} catch (Exception $e) {
    $errorInvalido = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 28</title>
</head>
<body>
    <h1>Ejercicio 28</h1>

    <h2>Matriz Original (4x5)</h2>
    <table border="1">
        <tbody>
            <?php foreach ($matrizOriginal as $fila): ?>
                <tr>
                    <?php foreach ($fila as $celda): ?>
                        <td><?php echo $celda; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Prueba 1: Extraer Coordenadas [[0,2], [2,4]]</h2>
    <?php if ($errorValido): ?>
        <p style="color: red;"><?php echo $errorValido; ?></p>
    <?php else: ?>
        <table border="1">
            <tbody>
                <?php foreach ($submatrizValida as $fila): ?>
                    <tr>
                        <?php foreach ($fila as $celda): ?>
                            <td><?php echo $celda; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2>Prueba 2: Extraer Coordenadas [[0,2], [5,4]] (Fuera de rango)</h2>
    <?php if ($errorInvalido): ?>
        <p style="color: red;"><?php echo $errorInvalido; ?></p>
    <?php else: ?>
        <p>Extracción completada.</p>
    <?php endif; ?>
</body>
</html>