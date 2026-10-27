
<?php
// Idiomas permitidos
$idiomas = [
    'es' => 'Español',
    'en' => 'Inglés',
    'pt' => 'Portugués'
];

// Si se envía el formulario, guardamos el idioma en una cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seleccion = $_POST['idioma'] ?? 'es';

    // Comprobar que el idioma seleccionado es válido
    if (array_key_exists($seleccion, $idiomas)) {
        setcookie('idioma', $seleccion, [
            'expires' => time() + (30 * 24 * 60 * 60),
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS'])
                && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        // Actualizar el valor mostrado en esta petición
        $idiomaActual = $seleccion;
    }
}

// Si no se ha enviado el formulario, leer la cookie
if (!isset($idiomaActual)) {
    $idiomaActual = $_COOKIE['idioma'] ?? 'es';
}

// Validar también el valor leído de la cookie
if (!array_key_exists($idiomaActual, $idiomas)) {
    $idiomaActual = 'es';
}

// Escapar el texto antes de mostrarlo en HTML
$idiomaSeguro = htmlspecialchars(
    $idiomas[$idiomaActual],
    ENT_QUOTES,
    'UTF-8'
);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preferencia de idioma</title>
</head>
<body>
    <h1>Preferencia de idioma</h1>

    <p>
        Tu idioma preferido es:
        <strong><?= $idiomaSeguro ?></strong>
    </p>

    <form method="post" action="">
        <label for="idioma">Selecciona tu idioma:</label>

        <select name="idioma" id="idioma">
            <?php foreach ($idiomas as $codigo => $nombre): ?>
                <option
                    value="<?= htmlspecialchars($codigo, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $idiomaActual === $codigo ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Guardar preferencia</button>
    </form>
</body>
</html>
