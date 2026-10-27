
<?php
$resultado = "";

if (isset($_POST['numero1']) && isset($_POST['numero2']) && isset($_POST['operacion'])) {
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];

    switch ($operacion) {
        case 'suma':
            $resultado = "La suma de $numero1 y $numero2 es: " . ($numero1 + $numero2);
            break;

        case 'resta':
            $resultado = "La resta de $numero1 y $numero2 es: " . ($numero1 - $numero2);
            break;

        case 'multiplicacion':
            $resultado = "La multiplicacion de $numero1 y $numero2 es: " . ($numero1 * $numero2);
            break;

        case 'division':
            if ($numero2 == 0) {
                $resultado = "No se puede dividir entre cero";
            } else {
                $resultado = "La division de $numero1 entre $numero2 es: " . ($numero1 / $numero2);
            }
            break;
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
    <h1>Ejercicio 4</h1>

    <form method="POST">
        <label for="numero1">Numero 1:</label>
        <input name="numero1" id="numero1" type="number" step="any" required>

        <label for="numero2">Numero 2:</label>
        <input name="numero2" id="numero2" type="number" step="any" required>

        <label for="operacion">Operacion:</label>
        <select name="operacion" id="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicacion</option>
            <option value="division">Division</option>
        </select>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($resultado != "") {
        echo "<p>$resultado</p>";
    }
    ?>
</body>
</html>
