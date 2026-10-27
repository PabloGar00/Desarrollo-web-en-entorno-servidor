
<?php
$titulo = "";
$comentario = "";
$caracteres = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"] ?? "");
    $comentario = trim($_POST["comentario"] ?? "");
    $caracteres = strlen($comentario);
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
    <h1>Ejercicio 15</h1>

    <form method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>

        <br><br>

        <label for="comentario">Comentario:</label>
        <br>
        <textarea name="comentario" id="comentario" rows="5" cols="40" required><?php echo htmlspecialchars($comentario); ?></textarea>

        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>" . htmlspecialchars($titulo) . "</h2>";
        echo "<p>" . nl2br(htmlspecialchars($comentario)) . "</p>";
        echo "<p>Numero de caracteres: $caracteres</p>";
    }
    ?>
</body>
</html>
