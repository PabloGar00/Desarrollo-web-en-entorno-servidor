<?php
session_start();

$error = "";
$csrf = "";
$usernameRecordado = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['usuario'])){
        $error = 'inserta el usuario';
    }
    if(!isset($_POST['contrasena'])){
        $error = 'inserta la contraseña';
    }

    if($error === ''){
        $usuario =json_decode(file_get_contents('usuarios.json'))
    header('Location: inicio.php');
    }
}



if(!isset($_SESSION["csrf"])){
$csrf = bin2hex(random_bytes(32));
$_SESSION['csrf'] = $csrf;
}
require('login.html');