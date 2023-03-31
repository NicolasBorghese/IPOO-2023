<?php
include("Fecha.php");

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
        echo "|| [1] Incrementa la fecha en un día                                          ||\n";
        echo "|| [2] Muestra la fecha abreviada                                             ||\n";
        echo "|| [3] Muestra la fecha extendida                                             ||\n";
        echo "|| [4] Modificar la fecha actual (no valida fecha correcta)                   ||\n";
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
 * Incrementa la Fecha en un día
 * 
 * @param Fecha $fecha
 */
function incrementaFechaUnDia($fecha){
    $fecha->incremento_un_dia();
}

/**
 * Muestra la fecha abreviada
 * 
 * @param Fecha $fecha
 * @return string
 */
function muestraFechaAbreviada($fecha){
    return $fecha->fechaAbreviada();
}

/**
 * Muestra la fecha extendida
 * 
 * @param Fecha $fecha
 * @return string
 */
function muestraFechaExtendida($fecha){
    return $fecha->fechaExtendida();
}

/**
 * Modifica la fecha actual
 * 
 * @param Fecha $fecha
 * @param int $dia
 * @param int $mes
 * @param int $anio
 */
function modificaFechaActual($fecha, $dia, $mes, $anio){
    $fecha->setDia($dia);
    $fecha->setMes($mes);
    $fecha->setAnio($anio);
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

$fecha = new Fecha;

do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            incrementaFechaUnDia($fecha);
            echo "Fecha incrementada con exito!";
            detenerEjecucion();
            break;
        case 2:
            echo muestraFechaAbreviada($fecha);
            detenerEjecucion();
            break;
        case 3:
            echo muestraFechaExtendida($fecha);
            detenerEjecucion();
            break;
        case 4:
            echo "Ingrese el día de la fecha nueva: ";
            $dia = trim(fgets(STDIN));
            echo "Ingrese el mes de la fecha nueva: ";
            $mes = trim(fgets(STDIN));
            echo "Ingrese el año de la fecha nueva: ";
            $anio = trim(fgets(STDIN));
            modificaFechaActual($fecha, $dia, $mes, $anio);
            detenerEjecucion();
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