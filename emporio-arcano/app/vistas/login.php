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
class Login{
    /**
     * Summary of mostrar loging
     * @return void
     */
    public function mostrar(?string $mensaje = null, bool $exito = false): void{
        if ($mensaje !== null){
            $mensaje = htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }
        require(Configurador::ver('path_vistas').'login.html');
    }
}


