<?php
declare(strict_types=1);
namespace App\Servicios;
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
use App\Servicios\configurador;

/**
 * Clase enrruatador 
 *  carga las rutas y crae el controlador y llama al metodo
 */

class Enrutador{
    /**
     * Ruta de acceso a la aplicación 
	 * @var array<int, string $metodo_http, string $path, string $controlador, string $accion_controlador>
     */
    private static array $rutas;
    /**
     * Summary of cargar que carga carga desde el fichero de configuración
     * @return void
     */
	private static function cargar(): void{
		self::$rutas = require(Configurador::ver('path_rutas'));
	}

    public static function enrutar(): void{
        //cargar las rutas
        self::cargar();

        //Analiza la peticion
        $peticion = [];
        $peticion['metodo'] = strtoupper($_SERVER['REQUEST_METHOD']) ?? 'GET';
        $ruta_base = configurador::ver('ruta_base');
		$peticion['path'] = str_replace($ruta_base, '',  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
       
        foreach(self::$rutas as [$ruta_metodo, $ruta_path, $controlador, $accion]){
			//echo $peticion['path'] .' - '. $ruta_path. '<br/>';
			if ($peticion['metodo'] !== $ruta_metodo)
				continue;
			if ($peticion['path'] === $ruta_path){
				$controlador = new $controlador();
				$controlador->$accion();
				die();
	 		}
	 	}
		header('HTTP/1.1 404 Not Found');
		die();

    }

}
