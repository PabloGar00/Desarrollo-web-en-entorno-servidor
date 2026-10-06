<?php
$alumnos = [
    [
        "Nombre" => "Pablo",
        "Edad" => 20,
        "Nota" => 8.5
    ],
    [
        "Nombre" => "Laura",
        "Edad" => 22,
        "Nota" => 9.2
    ],
    [
        "Nombre" => "Carlos",
        "Edad" => 21,
        "Nota" => 7.4
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 16</title>
</head>
<body>
    <h1>Ejercicio 16</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <?php foreach ($alumno as $dato): ?>
                        <td><?php echo $dato; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>