# Emporio Arcano

Mock de una tienda virtual de productos mágicos para prácticas de Desarrollo Web en Entorno Servidor.

## Objetivo

El proyecto representa únicamente la interfaz y la navegación de la aplicación. En esta primera fase no existe lógica real de servidor, persistencia de carrito, autenticación ni procesamiento de pagos.

## Estructura

```text
emporio-arcano/
├── README.md
├── datos/
│   ├── clientes.json
│   ├── items.json
│   ├── precios.php
│   └── img/
├── html/
│   ├── login.html
│   ├── registro.html
│   ├── inicio.html
│   ├── item.html
│   ├── carrito.html
│   ├── compra1.html
│   ├── compra2.html
│   └── compra3.html
├── css/
│   └── estilo.css
└── php/
```

## Navegación del mock

`login.html` → `inicio.html` → `item.html` / `carrito.html` → `compra1.html` → `compra2.html` → `compra3.html` → `inicio.html`

## Datos

- `clientes.json`: 10 clientes de ejemplo.
- `items.json`: 25 productos repartidos entre varitas, hechizos y pócimas.
- `precios.php`: matriz bidimensional no asociativa con precios distintos para Muggle, Estudiante de Howarts y Bruja/Mago.

## Imágenes

Las páginas esperan imágenes llamadas `item01.jpg` ... `item25.jpg` dentro de `datos/img/`. Se añadirán en una fase posterior.

## Uso

Abrir `html/login.html` en el navegador. Todos los datos mostrados son simulados.
