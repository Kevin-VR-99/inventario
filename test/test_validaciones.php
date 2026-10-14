<?php

require_once __DIR__ . '/../validaciones.php';

$casos = [
    //Pruebas para validarNombre
    [ "nombre válido: Teclado", "Teclado", 'nombre', null ],
    [ "nombre vacío", "", 'nombre', 'incompleto' ],
    [ "nombre con espacios", "   ", 'nombre', 'incompleto' ],
    [ "nombre válido: Mouse", "Mouse", 'nombre', null ],

    //Pruebas para validarCantidad
    [ "cantidad válida: 10", 10, 'cantidad', null ],
    [ "cantidad vacía", "", 'cantidad', 'incompleto' ],
    [ "cantidad no numérica: abc", "abc", 'cantidad', 'cantidad_invalida' ],
    [ "cantidad cero", 0, 'cantidad', 'cantidad_invalida' ],
    [ "cantidad negativa: -5", -5, 'cantidad', 'cantidad_invalida' ],
];

$correctas = 0;
$fallidas = 0;

foreach ($casos as [$descripcion, $entrada, $tipo, $esperado]) {

    $obtenido = validarNombre($entrada);

if ($tipo === 'nombre') {
        $obtenido = validarNombre($entrada);
    } else {
        $obtenido = validarCantidad($entrada);
    }

    if ($obtenido === $esperado) {
        echo "Prueba exitosa: $descripcion\n";
        $correctas++;
    } else {
        echo "FAIL - $descripcion\n";
        echo "Esperado: " . var_export($esperado, true) . "\n";
        echo "Obtenido: " . var_export($obtenido, true) . "\n";
        $fallidas++;
    }
}

echo "\nResumen de pruebas:\n";
echo "Total de pruebas: " . count($casos) . "\n";
echo "Pruebas correctas: $correctas\n";
echo "Pruebas fallidas: $fallidas\n";
exit($fallidas > 0 ? 1 : 0);