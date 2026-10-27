
<?php
$resultado = "";

if (isset($_POST['euros']) && isset($_POST['tasa'])) {
    $euros = $_POST['euros'];
    $tasa = $_POST['tasa'];

    if (is_numeric($euros) && is_numeric($tasa) && $euros >= 0 && $tasa > 0) {
        $dolares = $euros * $tasa;
        $resultado = number_format($dolares, 2, ',', '.');
    } else {
        $resultado = "Introduce valores validos";
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
    <h1>Ejercicio 5</h1>

    <form method="POST">
        <label for="euros">Cantidad en euros:</label>
        <input type="number" name="euros" id="euros" step="any" required>

        <label for="tasa">Tasa de cambio:</label>
        <input type="number" name="tasa" id="tasa" step="any" required>

        <button type="submit">Convertir</button>
    </form>

    <?php
    if ($resultado != "") {
        echo "<p>Resultado en dolares: $resultado $</p>";
    }
    ?>
</body>
</html>
