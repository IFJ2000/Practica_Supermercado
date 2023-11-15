<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../PracticaSupermercado/Objeto_producto.php" ?>
    <?php require "../PracticaSupermercado/Conexion_BBDD.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php

    session_start();
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        $_SESSION["usuario"] = "invitado";
        $usuario = $_SESSION["usuario"];

    }

    ?>

    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);
    $productos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $id = $fila["idProducto"];
        $nombre = $fila["nombreProducto"];
        $precio = $fila["precio"];
        $descripcion = $fila["descripcion"];
        $cantidad = $fila["cantidad"];
        $imagen = $fila["imagen"];

        $nuevo_producto = new producto($id, $nombre, $precio, $descripcion, $cantidad, $imagen);
        array_push($productos, $nuevo_producto);
    }
    ?>

    <h1>Bienvenido a la pagina principal
        <?php echo "<h1>" . $usuario . "</h1>" ?>
    </h1>

    <table>
        <caption>TABLA DE PRODUCTOS</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td>
                        <?php $producto->$idProducto ?>
                    </td>

                    <td>
                        <?php $producto->$nombreProducto ?>
                    </td>

                    <td>
                        <?php $producto->$precio ?>
                    </td>
                    <td>
                        <?php $producto->$descripcion ?>
                    </td>

                    <td>
                        <?php $producto->$imagen ?>
                    </td>

                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $producto->$idProducto ?>">
                            <input class="btn btn-dander" type="submit" value="Añadir a cesta">
                        </form>
                    </td>



                <?php } ?>

            </tr>
        </tbody>

    </table>


    <button> <a href="cerrar_sesion.php">Cerrar sesión</a></button>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</html>