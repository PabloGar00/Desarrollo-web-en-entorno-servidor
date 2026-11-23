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

use App\Modelos\Item as ModeloItem;

/**
 * Clase Controlador de Login
 *
 * Gestiona el Login de la aplicación.
 */
class Item{
	private $vista;

	public function __construct(){
		$this->vista = new \App\Vistas\Item();
	}
	/**
	 * Muestra los datos del item indicado en el parámetro GET id.
	 */
	public function ver():void {
		$id = $_GET['id'] ?? null;
		if (!is_string($id) || !ctype_digit($id) || (int)$id < 1){
			http_response_code(400);
			echo 'El identificador del producto no es válido.';
			return;
		}

		$item = (new ModeloItem())->getItem((int)$id);
		if ($item === null){
			http_response_code(404);
			echo 'No se encontró el producto solicitado.';
			return;
		}

		$this->vista->mostrar($item);
	}
}