<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../util/constantes_sesion.php" ?>
    <?php require "../util/Conexion_BBDD.php" ?>
    <?php require "../util/constantes_vista.php" ?>
    <?php require "../util/controlador_productosCestas.php" ?>
    <style>
        img {
            height: 200px;

        }

        #cerrarSesion {
            text-decoration: none;
            color: white;
        }

        #paginaPrincipal {
            text-decoration: none;
            color: white;

        }
    </style>
</head>

<body>

    <?php

    session_start();
    if (!isset($_SESSION[ConstantesSesion::USUARIO])) {
        header("location: ../views/iniciar_sesion_usuario.php");
    } else {
    } ?>



    <h1>Cesta de Productos de
        <?php echo "<h1>" . $_SESSION[ConstantesSesion::USUARIO] . "</h1>" ?>
    </h1>

    <?php
    $usuario =  $_SESSION[ConstantesSesion::USUARIO];
    $productosCesta = findProductosCestas($conexion, $usuario);

    ?>

    <table>
        <thead>
            <tr>

                <th>Nombre de Producto</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>


        </thead>
        <tbody>
            <?php foreach ($productosCesta as $lista) {

            ?>
                <tr>
                    <td>
                        <?php echo $lista->nombreProducto ?>

                    </td>

                    <td>
                        <img src=" <?php echo $lista->imagen; ?>">
                    </td>

                    <td>
                        <?php echo $lista->precio ?>
                    </td>

                    <td>
                        <?php echo $lista->cantidad ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
    <a id="cerrarSesion" href="cerrar_sesion.php"><button class="btn btn-danger">Cerrar sesión</button></a>
    <a id="paginaPrincipal" href="Pagina_Principal.php"> <button class="btn btn-info">Volver a la Pagina Principal</button></a>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>