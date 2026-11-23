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


class configurador{
	/**
	 * Parámetros de configuración.
	 *
	 * @var array<string, mixed>
	 */

    private static array $parametros;
    /** 
     * Inicializar la configuración inicial de la aplicación 
    */

    public static function iniciar(): void{
        self::$parametros = require('../config/config.php');
        date_default_timezone_set('Europe/Madrid');
		
		if (self::$parametros['debug']) {
			// Mostrar todos los errores durante el desarrollo
			ini_set('display_errors', 'E_ALL');
			ini_set('error_reporting', 1);
		}else{
			ini_set('display_errors', '0');
			ini_set('error_reporting', 0);
		}
    }
    /**
     * Summary of ver
     * @param string $parametro
     * @return mixed
     */
    public static function ver(string $parametro): mixed{
        return self::$parametros[$parametro] ?? null;
    }
}
