<?php
declare(strict_types=1);
namespace App\Vistas;
/**
 * @file
 * clase controlador de la vista del carrito 
 *  
 * Grestiona la aparición del carrito en pantalla 
 * 
 * @author Javier Blanco Garcia <jblancog26@educarex.es>
 * @copyright 2026 Javier Blnaco Garcia
 * @license GPL v3
 */

use \App\Servicios\Configurador;


/**
 * clase vista de carrito 
 * Presenta el formulario de carrito 
 */
class Carrito{
    /**
     * Summary of mostrar Inicio
     * @return void
     */
    public function mostrar(): void{
        require(Configurador::ver('path_vistas').'carrito.html');
    }
}


