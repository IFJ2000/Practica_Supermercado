<?php
//crea la sesion o la recupera
session_start();
//destruimos la sesion
session_destroy();
header("location: principal.php");

?>