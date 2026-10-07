<?php
function totalizar(array $matriz) {
    if (empty($matriz)) {
        return [];
    }

    $numFilas = count($matriz);
    $numColumnas = count($matriz[0]);

    $resultado = [];
    $sumasColumnas = array_fill(0, $numColumnas, 0);

    for ($i = 0; $i < $numFilas; $i++) {
        $sumaFila = 0;
        $filaResultado = [];

        for ($j = 0; $j < $numColumnas; $j++) {
            $valor = $matriz[$i][$j];

            if (!is_numeric($valor)) {
                throw new Exception("El elemento en la posición [$i][$j] no es numérico.");
            }

            $filaResultado[] = $valor;
            $sumaFila += $valor;
            $sumasColumnas[$j] += $valor;
        }

        $filaResultado[] = $sumaFila;
        $resultado[] = $filaResultado;
    }

    $filaTotalColumnas = [];
    $sumaGranTotal = 0;

    for ($j = 0; $j < $numColumnas; $j++) {
        $filaTotalColumnas[] = $sumasColumnas[$j];
        $sumaGranTotal += $sumasColumnas[$j];
    }

    $filaTotalColumnas[] = $sumaGranTotal;
    $resultado[] = $filaTotalColumnas;

    return $resultado;
}

$matrizValida = [
    [10, 20, 30],
    [5,  15, 25],
    [1,   2,  3]
];

$matrizInvalida = [
    [10, 20, 30],
    [5,  "ABC", 25]
];

$resultadoValido = null;
$errorValido = null;

try {
    $resultadoValido = totalizar($matrizValida);
} catch (Exception $e) {
    $errorValido = $e->getMessage();
}

$resultadoInvalido = null;
$errorInvalido = null;

try {
    $resultadoInvalido = totalizar($matrizInvalida);
} catch (Exception $e) {
    $errorInvalido = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 27</title>
</head>
<body>
    <h1>Ejercicio 27</h1>

    <h2>Prueba 1: Matriz Válida con Totalizaciones</h2>
    <?php if ($errorValido): ?>
        <p style="color: red;"><?php echo $errorValido; ?></p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Columna 1</th>
                    <th>Columna 2</th>
                    <th>Columna 3</th>
                    <th>Total Fila</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalFilasRes = count($resultadoValido);
                for ($i = 0; $i < $totalFilasRes; $i++): 
                ?>
                    <tr>
                        <?php 
                        $esFilaTotal = ($i === $totalFilasRes - 1);
                        foreach ($resultadoValido[$i] as $celda): 
                        ?>
                            <td>
                                <?php if ($esFilaTotal): ?>
                                    <strong><?php echo $celda; ?></strong>
                                <?php else: ?>
                                    <?php echo $celda; ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2>Prueba 2: Matriz con Elemento No Numérico</h2>
    <?php if ($errorInvalido): ?>
        <p style="color: red;"><?php echo $errorInvalido; ?></p>
    <?php else: ?>
        <p>Procesada correctamente.</p>
    <?php endif; ?>
</body>
</html>