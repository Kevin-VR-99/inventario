<?php
// validaciones.php

/**
 * Valida el nombre del producto.
 * Devuelve null si es válido, o el estado de error.
 */
function validarNombre(string $nombre): ?string
{
    $nombre = trim($nombre);

    if ($nombre === '') {
        return 'incompleto';
    }

    if (mb_strlen($nombre, 'UTF-8') <= 3) {
        return 'nombre_corto';
    }

    return null;
}

/**
 * Valida la cantidad del producto.
 * Devuelve null si es válido, o el estado de error.
 */
function validarCantidad($cantidad): ?string
{
    if ($cantidad === '' || $cantidad === null) {
        return 'incompleto';
    }

    if (!is_numeric($cantidad)) {
        return 'cantidad_invalida';
    }

    if ((int) $cantidad <= 0) {
        return 'cantidad_invalida';
    }

    return null;
}