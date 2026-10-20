<?php

require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/validaciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id       = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
$nombre   = trim($_POST['nombre'] ?? '');
$cantidad = $_POST['cantidad'] ?? '';

// Validar el ID
if ($id === false || $id < 1) {
    header('Location: index.php?estado=no_encontrado');
    exit;
}

// Validar nombre y cantidad con las mismas funciones que usa guardar.php
$error = validarNombre($nombre);

if ($error === null) {
    $error = validarCantidad($cantidad);
}

if ($error !== null) {
    header('Location: editar.php?id=' . $id . '&estado=' . $error);
    exit;
}

// Comprobar que el producto existe antes de actualizar
$consulta = $conexion->prepare('SELECT id FROM productos WHERE id = :id');
$consulta->execute(['id' => $id]);

if (!$consulta->fetch()) {
    header('Location: index.php?estado=no_encontrado');
    exit;
}

// Actualizar
$sentencia = $conexion->prepare(
    'UPDATE productos
     SET nombre = :nombre, cantidad = :cantidad
     WHERE id = :id'
);

$sentencia->execute([
    'nombre'   => $nombre,
    'cantidad' => (int) $cantidad,
    'id'       => $id,
]);

header('Location: index.php?estado=actualizado');
exit;