<?php
require_once __DIR__ . '/../src/validaciones.php';

$casos = [
    ["Nombre valido: Teclado", "Teclado", true],
    ["Nombre vacio", "", false],
    ["Nombre con espacios", " ", false],
    ["Nombre muy corto", "Mo", true],   // ← este fallará (longitud 2)
];

$correctas = 0;
$fallidas = 0;

foreach ($casos as [$descripcion, $entrada, $esperado]) {
    $obtenido = validarNombreProducto($entrada);  // ← función correcta

    if ($obtenido == $esperado) {
        echo "- $descripcion\n";
        $correctas++;
    } else {
        echo "FAIL - $descripcion\n";
        echo " Esperado: " . var_export($esperado, true) . "\n";
        echo " Obtenido: " . var_export($obtenido, true) . "\n";
        $fallidas++;
    }
}

echo "\n--RESUMEN--\n";
echo "Total: " . count($casos) . "\n";
echo "Correctas: $correctas\n";
echo "Fallidas: $fallidas\n";
exit($fallidas > 0 ? 1 : 0);