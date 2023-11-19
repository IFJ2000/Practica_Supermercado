<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../util/Conexion_BBDD.php" ?>
    <?php require "../views/iniciar_sesion_usuario.php" ?>
</head>

<body>
    <?php
    //crea la sesion o la recupera
    session_start();
    //destruimos la sesion
    session_destroy();
    header("location: ../views/iniciar_sesion_usuario.php");

    ?>
</body>

</html>