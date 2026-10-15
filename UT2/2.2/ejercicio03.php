<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form method="POST">
        <label for="numero1">Numero 1:</label><input name="numero1" type="number">
         <label for="numero2">Numero 2:</label><input name="numero2" type="number">
        <button>Enviar</button>
        <?php
        if (isset($_POST['numero1']) && isset($_POST['numero2'])) {
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $suma = $numero1 + $numero2;
            echo "<p>La suma de $numero1 y $numero2 es: $suma</p>";
        }
        ?>
    </form>
</body>
</html>