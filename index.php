<?php

require_once __DIR__ . '/config/conexion.php';
/** @var PDO $conexion */

$consulta = $conexion->query(
    'SELECT
        id,
        nombre,
        cantidad,
        fecharegistro
    FROM productos
    ORDER BY id asc'
);

$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

$estado = $_GET['estado'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIO</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="encabezado">
    <div class="contenido-encabezado">
        <p class="etiqueta">GPDS</p>
        <h1>INVENTARIO</h1>
        <p>Registro y consulta de productos</p>
    </div>
</header>

<main class="contenedor">

    <section class="tarjeta formulario">
        <h2>Registrar producto</h2>
        <p class="descripcion">
            Escriba el nombre del producto y su cantidad.
        </p>

        <?php if ($estado === 'guardado'): ?>
            <div class="mensaje correcto">Producto registrado correctamente.</div>
        <?php endif; ?>

        <?php if ($estado === 'actualizado'): ?>
            <div class="mensaje correcto">Producto actualizado correctamente.</div>
        <?php endif; ?>

        <?php if ($estado === 'no_encontrado'): ?>
            <div class="mensaje error">El producto que intentó editar no existe.</div>
        <?php endif; ?>

        <?php if ($estado === 'incompleto'): ?>
            <div class="mensaje error">Debe completar todos los campos.</div>
        <?php endif; ?>

        <?php if ($estado === 'cantidad_invalida'): ?>
            <div class="mensaje error">La cantidad debe ser un número.</div>
        <?php endif; ?>

        <form action="guardar.php" method="POST">

            <div class="campo">
                <label for="nombre">Nombre del producto</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    maxlength="60"
                    placeholder="Ejemplo: Café"
                    required
                >
            </div>

            <div class="campo">
                <label for="cantidad">Cantidad</label>
                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    placeholder="Ejemplo: 10"
                    required
                >
            </div>

            <button type="submit">Registrar producto</button>

        </form>
    </section>

    <section class="tarjeta listado">

        <div class="titulo-listado">
            <div>
                <h2>Productos registrados</h2>
                <p class="descripcion">
                    Total: <?php echo count($productos); ?>
                </p>
            </div>
        </div>

        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (count($productos) === 0): ?>
                        <tr>
                            <td colspan="6" class="sin-registros">
                                No hay productos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($productos as $producto): ?>
                        <tr>

                            <td><?php echo $producto['id']; ?></td>

                            <td>
                                <?php echo htmlspecialchars($producto['nombre']); ?>
                            </td>

                            <td><?php echo $producto['cantidad']; ?></td>

                            <td>
                                <?php if ($producto['cantidad'] > 0): ?>
                                    <span class="estado disponible">Disponible</span>
                                <?php else: ?>
                                    <span class="estado agotado">Sin existencia</span>
                                <?php endif; ?>
                            </td>

                            <td><?php echo $producto['fecharegistro']; ?></td>

                            <td>
                                <a
                                    class="boton-editar"
                                    href="editar.php?id=<?php echo (int) $producto['id']; ?>"
                                    title="Editar producto"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                    </svg>
                                    Editar
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </section>

</main>

<footer>
    U1. Planeación del proceso de desarrollo de software
</footer>

</body>
</html>