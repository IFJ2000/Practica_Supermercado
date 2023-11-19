<?php
function findUsuario($conexion, $usuario)
{
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);

    while ($fila = $resultado->fetch_assoc()) {
        $usuario = $fila[Usuario::USUARIO];
        $contrasena = $fila[Usuario::CONTRASENA];
        $fecha_naci = $fila[Usuario::FECHA_NACI];
        $rol = $fila[Usuario::ROL];

        return  new Usuario($usuario, $contrasena, $fecha_naci, $rol);
    }
    return null;
}
