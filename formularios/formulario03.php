
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["dato3"] = $_POST["dato3"] ?? "";

    if (isset($_POST["anterior"])) {
        header("Location: formulario2.php");
        exit;
    }

    if (isset($_POST["primero"])) {
        header("Location: formulario1.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario 3</title>
</head>
<body>
    <h2>Formulario 3</h2>

    <form method="post">
        Dato 3:

        <input type="radio" name="dato3" value="Opcion1"
        <?= ($_SESSION["dato3"] ?? "") == "Opcion1" ? "checked" : "" ?>> Opcion1

        <input type="radio" name="dato3" value="Opcion2"
        <?= ($_SESSION["dato3"] ?? "") == "Opcion2" ? "checked" : "" ?>> Opcion2

        <br><br>

        <button type="submit" name="anterior">Anterior</button>
        <button type="submit" name="primero">Formulario 1</button>
    </form>
</body>
</html>
