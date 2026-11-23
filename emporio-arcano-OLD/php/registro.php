<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

auth_start_session();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    auth_json_response(200, ['csrf_token' => auth_csrf_token()]);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: GET, POST');
    auth_json_response(405, ['error' => 'Método no permitido.']);
}

if (!auth_has_valid_csrf_token()) {
    auth_json_response(403, ['error' => 'Token CSRF inválido o ausente.']);
}

$name = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['usuario'] ?? '';
$password = $_POST['clave'] ?? '';
$passwordConfirmation = $_POST['repetir'] ?? '';
$type = $_POST['tipo'] ?? '';

if (
    !is_string($name)
    || !is_string($email)
    || !is_string($username)
    || !is_string($password)
    || !is_string($passwordConfirmation)
    || !is_string($type)
) {
    auth_json_response(400, ['error' => 'Los datos del registro no son válidos.']);
}

$name = trim($name);
$email = trim($email);
$username = strtolower(trim($username));
$typeOptions = ['Muggle', 'Estudiante de Howarts', 'Bruja/Mago'];

if ($name === '' || strlen($name) > 120) {
    auth_json_response(400, ['error' => 'El nombre es obligatorio y no debe superar 120 caracteres.']);
}

if (
    strlen($email) > 254
    || filter_var($email, FILTER_VALIDATE_EMAIL) === false
) {
    auth_json_response(400, ['error' => 'El correo electrónico no es válido.']);
}

if (!preg_match('/^[a-z0-9._-]{3,32}$/', $username)) {
    auth_json_response(400, ['error' => 'El usuario debe tener entre 3 y 32 caracteres: letras, números, punto, guion o guion bajo.']);
}

if (strlen($password) < 8 || strlen($password) > 4096) {
    auth_json_response(400, ['error' => 'La contraseña debe tener al menos 8 caracteres.']);
}

if (!hash_equals($password, $passwordConfirmation)) {
    auth_json_response(400, ['error' => 'Las contraseñas no coinciden.']);
}

if (!in_array($type, $typeOptions, true)) {
    auth_json_response(400, ['error' => 'El tipo de cliente no es válido.']);
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

try {
    $created = auth_register_client([
        'nombre' => $name,
        'email' => $email,
        'usuario' => $username,
        'clave' => $passwordHash,
        'tipo' => $type,
    ]);
} catch (RuntimeException $error) {
    auth_json_response(500, ['error' => 'No se pudo guardar el registro.']);
}

if (!$created) {
    auth_json_response(409, ['error' => 'El usuario o el correo electrónico ya están registrados.']);
}

auth_json_response(201, ['message' => 'Cuenta creada correctamente.']);
