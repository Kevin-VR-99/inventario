<?php

require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/validaciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nombre   = trim($_POST['nombre'] ?? '');
$cantidad = $_POST['cantidad'] ?? '';

// Validamos en orden: primero nombre, luego cantidad.
$error = validarNombre($nombre);

if ($error === null) {
    $error = validarCantidad($cantidad);
}

if ($error !== null) {
    header('Location: index.php?estado=' . $error);
    exit;
}

$sentencia = $conexion->prepare(
    'INSERT INTO productos (nombre, cantidad)
     VALUES (:nombre, :cantidad)'
);

$sentencia->execute([
    'nombre'   => $nombre,
    'cantidad' => (int) $cantidad,
]);

header('Location: index.php?estado=guardado');
exit;