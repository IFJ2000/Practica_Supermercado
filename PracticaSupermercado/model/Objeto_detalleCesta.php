<?php
class DetalleCesta
{
    public string $nombreProducto;
    public string $imagen;
    public float $precio;
    public int $cantidad;

    function __construct(string $nombreProducto, string $imagen, float $precio, int $cantidad)
    {
        $this->nombreProducto = $nombreProducto;
        $this->imagen = $imagen;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
};
