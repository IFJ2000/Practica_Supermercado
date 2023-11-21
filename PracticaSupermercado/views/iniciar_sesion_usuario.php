<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <?php require "../util/util.php" ?>
    <?php require "../util/Conexion_BBDD.php" ?>
    <?php require "../util/constantes_vista.php" ?>
    <?php require "../util/controlador_usuario.php" ?>
    <?php require "../model/Objeto_usuario.php" ?>
    <?php require "../util/constantes_sesion.php" ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = depurar($_POST[Constantes_vista::USUARIO]);
        $contrasena = depurar($_POST[Constantes_vista::CONTRASENA]);
        $usuario = findUsuario($conexion, $usuario);
        if ($usuario == null) {
            echo "El usuario introducido no existe";
        } else {

            $acceso_valido = password_verify($contrasena, $usuario->contrasena);

            if ($acceso_valido) {
                echo "TE HAS LOGEADO CON EXITO " . $usuario->usuario;
                session_start();
                $_SESSION[ConstantesSesion::USUARIO] = $usuario->usuario;
                $_SESSION[ConstantesSesion::ROL] = $usuario->rol;


                if ($_SESSION[ConstantesSesion::ROL] == "admin") {
                    header("Location: Insertar_product.php");
                } else {
                    header("Location: Pagina_Principal.php");
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>