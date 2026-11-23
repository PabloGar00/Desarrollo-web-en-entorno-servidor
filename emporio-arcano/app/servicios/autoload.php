<?php
declare(strict_types=1);

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


/**
 * Autoloader basado en un array de directorios.
 *
 * Dado el nombre completo de una clase convierte el nombre a minúsculas
 * y la busca en los directorios del array utilizando el separador de directorios.
 *
 * @param string $clase Nombre de la clase.
 *
 * @return void
 */
function autoload(string $clase): void{
	//echo "Clase: $clase<br/>";
	$fichero = ".." . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, strtolower($clase)).'.php';
	if (is_file($fichero))
		require_once $fichero;
}

//Registramos el autoload
spl_autoload_register('autoload');
