
<?php
$errores = [];
$texto = "";
$numero = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = trim($_POST["texto"] ?? "");
    $numero = $_POST["numero"] ?? "";

    if ($texto == "") {
        $errores[] = "El campo de texto no puede estar vacio";
    }

    if ($numero == "" || !is_numeric($numero)) {
        $errores[] = "Introduce un numero valido";
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
    <h1>Ejercicio 6</h1>

    <?php
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p>Formulario enviado correctamente</p>";
    }
    ?>

    <form method="POST">
        <label for="texto">Texto:</label>
        <input type="text" name="texto" id="texto" value="<?php echo htmlspecialchars($texto); ?>">

        <br><br>

        <label for="numero">Numero:</label>
        <input type="number" name="numero" id="numero" value="<?php echo htmlspecialchars($numero); ?>">

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
