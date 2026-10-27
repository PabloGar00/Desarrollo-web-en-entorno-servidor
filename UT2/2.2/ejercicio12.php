
<?php
$turno = "";
$nivel = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $turno = $_POST["turno"] ?? "";
    $nivel = $_POST["nivel"] ?? "";
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
    <h1>Ejercicio 12</h1>

    <form method="POST">
        <p>Selecciona el turno:</p>

        <input type="radio" name="turno" id="manana" value="Mañana" required>
        <label for="manana">Mañana</label>

        <br>

        <input type="radio" name="turno" id="tarde" value="Tarde">
        <label for="tarde">Tarde</label>

        <br>

        <input type="radio" name="turno" id="noche" value="Noche">
        <label for="noche">Noche</label>

        <p>Selecciona el nivel:</p>

        <input type="radio" name="nivel" id="basico" value="Básico" required>
        <label for="basico">Básico</label>

        <br>

        <input type="radio" name="nivel" id="intermedio" value="Intermedio">
        <label for="intermedio">Intermedio</label>

        <br>

        <input type="radio" name="nivel" id="avanzado" value="Avanzado">
        <label for="avanzado">Avanzado</label>

        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p>Turno seleccionado: " . htmlspecialchars($turno) . "</p>";
        echo "<p>Nivel seleccionado: " . htmlspecialchars($nivel) . "</p>";
    }
    ?>
</body>
</html>
