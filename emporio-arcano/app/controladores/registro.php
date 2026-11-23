<?php
declare(strict_types=1);
namespace App\Controladores;
/**
 * @file
 * clase controlador de Inicio 
 *  
 * Grestiona el loguin de la aplicación.
 * 
 * @author Javier Blanco Garcia <jblancog26@educarex.es>
 * @copyright 2026 Javier Blnaco Garcia
 * @license GPL v3
 */

use App\Servicios\Configurador;
use App\Modelos\Usuarios;

/**
 * Clase Controlador de Login
 *
 * Gestiona el Login de la aplicación.
 */
class Registro{
	private $vista;

	public function __construct(){
		$this->vista = new \App\Vistas\Registro();
	}
	/**
	* Muestra el carrito de la compra.
	*/
	public function ver():void {
		$this->vista->mostrar();
	}
}



