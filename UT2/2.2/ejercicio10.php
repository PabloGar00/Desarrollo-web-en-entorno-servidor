
<?php
$errores = [];
$usuario = "";
$hash = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";
    $confirmacion = $_POST["confirmacion"] ?? "";

    if ($usuario == "") {
        $errores[] = "El usuario no puede estar vacio";
    }

    if (strlen($contrasena) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres";
    }

    if ($contrasena != $confirmacion) {
        $errores[] = "Las contraseñas no coinciden";
    }

    if (empty($errores)) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
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
    <h1>Ejercicio 10</h1>

    <?php
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
    } elseif ($hash != "") {
        echo "<p>Registro realizado correctamente</p>";
        echo "<p>Usuario: " . htmlspecialchars($usuario) . "</p>";
        echo "<p>Hash de la contraseña: " . htmlspecialchars($hash) . "</p>";
    }
    ?>

    <form method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>

        <br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <br><br>

        <label for="confirmacion">Confirmar contraseña:</label>
        <input type="password" name="confirmacion" id="confirmacion" required>

        <br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
