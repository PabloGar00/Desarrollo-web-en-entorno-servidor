<?php
declare(strict_types=1);
namespace App\Vistas;
/**
 * @file
 * clase controlador de la vista de loguin 
 *  
 * Grestiona la aparición del loguin en pantalla 
 * 
 * @author Javier Blanco Garcia <jblancog26@educarex.es>
 * @copyright 2026 Javier Blnaco Garcia
 * @license GPL v3
 */

use \App\Servicios\Configurador;


/**
 * clase vista de Loguin 
 * Presenta el formulario de loguin 
 */
class Inicio{
    /**
     * Summary of mostrar Inicio
     * @return void
     */
    public function mostrar(string $nombre, string $tipo): void{
        $nombre = htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $tipo = htmlspecialchars($tipo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        require(Configurador::ver('path_vistas').'inicio.html');
    }
}


