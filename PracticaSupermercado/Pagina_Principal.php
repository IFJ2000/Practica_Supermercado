<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../PracticaSupermercado/Objeto_producto.php" ?>
    <?php require "../PracticaSupermercado/Conexion_BBDD.php" ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    img {
        height: 200px;

    }

    #cerrarSesion {
        text-decoration: none;
        color: white;
    }
</style>

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

    <table class="table table-striped-columns">
        <caption>TABLA DE PRODUCTOS</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>
                <th>IMAGEN</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td>
                        <?php echo $producto->id; ?>
                    </td>

                    <td>
                        <?php echo $producto->nombre; ?>
                    </td>

                    <td>
                        <?php echo $producto->precio; ?>
                    </td>
                    <td>
                        <?php echo $producto->descripcion; ?>
                    </td>

                    <td>
                        <?php echo $producto->cantidad; ?>
                    </td>

                    <td>
                        <img src=" <?php echo $producto->imagen; ?>">

                    </td>

                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $producto->id ?>">
                            <input class="btn btn-success" type="submit" value="Añadir a cesta">
                        </form>
                    </td>



                <?php } ?>

            </tr>
        </tbody>

    </table>
    <?php

    /* APARTADO 7 */
    if (($_SERVER["REQUEST_METHOD"] == "POST")) {
        $sql = "SELECT * FROM cestas";
        $resultado = $conexion->query($sql);
        

        while ($fila = $resultado->fetch_assoc()) {
            $idCesta = $fila["idCesta"];

        }
        echo $idCesta;

        $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            $idProducto = $fila["idProducto"];
            $cantidad = $fila["cantidad"];
        }
        $sql = "INSERT INTO productosCestas (idProducto, idCesta, cantidadTotal) VALUES ('$idProducto','$idCesta','$cantidad')";
        echo "he insertado los datos en prodcutos cestas";
    }


    ?>



    <!-- ESTE TROZO ME SIRVE PARA EL APARTADOP 8 -->

    <!-- $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
        $idProducto = $fila["idProducto"];
        $idCesta = $fila["idCesta"];

        }
 -->

    <button class="btn btn-danger"> <a id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a></button>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>