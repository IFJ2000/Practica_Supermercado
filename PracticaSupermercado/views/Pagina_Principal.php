<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../model/Objeto_producto.php" ?>
    <?php require "../util/constantes_sesion.php" ?>
    <?php require "../util/Conexion_BBDD.php" ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    img {
        height: 200px;

    }

    #cerrarSesion {
        text-decoration: none;
        color: white;
    }

    #verCesta {
        text-decoration: none;
        color: white;

    }
</style>

<body>
    <?php

    session_start();
    if (isset($_SESSION[ConstantesSesion::USUARIO])) {
        $usuario = $_SESSION[ConstantesSesion::USUARIO];
    } else {
        $_SESSION[ConstantesSesion::USUARIO] = "invitado";
        $usuario = $_SESSION[ConstantesSesion::USUARIO];
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

        $nuevo_producto = new Producto($id, $nombre, $precio, $descripcion, $cantidad, $imagen);
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
        if (isset($_POST["id_producto"])) {
            $id_producto = $_POST["id_producto"];
            $usuario = $_SESSION[ConstantesSesion::USUARIO];
            $sql = "SELECT idCesta FROM cestas WHERE usuario = '$usuario'";
            $usuario = $conexion->query($sql);
            if ($usuario->num_rows == 0) {
                echo "no hay cestas registradas en la base de datos";
            } else {

                $fila = $usuario->fetch_assoc();
                $idCesta = $fila["idCesta"];

                echo $idCesta;

                $sql = "SELECT * FROM productosCestas WHERE idProducto = '$id_producto' AND idCesta = '$idCesta'";
                $usuario = $conexion->query($sql);

                if ($usuario->num_rows == 0) {
                    $sql = "INSERT INTO productosCestas (idProducto, idCesta, cantidad) VALUES ('$id_producto','$idCesta',1)";
                    $usuario = $conexion->query($sql);

                    echo "Producto añadido!!";
                } else {

                    $fila = $usuario->fetch_assoc();
                    $cantidad = $fila["cantidad"] + 1;
                    $sql = "UPDATE  productosCestas SET cantidad = '$cantidad' WHERE idProducto = '$id_producto' AND idCesta = '$idCesta'";
                    $usuario = $conexion->query($sql);
                    echo "se ha añadido otro producto";
                }
            }
        }
    }




    ?>


    <a id="cerrarSesion" href="cerrar_sesion.php"><button class="btn btn-danger">Cerrar sesión</button></a>
    <a id="verCesta" href="listado_productosCestas.php"><button class="btn btn-info">Ver Cesta de productos</button></a>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>