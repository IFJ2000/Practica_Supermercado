<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $sql = "SELECT * FROM productos";
    $usuario = $conexion->query($sql);
    $productos = [];

    while ($fila = $usuario->fetch_assoc()) { /* Aqui fila es un array */
        $nombre = $fila["nombreProducto"];
        $precio = $fila["precio"];
        $descripcion = $fila["descripcion"];
        $cantidad = $fila["cantidad"];
        $imagen = $fila["imagen"];
        $nuevo_producto = new producto($id_producto,$nombre, $precio, $descripcion, $cantidad, $imagen);
        array_push($productos, $nuevo_producto);
    }
    ?>
    <h1>Listado de videojuegos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <?php
                foreach ($productos as $producto) { ?>
                <tr>

                    <td>
                        <?php echo $producto->$id_producto ?>
                    </td>
                    <td>
                        <?php echo $producto->$nombre ?>
                    </td>
                    <td>
                        <?php echo $producto->$precio ?>
                    </td>
                    <td>
                        <?php echo $producto->$descripcion ?>
                    </td>
                    <td>
                        <?php echo $producto->$cantidad ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $producto->$id_producto ?>">
                            <input class="btn btn-dander" type="submit" value="Añadir a cesta">
                        </form>
                    </td>
                </tr>
                <?php

                }
                ?>
            </tr>
        </tbody>

    </table>


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</html>