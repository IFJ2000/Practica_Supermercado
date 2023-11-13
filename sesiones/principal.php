<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require "conexion.php" ?>
</head>

<body>
    <?php
    session_start(); /* Inicio sesion y almaceno (recupero) el uduario de la sesion */
    /* Con esto controlamos que el usuario no pueda acceder a la pagina principal si no esta logeado lo redirige al login */
   
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        //header("location: iniciar_Sesion.php"); /* lo redirige al login  */
        
        /* Entramos como invitado */
        $_SESSION["usuario"] = "invitado";
        $usuario = $_SESSION["usuario"];
    }

    ?>
    <div class="container">
        <h1>Esta el la pagina principal</h1>
        <h2>Bienvenid@
            <?php echo $usuario ?> <!-- SERA O EL USUARIO QUE NOS LOGEAMOS O COMO INVITADO -->
        </h2>
    </div>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>

</html>