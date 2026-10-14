<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dato1'])) {
        require 'formulario02.php';
    die;
    }
    var_dump($_POST);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de concepto de formulario</title>
</head>
<body>
    <h1>Página 1</h1>
    <form method="POST">
      <label for="dato1">Dato1:</label><input name="dato1" value='<?= $_POST['dato1']?>'/>
        <button>Enviar</button>
</body>
</html>
