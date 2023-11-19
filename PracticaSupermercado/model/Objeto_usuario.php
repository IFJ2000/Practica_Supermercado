<?php

class Usuario
{
    const USUARIO = "usuario";
    const CONTRASENA = "contraseña";
    const FECHA_NACI = "fechaNacimiento";
    const ROL = "rol";
    public string $usuario;
    public string $contrasena;
    public string $fecha_naci;
    public string $rol;


    function __construct(string $usuario, string $contrasena, string $fecha_naci, string $rol)
    {
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->fecha_naci = $fecha_naci;
        $this->rol = $rol;
    }
}
