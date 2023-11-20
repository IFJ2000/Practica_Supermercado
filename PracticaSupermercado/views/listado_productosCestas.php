<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cesta de Productos de </h1>
    <?php
    /* Crea una página donde se muestren los productos que hay en la cesta del usuario que ha iniciado sesión. Se mostrará el nombre del producto, su imagen, precio por unidad y la cantidad que hay en la cesta. */
    $sql = "SELECT nombreProducto, imagen , precio , cantidad FROM  Productos INNER JOIN cestas ON productos.idProducto = cestas.idCesta";
    $resultado = $conexion->query($sql);
    $productosCesta = [];
    while ($fila = $resultado->fetch_assoc()) {


        $nombre_Producto = $fila[Constantes_producto::NOMBRE];
        $imagen = $fila["imagen"];
        $precioProducto = $fila[Constantes_producto::PRECIO];
        $cantidad = $fila[Constantes_producto::CANTIDAD];
        array_push($productosCesta, $nombre_Producto);
        array_push($productosCesta, $imagen);
        array_push($productosCesta, $precioProducto);
        array_push($productosCesta, $cantidad);

    }
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
            <?php foreach ($productosCesta as $lista) ?>
            <tr>
                <td>
                    <?php echo $lista->nombreProducto ?>
                </td>

                <td>
                    <?php echo $lista->imagen ?>
                </td>

                <td>
                    <?php echo $lista->precio ?>
                </td>

                <td>
                    <?php echo $lista->cantidad ?>
                </td>
            </tr>

        </tbody>




    </table>
</body>

</html>