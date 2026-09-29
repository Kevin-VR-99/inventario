<?php

require_once __DIR__ . '/config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);

if ($id === false || $id < 1) {
    header('Location: index.php?estado=no_encontrado');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$cantidadTexto = trim($_POST['cantidad'] ?? '');

if ($nombre === '' || $cantidadTexto === '') {
    header('Location: editar.php?id=' . $id . '&estado=incompleto');
    exit;
}

if (mb_strlen($nombre) > 60) {
    header('Location: editar.php?id=' . $id . '&estado=nombre_largo');
    exit;
}

$cantidad = filter_var(
    $cantidadTexto,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 0]]
);

if ($cantidad === false) {
    header('Location: editar.php?id=' . $id . '&estado=cantidad_invalida');
    exit;
}

try {
    $sentencia = $conexion->prepare(
        'UPDATE productos
         SET nombre = :nombre, cantidad = :cantidad
         WHERE id = :id'
    );

    $sentencia->execute([
        'nombre'   => $nombre,
        'cantidad' => $cantidad,
        'id'       => $id
    ]);
} catch (PDOException $e) {
    header('Location: editar.php?id=' . $id . '&estado=error');
    exit;
}

header('Location: index.php?estado=actualizado');
exit;