<?php

class producto{

    public int $id_producto;
    public string $nombre;
    public string $precio;
    public string $descripcion;
    public string $cantidad;
    public string $imagen;

    function __construct(int $id_producto, string $nombre, string $precio, string $descripcion, int $cantidad, string $imagen)
    {
        $this->$id_producto = $id_producto;
        $this->$nombre = $nombre;
        $this->$precio = $precio;
        $this->$cantidad = $cantidad;
        $this->imagen = $imagen;

    }

}

?>