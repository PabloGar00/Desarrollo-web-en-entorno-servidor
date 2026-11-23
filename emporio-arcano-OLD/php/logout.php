<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

auth_start_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    auth_json_response(405, ['error' => 'Método no permitido.']);
}

if (!auth_has_valid_csrf_token()) {
    auth_json_response(403, ['error' => 'Token CSRF inválido o ausente.']);
}

$_SESSION = [];
auth_clear_session_cookie();
session_destroy();

auth_json_response(200, ['message' => 'Sesión cerrada.']);
