<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require "../Práctica Supermercado/BBDD_Supermercado.sql" ?>
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    /* Almacenamos en resultado la tabla gracias a la sentencia sql que nos la muestra */
    $usuario = $_conexion->query($sql);
    /* Si en la tabla no hay ninguna fila */
    if ($usuario->num_rows == 0) {
        echo " El usuario introducido no existe";
    } else {
        /* Coge la info d euna tabla de manera asociativa y cada fila la transforma en un array, en cada iteracion alamacena en la variable $fila una fila de la tabla */
        while ($fila = $usuario->fetch_assoc()) {
            $contrasena_cifrada = $fila["contrasena"]; /* En contraseña_cifrada metemos las contraseñas de cada fila de la tabla. Al poner [contrasena], nos referimos a la columna de la tabla */
        }
        
        $acceso_valido = password_verify($contrasena, $contrasena_cifrada);
        if ($acceso_valido) {
            header("Location: .$principal.php");
        }

    }
}
?>




<body>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>