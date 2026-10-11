<?php

function validarNombre($nombre) {
    $nombre = trim($nombre);

    if ($nombre === "") {
        return "El nombre no puede estar vacío.";
    }

    if (mb_strlen($nombre) < 3) {
        return "El nombre debe tener al menos 3 caracteres.";
    }

    return true;
}

function validarCantidad($cantidad) {
    if (!is_numeric($cantidad)) {
        return "La cantidad debe ser un número.";
    }

    $cantidad = (int) $cantidad;

    if ($cantidad <= 0) {
        return "La cantidad no puede ser menor o igual a 0.";
    }

    return true;
}