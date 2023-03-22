<?php

include("Reloj.php");

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
        echo "|| [1] Incrementa el reloj según los segundos indicados                       ||\n";
        echo "|| [2] Muestra los valores del reloj                                          ||\n";
        echo "|| [3] Para ejecutar la operación 3                                           ||\n";
        echo "|| [4] Para ejecutar la operación 4                                           ||\n";
        echo "|| [5] Para ejecutar la operación 5                                           ||\n";
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
 * Incrementa el reloj en una cantidad de segundos indicada
 * 
 * @param int $segundosIncrementados
 * @param Reloj $reloj
 */
function incrementaReloj($segundosIncrementados, $reloj){
    for($i = 0; $i < $segundosIncrementados; $i++){
        $reloj->incremento();
    }
}

/**
 * Muestra los valores del reloj actualmente
 * 
 * @param Reloj $reloj
 */
function muestraReloj($reloj){
    echo "Reloj: ".$reloj->__toString();
    echo "\n";
}

/**
 * Vuelve el reloj a 0
 * 
 * @param Reloj $reloj
 */
function resetearReloj($reloj){
    $reloj->puesta_a_cero();
}

/**
 * OPERACIÓN 1 GENÉRICA
 * (Formato de un comentario genérico)
 * 
 * @param int $elemento1
 * @param float $elemento2
 * @param string $elemento3
 * @param boolean $elemento4
 * @param array $elemento5
 * 
 * @return int
 */
function operacionGenerica1($elemento1, $elemento2){
    // int $elementoRetornado

    $elementoRetornado = 1;

    return $elementoRetornado;
}

/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int
// string
// boolean
// array

$reloj = new Reloj();


do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            echo "Indique la cantidad de segundo que desea incrementar el reloj: ";
            $segundosIncrementados = trim(fgets(STDIN));
            incrementaReloj($segundosIncrementados, $reloj);
            echo "Incrementado exitosamente. \n";
            detenerEjecucion();
            break;
        case 2:
            muestraReloj($reloj);
            detenerEjecucion();
            break;
        case 3:
            resetearReloj($reloj);
            echo "Reloj en 0 exitosamente";
            detenerEjecucion();
            break;
        case 4:
            // Ejecuta la operación 4
            break;
        case 5:
            // Ejecuta la operación 5
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