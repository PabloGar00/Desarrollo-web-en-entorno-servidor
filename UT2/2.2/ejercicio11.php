
<?php
$aficiones = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aficiones = $_POST["aficiones"] ?? [];
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
    <h1>Ejercicio 11</h1>

    <form method="POST">
        <p>Selecciona tus aficiones:</p>

        <input type="checkbox" name="aficiones[]" id="leer" value="Leer">
        <label for="leer">Leer</label>

        <br>

        <input type="checkbox" name="aficiones[]" id="musica" value="Musica">
        <label for="musica">Musica</label>

        <br>

        <input type="checkbox" name="aficiones[]" id="deporte" value="Deporte">
        <label for="deporte">Deporte</label>

        <br>

        <input type="checkbox" name="aficiones[]" id="cine" value="Cine">
        <label for="cine">Cine</label>

        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($aficiones)) {
            echo "<p>No has seleccionado ninguna aficion</p>";
        } else {
            echo "<p>Tus aficiones seleccionadas son:</p>";
            echo "<ul>";

            foreach ($aficiones as $aficion) {
                echo "<li>" . htmlspecialchars($aficion) . "</li>";
            }

            echo "</ul>";
        }
    }
    ?>
</body>
</html>
