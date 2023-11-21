<?php
function findUsuario($conexion, $usuario)
{
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    $usuario = null;
    if ($fila = $resultado->fetch_assoc()) { //obtiene el primer resultadoo, si exste entra em el if, si no no
        $usuario = $fila[Usuario::USUARIO];
        $contrasena = $fila[Usuario::CONTRASENA];
        $fecha_naci = $fila[Usuario::FECHA_NACI];
        $rol = $fila[Usuario::ROL];

        $usuario=  new Usuario($usuario, $contrasena, $fecha_naci, $rol);
    }
    return $usuario;
}
