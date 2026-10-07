<?php
function esPar($n) {
    return $n % 2 === 0;
}

function factorial($n) {
    if ($n < 0) {
        return null;
    }
    $resultado = 1;
    for ($i = 1; $i <= $n; $i++) {
        $resultado *= $i;
    }
    return $resultado;
}

function esPrimo($n) {
    if ($n <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }
    return true;
}

$numerosPrueba = [4, 7, 5, 0, 13];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 18</title>
</head>
<body>
    <h1>Ejercicio 18</h1>
    <ul>
        <?php foreach ($numerosPrueba as $num): ?>
            <li>
                <strong>Número <?php echo $num; ?>:</strong>
                <?php echo esPar($num) ? "Es par" : "Es impar"; ?>, 
                Factorial = <?php echo factorial($num); ?>, 
                <?php echo esPrimo($num) ? "Es primo" : "No es primo"; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>