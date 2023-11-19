<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require "../util/util.php" ?>
    <?php require "../util/Conexion_BBDD.php" ?>


</head>

<body>
    <h1>INSERTAR PRODUCTOS</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $temp_nombre = depurar($_POST["nombre"]);
        $temp_precio = depurar($_POST["precio"]);
        $temp_descripcion = depurar($_POST["descripcion"]);

        $temp_cantidad = depurar($_POST["cantidad"]);


        /* ------------------------------------------------------------------------------------ */

        if (strlen($temp_nombre) == 0) {

            $error_nombre = "El campo nombre es obligatorio";
        } else {

            if (strlen($temp_nombre) > 40) {
                $error_nombre = "El nombre debe de tener menos de 40 caracteres";
            } else if (!preg_match("/^[a-zA-Z 0-9]+$/", $temp_nombre)) {

                $error_nombre = "El nombre solo acepta caracteres, numeros  y espacios en blanco ";
            } else {

                $nombre = $temp_nombre;
                echo "soy la imagen correcta";
            }
        }

        if (strlen($temp_precio) == 0) {
            $error_precio = "El campo precio es un campo obligatorio";
            echo "1";
        } else {
            $temp_precio = (float) $temp_precio;
            if ($temp_precio > 99999.99 || $temp_precio < 0) {
                $error_precio = "El precio debe ser menor de 99999,99 y mayor que 0";
                echo "2";
            } else if (filter_var($temp_precio, FILTER_VALIDATE_FLOAT) == false) {
                $error_precio = "El precio debe de ser un numero";
                echo "3";
            } else {
                $precio = $temp_precio;
                echo "soy el precio correcto";
            }
        }

        if (strlen($temp_descripcion) == 0) {
            $error_descripcion = "El campo descripción es obligatorio ";
        } else {
            if (strlen($temp_descripcion) > 255) {
                $error_descripcion = "La descripcion debe tener menos de 255 caracteres ";
            } else {

                $descripcion = $temp_descripcion;
                echo "soy la descripcion correcta!";
            }
        }

        if (strlen($temp_cantidad) == 0) {
            $error_cantidad = "El campo cantidad es un campo obligatorio";
        } else {

            if (filter_var($temp_cantidad, FILTER_VALIDATE_INT) == false) {
                echo "holaaaa";
                $error_cantidad = "La cantidad introducida no es un numero";
            } else if ($temp_cantidad > 99999 || $temp_cantidad < 0) {

                $error_cantidad = "La cantidad debe ser mayo a 0 y menor que 99999";
            } else {

                $cantidad = $temp_cantidad;
                echo "soy la cantidad correcta!";
            }
        }

        /* Para mostar el nombre de  imagenes */
        $nombre_fichero = $_FILES["imagen"]["name"];
        echo $nombre_fichero . "aaaaaaaaaa";
        $temp_imagen = $_FILES["imagen"]["tmp_name"];
        echo $temp_imagen;

        if (strlen($nombre_fichero) == 0) {
            $error_imagen = "El campo imagen es obligatorio";
        } else {


            $tamaño_fichero = $_FILES["imagen"]["size"];
            echo $tamaño_fichero;

            $tamaño_Max_Fichero = 1 * 1024 * 1024;
            $formato = $_FILES["imagen"]["type"];

            if ($tamaño_fichero > $tamaño_Max_Fichero) {
                $error_imagen = "Error, la imagen es muy pesada, debe pesar menos de 1MB";
            } else if (!strpos($formato, "/jpg") && !strpos($formato, "/jpeg") && !strpos($formato, "png")) {
                $error_imagen = "El formato de la imagen no es correcto: jpg/jpeg/png";
            } else {
                //$imagen = $temp_imagen;
                $rutaFinal = "./images/" . $nombre_fichero;
                move_uploaded_file($temp_imagen, $rutaFinal);
            }
        }
    }


    ?>

    <form action="" method="post" enctype="multipart/form-data"> <!-- Para insertar imagenes -->
        <!--  <label class="form-label" for="">Identificador:</label>
            <input class="form-control valied-tooltip" type="number" name="id">
            <br><br> -->
        <label class="form-label" for="">Nombre:</label>
        <input class="form-control" type="text" name="nombre">
        <?php if (isset($error_nombre)) {
            echo $error_nombre;
        }
        ?>
        <br><br>
        <label class="form-label" for="">precio:</label>
        <input class="form-control" type="number" name="precio">
        <?php if (isset($error_precio)) {
            echo $error_precio;
        } ?>
        <br><br>

        <label class="form-label" for="">Descripción</label>
        <input class="form-control" type="text" name="descripcion">
        <?php if (isset($error_descripcion)) {
            echo $error_descripcion;
        } ?>
        <br><br>

        <label class="form-label" for="">Cantidad</label>
        <input class="form-control" type="text" name="cantidad">
        <?php if (isset($error_cantidad)) {
            echo $error_cantidad;
        } ?>
        <br><br>
        <div class="mb-3">
            <label for="" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen">
            <?php if (isset($error_imagen)) {
                echo $error_imagen;
            } ?>
        </div>

        <input type="submit" class="btn btn-primary" value="Enviar Producto">

    </form>
    
    <?php
    if (isset($nombre) && isset($precio) && isset($descripcion) && isset($cantidad) && isset($rutaFinal)) {
        $sql = "INSERT INTO productos (nombreProducto , precio , descripcion, cantidad, imagen) VALUES('$nombre', $precio, '$descripcion', $cantidad , '$rutaFinal')";
        $conexion->query($sql);
        echo $sql;
    }
    ?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</html>