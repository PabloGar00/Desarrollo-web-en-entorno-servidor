<?php
declare(strict_types=1);
namespace App\Modelos;

/**
 * @file
 * Clase modelo de los items.
 *
 * Gestiona los datos de los productos almacenados en items.json.
 *
 * @author Javier Blanco Garcia <jblancog26@educarex.es>
 * @copyright 2026 Javier Blanco Garcia
 * @license GPL v3
 */

use App\Servicios\Configurador;

/**
 * Clase Modelo de Items.
 *
 * Gestiona la consulta de los items disponibles.
 */
class Item {
	private array $items;

	/**
	 * Carga el fichero de items en la variable de clase.
	 */
	public function __construct(){
		$ruta = Configurador::ver('path_productos');
		if (!is_string($ruta) || $ruta === ''){
			throw new \UnexpectedValueException('La ruta del fichero de productos no es válida.');
		}

		$contenido = file_get_contents($ruta);
		if ($contenido === false){
			throw new \RuntimeException('No se pudo leer el fichero de productos.');
		}

		try{
			$items = json_decode($contenido, true, 512, JSON_THROW_ON_ERROR);
		}catch(\JsonException $e){
			throw new \UnexpectedValueException('El fichero de productos no contiene JSON válido.', 0, $e);
		}

		if (!is_array($items)){
			throw new \UnexpectedValueException('El fichero de productos debe contener una lista.');
		}
		$this->items = $items;
	}

	/**
	 * Devuelve todos los items.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getItems(): array {
		return $this->items;
	}

	/**
	 * Devuelve los datos de un item por su identificador.
	 *
	 * @param int $id Identificador del item.
	 *
	 * @return array<string, mixed>|null
	 */
	public function getItem(int $id): ?array {
		foreach($this->items as $item){
			if (!is_array($item)){
				continue;
			}
			if (isset($item['id']) && (int)$item['id'] === $id){
				return $item;
			}
		}
		return null;
	}

	/**
	 * Devuelve los items que pertenecen a una categoría.
	 *
	 * @param string $categoria Categoría de los items.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getItemsPorCategoria(string $categoria): array {
		$categoria = trim($categoria);
		$resultado = [];

		foreach($this->items as $item){
			if (!is_array($item)){
				continue;
			}
			$itemCategoria = $item['categoria'] ?? null;
			if (is_string($itemCategoria) && strcasecmp(trim($itemCategoria), $categoria) === 0){
				$resultado[] = $item;
			}
		}
		return $resultado;
	}
}
