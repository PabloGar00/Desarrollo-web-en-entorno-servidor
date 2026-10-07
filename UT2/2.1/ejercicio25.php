<?php
function leerArchivo($ruta) {
    if (!file_exists($ruta)) {
        throw new Exception("El archivo '$ruta' no existe.");
    }

    $recurso = @fopen($ruta, "r");
    if (!$recurso) {
        throw new Exception("No se pudo abrir el archivo '$ruta'.");
    }

    $lineas = [];
    try {
        while (($linea = fgets($recurso)) !== false) {
            $lineas[] = rtrim($linea, "\r\n");
        }
        return $lineas;
    } finally {
        if ($recurso) {
            fclose($recurso);
        }
    }
}

$archivoExistente = "ejemplo_prueba.txt";
file_put_contents($archivoExistente, "Línea 1: Primer mensaje de prueba\nLínea 2: Desarrollo Web en Entorno Servidor\nLínea 3: Fin del archivo");

$archivoInexistente = "no_existo.txt";

$pruebas = [
    $archivoExistente,
    $archivoInexistente
];

$resultados = [];

foreach ($pruebas as $ruta) {
    try {
        $contenido = leerArchivo($ruta);
        $resultados[] = [
            "ruta" => $ruta,
            "exito" => true,
            "contenido" => $contenido
        ];
    } catch (Exception $e) {
        $resultados[] = [
            "ruta" => $ruta,
            "exito" => false,
            "mensaje" => $e->getMessage()
        ];
    }
}

if (file_exists($archivoExistente)) {
    unlink($archivoExistente);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 25</title>
</head>
<body>
    <h1>Ejercicio 25</h1>
    <?php foreach ($resultados as $res): ?>
        <h2>Archivo: <?php echo $res["ruta"]; ?></h2>
        <?php if ($res["exito"]): ?>
            <p style="color: green;">Archivo leído correctamente:</p>
            <ul>
                <?php foreach ($res["contenido"] as $linea): ?>
                    <li><?php echo htmlspecialchars($linea); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: red;"><?php echo htmlspecialchars($res["mensaje"]); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>