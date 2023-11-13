<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../Funciones/util.php" ?>
    <?php require "../Práctica Supermercado/BBDD_Supermercado.sql" ?>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = depurar($POST["usuario"]);
        $contrasena = depurar($POST["contrasena"]);
        $sql = "SELECT * FROM usuarios WHERE usuario = $usuario";
        $resultado = $_conexion->query($sql);
        if ($resultado->num_rows == 0) {
            echo "El usuario introducido no existe";

        } else {
            while ($fila = $resultado->fetch_assoc()) {
                $contrasena_cifrada = $fila["contrasena"];
            }
            $acceso_valido = password_verify($_contrasena, $contrasena_cifrada);
            if ($acceso_valido) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                //$_SESSION["loquesea"] = "loquesea";
                /* AQUI CONTROLAREMOS SI EL USUARIO TIENE ROL DE ADMIN O NO*/
                /* select rol FROM usuarios WHERE usuario = $usuario */
                $_SESSION["rol"] = $rol;
                if ($_SESSION["rol"] == "admin") {
                    header("Location: Insertar_product.php");
                } else {
                    header("Location: principal.php");

                }
            } else {
                echo "CONTRASEÑA MAL";
            }
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

</html>