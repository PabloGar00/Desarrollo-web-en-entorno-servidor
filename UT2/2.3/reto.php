<?php
$temas = ['claro', 'oscuro'];
$tamanos = ['pequeño', 'normal', 'grande'];
$elementosPermitidos = [10, 20, 50];

$tema = 'claro';
$tamano = 'normal';
$elementos = 10;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['restablecer'])) {
        // Eliminamos las tres cookies estableciendo una fecha de caducidad pasada.
        $opciones = [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax'
        ];

        setcookie('tema', '', $opciones);
        setcookie('tamano', '', $opciones);
        setcookie('elementos', '', $opciones);

    } else {
        $tema = $_POST['tema'] ?? 'claro';
        $tamano = $_POST['tamano'] ?? 'normal';
        $elementos = (int) ($_POST['elementos'] ?? 10);

        if (!in_array($tema, $temas)) {
            $tema = 'claro';
        }

        if (!in_array($tamano, $tamanos)) {
            $tamano = 'normal';
        }

        if (!in_array($elementos, $elementosPermitidos)) {
            $elementos = 10;
        }

        // Las cookies duran 60 días.
        // path '/' permite utilizarlas en todo el sitio.
        // secure solo se activa cuando se utiliza HTTPS.
        // httponly impide acceder a ellas mediante JavaScript.
        // samesite Lax reduce el envío de cookies en peticiones externas.
        $opciones = [
            'expires' => time() + (60 * 24 * 60 * 60),
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax'
        ];

        setcookie('tema', $tema, $opciones);
        setcookie('tamano', $tamano, $opciones);
        setcookie('elementos', $elementos, $opciones);
    }

} else {

    if (isset($_COOKIE['tema']) && in_array($_COOKIE['tema'], $temas)) {
        $tema = $_COOKIE['tema'];
    }

    if (isset($_COOKIE['tamano']) && in_array($_COOKIE['tamano'], $tamanos)) {
        $tamano = $_COOKIE['tamano'];
    }

    if (isset($_COOKIE['elementos']) && in_array((int) $_COOKIE['elementos'], $elementosPermitidos) && (string) (int) $_COOKIE['elementos'] === $_COOKIE['elementos']) {
        $elementos = (int) $_COOKIE['elementos'];
    }
}

$elementosPagina = range(1, 50);
$elementosPagina = array_slice($elementosPagina, 0, $elementos);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preferencias</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .claro {
            background-color: white;
            color: black;
        }

        .oscuro {
            background-color: #222;
            color: white;
        }

        .pequeño {
            font-size: 12px;
        }

        .normal {
            font-size: 16px;
        }

        .grande {
            font-size: 22px;
        }
    </style>
</head>

<body
    class="<?php echo htmlspecialchars($tema, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($tamano, ENT_QUOTES, 'UTF-8'); ?>">

    <h1>Preferencias de la aplicación</h1>

    <form method="POST" action="">

        <label for="tema">Tema:</label>
        <select name="tema" id="tema">
            <option value="claro" <?php if ($tema == 'claro')
                echo 'selected'; ?>>Claro</option>
            <option value="oscuro" <?php if ($tema == 'oscuro')
                echo 'selected'; ?>>Oscuro</option>
        </select>

        <br><br>

        <label for="tamano">Tamaño de texto:</label>
        <select name="tamano" id="tamano">
            <option value="pequeño" <?php if ($tamano == 'pequeño')
                echo 'selected'; ?>>Pequeño</option>
            <option value="normal" <?php if ($tamano == 'normal')
                echo 'selected'; ?>>Normal</option>
            <option value="grande" <?php if ($tamano == 'grande')
                echo 'selected'; ?>>Grande</option>
        </select>

        <br><br>

        <label for="elementos">Elementos por página:</label>
        <select name="elementos" id="elementos">
            <option value="10" <?php if ($elementos == 10)
                echo 'selected'; ?>>10</option>
            <option value="20" <?php if ($elementos == 20)
                echo 'selected'; ?>>20</option>
            <option value="50" <?php if ($elementos == 50)
                echo 'selected'; ?>>50</option>
        </select>

        <br><br>

        <button type="submit" name="guardar">Guardar preferencias</button>
        <button type="submit" name="restablecer">Restablecer preferencias</button>

    </form>

    <h2>Elementos de la página</h2>

    <p>Mostrando <?php echo count($elementosPagina); ?> elementos:</p>

    <ul>
        <?php foreach ($elementosPagina as $elemento) { ?>
            <li>Elemento <?php echo $elemento; ?></li>
        <?php } ?>
    </ul>

</body>

</html>