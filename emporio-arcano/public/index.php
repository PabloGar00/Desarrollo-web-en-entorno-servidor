<?php
/**
 * @file
 * clase controlador de loguin 
 *  
 * Grestiona el loguin de la aplicación.
 * 
 * @author Javier Blanco Garcia <jblancog26@educarex.es>
 * @copyright 2026 Javier Blnaco Garcia
 * @license GPL v3
 */

try{
    session_start();

    require('../app/servicios/autoload.php');

    App\Servicios\Configurador::iniciar();

    App\Servicios\Enrutador::enrutar();
    die();

 }catch(Exception $e){
	header('HTTP/1.1 400 Bad Request');
	if (App\Servicios\Configurador::ver('debug')){
		echo ('<pre>' . $e->getMessage()).'<br/>';
		print_r($e->getTrace());
	}
 }catch(Throwable $e){
 	header('HTTP/1.1 500 Internal Server Error');
	if (App\Servicios\Configurador::ver('debug')){
		echo ('<pre>' . $e->getMessage()).'<br/>';
		print_r($e->getTrace());
	}
 }