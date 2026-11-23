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
class Item{
    /**
     * Summary of mostrar loging
     * @return void
     */
    public function mostrar(array $item): void{
        foreach (['id', 'nombre', 'descripcion', 'categoria', 'stock'] as $campo){
            if (!array_key_exists($campo, $item)){
                throw new \UnexpectedValueException('Falta el campo ' . $campo . ' en los datos del producto.');
            }
        }
        if (!is_string($item['nombre']) || !is_string($item['descripcion']) ||
            !is_string($item['categoria']) || !is_numeric($item['stock'])){
            throw new \UnexpectedValueException('Los datos del producto no tienen un formato válido.');
        }

        $id = (int)$item['id'];
        $nombre = htmlspecialchars($item['nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $descripcion = htmlspecialchars($item['descripcion'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $categoria = htmlspecialchars($item['categoria'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $imagen = sprintf('/emporio-arcano/datos/img/item%02d.png', $id);
        $stock = (int)$item['stock'];
        require(Configurador::ver('path_vistas').'item.html');
    }
}


