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
        echo "|| [4] Crea un arreglo nuevo con empleados                                    ||\n";
        echo "|| [5] Crea un arreglo nuevo con empleados aleatorios                         ||\n";
        echo "|| [6] Muestra todos los empleados de la empresa                              ||\n";
        echo "|| [7] Muestra el sueldo que le corresponde cobrar a cada empleado            ||\n";
        echo "|| [0] Para finaizar el programa                                              ||\n";
        echo "||                                                                            ||\n";
        echo "--------------------------------------------------------------------------------\n";
        echo "\n";
        echo "Indique la operación que desea realizar: ";
        $opcionElegida = trim(fgets(STDIN));
        
        // OBSERVAR: el rango varía según cantidad de opciones
        if($opcionElegida < 0 || $opcionElegida > 7){
            echo "\n";
            // Mensaje de error cuando la opción elegida está fuera de rango
            echo "--------------------------------------------------------------------------------\n";
            echo "|| ¡ERROR! Usted ha ingresado un valor NO válido,                             ||\n";
            echo "|| verifique las opciones del menú nuevamente.                                ||\n";
            echo "--------------------------------------------------------------------------------\n";
            detenerEjecucion();
        }
    // OBSERVAR: el rango varía según cantidad de opciones
    } while ($opcionElegida < 0 || $opcionElegida > 7);

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
 * Muestra el balance una empresa
 * 
 * @param array $balanceEmpresa
 */
function muestraBalanceEmpresa($balanceEmpresa){
    for($i = 0; $i < count($balanceEmpresa) ; $i++){
        echo numeroAMesString($i+1).". Recaudado: $".$balanceEmpresa[$i]["cantRecaudado"].", costo total: $".$balanceEmpresa[$i]["costoTotal"]."\n";
    }
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

/**
 * Crea automaticamente un arreglo asociativo donde cada celda es un empleado y a cada empleado 
 * le corresponde un nombre, un sueldo básico y una antigüedad
 * 
 * @return array
 */
function creaArregloEmpleados(){
    // array $empleadosNuevos

    $empleadosNuevos = [];
    $empleadosNuevos[0] = ["nombre" => "Fernandez María", "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[1] = ["nombre" => "Gonzales Eduardo", "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40) ];
    $empleadosNuevos[2] = ["nombre" => "Gonzales Pablo", "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[3] = ["nombre" => "Lopez Marta", "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40)];
    $empleadosNuevos[4] = ["nombre" => "Rodriguez Carlos", "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40)];

    return $empleadosNuevos;
}

/**
 * Crea automaticamente un arreglo asociativo completamente aleatorio donde cada celda es un empleado y
 * a cada empleado le corresponde un nombre, un sueldo básico y una antigüedad
 * 
 * @return array
 */
function creaArregloEmpleadosAleatorio(){
    // int $cantEmpleados
    // string $nombre
    // array $empleadosAleatorios

    $cantEmpleados = random_int(7, 20);
    $empleadosAleatorios = [];

    for ($i = 0 ; $i < $cantEmpleados; $i++){

        if(random_int(1, 2) == 1){
            $nombre = generaNombreVaron(random_int(1, 21))." ".generaApellido(random_int(1, 21));
        } else {
            $nombre = generaNombreMujer(random_int(1, 21))." ".generaApellido(random_int(1, 21));
        }

        array_push($empleadosAleatorios, ["nombre" => $nombre, "sueldoBasico" => random_int(1000, 3500), "antiguedad" => random_int(0, 40)]);
    }

    return $empleadosAleatorios;
}

/**
 * Recibe un número y devuelve un nombre de varón
 * 
 * @param int $numero
 * @return string
 */
function generaNombreVaron($numero){
    // string $nombre

    switch ($numero){
        case 1:
            $nombre = "Juan";
            break;
        case 2:
            $nombre = "Manuel";
            break;
        case 3:
            $nombre = "José";
            break;
        case 4:
            $nombre = "Antonio";
            break;
        case 5:
            $nombre = "Carlos";
            break;
        case 6:
            $nombre = "Jorge";
            break;
        case 7:
            $nombre = "Miguel";
            break;
        case 8:
            $nombre = "Pedro";
            break;
        case 9:
            $nombre = "Alberto";
            break;
        case 10:
            $nombre = "Luis";
            break;
        case 11:
            $nombre = "Daniel";
            break;
        case 12:
            $nombre = "Fernando";
            break;
        case 13:
            $nombre = "Mario";
            break;
        case 14:
            $nombre = "Sergio";
            break;
        case 15:
            $nombre = "Marcelo";
            break;
        case 16:
            $nombre = "Guillermo";
            break;
        case 17:
            $nombre = "Pablo";
            break;
        case 18:
            $nombre = "Gabriel";
            break;
        case 19:
            $nombre = "Eduardo";
            break;
        case 20:
            $nombre = "Raul";
        default:
            $nombre = "OwO";
            break;
    }
    return $nombre;
}

/**
 * Recibe un número y devuelve un nombre de mujer
 * 
 * @param int $numero
 * @return string
 */
function generaNombreMujer($numero){
    // string $nombre

    switch ($numero){
        case 1:
            $nombre = "María";
            break;
        case 2:
            $nombre = "Ana";
            break;
        case 3:
            $nombre = "Carolina";
            break;
        case 4:
            $nombre = "Andrea";
            break;
        case 5:
            $nombre = "laura";
            break;
        case 6:
            $nombre = "Paula";
            break;
        case 7:
            $nombre = "Martina";
            break;
        case 8:
            $nombre = "Valentina";
            break;
        case 9:
            $nombre = "Lucía";
            break;
        case 10:
            $nombre = "Sofía";
            break;
        case 11:
            $nombre = "Natalia";
            break;
        case 12:
            $nombre = "Julieta";
            break;
        case 13:
            $nombre = "Verónica";
            break;
        case 14:
            $nombre = "Daniela";
            break;
        case 15:
            $nombre = "Silvia";
            break;
        case 16:
            $nombre = "Patricia";
            break;
        case 17:
            $nombre = "Gabriela";
            break;
        case 18:
            $nombre = "Victoria";
            break;
        case 19:
            $nombre = "Micaela";
            break;
        case 20:
            $nombre = "Alejandra";
        default:
            $nombre = "UwU";
            break;
    }
    return $nombre;
}

/**
 * Recibe un número y devuelve un apellido
 * 
 * @param int $numero
 * @return string
 */
function generaApellido($numero){
    // string $nombre

    switch ($numero){
        case 1:
            $apellido = "González";
            break;
        case 2:
            $apellido = "Rodríguez";
            break;
        case 3:
            $apellido = "García";
            break;
        case 4:
            $apellido = "Fernández";
            break;
        case 5:
            $apellido = "López";
            break;
        case 6:
            $apellido = "Martínez";
            break;
        case 7:
            $apellido = "Pérez";
            break;
        case 8:
            $apellido = "Gómez";
            break;
        case 9:
            $apellido = "Sánchez";
            break;
        case 10:
            $apellido = "Romero";
            break;
        case 11:
            $apellido = "Díaz";
            break;
        case 12:
            $apellido = "Torres";
            break;
        case 13:
            $apellido = "Flores";
            break;
        case 14:
            $apellido = "Álvarez";
            break;
        case 15:
            $apellido = "Castro";
            break;
        case 16:
            $apellido = "Ruiz";
            break;
        case 17:
            $apellido = "Ramírez";
            break;
        case 18:
            $apellido = "Acosta";
            break;
        case 19:
            $apellido = "Vázquez";
            break;
        case 20:
            $apellido = "Herrera";
        default:
            $apellido = "^w^";
            break;
    }
    return $apellido;
}

/**
 * Muestra los datos de todos los empleados
 * 
 * @param array $empleados
 */
function muestraEmpleados($empleados){
    for($i = 0; $i < count($empleados); $i++){
        echo "Empleado n°: ".($i+1).". Nombre: ".$empleados[$i]["nombre"].", Sueldo básico: $".$empleados[$i]["sueldoBasico"].", Antigüedad: ".$empleados[$i]["antiguedad"]." años.\n";
    }
}

/**
 * Crea un arreglo que muestra el nombre y lo que le corresponde cobrar a cada empleado
 * 
 * @param array $empleados
 * @return array
 */
function sueldosACobrar($empleados){
    // string $nombre
    // int $sueldoBasico
    // int $sueldoNeto
    $sueldos = [];
    for ($i = 0; $i < count($empleados); $i++){
        $nombre = $empleados[$i]["nombre"];
        $sueldoBasico = $empleados[$i]["sueldoBasico"];
        if($empleados[$i]["antiguedad"] > 10){
            $sueldoNeto = $sueldoBasico + ($sueldoBasico / 2);
        } else {
            $sueldoNeto = $sueldoBasico + ($sueldoBasico / 4);
        }
        $sueldos[$i] = ["nombre" => $nombre, "sueldo" => $sueldoNeto];
    }

    return $sueldos;
}

/**
 * Muestra los sueldos que se deben pagar
 * 
 * @param array $sueldos
 */
function muestraSueldosAPagar($sueldos){
    for($i = 0; $i < count($sueldos); $i++){
        echo "A ".$sueldos[$i]["nombre"]." le corresponde un sueldo de : $".$sueldos[$i]["sueldo"].".\n";
    }
}

/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int $opcionMenu
// string $mesGanancia
// boolean
// array $ultimoBalance, $empleados, $sueldos

$ultimoBalance = [];
$ultimoBalance[0] = ["cantRecaudado" => 0, "costoTotal" => 0];

$empleados = [];
$empleados[0] = ["nombre" => "-", "sueldoBasico" => 0, "antiguedad" => 0];


$sueldos = [];
$sueldos[0] = ["nombre" => "-", "sueldo" => 0];

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
            muestraBalanceEmpresa($ultimoBalance);
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
            echo "Empleados conocidos cargados con exito.\n";
            echo "La ahora empresa tiene : ".count($empleados)." empleados.\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 5:
            $empleados = creaArregloEmpleadosAleatorio();
            echo "Empleados aleatorios nuevos cargados con exito.\n";
            echo "La ahora empresa tiene : ".count($empleados)." empleados.\n";
            echo "\n";
            detenerEjecucion();
            break;
        case 6:
            muestraEmpleados($empleados);
            detenerEjecucion();
            break;
        case 7:
            $sueldos = sueldosACobrar($empleados);
            muestraSueldosAPagar($sueldos);
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