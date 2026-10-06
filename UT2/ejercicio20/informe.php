<?php
require 'datos.php';

function obtenerProductoMasCaro($lista) {
    if (empty($lista)) {
        return null;
    }
    $masCaro = $lista[0];
    foreach ($lista as $p) {
        if ($p["precio"] > $masCaro["precio"]) {
            $masCaro = $p;
        }
    }
    return $masCaro;
}

function obtenerProductoMasBarato($lista) {
    if (empty($lista)) {
        return null;
    }
    $masBarato = $lista[0];
    foreach ($lista as $p) {
        if ($p["precio"] < $masBarato["precio"]) {
            $masBarato = $p;
        }
    }
    return $masBarato;
}

$valorTotalInventario = 0;
$agotados = [];
$porCategoria = [];

foreach ($productos as $p) {
    $valorTotalInventario += $p["precio"] * $p["stock"];

    if ($p["stock"] === 0) {
        $agotados[] = $p["nombre"];
    }

    $cat = $p["categoria"];
    if (!isset($porCategoria[$cat])) {
        $porCategoria[$cat] = [];
    }
    $porCategoria[$cat][] = $p;
}

$productoMasCaro = obtenerProductoMasCaro($productos);
$productoMasBarato = obtenerProductoMasBarato($productos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 20</title>
</head>
<body>
    <h1>Ejercicio 20</h1>

    <h2>Listado Completo de Productos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Valor Subtotal (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?php echo $p["nombre"]; ?></td>
                    <td><?php echo number_format($p["precio"], 2); ?></td>
                    <td><?php echo $p["stock"]; ?></td>
                    <td><?php echo $p["categoria"]; ?></td>
                    <td><?php echo number_format($p["precio"] * $p["stock"], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Resumen e Indicadores</h2>
    <ul>
        <li>
            <strong>Valor total del inventario:</strong> 
            <?php echo number_format($valorTotalInventario, 2); ?> €
        </li>
        <li>
            <strong>Producto más caro:</strong> 
            <?php echo $productoMasCaro ? $productoMasCaro["nombre"] . " (" . number_format($productoMasCaro["precio"], 2) . " €)" : "N/A"; ?>
        </li>
        <li>
            <strong>Producto más barato:</strong> 
            <?php echo $productoMasBarato ? $productoMasBarato["nombre"] . " (" . number_format($productoMasBarato["precio"], 2) . " €)" : "N/A"; ?>
        </li>
    </ul>

    <h2>Productos Agotados (Stock 0)</h2>
    <?php if (!empty($agotados)): ?>
        <ul>
            <?php foreach ($agotados as $nombreAgotado): ?>
                <li><?php echo $nombreAgotado; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos agotados.</p>
    <?php endif; ?>

    <h2>Productos Agrupados por Categoría</h2>
    <?php foreach ($porCategoria as $categoria => $listaProd): ?>
        <h3><?php echo $categoria; ?></h3>
        <ul>
            <?php foreach ($listaProd as $p): ?>
                <li>
                    <?php echo $p["nombre"]; ?> - <?php echo number_format($p["precio"], 2); ?> € 
                    (Stock: <?php echo $p["stock"]; ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</body>
</html>