<?php
return[
    ['GET','/', 'App\Controladores\Login', 'ver'],
    ['POST','/login', 'App\Controladores\Login', 'autenticar'],
    ['GET','/logout', 'App\Controladores\Login', 'logout'],
    ['GET', '/inicio', 'App\Controladores\Inicio', 'ver'],
    ['GET', '/registro', 'App\Controladores\Registro', 'ver'],
    ['GET', '/item', 'App\Controladores\Item', 'ver'],
    ['GET','/carrito', 'App\Controladores\Carrito', 'ver'],
    ['GET','/compra1', 'App\Controladores\Compra1', 'ver'],
    ['GET','/compra2', 'App\Controladores\Compra2', 'ver'],
    ['GET','/compra3', 'App\Controladores\Compra3', 'ver'],
    ];