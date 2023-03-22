<?php

/********************************************************************************/
/*********************** FUNCIONES DEL MENÚ PRINCIPAL ***************************/
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
        echo "|| [1] Crea un arreglo nuevo con valores aleatorios para el balance empresa   ||\n";
        echo "|| [2] Imprime los valores del balance empresa actual                         ||\n";
        echo "|| [3] Indica cual fue el mes de mayor ganancia                               ||\n";
        echo "|| [4] Crea un arreglo nuevo con empleados aleatorios                         ||\n";
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

/********************************************************************************/
/********************** FUNCIONES DEL TRABAJO PRÁCTICO **************************/
/********************************************************************************/

/**
 * Crea automaticamente un arreglo asociativo donde cada celda es un mes y a cada mes 
 * le corresponde una recaudación y un costo total
 * 
 * @return array
 */
function creaBalanceEmpresa(){
    // array $balanceEmpresa

    $balanceEmpresa = [];
    $balanceEmpresa[0] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[1] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[2] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[3] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[4] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[5] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[6] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[7] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[8] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[9] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[10] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];
    $balanceEmpresa[11] = ["cantRecaudado" => random_int(0, 1000), "costoTotal" => random_int(0, 1000)];

    return $balanceEmpresa;
}

/**
 * Recibe una estructura de arreglos asociativos compuesta por 12 meses con sus respectivas
 * recaudaciones y costos
 * Devuelve el mes donde hubo mayor ganancia
 * 
 * @param array $arregloRecibido
 * @return string
 */
function calculaGanancia($arregloRecibido){

    // int $posActual, $recaudado, $costo, $ganancia, $mayorGanancia, $mesMayorGanancia
    // String $mes

    $mayorGanancia = -9999999;

    for($i = 0; $i < count($arregloRecibido); $i++){
        $recaudado = $arregloRecibido[$i]["cantRecaudado"];
        $costo = $arregloRecibido[$i]["costoTotal"];
        $ganancia = $recaudado - $costo;

        if($ganancia > $mayorGanancia){
            $mayorGanancia = $ganancia;
            $mesMayorGanancia = $i+1;
        }
    }

    $mes = numeroAmesString($mesMayorGanancia);

    return $mes;
}

/**
 * Crea automaticamente un arreglo asociativo donde cada celda es un empleado y a cada empleado 
 * le corresponde un nombre, un sueldo básico y una antigüedad
 * 
 * @return array
 */
function creaArregloEmpleados(){
    // array $empleadosNuevos

    $empleadosNuevos = [];
    $empleadosNuevos[0] = ["nombre" => "Fernandez María", "sueldoBasico" => random_int(1000, 1500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[1] = ["nombre" => "Gonzales Eduardo", "sueldoBasico" => random_int(1000, 1500), "antiguedad" => random_int(0, 40) ];
    $empleadosNuevos[2] = ["nombre" => "Gonzales Pablo", "sueldoBasico" => random_int(1000, 1500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[3] = ["nombre" => "Lopez Marta", "sueldoBasico" => random_int(1000, 1500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[4] = ["nombre" => "Rodriguez Carlos", "sueldoBasico" => random_int(1000, 1500), "antiguedad" => random_int(0, 40)];

    return $empleadosNuevos;
}




/**
 * Recibe un número del 1 al 12 (preferentemente) y retorna el mes que le corresponde
 * 
 * @param int $numeroMes
 * @return string
 */
function numeroAMesString($numeroMes){
    // string $palabraMes

    switch($numeroMes){
        case 1:
            $palabraMes = "Enero";
            break;
        case 2:
            $palabraMes = "Febrero";
            break;
        case 3:
            $palabraMes = "Marzo";
            break;
        case 4:
            $palabraMes = "Abril";
            break;
        case 5:
            $palabraMes = "Mayo";
            break;
        case 6:
            $palabraMes = "Junio";
            break;
        case 7:
            $palabraMes = "Julio";
            break;
        case 8:
            $palabraMes = "Agosto";
            break;
        case 9:
            $palabraMes = "Septiembre";
            break;
        case 10:
            $palabraMes = "Octubre";
            break;
        case 11:
            $palabraMes = "Noviembre";
            break;
        case 12:
            $palabraMes = "Diciembre";
            break;
        default:
            $palabraMes = "Error!";
            break;
    }

    return $palabraMes;
}


/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int $opcionMenu
// string $mesGanancia
// boolean
// array $ultimoBalance, $empleados

$ultimoBalance = [];
$ultimoBalance[0] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[1] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[2] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[3] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[4] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[5] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[6] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[7] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[8] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[9] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[10] = ["cantRecaudado" => 0, "costoTotal" => 0];
$ultimoBalance[11] = ["cantRecaudado" => 0, "costoTotal" => 0];

$empleados = [];
$empleados[0] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];
$empleados[1] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];
$empleados[2] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];
$empleados[3] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];
$empleados[4] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];


do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            $ultimoBalance = creaBalanceEmpresa();
            echo "Balance nuevo creado con exito.";
            echo "\n";
            detenerEjecucion();
            break;
        case 2:
            echo "Enero. Recaudado: $".$ultimoBalance[0]["cantRecaudado"].", costo total: $".$ultimoBalance[0]["costoTotal"]."\n";
            echo "Febrero. Recaudado: $".$ultimoBalance[1]["cantRecaudado"].", costo total: $".$ultimoBalance[1]["costoTotal"]."\n";
            echo "Marzo. Recaudado: $".$ultimoBalance[2]["cantRecaudado"].", costo total: $".$ultimoBalance[2]["costoTotal"]."\n";
            echo "Abril. Recaudado: $".$ultimoBalance[3]["cantRecaudado"].", costo total: $".$ultimoBalance[3]["costoTotal"]."\n";
            echo "Mayo. Recaudado: $".$ultimoBalance[4]["cantRecaudado"].", costo total: $".$ultimoBalance[4]["costoTotal"]."\n";
            echo "Junio. Recaudado: $".$ultimoBalance[5]["cantRecaudado"].", costo total: $".$ultimoBalance[5]["costoTotal"]."\n";
            echo "Julio. Recaudado: $".$ultimoBalance[6]["cantRecaudado"].", costo total: $".$ultimoBalance[6]["costoTotal"]."\n";
            echo "Agosto. Recaudado: $".$ultimoBalance[7]["cantRecaudado"].", costo total: $".$ultimoBalance[7]["costoTotal"]."\n";
            echo "Septiembre. Recaudado: $".$ultimoBalance[8]["cantRecaudado"].", costo total: $".$ultimoBalance[8]["costoTotal"]."\n";
            echo "Octubre. Recaudado: $".$ultimoBalance[9]["cantRecaudado"].", costo total: $".$ultimoBalance[9]["costoTotal"]."\n";
            echo "Noviembre. Recaudado: $".$ultimoBalance[10]["cantRecaudado"].", costo total: $".$ultimoBalance[10]["costoTotal"]."\n";
            echo "Diciembre. Recaudado: $".$ultimoBalance[11]["cantRecaudado"].", costo total: $".$ultimoBalance[11]["costoTotal"]."\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 3:
            $mesGanancia = calculaGanancia($ultimoBalance);
            echo "El mes de mayor ganancia fue: ".$mesGanancia."\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 4:
            $empleados = creaArregloEmpleados();
            echo "Empleados nuevos cargados con exito.";
            echo "\n";
            detenerEjecucion();
            break;
        case 5:
            muestraEmpleados();
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