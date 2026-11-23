<?php
declare(strict_types=1);
namespace App\Modelos;
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

/**
 * Clase Modelo de Usuarios.
 *
 * Gestiona los datos de los usuarios.
 */
class Usuarios {
	private array $usuarios;

	/**
	* Carga el fichero de usuario en la variable de clase.
	*/
	public function __construct(){
		$ruta = Configurador::ver('path_usuarios');
		if (!is_string($ruta) || $ruta === ''){
			throw new \UnexpectedValueException('La ruta del fichero de usuarios no es válida.');
		}

		$contenido = file_get_contents($ruta);
		if ($contenido === false){
			throw new \RuntimeException('No se pudo leer el fichero de usuarios.');
		}

		try{
			$usuarios = json_decode($contenido, true, 512, JSON_THROW_ON_ERROR);
		}catch(\JsonException $e){
			throw new \UnexpectedValueException('El fichero de usuarios no contiene JSON válido.', 0, $e);
		}

		if (!is_array($usuarios)){
			throw new \UnexpectedValueException('El fichero de usuarios debe contener una lista.');
		}
		$this->usuarios = $usuarios;

	}

	/**
	* Devuelve los datos de un usuario.
	* @param string $usuario Nombre del usuario.
	*
	* @return array[mixed] Array con los datos del usuario. Devuelve null si no existe coincidencia.
	*/
	public function getUsuario(string $usuario): ?array {
		$usuario = trim($usuario);
		foreach($this->usuarios as $usuario_registrado){
			if (!is_array($usuario_registrado)){
				continue;
			}
			$nombre = $usuario_registrado['nombre'] ?? $usuario_registrado['usuario'] ?? null;
			if (is_string($nombre) && strcasecmp(trim($nombre), $usuario) === 0){
				return $usuario_registrado;
            }
		}
		return null;
	}

}
