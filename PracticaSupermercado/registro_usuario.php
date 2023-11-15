<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <?php require "../../Funciones/util.php" ?>
    <?php require "../PracticaSupermercado/Conexion_BBDD.php" ?>

</head>

<body>
    <h1>REGISTRO USUARIOS</h1><br><br>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $temp_usuario = depurar($_POST["usuario"]);
        $temp_contrasena = depurar($_POST["contrasena"]);
        $temp_fechaNaci = depurar($_POST["fechaNacimiento"]);


        if (strlen($temp_usuario) == 0) {
            $error_usuario = "El campo usuario es obligatorio";
        } else {

            if (strlen($temp_usuario) < 4 || strlen($temp_usuario) > 12) {
                $error_usuario = "El usurio debe de tener entre 4 y 12 caracteres";
            } else if (!preg_match("/^[\w_]+$/", $temp_usuario)) {
                $error_usuario = "El nombre de usuario debe de tener caracteres y barra baja";
            } else {
                $usuario = $temp_usuario;
                echo "hola";
            }
        }

        if (strlen($temp_contrasena) == 0) {
            $error_contrasena = "El campo contraseña es obligatorio";
        } else {

            if (strlen($temp_contrasena) > 255) {
                $error_contrasena = "La contraseña debe de tener menos de 255 char";
            } else {

                $contrasena = $temp_contrasena;
                $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
            }
        }


        if (strlen($temp_fechaNaci) == 0) {
            $error_fechaNaci = "No has seleccionado ninguna fecha";
        } else {
            $fechaActual = date("Y-m-d");

            list($añoActual, $mesActual, $diaActual) = explode("-", $fechaActual);
            list($añoNaci, $mesNaci, $diaNaci) = explode("-", $temp_fechaNaci);

            $edad = $añoActual - $añoNaci;

            if ($edad < 12 || $edad > 120) {
                $error_fechaNaci = "El usuario debe tener más de 12 años y menos de 120";
            } else if ($edad == 12 || $edad == 120) {
                // Si la edad es exactamente 12 o 120 años, se realiza una verificación adicional con el mes
                if ($mesActual < $mesNaci) {
                    $error_fechaNaci = "No puedes tener menos de 12 años";
                } elseif ($mesActual == $mesNaci && $diaActual < $diaNaci) {
                    $error_fechaNaci = "No puedes tener menos de 12 años";
                } 

                   
                
            }else{
                $fecha_naci = $temp_fechaNaci;
                echo "CUM";
            }
        }
    }


    ?>

    <form action="" method="post">
        <label for="" class="form-label">Usuario:</label>
        <input type="text" class="form-control" name="usuario">
        <?php if (isset($error_usuario)) {
            echo $error_usuario;
        } ?><br><br>
        <label for="" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" name="contrasena">
        <?php if (isset($error_contrasena)) {
            echo $error_contrasena;
        } ?><br><br>
        <label for="" class="form-label">fechaNacimiento:</label>
        <input type="date" class="form-control" name="fechaNacimiento">
        <?php if (isset($error_fechaNaci)) {
            echo $error_fechaNaci;
        } ?><br><br>

        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>

    <?php if (isset($usuario) && isset($contrasena) && isset($fecha_naci)) {
        $sql = "INSERT INTO usuarios (usuario, contraseña, fechaNacimiento) VALUES('$usuario','$contrasena_cifrada','$fecha_naci')";
        $conexion->query($sql);

        /* NOSE PORQUE PERO DUPLICA LOS REGISTROS */
        /*if ($conexion->query($sql) === TRUE) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error en la inserción: " . $conexion->error;
        }*/
    } ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>