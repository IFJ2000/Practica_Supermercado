<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require "../Práctica Supermercado/Insertar_product.php" ?>
</head>

<body>
    <?php

    session_start();
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        $_SESSION["usuario"] = "invitado";
        $usuario = $_SESSION["usuario"];

    }
    ?>

    <h1>BIENVENIDO A LA PAGINA PRINCIPAL
        <?php echo $usuario ?>
    </h1>

    <table>
        <caption>TABLA DE PRODUCTOS</caption>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $sql = "SELECT * FROM productos";
                $resultado = $_conexion->query($sql);
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<td>" . $fila["nombre"]. "</td>";
                    echo "<td>" . $fila["precio"] . "</td>";
                    echo "<td>" . $fila["descripcion"] . "</td>";
                    echo "<td>" . $fila["cantidad"] . "</td>";
                    echo "<td>". $fila["imagen"] . "</td>";

                }
                ?>

            </tr>

        </tbody>

    </table>
</body>

</html>