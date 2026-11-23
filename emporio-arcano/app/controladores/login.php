<?php
declare(strict_types=1);
namespace App\Controladores;
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

use App\Servicios\Configurador;
use App\Modelos\Usuarios;

/**
 * Clase Controlador de Login
 *
 * Gestiona el Login de la aplicación.
 */
class Login{
	private $vista;

	public function __construct(){
		$this->vista = new \App\Vistas\Login();
	}

	/**
	* Muestra el formulario de login.
	*/
	public function ver():void {
		$this->vista->mostrar();
	}
	/**
	 * Summary of autenticar
	 * @throws \RuntimeException
	 * @return void
	 */
	public function autenticar():void {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
			throw new \RuntimeException('Método inadecuado.');
		}
		$nombre = $_POST['usuario'] ?? null;
		$clave = $_POST['clave'] ?? null;
		if (!is_string($nombre) || trim($nombre) === ''){
			$this->vista->mostrar('Introduce el usuario.');
			return;
		}
		if (!is_string($clave) || $clave === ''){
			$this->vista->mostrar('Introduce la clave.');
			return;
		}
		$usuarios = new Usuarios();
		$usuario_registrado = $usuarios->getUsuario(trim($nombre));
		if ($usuario_registrado === null){
			$this->vista->mostrar('Usuario inexistente.');
			return;
		}
		$clave_registrada = $usuario_registrado['clave'] ?? null;
		if (!is_string($clave_registrada) || !hash_equals($clave_registrada, $clave)){
			$this->vista->mostrar('Clave errónea.');
			return;
		}
		session_regenerate_id(true);
		$_SESSION['usuario'] = $usuario_registrado['nombre'] ?? trim($nombre);
		$_SESSION['usuario_id'] = $usuario_registrado['id'] ?? null;
		$_SESSION['usuario_rol'] = $usuario_registrado['tipo'] ?? null;
		$this->vista->mostrar('Inicio de sesión correcto.', true);
		$ruta_base = Configurador::ver('ruta_base');
		header('Location: ' . $ruta_base . '/inicio', true, 303);
	}

	/**
	 * Cierra la sesión del usuario y vuelve a la pantalla de login.
	 */
	public function logout():void {
		$_SESSION = [];
		session_destroy();

		$ruta_base = Configurador::ver('ruta_base');
		header('Location: ' . $ruta_base . '/', true, 303);
		exit;
	}
}



