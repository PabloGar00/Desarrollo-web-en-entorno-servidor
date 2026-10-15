<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
        <h1>Ejercicio 2</h1>
    <form method=POST>
      <label for="nombre">Nombre:</label><input name="nombre">
        <button>Enviar</button>
        <?php
        if ($_POST) {
            echo "<p>Hola, " . $_POST['nombre'] . "!</p>";
        }
        ?>
</body>
</html>