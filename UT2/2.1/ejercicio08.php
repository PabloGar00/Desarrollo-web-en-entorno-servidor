<?php
$dia = 3;
$nombreDia = "";

switch ($dia) {
    case 1:
        $nombreDia = "Lunes";
        break;
    case 2:
        $nombreDia = "Martes";
        break;
    case 3:
        $nombreDia = "Miércoles";
        break;
    case 4:
        $nombreDia = "Jueves";
        break;
    case 5:
        $nombreDia = "Viernes";
        break;
    case 6:
        $nombreDia = "Sábado";
        break;
    case 7:
        $nombreDia = "Domingo";
        break;
    default:
        $nombreDia = "Error: El número debe estar entre 1 y 7.";
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 8</title>
</head>
<body>
    <h1>Ejercicio 8</h1>
    <p><?php echo $nombreDia; ?></p>
</body>
</html>