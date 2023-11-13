<?php
$_servidor = 'localhost';
$_usuario = 'root';
$_contrasena = 'medac';
$_base_de_datos = 'db_login';


$_conexion = new mysqli($_servidor, $_usuario, $_contrasena, $_base_de_datos) /* fUNCION QUE RECIBE LOS PARAMETROS NECESARIOS PARA REALIZAR LA CONEX CON LA bbdd */
    or die("ERROR DE CONEXIÓN");


?>