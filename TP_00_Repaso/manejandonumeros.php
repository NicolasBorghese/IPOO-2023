<?php

/**
 * Menú de selección
 * 
 * @return $int
 */
function seleccionarOpcion()
{
    do {
        echo "--------------------------------------------------------------------------------\n";
        echo "||                              MENÚ PRINCIPAL                                ||\n";
        echo "||                                                                            ||\n";
        echo "|| Ingrese por teclado el número que corresponda a la opción elegida:         ||\n";
        echo "||                                                                            ||\n";
        echo "|| [1]                                                                        ||\n";
        echo "|| [2]                                                                        ||\n";
        echo "|| [3]                                                                        ||\n";
        echo "|| [4]                                                                        ||\n";
        echo "|| [5]                                                                        ||\n";
        echo "|| [6]                                                                        ||\n";
        echo "|| [7]                                                                        ||\n";
        echo "|| [8]                                                                        ||\n";
        echo "|| [0] Finalizar el programa                                                  ||\n";
        echo "--------------------------------------------------------------------------------\n";
        echo "\n";
        echo "Opción elegida: ";
        $opcion = trim(fgets(STDIN));
        echo "\n";
        if ($opcion < 0 || $opcion > 8) {
            // Mensaje de error
            echo "\n";
            echo "Usted ha ingresado una opción no válida \n";
            echo "Recuerde que las operaciones disponibles solo responden al ingreso de números enteros entre 1 y 8";
            $opcion = detenerEjecucion();
        }
    } while ($opcion < 0 || $opcion > 8);

    return $opcion;
}

/**
 * Este modulo solicita que se ingrese un valor con el simple objeto de detener la ejecución del programa
 * y así poder leer resultados.
 * 
 * @return int
 */
function detenerEjecucion()
{
    echo "\n";
    // Mensaje de parada para leer los resultados
    echo "Presione ENTER para volver al menú principal o ingrese 0 para finalizar: ";
    // Obligación de ingresar un valor para continuar la ejecución del código
    $opcion = trim(fgets(STDIN));

    return $opcion;
}

/**
 * PUNTO 1 Función Factorial
 */
function factorial()
{
    echo "Ingrese el número del cual desea obtener su factorial: ";
    $numElegido = trim(fgets(STDIN));
    $factorial = 1;

    for ($i = 1; $i <= $numElegido; $i++) {
        $factorial = $factorial * $i;
    }

    echo "El factorial de " . $numElegido . " es " . $factorial."\n";
    echo "";
}

/** 
 * PUNTO 2 Indica si el número ingresado es par o no 
 * 
 * @return boolean
 */
function numeroPar()
{
    echo "Ingrese el número que desea saber si es par o no: ";
    $numElegido = trim(fgets(STDIN));
    $esPar = false;
    if ($numElegido % 2 == 0) {
        echo "El número es par \n";
        $esPar = true;
    } else {
        echo "El número no es par \n";
    }
    echo "";
    return  $esPar;
}

/**
 * PUNTO 3 Indica si el número ingresado N se puede dividir por el número ingresado M
 * 
 * @return boolean
 */
function divisionNporM()
{
    echo "Ingrese el número N: ";
    $numN = trim(fgets(STDIN));
    echo "Ingrese el número M: ";
    $numM = trim(fgets(STDIN));

    $esDivisible = false;

    if ($numN % $numM == 0) {
        echo "El número N SI es divisible por el número M \n";
        $esDivisible = true;
    } else {
        echo "El número N NO es divisible por el número M \n";
    }
    echo "";
    return  $esDivisible;
}

/**
 * PUNTO 4 Busca el número más grande y el número mas chico dentro de un arreglo e indica donde se encuentran
 */
function numerosEnArreglo()
{
    $coleccionNumeros = [
        5, 7, 25, 200, 33, 6
    ];

    $mayor = max($coleccionNumeros);
    $indMayor = array_search($mayor, $coleccionNumeros);
    echo "El número mayor dentro del arreglo es " . $mayor . "\n";
    echo "Que se encuentra en la posición " . $indMayor . "\n";
    $menor = min($coleccionNumeros);
    $indMenor = array_search($menor, $coleccionNumeros);
    echo "El número menor dentro del arreglo es " . $menor . "\n";
    echo "Que se encuentra en la posición " . $indMenor . "\n";
    echo "";
}

/**
 * PUNTO 5 este modulo lee un número y pide al usuario que ingrese esa cantidad de nombres luego retorna un arreglo que tiene todos esos nombres
 * 
 * @param int $cant
 * @return array
 */
function almacenaNombres($cant)
{
    $arregloNombres = [$cant];
    for ($i = 0; $i < $cant; $i++) {
        echo "Ingrese el nombre n°" . ($i + 1) . ": \n";
        $nombre = trim(fgets(STDIN));
        $arregloNombres[$i] = $nombre;
    }
    return $arregloNombres;
}

/**
 * PUNTO 6 este modulo guarda en un arreglo los años bisiestos menores al año ingresado
 * 
 * @param int $ano
 * @return array $arregloBisiestos
 */
function almacenaBisiestos($ano)
{
    $contador = 0;
    $arregloBisiestos = [];
    while ($contador < $ano && $ano >= 4) {
        if ($contador % 4 == 0) {
            if (!($contador % 100 == 0 && $contador % 400 != 0)) {
                array_push($arregloBisiestos, $contador);
            }
        }
        $contador++;
    }
    return $arregloBisiestos;
}

/**
 * PUNTO 7 toma 2 arreglos A y B, luego crea un arreglo que contiene los elementos de los 2 y lo retorna
 * 
 * @return array
 */
function sumaArreglos()
{
    $arregloA = ["arbol", "avion", "trineo"];
    $arregloB = [1, 5, 7, 25, 45];
    $arregloAmasB = [];

    for($i = 0; $i < count($arregloA); $i++){
        array_push($arregloAmasB, $arregloA[$i]);
    }

    for($i = 0; $i < count($arregloB); $i++){
        array_push($arregloAmasB, $arregloB[$i]);
    }
    return $arregloAmasB;
}

/**
 * PUNTO 8 toma 2 arreglos A y B, luego crea un arreglo que contiene los elementos de A pero no los de B
 * 
 * @return array
 */
function restaArreglos()
{
    $arregloA = ["helicoptero", "arbol","casa", "avion", "trineo", "helicoptero", "casa"];
    $arregloB = [1, 5, 7, 25, "casa", 45, "helicoptero"];
    $arregloAmenosB = [];

    echo "arreglo A: \n";
    print_r($arregloA);

    echo "arreglo B: \n";
    print_r($arregloB);

    for($i = 0; $i < count($arregloA); $i++){
        $posB = 0;
        while ($posB < count($arregloB) && $arregloA[$i] != $arregloB[$posB]){
            if($arregloA[$i] != $arregloB[$posB] && $posB == count($arregloB)-1){
                array_push($arregloAmenosB, $arregloA[$i]);
            }
            $posB++;
        }
    }

    return $arregloAmenosB;
}

/* PROGRAMA PRINCIPAL */

// Menú principal
do {
    $opcion = seleccionarOpcion();

    switch ($opcion) {
        case 1:
            factorial();
            $opcion = detenerEjecucion();
            break;
        case 2:
            numeroPar();
            $opcion = detenerEjecucion();
            break;
        case 3:
            divisionNporM();
            $opcion = detenerEjecucion();
            break;
        case 4:
            numerosEnArreglo();
            $opcion = detenerEjecucion();
            break;
        case 5:
            echo "Ingrese la cantidad de nombres que va a ingresar: ";
            $cantNombres = trim(fgets(STDIN));
            $verArreglo = almacenaNombres($cantNombres);
            print_r($verArreglo);
            $opcion = detenerEjecucion();
            break;
        case 6:
            echo "Ingrese el año limite para ver sus bisiestos anteriores: ";
            $anoIngresado = trim(fgets(STDIN));
            $verArreglo = almacenaBisiestos($anoIngresado);
            print_r($verArreglo);
            $opcion = detenerEjecucion();
            break;
        case 7:
            print_r(sumaArreglos());
            $opcion = detenerEjecucion();
            break;
        case 8:
            print_r(restaArreglos());
            $opcion = detenerEjecucion();
            break;
        case 0:
            echo "El programa ha finalizado \n";
            echo "";
            break;
    }
} while ($opcion != 0);

?>
