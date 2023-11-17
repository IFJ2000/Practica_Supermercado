<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../../Funciones/util.php" ?>
    <?php require "../PracticaSupermercado/Conexion_BBDD.php" ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <!-- ARREGLAR EL FILTRO DEL ROL!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = depurar($_POST["usuario"]);
        $contrasena = depurar($_POST["contrasena"]);
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows == 0) {
            echo "El usuario introducido no existe";
        } else {
            while ($fila = $resultado->fetch_assoc()) {
                $contrasena_cifrada = $fila["contraseña"];
                $rol = $fila["rol"];
            }
            $acceso_valido = password_verify($contrasena, $contrasena_cifrada);

            if ($acceso_valido) {
                echo "TE HAS LOGEADO CON EXITO $usuario";
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = $rol;
                //$_SESSION["loquesea"] = "loquesea";
                /* AQUI CONTROLAREMOS SI EL USUARIO TIENE ROL DE ADMIN O NO*/
               /*  $sql = "SELECT rol FROM usuarios WHERE usuario = $usuario";
                $resultado = $conexion->query($sql);
                while ($fila = $resultado->fetch_assoc()) {
                    $rol = $fila["rol"];
                } */

                if ($_SESSION["rol"] == "admin") {
                    header("Location: Insertar_product.php");
                } else {
                    header("Location: Pagina_Principal.php");
                }
            } else {
                echo "CONTRASEÑA MAL";
            }

            /*header("location: Pagina_Principal.php");
            } else {
                echo "CONTRASEÑA MAL";
            }*/
        }
    }
    ?>


    <div class="container">
        <h1>Iniciar Sesión</h1>

        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <input type="submit" value="Iniciar Sesion" class="btn btn-primary">

        </form>

    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>