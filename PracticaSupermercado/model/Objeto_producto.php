<?php

class producto
{

    public int $id;
    public string $nombre;
    public string $precio;
    public string $descripcion;
    public string $cantidad;
    public string $imagen;

    function __construct(int $id, string $nombre, string $precio, string $descripcion, int $cantidad, string $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->imagen = $imagen;
    }
}
