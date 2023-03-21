<?php

include("Calculadora.php");

echo "Ingrese un número A: \n";
$numA = trim(fgets(STDIN));
echo "Ingrese un número B: \n";
$numB = trim(fgets(STDIN));

$calculadora = new Calculadora();
print_r ( $calculadora ) ;

$resultado = $calculadora->suma($numA, $numB);
echo "El resultado de la suma entre A y B es: ".$resultado."\n";

$resultado = $calculadora->resta($numA, $numB);
echo "El resultado de la resta entre A y B es: ".$resultado."\n";

$resultado = $calculadora->multiplicar($numA, $numB);
echo "El resultado de multiplizar A por B es: ".$resultado."\n";

$resultado = $calculadora->dividir($numA, $numB);
echo "El resultado de dividir A por B es: ".$resultado."\n";




?>