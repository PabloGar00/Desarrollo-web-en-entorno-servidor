<?php
$alumno = [
    "Nombre" => "Pablo",
    "Edad" => 20,
    "Ciclo" => "DAW",
    "Nota Media" => 8.5
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 14</title>
</head>
<body>
    <h1>Ejercicio 14</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumno as $clave => $valor): ?>
                <tr>
                    <td><?php echo $clave; ?></td>
                    <td><?php echo $valor; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>