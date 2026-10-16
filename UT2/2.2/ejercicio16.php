
<?php
$respuestasCorrectas = [
    "pregunta1" => "Madrid",
    "pregunta2" => "PHP",
    "pregunta3" => "HTML"
];

$puntuacion = 0;
$respuestas = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuestas = $_POST;

    foreach ($respuestasCorrectas as $pregunta => $respuestaCorrecta) {
        if (isset($respuestas[$pregunta]) && $respuestas[$pregunta] == $respuestaCorrecta) {
            $puntuacion++;
        }
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
    <h1>Ejercicio 16</h1>

    <form method="POST">
        <p>1. ¿Cuál es la capital de España?</p>
        <input type="radio" name="pregunta1" id="madrid" value="Madrid" required>
        <label for="madrid">Madrid</label>
        <br>
        <input type="radio" name="pregunta1" id="barcelona" value="Barcelona">
        <label for="barcelona">Barcelona</label>
        <br>
        <input type="radio" name="pregunta1" id="sevilla" value="Sevilla">
        <label for="sevilla">Sevilla</label>

        <p>2. ¿Qué lenguaje se utiliza en este ejercicio?</p>
        <input type="radio" name="pregunta2" id="php" value="PHP" required>
        <label for="php">PHP</label>
        <br>
        <input type="radio" name="pregunta2" id="python" value="Python">
        <label for="python">Python</label>
        <br>
        <input type="radio" name="pregunta2" id="java" value="Java">
        <label for="java">Java</label>

        <p>3. ¿Qué lenguaje se utiliza para estructurar páginas web?</p>
        <input type="radio" name="pregunta3" id="html" value="HTML" required>
        <label for="html">HTML</label>
        <br>
        <input type="radio" name="pregunta3" id="sql" value="SQL">
        <label for="sql">SQL</label>
        <br>
        <input type="radio" name="pregunta3" id="php3" value="PHP">
        <label for="php3">PHP</label>

        <br><br>

        <button type="submit">Corregir</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>Resultado</h2>";
        echo "<p>Has obtenido $puntuacion de 3 puntos.</p>";
    }
    ?>
</body>
</html>
