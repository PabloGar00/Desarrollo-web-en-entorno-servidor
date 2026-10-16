
<?php
$errores = [];
$nombre = "";
$correo = "";
$edad = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $edad = $_POST["edad"] ?? "";

    if ($nombre == "") {
        $errores[] = "El nombre no puede estar vacio";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electronico no es valido";
    }

    if ($edad === "" || !is_numeric($edad) || $edad < 0 || $edad > 120) {
        $errores[] = "La edad debe ser un numero entre 0 y 120";
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
    <h1>Ejercicio 8</h1>

    <?php
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p>Registro realizado correctamente</p>";
    }
    ?>

    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>">

        <br><br>

        <label for="correo">Correo electronico:</label>
        <input type="text" name="correo" id="correo" value="<?php echo htmlspecialchars($correo); ?>">

        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="<?php echo htmlspecialchars($edad); ?>">

        <br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
