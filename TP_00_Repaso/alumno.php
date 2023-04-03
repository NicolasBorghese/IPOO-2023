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
        echo "----------------------------------------------------------------------------------------------\n";
        echo "||                                  MENÚ PRINCIPAL                                          ||\n";
        echo "||                                                                                          ||\n";
        echo "|| Ingrese por teclado el número que corresponda a la opción elegida:                       ||\n";
        echo "||                                                                                          ||\n";
        echo "|| [1] Crear un arreglo de alumnos con sus respectivas notas en cada materia                ||\n";
        echo "|| [2] Mostrar el arreglo de notas actual                                                   ||\n";
        echo "|| [3] Ordenar las notas por materia o número de legajo                                     ||\n";
        echo "|| [4] a) Ingresar una materia para obtener la cantidad de alumnos que la rindieron         ||\n";
        echo "|| [5] b) Indicar el porcentaje de alumnos que rindio cada materia                          ||\n";
        echo "|| [6] c) Obtener toda la información del alumno que tuvo mayor nota en cada materia        ||\n";
        echo "|| [7] d) Indicar la cantidad de alumnos que aprobaron cada materia con 70 o más nota       ||\n";
        echo "|| [8] e) Retorna un arreglo con los alumnos que aprobaron una materia indicada             ||\n";
        echo "|| [9] f) obtener los números de legajo de los alumnos que aprobaron más de cuatro materias ||\n";
        echo "|| [10] g) obtener un arreglo con las materias aprobadas por un alumno ingresando su legajo ||\n";
        echo "|| [0] Para finaizar el programa                                                            ||\n";
        echo "||                                                                                          ||\n";
        echo "-----------------------------------------------------------------------------------------------\n";
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
 * Retorna un arreglo compuesto de Notas en base a la cantidad de alumnos indicado
 * 
 * @return array
 */
function creaArregloNotas($cantAlumnos){
    // array $arregloNotas, $materiasAlumno
    // int $cantAlumnos, $cantMaterias, $posMateria
    // string $materiaParaArreglo
    if(!ctype_digit($cantAlumnos)){
        $cantAlumnos = random_int(10, 20);
    }
    $arregloNotas = [];
    $materiasAlumnos = [];
    $posNota = 0;

    for ($i = 0; $i < $cantAlumnos; $i++){
        $numLegajo = ((1+$i)*100) + (1+$i);
        $cantMaterias = random_int(1, 7);

        while (count($materiasAlumnos) < $cantMaterias){
            $materiaParaArreglo = asignaMateria(random_int(1, 70));
            if(!in_array($materiaParaArreglo, $materiasAlumnos)){
                array_push($materiasAlumnos, $materiaParaArreglo);
            }
        }

        for($j = 0; $j < $cantMaterias; $j++){
            $arregloNotas[$posNota] = ["nroLegajo" => $numLegajo, "codigoMateria" => $materiasAlumnos[$j], "notaObtenida" => random_int(0,100)];
            $posNota++;
        }
    }

    // El uasort solo sirve para ver con print_r
    uasort($arregloNotas, 'cmp');

    return $arregloNotas;
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
 * Ordena arreglo de alumnos (recibido por parametro) por orden de número de legajo y lo devuelve ordenado
 * 
 * @param array $alumnos
 * @return array
 */
function ordenaArregloAlumnosLegajo($alumnos){
    // array $alumnosOrdenados
    $alumnosOrdenados = [];
    $alumnosOrdenados[0] = $alumnos[0];

    for($i = 1; $i < count($alumnos); $i++){
        
        array_push($alumnosOrdenados, $alumnos[$i]);
        $posOrdenados = count($alumnosOrdenados)-1;

        while($posOrdenados >= 1 && ($alumnosOrdenados[$posOrdenados]["nroLegajo"] < $alumnosOrdenados[$posOrdenados-1]["nroLegajo"])){

            $guardaTemporal = $alumnosOrdenados[$posOrdenados-1];
            $alumnosOrdenados[$posOrdenados-1] = $alumnosOrdenados[$posOrdenados];
            $alumnosOrdenados[$posOrdenados] = $guardaTemporal;

            $posOrdenados--;

        }
    }

    return $alumnosOrdenados;
}

/**
 * Imprime en pantalla un arreglo de notas
 * 
 * @param array $arregloNotas
 */
function muestraAlumnos($arregloNotas){
    
    for($i = 0; $i < count($arregloNotas); $i++){
        echo "Nota n°". $i+1 ." legajo: ".$arregloNotas[$i]["nroLegajo"].", materia: ".$arregloNotas[$i]["codigoMateria"].", nota: ".$arregloNotas[$i]["notaObtenida"]."\n";
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
function ingreseMateriaverificador($materia){
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
 * Recibe un arreglo de notas y devuelve un arreglo de legajos de los alumnos
 * 
 * @param array $arregloNotas
 * @return array
 */
function devuelveArregloAlumnos($arregloNotas){
    // array $arregloAlumnos
    $arregloAlumnos = [];

    for($i = 0; $i < count($arregloNotas); $i++){
        if(!in_array($arregloNotas[$i]["nroLegajo"], $arregloAlumnos)){
            array_push($arregloAlumnos, $arregloNotas[$i]["nroLegajo"]);
        }
    }
    return $arregloAlumnos;
}

/**
 * PUNTO A)
 * Muestra la cantidad de alumnos que rindieron una materia dentro de un arreglo de Notas
 * 
 * @param string $materia
 * @param array $arregloNotas
 * @return int
 */
function cantAlumRindieronMateria($materia, $arregloNotas){
    // $cantAlumnos
    $cantAlumnos = 0;

    for ($i = 0; $i < count($arregloNotas); $i++){
        if($arregloNotas[$i]["codigoMateria"] == $materia){
            $cantAlumnos++;
        }
    }
    return $cantAlumnos;
}

/**
 * PUNTO B)
 * Muestra el porcentaje de alumnos que rindieron cada materia
 * 
 * @param array $alumnos
 */
function porcAlumnosRindieronMateria($arregloNotas){
    // int $alumnosTotales, $porcentajeAlumnos, $posArregloDatos
    // float $porcAlumnos
    // string $materia
    // array $datosAlumnos
    // boolean $materiaEncontrada

    $alumnosTotales = count(devuelveArregloAlumnos($arregloNotas));
    $datosAlumnos = [];
    $posArregloDatos = 0;
    $materiaEncontrada = false;

    // Se puede reveer esta condición
    if($arregloNotas[0] != null){
        $datosAlumnos[0] = ["codigoMateria" => $arregloNotas[0]["codigoMateria"], "cantMateria" => 1];

        // Recorre a cada alumno dentro del arreglo recibido
        for ($i = 1; $i < count($arregloNotas); $i++){
            // Recorre el arreglo nuevo y si la materia no existe la crea
            while ($materiaEncontrada == false){
                if($arregloNotas[$i]["codigoMateria"] == $datosAlumnos[$posArregloDatos]["codigoMateria"]){
                    $datosAlumnos[$posArregloDatos]["cantMateria"]++;
                    $materiaEncontrada = true;
    
                } else if ($posArregloDatos+1 == count($datosAlumnos)){
                    array_push($datosAlumnos, ["codigoMateria" => $arregloNotas[$i]["codigoMateria"], "cantMateria" => 1]);
                    $materiaEncontrada = true;
                }
                $posArregloDatos++;
            }
            $materiaEncontrada = false;
            $posArregloDatos = 0;
        }
    
        for ($i = 0; $i < count($datosAlumnos); $i++){
            $porcAlumnos = ($datosAlumnos[$i]["cantMateria"] * 100) / $alumnosTotales;
            $materia = $datosAlumnos[$i]["codigoMateria"];
            $cantAlumnos = $datosAlumnos[$i]["cantMateria"];

            echo "La cantidad de alumnos que rindio ".$materia." fue: ".$cantAlumnos."/".$alumnosTotales."\n";
            echo "El porcentaje de alumnos que rindio ".$materia." fue el ".$porcAlumnos."%\n";
            echo "\n";
        }

    } else {
        echo "La información recibida no es válida.";

    }
}

/**
 * PUNTO C)
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
                    }
                    $materiaEncontrada = true;
    
                } else if ($posArregloDatos+1 == count($datosAlumnos)){
                    array_push($datosAlumnos, $alumnos[$i]);
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
 * PUNTO D)
 * si una materia se aprueba con una nota >=7, retornar la cantidad de alumnos aprobados por materia.
 * 
 * @param array $alumnos
 */
function cantAlumnosAprobados($alumnos){
    // int $posArregloDatos, $cantAprobadosTotales, $alumnosTotales, 
    // array $arregloAlumnos
    // boolean $materiaEncontrada

    $examenesTotales = count($alumnos);
    $arregloAlumnos = [];
    $posArregloAprobados = 0;
    $materiaEncontrada = false;

    // Se puede reveer esta condición
    if($alumnos[0] != null){
        $arregloAlumnos[0] = ["codigoMateria" => $alumnos[0]["codigoMateria"], "cantAprobados" => 0, "cantTotal" => 0];

        // Recorre a cada alumno dentro del arreglo recibido
        for ($i = 0; $i < count($alumnos); $i++){
            // Recorre el arreglo nuevo y si la materia no existe la crea
            while ($materiaEncontrada == false){
                if($alumnos[$i]["codigoMateria"] == $arregloAlumnos[$posArregloAprobados]["codigoMateria"]){
                    if($alumnos[$i]["notaObtenida"] >= 70){
                        $arregloAlumnos[$posArregloAprobados]["cantAprobados"]++;
                        $arregloAlumnos[$posArregloAprobados]["cantTotal"]++;
                    } else {
                        $arregloAlumnos[$posArregloAprobados]["cantTotal"]++;
                    }
                    $materiaEncontrada = true;
    
                } else if ($posArregloAprobados+1 == count($arregloAlumnos)){
                    if($alumnos[$i]["notaObtenida"] >= 70){
                        array_push($arregloAlumnos, ["codigoMateria" => $alumnos[$i]["codigoMateria"], "cantAprobados" => 1, "cantTotal" => 1]);
                    } else {
                        array_push($arregloAlumnos, ["codigoMateria" => $alumnos[$i]["codigoMateria"], "cantAprobados" => 0, "cantTotal" => 1]);
                    }
                    $materiaEncontrada = true;
                }
                $posArregloAprobados++;
            }
            $materiaEncontrada = false;
            $posArregloAprobados = 0;
        }
    
        $cantAprobadosTotales = 0;

        for ($i = 0; $i < count($arregloAlumnos); $i++){

            $materia = $arregloAlumnos[$i]["codigoMateria"];
            $cantAprobados = $arregloAlumnos[$i]["cantAprobados"];
            $cantTotal = $arregloAlumnos[$i]["cantTotal"];
            $cantAprobadosTotales = $cantAprobadosTotales + $cantAprobados;

            echo "La cantidad de alumnos que aprobo ".$materia." fue: ".$cantAprobados."/".$cantTotal."\n";
        }
        echo "\n";
        echo "Cantidad de notas aprobadas totales: ".$cantAprobadosTotales."/".$examenesTotales."\n";

    } else {
        echo "La información recibida no es válida.";

    }
}

/**
 * PUNTO E)
 * dada una materia retornar un arreglo con los alumnos que aprobaron esa materia.
 * 
 * @param array $arregloNotas
 * @param string $materia
 * @return array
 */
function alumnosAprobaronMateria($arregloNotas, $materia){
    // array $arregloAlumnos
    $arregloAlumnos = [];

    for($i = 0; $i < count($arregloNotas); $i++){
        if($arregloNotas[$i]["codigoMateria"] == $materia && $arregloNotas[$i]["notaObtenida"] > 70){
            array_push($arregloAlumnos, $arregloNotas[$i]);
        }
    }
    return $arregloAlumnos;
}

/**
 * PUNTO F)
 * obtener los legajos de los alumnos que aprobaron más de 4 materias
 * 
 * @param array $arregloNotas
 * @return array
 */
function alumnos4MasMateriasAprobadas($arregloNotas){
    // int $posAlumno, $legajo, $aprobadas
    // boolean $alumnoEncontrado
    // array $arregloAlumnos, $arregloAprobados
    $alumnoEncontrado = false;
    $arregloAlumnos = [];
    $arregloAprobados = [];

    for ($i = 0; $i < count($arregloNotas); $i++){
        
        if($arregloNotas[$i]["notaObtenida"] > 70){
            $posAlumno = 0;
            $legajo = $arregloNotas[$i]["nroLegajo"];
            if(count($arregloAlumnos) == 0){
                array_push($arregloAlumnos, ["nroLegajo" => $legajo, "cantAprobadas" => 1]);
            } else {
                while($posAlumno < count($arregloAlumnos) && $alumnoEncontrado==false){
                    if($arregloNotas[$i]["nroLegajo"] == $arregloAlumnos[$posAlumno]["nroLegajo"]){
                        $alumnoEncontrado = true;
                        $arregloAlumnos[$posAlumno]["cantAprobadas"]++;
                    } else {
                        if ($posAlumno+1 == count($arregloAlumnos)){
                            array_push($arregloAlumnos, ["nroLegajo" => $legajo, "cantAprobadas" => 1]);
                            $alumnoEncontrado = true;
                        }
                    }
                    $posAlumno++;
                }
                $alumnoEncontrado = false;
            }
            
        }
    }

    for ($i = 0; $i < count($arregloAlumnos); $i++){
        $aprobadas = $arregloAlumnos[$i]["cantAprobadas"];
        if($aprobadas >= 4){
            $legajo = $arregloAlumnos[$i]["nroLegajo"];
            array_push($arregloAprobados, ["nroLegajo" => $legajo, "cantAprobadas" => $aprobadas]);
        }
    }
    return $arregloAprobados;
}

/**
 * PUNTO G)
 * dado un número de legajo, obtener un arreglo con las materias aprobadas por ese alumno.
 * 
 * @param array $arregloNotas
 * @param int $legajo
 * @return array
 */
function materiasAprobadasPorLegajo($arregloNotas, $legajo){
    // array $materiasAprobadas
    // int $legajoEnArreglo, $nota
    // string $materia
    $materiasAprobadas = [];
    for($i = 0; $i < count($arregloNotas); $i++){
        $legajoEnArreglo = $arregloNotas[$i]["nroLegajo"];
        $nota = $arregloNotas[$i]["notaObtenida"];
        if($legajoEnArreglo == $legajo){
            if($nota > 70){
                array_push($materiasAprobadas,$arregloNotas[$i]);
            }
        }
    }
    return $materiasAprobadas;
}

/********************************************************************************/
/***************************** PROGRAMA PRINCIPAL *******************************/
/********************************************************************************/

// ***** Declaración de variables *****/
// int $numLegajo, $opcionElegida, $cantAlumnos
// float $nota
// string $codMateria
// boolean
// array $arregloNotas, 

$numLegajo = 1000;
$codMateria = "Matematica";
$nota = 100;

$arregloNotas = [];
$arregloNotas[0] = ["nroLegajo" => $numLegajo, "codigoMateria" => $codMateria, "notaObtenida" => $nota];

do {
    $opcionMenu = menuDesplegable();

    switch ($opcionMenu){
        case 1:
            // Crea un arreglo de notas de alumnos aleatorio
            echo "Ingrese la cantidad de alumnos que desea crear: ";
            $cantAlumnos = trim(fgets(STDIN));
            $arregloNotas = creaArregloNotas($cantAlumnos);
            $cantAlumnos = count(devuelveArregloAlumnos($arregloNotas));
            echo "Arreglo de notas creado\n";
            echo count($arregloNotas)." notas de: ".$cantAlumnos." alumnos han sido cargadas exitosamente.\n";
            detenerEjecucion();
            break;
        case 2:
            // Imprime los alumnos que se encuentran cargados
            muestraAlumnos($arregloNotas);
            detenerEjecucion();
            break;
        case 3:
            // Ordena los alumnos según el criterio indicado
            echo "Ingrese 1 si desea ordenar las notas por número de legajo del alumno\n";
            echo "Ingrese 2 si desea ordenar las notas por matería: ";
            $opcionElegida = trim(fgets(STDIN));
            if ($opcionElegida == 1){
                $arregloNotas = ordenaArregloAlumnosLegajo($arregloNotas);
                echo "Notas ordenadas por número de legajo exitosamente\n";
            } else {
                if( $opcionElegida == 2){
                    $arregloNotas = ordenaArregloAlumnosMateria($arregloNotas);
                    echo "Notas ordenadas por materia exitosamente\n";
                } else {
                    echo "ERROR: opción ingresada no válida\n";
                }
            }
            detenerEjecucion();
            break;
        case 4:
            // punto a) dada una materia obtener la cantidad de alumnos que rindieron esa materia.
            echo "Ingrese la materia que desea saber cuantos alumnos rindieron: ";
            $materia = trim(fgets(STDIN));
            $cantAlumnos = cantAlumRindieronMateria($materia, $arregloNotas);
            echo "Los alumnos que rindieron ".$materia." fueron: ".$cantAlumnos.".\n";
            detenerEjecucion();
            break;
        case 5:
            // punto b) por cada materia el porcentaje de alumnos que la rindieron.
            porcAlumnosRindieronMateria($arregloNotas);
            detenerEjecucion();
            break;
        case 6:
            // punto c) obtener toda la información del alumno que mayor nota obtuvo por cada materia.
            alumnoMayorNota($arregloNotas);
            detenerEjecucion();
            break;
        case 7:
            // punto d) si una materia se aprueba con una nota >=7,
            // retornar la cantidad de alumnos aprobados por materia.
            cantAlumnosAprobados($arregloNotas);
            detenerEjecucion();
            break;
        case 8:
            // punto e) dada una materia retornar un arreglo con los alumnos que aprobaron esa materia.
            echo "Ingrese la materia que desea saber cuantos alumnos aprobaron: ";
            $materia = trim(fgets(STDIN));
            $aprobados = alumnosAprobaronMateria($arregloNotas, $materia);
            echo "\n";
            if (count($aprobados) > 0) {
                echo "Los alumnos que aprobaron ".$materia." fueron:\n";
                echo "\n";
                for($i = 0; $i < count($aprobados); $i++){
                    $legajo = $aprobados[$i]["nroLegajo"];
                    $nota = $aprobados[$i]["notaObtenida"];
                    echo "Alumno legajo: ".$legajo.", nota: ".$nota."\n";
                }
            } else {
                echo "No se encontraron aprobados para ".$materia."\n";
            }
            detenerEjecucion();
            break;
        case 9:
            // punto f) obtener el o los números de legajo de los alumnos que aprobaron más de cuatro materias.
            $arregloAprobados = alumnos4MasMateriasAprobadas($arregloNotas);
            if(count($arregloAprobados) == 0){
                echo "No hay alumnos aprobados con 4 o más materias\n";
            } else {
                echo "Los alumnos que tienen 4 o más materias aprobadas son\n";
                for($i = 0; $i < count($arregloAprobados); $i++){
                    $legajo = $arregloAprobados[$i]["nroLegajo"];
                    $cantAprobadas = $arregloAprobados[$i]["cantAprobadas"];
                    echo "Alumno legajo: ".$legajo.", materias aprobadas: ".$cantAprobadas."\n";
                }
            }
            detenerEjecucion();
            break;
        case 10:
            // punto g) dado un número de legajo, obtener un arreglo con las materias aprobadas por ese alumno.
            echo "Ingrese el número de legajo del alumno del cual desea saber que materias aprobó: ";
            $legajo = trim(fgets(STDIN));
            $materiasAprobadas = materiasAprobadasPorLegajo($arregloNotas, $legajo);
            if(count($materiasAprobadas) == 0){
                echo "El alumno legajo ".$legajo." no tiene materias aprobadas\n";
            } else {
                echo "Las materias aprobadas por el alumno legajo ".$legajo." son\n";
                for($i = 0; $i < count($materiasAprobadas); $i++){
                    $materia = $materiasAprobadas[$i]["codigoMateria"];
                    $nota = $materiasAprobadas[$i]["notaObtenida"];
                    echo $materia." aprobada con ".$nota." puntos\n";
                }
            }

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