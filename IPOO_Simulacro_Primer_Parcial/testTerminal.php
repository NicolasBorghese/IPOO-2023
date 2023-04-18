<?php
//Por Nicolás Borghese 2023

include_once("Terminal.php");
include_once("Empresa.php");
include_once("Viaje.php");
include_once("Responsable.php");

/**
 * Implementar un script TestTermial en el cual:
 * 1. Se crea una colección con un mínimo de 2 empresas, ejemplo Flecha Bus y Via Bariloche.
 * 2. A cada empresa se le incorporan 2 instancias de la clase viaje.
 * 3. Se crea un objeto Terminal con la colección de empresas creadas en el pnto1.
 * 4. Invocar y visualizar el resultado del método ventaAutomatica con cantidad de asientos
 * 3 y como destino alguno de los destinos de viaje creados en 2.
 * 5. Invocar y visualizar el resultado del método empresaMayorRecaudacion.
 * 6. Invocar y visualizar el resultado del método responsableViaje correspondiente a uno de los
 * números de viajes del punto 2.
 */

$responsable1 = new Responsable("Jose", "Perez", "23.455.633", "Calle 1200", "Jose@mail.com", "299-123123");
$responsable2 = new Responsable("María", "Fernandez", "45.344.433", "Calle 235", "maria@mail.com", "298-44412");
$responsable3 = new Responsable("Marcos", "Gonzales", "34.566.333", "Calle 12544", "marcos@mail.com", "542-434412");
$responsable4 = new Responsable("Marta", "Perez", "5.234.678", "Calle 1435", "marta@mail.com", "433-343531");

$viaje1 = new Viaje("Roca", "0800", "1200", "125", 175, "08042023", 50, 40, $responsable1);
$viaje2 = new Viaje("Chocon", "1000", "1800", "1127", 2700, "05092023", 60, 30, $responsable2);
$viaje3 = new Viaje("Cutral Co", "0900", "1100", "077", 27000, "23082024", 30, 5, $responsable3);
$viaje4 = new Viaje("Senillosa", "0630", "0830", "1544", 455, "03032025", 20, 10, $responsable4);
$viaje5 = new Viaje("Senillosa", "1030", "1230", "1560", 455, "03032025", 20, 4, $responsable4);

$colViajes1 = [$viaje1, $viaje2];
$colViajes2 = [$viaje3, $viaje4, $viaje5];

$empresaFlechaBus = new Empresa("02345", "Flecha Bus", $colViajes1);
$empresaViaBariloche = new Empresa ("01899", "Via Bariloche", $colViajes2);

$colEmpresas1 = [$empresaFlechaBus, $empresaViaBariloche];

$terminal = new Terminal("terminalNeuquen", "Neuquen 1234", $colEmpresas1);

echo "\n";
echo "Se muestra la terminal completa";
echo "\n";
echo $terminal;
echo "\n";

echo "Se vende un viaje a Roca de la empresa Flecha Bus, para 40 pasajeros día 08/04/2023\n";
echo "Se muestran los viajes de la empresa\n";
echo "\n";
$terminal->ventaAutomatica(40, "08042023","Roca", "Flecha Bus");
echo $terminal->getColEmpresas()[0];

echo "\n";
echo "La empresa que tuvo mayor recaudación fue: ".($terminal->empresaMayorRecaudacion())->getNombre()."\n";
echo "\n";
echo "El/la responsable del viaje indicado es: ".($terminal->responsableViaje("1544"))->getNombre()."\n";
echo "\n";

echo "Dar viaje a destino Senillosa 5:\n";
echo "\n";

$arregloViajes = $empresaViaBariloche->darViajeADestino("Senillosa 5");
for($i = 0; $i < count($arregloViajes); $i++ ){
    echo $arregloViajes[$i] ."\n";
    echo "\n";
}

echo "Se agrega un nuevo viaje a Flecha Bus\n";
echo "\n";
$nuevoViaje = new Viaje ("Chocon", "1100", "2000", "1130", 1500, "05092023", 60, 15, $responsable1);
($terminal->getColEmpresas()[0])->incorporarViaje($nuevoViaje);

echo"Se muestra la terminal completa con un viaje nuevo al chocon agregado:\n";
echo "\n";
echo $terminal;
echo "\n";

?>