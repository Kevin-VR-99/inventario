<?php

require_once __DIR__ . '/config/conexion.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

if ($id === false || $id < 1) {
    header('Location: index.php?estado=no_encontrado');
    exit;
}

$consulta = $conexion->prepare(
    'SELECT id, nombre, cantidad
     FROM productos
     WHERE id = :id'
);
$consulta->execute(['id' => $id]);
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: index.php?estado=no_encontrado');
    exit;
}

$estado = $_GET['estado'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR PRODUCTO</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenido-encabezado">
        <p class="etiqueta">GPDS</p>
        <h1>INVENTARIO</h1>
        <p>Editar producto</p>
    </div>
</header>

<main class="contenedor">

    <section class="tarjeta formulario">
        <h2>Editar producto #<?php echo (int) $producto['id']; ?></h2>
        <p class="descripcion">
            Modifique el nombre o la cantidad y presione guardar.
        </p>

        <?php if ($estado === 'incompleto'): ?>
            <div class="mensaje error">Debe completar todos los campos.</div>
        <?php endif; ?>

        <?php if ($estado === 'nombre_largo'): ?>
            <div class="mensaje error">El nombre no puede tener más de 60 caracteres.</div>
        <?php endif; ?>

        <?php if ($estado === 'cantidad_invalida'): ?>
            <div class="mensaje error">La cantidad debe ser un número entero de 0 en adelante.</div>
        <?php endif; ?>

        <?php if ($estado === 'error'): ?>
            <div class="mensaje error">No se pudo actualizar el producto. Intente de nuevo.</div>
        <?php endif; ?>

        <form action="actualizar.php" method="POST">

            <input type="hidden" name="id" value="<?php echo (int) $producto['id']; ?>">

            <div class="campo">
                <label for="nombre">Nombre del producto</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    maxlength="60"
                    value="<?php echo htmlspecialchars($producto['nombre']); ?>"
                    required
                >
            </div>

            <div class="campo">
                <label for="cantidad">Cantidad</label>
                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    min="0"
                    value="<?php echo (int) $producto['cantidad']; ?>"
                    required
                >
            </div>

            <div class="acciones-formulario">
                <button type="submit">Guardar cambios</button>
                <a class="boton-cancelar" href="index.php">Cancelar</a>
            </div>

        </form>
    </section>

</main>

<footer>
    U1. Planeación del proceso de desarrollo de software
</footer>

</body>
</html>