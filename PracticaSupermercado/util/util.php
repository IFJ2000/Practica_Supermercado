<?php
 function depurar(string $entrada): string
 {
     $salida = htmlspecialchars($entrada);
     $salida = trim($entrada);
     var_dump($salida);
     return $salida;
 }

?>