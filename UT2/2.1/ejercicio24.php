<?php
class ErrorDeValidacion extends Exception {}

function validarAlumno($nombre,$edad, $nota) {
    if (empty(trim($nombre))) {
        throw new ErrorDeValidacion("El nombre no puede estar vacío.");
    }
    if (!is_numeric($edad) || $edad < 0 \vert{}\vert{}$edad > 120) {
        throw new ErrorDeValidacion("La edad debe ser un número entre 0 y 120.");
    }
    if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
        throw new ErrorDeValidacion("La nota debe ser un número entre 0 y 10.");
    }
    return true;
}

$casosPrueba = [
    ["nombre" => "Pablo", "edad" => 20, "nota" => 8.5],
    ["nombre" => "", "edad" => 22, "nota" => 7.0],
    ["nombre" => "Carlos", "edad" => 150, "nota" => 9.0],
    ["nombre" => "Ana", "edad" => 25, "nota" => 11]
];

$resultados = [];

foreach ($casosPrueba as$caso) {
    try {
        validarAlumno($caso["nombre"], $caso["edad"], $caso["nota"]);
        $resultados[] = [
            "datos" => "Nombre: '{$caso['nombre']}', Edad: {$caso['edad']}, Nota: {$caso['nota']}",
            "estado" => "OK",
            "mensaje" => "Datos válidos"
        ];
    } catch (ErrorDeValidacion $e) {$resultados[] = [
            "datos" => "Nombre: '{$caso['nombre']}', Edad: {$caso['edad']}, Nota: {$caso['nota']}",
            "estado" => "ERROR",
            "mensaje" =>