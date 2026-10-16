
<?php
$ciudades = [
    "Madrid" => "Capital de España",
    "Barcelona" => "Ciudad conocida por la Sagrada Familia",
    "Sevilla" => "Ciudad famosa por su Feria de Abril",
    "Valencia" => "Ciudad conocida por las Fallas",
    "Bilbao" => "Ciudad del norte conocida por el Museo Guggenheim"
];

$ciudad = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ciudad = $_POST["ciudad"] ?? "";
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
    <h1>Ejercicio 13</h1>

    <form method="POST">
        <label for="ciudad">Selecciona una ciudad:</label>

        <select name="ciudad" id="ciudad">
            <?php
            foreach ($ciudades as $nombre => $descripcion) {
                echo "<option value=\"" . htmlspecialchars($nombre) . "\">" . htmlspecialchars($nombre) . "</option>";
            }
            ?>
        </select>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($ciudades[$ciudad])) {
        echo "<p>Ciudad seleccionada: " . htmlspecialchars($ciudad) . "</p>";
        echo "<p>Descripción: " . htmlspecialchars($ciudades[$ciudad]) . "</p>";
    }
    ?>
</body>
</html>
