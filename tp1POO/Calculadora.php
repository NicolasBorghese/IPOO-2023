<?php

class Calculadora{

    // Sin atributos

    public function __construct()
    {
        // No recibe parametros
        // No modifica atributos
    }

    public function suma($numA, $numB){
        return $numA + $numB;
    }

    public function resta($numA, $numB){
        return $numA - $numB;
    }

    public function multiplicar($numA, $numB){
        return $numA * $numB;
    }

    public function dividir($numA, $numB){
        return $numA / $numB;
    }

    // No tiene atributos, por lo tanto no tiene toString
}

?>