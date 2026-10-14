
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["dato1"] = $_POST["dato1"] ?? "";

    if (isset($_POST["siguiente"])) {
        header("Location: formulario2.php");
        exit;
    }

    if (isset($_POST["tercero"])) {
        header("Location: formulario3.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario 1</title>
</head>
<body>
    <h2>Formulario 1</h2>

    <form method="post">
        Dato 1:
        <input type="text" name="dato1"
        value="<?= htmlspecialchars($_SESSION["dato1"] ?? "") ?>">

        <br><br>

        <button type="submit" name="siguiente">Siguiente</button>
        <button type="submit" name="tercero">Formulario 3</button>
    </form>
</body>
</html>
