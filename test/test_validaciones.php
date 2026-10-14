<?php

require_once __DIR__ . '/../validaciones.php';

$casos = [
    // Un nombre válido devuelve null
    [ "nombre válido: Teclado", "Teclado", null ],
    
    // Un nombre vacío devuelve 'incompleto'
    [ "nombre vacío", "", 'incompleto' ],
    
    // Un nombre con solo espacios, al hacerle trim() queda vacío, por lo que devuelve 'incompleto'
    [ "nombre con espacios", "   ", 'incompleto' ],
    
    // Otro nombre válido devuelve null
    [ "nombre válido: Mouse", "Mouse", null ],
];

$correctas = 0;
$fallidas = 0;

foreach ($casos as [$descripcion, $entrada, $esperado]) {

    $obtenido = validarNombre($entrada);

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