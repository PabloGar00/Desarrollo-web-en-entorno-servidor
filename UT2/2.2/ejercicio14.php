
<?php
$lenguajes = ["PHP", "Java", "Python", "JavaScript", "C++"];
$seleccionados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seleccionados = $_POST["lenguajes"] ?? [];
    $seleccionados = array_intersect($seleccionados, $lenguajes);
    $resultado = implode(", ", $seleccionados);
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
    <h1>Ejercicio 14</h1>

    <form method="POST">
        <label for="lenguajes">Selecciona los lenguajes de programación:</label>

        <br><br>

        <select name="lenguajes[]" id="lenguajes" multiple>
            <?php
            foreach ($lenguajes as $lenguaje) {
                echo "<option value=\"" . htmlspecialchars($lenguaje) . "\">" . htmlspecialchars($lenguaje) . "</option>";
            }
            ?>
        </select>

        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($seleccionados)) {
            echo "<p>No has seleccionado ningún lenguaje</p>";
        } else {
            echo "<p>Lenguajes seleccionados: " . htmlspecialchars($resultado) . "</p>";
        }
    }
    ?>
</body>
</html>
