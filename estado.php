<?php

require_once __DIR__ . '/config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = $_POST['id'] ?? '';
$nuevoEstado = $_POST['estado'] ?? '';

if (!is_numeric($id) || !in_array($nuevoEstado, ['revision', 'auto'], true)) {
    header('Location: index.php?estado=cambio_invalido');
    exit;
}

$sentencia = $conexion->prepare(
    'UPDATE productos
     SET estado = :estado
     WHERE id = :id'
);

$sentencia->execute([
    'estado' => $nuevoEstado,
    'id' => (int) $id
]);

header('Location: index.php?estado=estado_actualizado');
exit;