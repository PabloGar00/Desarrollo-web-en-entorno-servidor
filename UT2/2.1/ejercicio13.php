<?php
$frutas = ["Manzana", "Plátano", "Naranja", "Fresa", "Kiwi"];
$totalFrutas = count($frutas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 13</title>
</head>
<body>
    <h1>Ejercicio 13</h1>
    <p>Total de frutas: <?php echo $totalFrutas; ?></p>
    <ul>
        <?php foreach ($frutas as $fruta): ?>
            <li><?php echo $fruta; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>