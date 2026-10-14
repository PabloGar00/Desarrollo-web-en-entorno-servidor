
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dato2'])) {
        require 'formulario01.php';
    
    
    die;
    }
    var_dump($_POST);
}
?><!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de concepto de formulario</title>
</head>
<body>
    <h1>Página 2</h1>
    <form method="POST">
      <label for="dato2">Dato2:</label><input name="dato2">
        <button>Enviar</button>
    </form>
</body>
</html>
