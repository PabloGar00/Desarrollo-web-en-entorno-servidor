
<?php
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $edad = $_POST["edad"] ?? "";

    if ($nombre == "" || $edad == "" || !is_numeric($edad) || $edad < 0) {
        $mensaje = "Introduce un nombre y una edad validos";
    } elseif ($edad < 18) {
        $mensaje = "No puedes acceder";
    } else {
        $mensaje = "Bienvenido, " . htmlspecialchars($nombre);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 7</h1>

    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" min="0" required>

        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($mensaje != "") {
        echo "<p>$mensaje</p>";
    }
    ?>
</body>
</html>
