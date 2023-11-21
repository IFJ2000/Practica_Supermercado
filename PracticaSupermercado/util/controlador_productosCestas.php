<?php require "../model/Objeto_detalleCesta.php" ?>
<?php require "../model/Objeto_producto.php" ?>


<?php
function findProductosCestas($conexion, $usuario)
{
    $sql = "SELECT nombreProducto, imagen , precio , productosCestas.cantidad 
    FROM  productosCestas 
    INNER JOIN cestas ON cestas.idCesta = productosCestas.idCesta 
    INNER JOIN productos ON productos.idProducto = productosCestas.idProducto 
    WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    $listaDetalles = [];
    while ($fila = $resultado->fetch_assoc()) {


        $nombre_Producto = $fila[Producto::NOMBRE];
        $imagen = $fila[Producto::IMAGEN];
        $precioProducto = $fila[Producto::PRECIO];
        $cantidad = $fila[Producto::CANTIDAD];
        $detalleCesta = new DetalleCesta($nombre_Producto, $imagen, $precioProducto, $cantidad);
        array_push($listaDetalles, $detalleCesta);
    }

    return $listaDetalles;
}
