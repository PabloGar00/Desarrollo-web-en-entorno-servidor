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
class Inicio{
	private $vista;

	public function __construct(){
		$this->vista = new \App\Vistas\Inicio();
	}
	/**
	* Muestra el formulario de login.
	*/
	public function ver():void {
		$nombre = $_SESSION['usuario'] ?? 'Invitado';
		$tipo = $_SESSION['usuario_rol'] ?? '';
		$this->vista->mostrar(
			is_string($nombre) ? $nombre : 'Invitado',
			is_string($tipo) ? $tipo : ''
		);
	}
}



