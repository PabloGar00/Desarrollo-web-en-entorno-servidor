<?php
$numero = 7;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 9</title>
</head>
<body>
    <h1>Ejercicio 9</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Operación</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td><?php echo "$numero x $i"; ?></td>
                    <td><?php echo $numero * $i; ?></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>