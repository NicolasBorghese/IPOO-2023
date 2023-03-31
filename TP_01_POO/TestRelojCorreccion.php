<?php

include("RelojCorreccion.php");

//Creo el objeto reloj
$objReloj = new RelojCorreccion(23, 59, 58);
//Invoco a los metodos
echo $objReloj."\n";
$objReloj->incrementar();
echo "1er incremento: ".$objReloj."\n";
$objReloj->incrementar();
echo "2er incremento: ".$objReloj."\n";
$objReloj->incrementar();
echo "3er incremento: ".$objReloj."\n";

$objReloj->puesta_a_cero();
echo $objReloj."\n";

?>