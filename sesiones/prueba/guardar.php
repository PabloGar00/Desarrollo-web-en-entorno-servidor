<?php 
session_start();
$_SESSION['usuario'] = 'Lucia';
$_SESSION['visitas'] = 1;

echo "datos guardados";