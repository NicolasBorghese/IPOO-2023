<?php

/********************************************************************************/
/*********************************** FUNCIONES **********************************/
/********************************************************************************/

/**
 * Imprime en pantalla un menú de opciones y
 * retorna un entero que representa la opcion elegida
 * 
 * @return int
 */
function menuDesplegable()
{
    // int $opcionElegida

    do{
        echo "--------------------------------------------------------------------------------\n";
        echo "||                              MENÚ PRINCIPAL                                ||\n";
        echo "||                                                                            ||\n";
        echo "|| Ingrese por teclado el número que corresponda a la opción elegida:         ||\n";
        echo "||                                                                            ||\n";
        echo "|| [1] Cuenta letras en una cadena de texto                                   ||\n";
        echo "|| [2] Cuenta aparición de caracter en texto                                  ||\n";
        echo "|| [3] Indica si un texto se encuentra dentro de otro                         ||\n";
        echo "|| [4] Cuenta los caracteres que contiene un texto ingresado                  ||\n";
        echo "|| [5] Compara la longitud de 2 strings y devuelve el más largo               ||\n";
        echo "|| [0] Para finaizar el programa                                              ||\n";
        echo "||                                                                            ||\n";
        echo "--------------------------------------------------------------------------------\n";
        echo "\n";
        echo "Indique la operación que desea realizar: ";
        $opcionElegida = trim(fgets(STDIN));
        
        // OBSERVAR: el rango varía según cantidad de opciones
        if($opcionElegida < 0 || $opcionElegida > 5){
            echo "\n";
            // Mensaje de error cuando la opción elegida está fuera de rango
            echo "--------------------------------------------------------------------------------\n";
            echo "|| ¡ERROR! Usted ha ingresado un valor NO válido,                             ||\n";
            echo "|| verifique las opciones del menú nuevamente.                                ||\n";
            echo "--------------------------------------------------------------------------------\n";
            detenerEjecucion();
        }
    // OBSERVAR: el rango varía según cantidad de opciones
    } while ($opcionElegida < 0 || $opcionElegida > 5);

    echo "\n";

    return $opcionElegida;  
}

/**
 * Este módulo solicita que se ingrese un valor con el simple objeto
 * de detener la ejecución del programa y así poder leer resultados.
 * 
 */
function detenerEjecucion()
{
    // string $presionarEnter

    echo "\n";

    do {
        // Mensaje de parada para leer los resultados
        echo "Presione [ENTER] para continuar. ";
        // Obligación de ingresar un valor para continuar la ejecución del código
        $presionarEnter = trim(fgets(STDIN));

    }while ($presionarEnter != "");
    
    echo "\n";
}

/**
 * PUNTO 1
 * Lee una cadena de caracteres e indica la cantidad de letras que tiene
 * (Dada una cadena de caracteres terminada en punto retornar la cantidad de letras que contiene la cadena)
 */
function cuentaLetras(){
    // string $palabra
    // int cuentaLetras

    echo "Ingrese una palabra para saber cuantas letras contiene: ";
    $palabra = trim(fgets(STDIN));

    $cuentaLetras = 0;

    for($i = 0; $i < strlen($palabra) ; $i++){
        
        if(esLetra(substr($palabra, $i, 1))){
            $cuentaLetras++;
        }
    }

    echo "La cantidad de letras que tiene la palabra ingresada es: ".$cuentaLetras."\n";
}

/**
 * Indica si un caracter recibido es una letra o no
 * 
 * @param string
 * @return boolean
 */
function esLetra($letraRecibida){
    $esUnaLetra = true;

    $letraRecibida = strtolower($letraRecibida);

    switch($letraRecibida){
        case "a":
            break;
        case "b":
            break;
        case "c":
            break;
        case "d":
            break;
        case "e";
            break;
        case "f":
            break;
        case "g":
            break;
        case "h":
            break;
        case "i":
            break;
        case "j":
            break;
        case "k";
            break;
        case "l":
            break;
        case "m";
            break;
        case "n";
            break;
        case "o":
            break;
        case "p";
            break;
        case "r":
            break;
        case "s":
            break;
        case "t":
            break;
        case "w";
            break;
        case "x";
            break;
        case "y";
            break;
        case "z";
            break;
        default:
            $esUnaLetra = false;
            break;
    }

    return $esUnaLetra;
}

/**
 * PUNTO 2
 * Dado un texto terminado en / y un caracter, determinar cuántas veces aparece ese caracter en la cadena.
 */
function cuentaCaracter(){
    //string $caracter, $texto
    // int $cuentaCaracter

    echo "Ingrese un caracter para saber cuantas veces se encuentra en un texto: ";
    $caracter = trim(fgets(STDIN));
    echo "Ingrese un texto: ";
    $texto = trim(fgets(STDIN));
    $cuentaCaracter = 0;

    for($i = 0; $i < strlen($texto); $i++){
        if(substr($texto, $i, 1) == $caracter){
            $cuentaCaracter++;
        }
    }

    echo "El caracter ".$caracter." se encuentra en el texto :".$cuentaCaracter." veces.\n";
}

/**
 * PUNTO 3
 * Dada 2 cadenas cadena1 y cadena2 retornar verdadero si cadena2 se encuentra en cadena1 y 
 * falso en caso contrario.
 */
function cadena2EnCadena1(){
    // string $cadena1, $cadena2
    // boolean $cadenaEncontrada

    echo "Ingrese la cadena de texto 1 (donde se va a buscar): ";
    $cadena1 = trim(fgets(STDIN));
    echo "Ingrese la cadena de texto 2 (la cadena que se va a buscar): ";
    $cadena2 = trim(fgets(STDIN));

    $cadenaEncontrada = str_contains($cadena1, $cadena2);

    if($cadenaEncontrada){
        echo "La cadena de texto 2 SI se encuentra contenida dentro de la cadena 1.";
    } else {
        echo "La cadena de texto 2 NO se encuentra contenida dentro de la cadena 1.";
    }
}

/**
 * PUNTO 4
 * Dada una cadena retornar su longitud sin utilizar la función count de PHP.
 * 
 * @param string $texto
 * @return int
 */
function longitudCadena($texto){
    // int $cuentaCaracter

    $cuentaCaracter = 0;

    while(substr($texto, $cuentaCaracter, 1) != "" ){
        $cuentaCaracter++;
    }

    return $cuentaCaracter;
}

/**
 * PUNTO 5
 * Dada 2 cadenas cadena1 y cadena2 retornar la cadena de mayor longitud, invocar al método implementado 
 * para el inciso anterior.
 * 
 * @param string $cadena1
 * @param string $cadena2
 * @return string
 */
function comparaLongitudCadenas($cadena1, $cadena2){

    // string $cadenaMayor
    if(longitudCadena($cadena1) > longitudCadena($cadena2)){
        $cadenaMayor = $cadena1;
    }else{
        $cadenaMayor = $cadena2;
    }
    return $cadenaMayor;
}

/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int $opcionMenu

do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            cuentaLetras();
            detenerEjecucion();
            break;
        case 2:
            cuentaCaracter();
            detenerEjecucion();
            break;
        case 3:
            cadena2EnCadena1();
            detenerEjecucion();
            break;
        case 4:
            echo "Ingrese una cadena de texto para botener la cantidad de caracteres que la componen: ";
            $cadenaTexto = trim(fgets(STDIN));
            $cuentaCaracter = longitudCadena($cadenaTexto);
            echo "La cantidad de caracteres que contiene el texto ingresado es: ".$cuentaCaracter."\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 5:
            echo "Ingrese la cadena de texto 1 para comparar: ";
            $cadena1 = trim(fgets(STDIN));
            echo "Ingrese la cadena de texto 2 para comparar: ";
            $cadena2 = trim(fgets(STDIN));
            $cadenaMasLarga = comparaLongitudCadenas($cadena1, $cadena2);
            echo "La cadena de mayor longitud es: ".$cadenaMasLarga."\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 0:
            // Finaliza el programa
            break;
        default:
            // En caso de error (imposible) accederá a esta opción
            break;
    }

} while ($opcionMenu != 0);

echo "¡PROGRAMA FINALIZADO!\n";
echo "\n";

?>