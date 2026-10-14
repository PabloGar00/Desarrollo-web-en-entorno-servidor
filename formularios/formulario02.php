
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["dato2"] = $_POST["dato2"] ?? "";

    if (isset($_POST["anterior"])) {
        header("Location: formulario1.php");
        exit;
    }

    if (isset($_POST["siguiente"])) {
        header("Location: formulario3.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario 2</title>
</head>
<body>
    <h2>Formulario 2</h2>

    <form method="post">
        Dato 2:
        <select name="dato2">
            <option value="">Selecciona</option>
            <option value="Opcion1" <?= ($_SESSION["dato2"] ?? "") == "Opcion1" ? "selected" : "" ?>>Opcion1</option>
            <option value="Opcion2" <?= ($_SESSION["dato2"] ?? "") == "Opcion2" ? "selected" : "" ?>>Opcion2</option>
            <option value="Opcion3" <?= ($_SESSION["dato2"] ?? "") == "Opcion3" ? "selected" : "" ?>>Opcion3</option>
        </select>

        <br><br>

        <button type="submit" name="anterior">Anterior</button>
        <button type="submit" name="siguiente">Siguiente</button>
    </form>
</body>
</html>
