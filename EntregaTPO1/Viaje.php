<?php

class Viaje{

    // ATRIBUTOS
    private $pasajeros;
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    // Composición del arreglo de pasajeros
    // pasajeros[x] = ["numero de documento" => $nroDni, "nombre" => $nombre, "apellido" => $apellido];

    // CONSTRUCTOR
    public function __construct($codigoNuevo, $destinoNuevo, $cantPasajeros){
        $this->pasajeros = [];
        $this->codigo = $codigoNuevo;
        $this->destino = $destinoNuevo;
        $this->cantMaxPasajeros = $cantPasajeros;
    }

    // MODIFICADORES
    public function setDestino($destinoNuevo){
        $this -> destino = $destinoNuevo;
    }

    // NO SE DEBERÍA MODIFICAR EL CÓDIGO DE UN VIAJE YA QUE SE ASUME QUE ES ÚNICO
    // (En tal caso se debe borrar y crear un viaje nuevo)
    /*
    public function setCodigo($codigoNuevo){
        $this -> codigo = $codigoNuevo;
    }
    */

    public function setPasajeros($arregloPasajeros){
        $this -> pasajeros = $arregloPasajeros;
    }

    // OBSERVADORES
    public function getDestino(){
        return $this -> destino;
    }

    public function getCodigo(){
        return $this -> codigo;
    }

    public function getPasajeros(){
        return $this -> pasajeros;
    }

    public function getCantMaxPasajeros(){
        return $this -> cantMaxPasajeros;
    }

    // PROPIAS DE TIPO
    /**
     * Si hay espacio en el viaje agrega un nuevo pasajero
     * Retorna true si es posible, false en caso contrario
     * 
     * @param array $nuevoPasajero
     * @return boolean
     */
    public function agregarPasajero($nuevoPasajero){
        // boolean $puedeAgregar
        
        if(count($this -> pasajeros) == $this -> cantMaxPasajeros){
            $puedeAgregar = false;
        } else {
            $puedeAgregar = true;
            array_push($this->pasajeros, $nuevoPasajero);
        }

        return $puedeAgregar;
    }

    /**
     * Recibe el dni del pasajero a quitar
     * Retorna true si es posible, false en caso contrario
     * 
     * @param int $dniQuitar
     * @return boolean
     */
    public function quitarPasajeroPorDni($dniQuitar){
        // int $posPasajero
        // boolean $puedeQuitar

        $posPasajero = $this->buscaPasajero($dniQuitar);

        if($posPasajero == -1){
            $puedeQuitar = false;
        } else {
            $puedeQuitar = true;
            unset($this->pasajeros[$posPasajero]);
            array_values($this->pasajeros);
        }
        return $puedeQuitar;
    }
    
    /**
     * Modifica el nombre de un pasajero por su número de DNI
     * Retorna true si es posible, false en caso contrario
     * 
     * @param int $nroDni
     * @param string $nombreNuevo
     * @return boolean
     */
    public function modificarNombrePorDni($nroDni, $nombreNuevo){
        // int $posPasajero
        // boolean $puedeModificar

        $posPasajero = $this->buscaPasajero($nroDni);

        if($posPasajero == -1){
            $puedeModificar = false;
        } else {
            $puedeModificar = true;
            $this->pasajeros[$posPasajero]["nombre"] = $nombreNuevo;
        }
        return $puedeModificar;
    }

    /**
     * Modifica el apellido de un pasajero por su número de DNI
     * Retorna true si es posible, false en caso contrario
     * 
     * @param int $nroDni
     * @param string $apellidoNuevo
     * @return boolean
     */
    public function modificarApellidoPorDni($nroDni, $apellidoNuevo){
        // int $posPasajero
        // boolean $puedeModificar

        $posPasajero = $this->buscaPasajero($nroDni);

        if($posPasajero == -1){
            $puedeModificar = false;
        } else {
            $puedeModificar = true;
            $this->pasajeros[$posPasajero]["apellido"] = $apellidoNuevo;
        }
        return $puedeModificar;
    }

    private function buscaPasajero($nroDni){
        // boolean $existePasajero
        // int $posPasajero

        $existePasajero = false;
        $posPasajero = 0;

        while ($existePasajero == false && $posPasajero < count($this->pasajeros)){
            if ($nroDni == $this->pasajeros[$posPasajero]["numero de documento"]){
                $existePasajero = true;    
            }
            $posPasajero++;
        }
        if($posPasajero == count($this->pasajeros)){
            $posPasajero = -1;
        }

        return $posPasajero;
    }

    // NO SE DEBERÍA MODIFICAR EL DNI DE UN PASAJERO YA QUE SE ASUME QUE ES ÚNICO
    // (En tal caso se debe borrar y crear un pasajero nuevo)
}
?>