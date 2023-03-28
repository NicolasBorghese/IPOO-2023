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
        echo "------------------------------------------------------------------------------------\n";
        echo "||                                  MENÚ PRINCIPAL                                ||\n";
        echo "||                                                                                ||\n";
        echo "|| Ingrese por teclado el número que corresponda a la opción elegida:             ||\n";
        echo "||                                                                                ||\n";
        echo "|| [1] Crea un arreglo de alumnos                                                 ||\n";
        echo "|| [2] Muestra el arreglo de alumnos actual                                       ||\n";
        echo "|| [3] Ingresar una materia para obtener la cantidad de alumnos que la rindieron  ||\n";
        echo "|| [4] Indica el porcentaje de alumnos que rindio cada materia                    ||\n";
        echo "|| [5] Obtener toda la información del alumno que tuvo mayor nota en cada materia ||\n";
        echo "|| [6] Indica la cantidad de alumnos que aprobaron cada materia con 70 o más nota ||\n";
        echo "|| [7] Retorna un arreglo con los alumnos que aprobaron una materia indicada      ||\n";
        echo "|| [0] Para finaizar el programa                                                  ||\n";
        echo "||                                                                                ||\n";
        echo "------------------------------------------------------------------------------------\n";
        echo "\n";
        echo "Indique la operación que desea realizar: ";
        $opcionElegida = trim(fgets(STDIN));
        
        // OBSERVAR: el rango varía según cantidad de opciones
        if($opcionElegida < 0 || $opcionElegida > 10){
            echo "\n";
            // Mensaje de error cuando la opción elegida está fuera de rango
            echo "--------------------------------------------------------------------------------\n";
            echo "|| ¡ERROR! Usted ha ingresado un valor NO válido,                             ||\n";
            echo "|| verifique las opciones del menú nuevamente.                                ||\n";
            echo "--------------------------------------------------------------------------------\n";
            detenerEjecucion();
        }
    // OBSERVAR: el rango varía según cantidad de opciones
    } while ($opcionElegida < 0 || $opcionElegida > 10);

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
 * Retorna un arreglo compuesto de alumnos y sus datos
 * 
 * @return array
 */
function creaArregloAlumnos(){
    // array $arregloAlumnos
    // int $cantAlumnos
    $cantAlumnos = random_int(30, 45);
    $arregloAlumnos = [];

    for ($i = 0; $i < $cantAlumnos; $i++){
        $arregloAlumnos[$i] = ["nroLegajo" => 1000 + $i, "codigoMateria" => asignaMateria(random_int(1, 70)), "notaObtenida" => random_int(0,100)];
    }

    // El uasort solo sirve para ver con print_r
    uasort($arregloAlumnos, 'cmp');

    $arregloAlumnos = ordenaArregloAlumnosMateria($arregloAlumnos);

    return $arregloAlumnos;
}

/**
 * Función de comparación utilizada para ordenar por nombre de palabra
 * 
 * @param object $a
 * @param object $b
 * @return int
 */
function cmp($a, $b){
    if ($a["codigoMateria"] == $b["codigoMateria"]){
        $orden = 0;
    } elseif ($a["codigoMateria"] < $b["codigoMateria"]){
        $orden = -1;
    } else {
        $orden = 1;
    }
    return $orden;
}

/**
 * Ordena arreglo de alumnos (recibido por parametro) por orden alfabetico de materia y lo devuelve ordenado
 * 
 * @param array $alumnos
 * @return array
 */
function ordenaArregloAlumnosMateria($alumnos){
    // array $alumnosOrdenados
    $alumnosOrdenados = [];
    $alumnosOrdenados[0] = $alumnos[0];

    for($i = 1; $i < count($alumnos); $i++){
        
        array_push($alumnosOrdenados, $alumnos[$i]);
        $posOrdenados = count($alumnosOrdenados)-1;

        while($posOrdenados >= 1 && ($alumnosOrdenados[$posOrdenados]["codigoMateria"] < $alumnosOrdenados[$posOrdenados-1]["codigoMateria"])){

            $guardaTemporal = $alumnosOrdenados[$posOrdenados-1];
            $alumnosOrdenados[$posOrdenados-1] = $alumnosOrdenados[$posOrdenados];
            $alumnosOrdenados[$posOrdenados] = $guardaTemporal;

            $posOrdenados--;

        }
    }

    return $alumnosOrdenados;
}

/**
 * Imprime en pantalla un arreglo de alumnos
 * 
 * @param array $arregloAlumnos
 */
function muestraAlumnos($arregloAlumnos){
    
    for($i = 0; $i < count($arregloAlumnos); $i++){
        echo "Alumno legajo: ".$arregloAlumnos[$i]["nroLegajo"].", materia: ".$arregloAlumnos[$i]["codigoMateria"].", nota: ".$arregloAlumnos[$i]["notaObtenida"]."\n";
    }
}

/**
 * Recibe un número y devuelve un string que corresponde al código de una materia
 * 
 * @param int $numero
 * @return string
 */
function asignaMateria($numero){

    // string $codMateria

    if($numero > 0 && $numero <= 10){
        $numero = 1;
    } else if ($numero > 10 && $numero <= 20){
        $numero = 2;
    } else if ($numero > 20 && $numero <= 30){
        $numero = 3;
    } else if ($numero > 30 && $numero <= 40){
        $numero = 4;
    } else if ($numero > 40 && $numero <= 50){
        $numero = 5;
    } else if ($numero > 50 && $numero <= 60){
        $numero = 6;
    } else if ($numero > 60 && $numero <= 70){
        $numero = 7;
    } else {
        $numero = 8;
    }

    switch($numero){
        case 1:
            $codMateria = "Matematica";
            break;
        case 2:
            $codMateria = "Fisica";
            break;
        case 3:
            $codMateria = "Quimica";
            break;
        case 4:
            $codMateria = "Geografia";
            break;
        case 5:
            $codMateria ="Educacion Fisica";
            break;
        case 6:
            $codMateria = "Biologia";
            break;
        case 7:
            $codMateria = "Informatica";
            break;
        default:
        $codMateria = "Cosmetologia";
    }

    return $codMateria;
}

/**
 * Pide al usuario que ingrese una materia y si está correcta la devuelta
 */
function ingreseMateriaFerificador($materia){
    // boolean $existeMateria
    $existeMateria = false;
    do {
        switch($materia){
            case "Biologia":
                $existeMateria = true;
                break;
            case "Educacion Fisica":
                $existeMateria = true;
                break;
            case "Fisica";
                $existeMateria = true;
                break;
            case "Geografia":
                $existeMateria = true;
                break;
            case "Informatica":
                $existeMateria = true;
                break;
            case "Matematica":
                $existeMateria = true;
                break;
            case "Quimica":
                $existeMateria = true;
                break;
            case "Cosmetologia":
                $existeMateria = true;
                break;
            default:
                $existeMateria = false;
                break;
        }

        if($existeMateria == false){
            
        }

    }while ($existeMateria == false);

    return $materia;
} 
/**
 * Muestra la cantidad de alumnos que rindieron una materia dentro de un arreglo de alumnos
 * 
 * @param string $materia
 * @param array $alumnos
 * @return int
 */
function cantAlumRindieronMateria($materia, $alumnos){
    // $cantAlumnos
    $cantAlumnos = 0;

    for ($i = 0; $i < count($alumnos); $i++){
        if($alumnos[$i]["codigoMateria"] == $materia){
            $cantAlumnos++;
        }
    }
    return $cantAlumnos;
}

/**
 * Muestra el porcentaje de alumnos que rindieron cada materia
 * 
 * @param array $alumnos
 */
function porcAlumnosRindieronCateria($arregloAlumnos){
    // int $alumnosTotales, $porcentajeAlumnos, $posArregloDatos
    // float $porcAlumnos
    // string $materia
    // array $datosAlumnos
    // boolean $materiaEncontrada

    $alumnosTotales = count($arregloAlumnos);
    $datosAlumnos = [];
    $posArregloDatos = 0;
    $materiaEncontrada = false;

    // Se puede reveer esta condición
    if($arregloAlumnos[0] != null){
        $datosAlumnos[0] = ["codigoMateria" => $arregloAlumnos[0]["codigoMateria"], "cantMateria" => 1];

        // Recorre a cada alumno dentro del arreglo recibido
        for ($i = 1; $i < count($arregloAlumnos); $i++){
            // Recorre el arreglo nuevo y si la materia no existe la crea
            while ($materiaEncontrada == false){
                if($arregloAlumnos[$i]["codigoMateria"] == $datosAlumnos[$posArregloDatos]["codigoMateria"]){
                    $datosAlumnos[$posArregloDatos]["cantMateria"]++;
                    $materiaEncontrada = true;
    
                } else if ($posArregloDatos+1 == count($datosAlumnos)){
                    array_push($datosAlumnos, ["codigoMateria" => $arregloAlumnos[$i]["codigoMateria"], "cantMateria" => 1]);
                    $materiaEncontrada = true;
                }
                $posArregloDatos++;
            }
            $materiaEncontrada = false;
            $posArregloDatos = 0;
        }
    
        $cantTotal = 0;
        for ($i = 0; $i < count($datosAlumnos); $i++){
            $porcAlumnos = ($datosAlumnos[$i]["cantMateria"] * 100) / $alumnosTotales;
            $materia = $datosAlumnos[$i]["codigoMateria"];
            $cantAlumnos = $datosAlumnos[$i]["cantMateria"];
            $cantTotal = $cantTotal + $cantAlumnos;
            echo "La cantidad de alumnos que rindio ".$materia." fue: ".$cantAlumnos."/".$alumnosTotales."\n";
            echo "El porcentaje de alumnos que rindio ".$materia." fue el ".$porcAlumnos."%\n";
            echo "\n";
        }
        echo $cantTotal."/".$alumnosTotales."\n";

    } else {
        echo "La información recibida no es válida.";

    }
}

/**
 * obtener toda la información del alumno que mayor nota obtuvo por cada materia.
 * 
 * @param array $alumnos
 */
function alumnoMayorNota($alumnos){
    // array $datosMejorAlumno
    // string $materia
    // int $posArregloDatos
    // $materiaEncontrada

    $posArregloDatos = 0;
    $materiaEncontrada = false;

    // Se puede reveer esta condición
    if($alumnos[0] != null){
        $datosAlumnos[0] = $alumnos[0];

        // Recorre a cada alumno dentro del arreglo recibido
        for ($i = 1; $i < count($alumnos); $i++){
            // Recorre el arreglo nuevo y si la materia no existe la crea
            while ($materiaEncontrada == false){
                if($alumnos[$i]["codigoMateria"] == $datosAlumnos[$posArregloDatos]["codigoMateria"]){
                    if($alumnos[$i]["notaObtenida"] > $datosAlumnos[$posArregloDatos]["notaObtenida"]){
                        $datosAlumnos[$posArregloDatos] = $alumnos[$i];

                        /**
                         * $legajo0 = $datosAlumnos[$posArregloDatos]["nroLegajo"];
                         * $materia0 = $datosAlumnos[$posArregloDatos]["codigoMateria"];
                         * $nota0 = $datosAlumnos[$posArregloDatos]["notaObtenida"];
                         * echo "Modifíca posición: ".$posArregloDatos." con nro legajo:".$legajo0.", materia: ".$materia0.", nota: ".$nota0."\n";
                         */
                        
                    }
                    $materiaEncontrada = true;
    
                } else if ($posArregloDatos+1 == count($datosAlumnos)){
                    array_push($datosAlumnos, $alumnos[$i]);

                    /**
                    * $legajo0 = $datosAlumnos[$posArregloDatos]["nroLegajo"];
                    * $materia0 = $datosAlumnos[$posArregloDatos]["codigoMateria"];
                    * $nota0 = $datosAlumnos[$posArregloDatos]["notaObtenida"];
                    * echo "Agrega en posición: ".$posArregloDatos." con nro legajo:".$legajo0.", materia: ".$materia0.", nota: ".$nota0."\n";
                    */

                    $materiaEncontrada = true;
                }
                $posArregloDatos++;
            }
            $materiaEncontrada = false;
            $posArregloDatos = 0;
        }

        echo "\n";

        for ($i = 0; $i < count($datosAlumnos); $i++){
            $materia = $datosAlumnos[$i]["codigoMateria"];
            echo "La nota más alta de ".$materia." fue del alumno legajo: ".$datosAlumnos[$i]["nroLegajo"].", nota: ".$datosAlumnos[$i]["notaObtenida"]."\n";
        }
    }
}

/**
 * si una materia se aprueba con una nota >=7, retornar la cantidad de alumnos aprobados por materia.
 * 
 * @param array $alumnos
 */
function cantAlumnosAprobados($alumnos){
    // int $posArregloDatos, $cantAprobadosTotales, $alumnosTotales, 
    // array $arregloAprobados
    // boolean $materiaEncontrada

    $alumnosTotales = count($alumnos);
    $arregloAprobados = [];
    $posArregloAprobados = 0;
    $materiaEncontrada = false;

    // Se puede reveer esta condición
    if($alumnos[0] != null){
        $arregloAprobados[0] = ["codigoMateria" => $alumnos[0]["codigoMateria"], "cantAprobados" => 0, "cantTotal" => 0];

        // Recorre a cada alumno dentro del arreglo recibido
        for ($i = 1; $i < count($alumnos); $i++){
            // Recorre el arreglo nuevo y si la materia no existe la crea
            while ($materiaEncontrada == false){
                if($alumnos[$i]["codigoMateria"] == $arregloAprobados[$posArregloAprobados]["codigoMateria"]){
                    if($alumnos[$i]["notaObtenida"] >= 70){
                        $arregloAprobados[$posArregloAprobados]["cantAprobados"]++;
                        $arregloAprobados[$posArregloAprobados]["cantTotal"]++;
                    } else {
                        $arregloAprobados[$posArregloAprobados]["cantTotal"]++;
                    }
                    $materiaEncontrada = true;
    
                } else if ($posArregloAprobados+1 == count($arregloAprobados)){
                    if($alumnos[$i]["notaObtenida"] >= 70){
                        array_push($arregloAprobados, ["codigoMateria" => $alumnos[$i]["codigoMateria"], "cantAprobados" => 1, "cantTotal" => 1]);
                    } else {
                        array_push($arregloAprobados, ["codigoMateria" => $alumnos[$i]["codigoMateria"], "cantAprobados" => 0, "cantTotal" => 1]);
                    }
                    $materiaEncontrada = true;
                }
                $posArregloAprobados++;
            }
            $materiaEncontrada = false;
            $posArregloAprobados = 0;
        }
    
        $cantAprobadosTotales = 0;

        for ($i = 0; $i < count($arregloAprobados); $i++){

            $materia = $arregloAprobados[$i]["codigoMateria"];
            $cantAprobados = $arregloAprobados[$i]["cantAprobados"];
            $cantTotal = $arregloAprobados[$i]["cantTotal"];
            $cantAprobadosTotales = $cantAprobadosTotales + $cantAprobados;

            echo "La cantidad de alumnos que aprobo ".$materia." fue: ".$cantAprobados."/".$cantTotal."\n";
        }
        echo "\n";
        echo "Cantidad de aprobados totales: ".$cantAprobadosTotales."/".$alumnosTotales."\n";

    } else {
        echo "La información recibida no es válida.";

    }
}

/**
 * dada una materia retornar un arreglo con los alumnos que aprobaron esa materia.
 * 
 * @param array $alumnos
 * @param string $materia
 * @return array
 */
function alumnosAprobaronMateria($alumnos, $materia){
    cwcwec;

}

/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int
// string
// boolean
// array $arregloFavorito

$numLegajo = 1000;
$codMateria = "Matematica";
$nota = 100;

$arregloAlumnos = [];
$arregloAlumnos[0] = ["nroLegajo" => $numLegajo, "codigoMateria" => $codMateria, "notaObtenida" => $nota];

do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            $arregloAlumnos = creaArregloAlumnos();
            echo "Arreglo de alumnos creado exitosamente\n";
            echo count($arregloAlumnos)." alumnos han sido cargados.\n";
            detenerEjecucion();
            break;
        case 2:
            muestraAlumnos($arregloAlumnos);
            detenerEjecucion();
            break;
        case 3:
            echo "Ingrese la materia que desea saber cuantos alumnos rindieron: ";
            $materia = trim(fgets(STDIN));
            $cantAlumnos = cantAlumRindieronMateria($materia, $arregloAlumnos);
            echo "Los alumnos que rindieron ".$materia." fueron: ".$cantAlumnos.".\n";
            detenerEjecucion();
            break;
        case 4:
            porcAlumnosRindieronCateria($arregloAlumnos);
            detenerEjecucion();
            break;
        case 5:
            alumnoMayorNota($arregloAlumnos);
            detenerEjecucion();
            break;
        case 6:
            cantAlumnosAprobados($arregloAlumnos);
            detenerEjecucion();
            break;
        case 7:
            echo "Ingrese la materia que desea saber cuantos alumnos aprobaron: ";
            $materia = trim(fgets(STDIN));
            $aprobados = alumnosAprobaronMateria($arregloAlumnos, $materia);
            echo "Los alumnos que aprobaron ".$materia." fueron: ".$aprobados."\n";
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