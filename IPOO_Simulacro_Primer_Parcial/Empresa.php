<?php
include_once("Viaje.php");

class Empresa{

    //ATRIBUTOS
    private $identificacion;
    private $nombre;
    private $colViajes;

    //CONSTRUCTOR
    public function __construct($identificacion, $nombre, $colViajes){
        $this->identificacion = $identificacion;
        $this->nombre = $nombre;
        $this->colViajes = $colViajes;
    }

    //OBSERVADORES
    public function getIdentificacion(){
        return $this->identificacion;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getColViajes(){
        return $this->colViajes;
    }

    //MODIFICADORES
    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setColViajes($colViajes){
        $this->colViajes = $colViajes;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve un string que contiene toda la información del estado de una instancia de tipo Empresa
     * 
     * @return string
     */
    public function __toString(){
        $cadena = "Identificación: ".$this->getIdentificacion()."\n";
        $cadena = $cadena. "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena. "\n";
        $cadena = $cadena."Colección de viajes: [\n".$this->viajesAString()."]\n";
        return $cadena;
    }

    /**
     * Devuelve un string que contiene toda la información de un arreglo que guarda objetos de tipo Viaje
     * 
     * @return string
     */
    public function viajesAString(){
        //string $viajesCadena
        $viajesCadena = "";
        for($i = 0; $i < count($this->getColViajes()); $i++){
            $viajesCadena = $viajesCadena. $this->getColViajes()[$i]."\n";
        }
        return $viajesCadena;
    }

    /**
     * Implementar el método darViajeADestino($elDestino) que recibe por parámetro un
     * destino junto a una cantidad de asientos y retorna una colección con todos los viajes
     * disponibles a ese destino.
     * 
     * @param string $elDestino
     * @return array
     */
    public function darViajeADestino($elDestino){
        //array $destinoMAsiento, $viajesDisponibles
        //string $destino, $destinoLeido
        //int $cantAsientos, $i, $asientosDisponibles
        //Viaje $viajeLeido

        //Separa el argumento leído en 2 partes, la primera para el nombre del destino y la segunda
        //para la cantidad de asientos
        $destinoMAsiento = explode(" ", $elDestino);
        $destino = $destinoMAsiento[0];
        $cantAsientos = $destinoMAsiento[1];

        $viajesDisponibles = [];

        for($i = 0; $i < count($this->getColViajes()); $i++){
            $viajeLeido = $this->getColViajes()[$i];
            $destinoLeido = $viajeLeido->getDestino();
            $asientosDisponibles = $viajeLeido->getAsientosDisponibles();

            if($destino == $destinoLeido && $cantAsientos <= $asientosDisponibles){
                array_push($viajesDisponibles, $viajeLeido);
            }
        }

        return $viajesDisponibles;
    }

    /**
     * Implementar el método incorporarViaje($objViaje) que recibe como parámetro un viaje,
     * verifica que no se encuentre registrado ningún otro viaje al mismo destino, en la misma
     * fecha y con el mismo horario de partida. El método retorna verdadero si la incorporación
     * del viaje se realizó correctamente y falso en caso contrario.
     * 
     * @param Viaje
     * @return boolean
     */
    public function incorporarViaje($objViaje){
        //int $posViaje
        //string $destinoViaje, $fechaViaje, $horaPartidaViaje, $destinoColeccion, $fechaColeccion, $paridaColeccion
        //boolean $puedeAgregar
        //Viaje $viajeColeccion

        $destinoViaje = $objViaje->getDestino();
        $fechaViaje = $objViaje->getFecha();
        $horaPartidaViaje = $objViaje->getHoraPartida();
        $puedeAgregar = true;
        $posViaje = 0;

        //Recorro toda la colección de viajes comparando el recibido con cada uno que ya tengo
        while($posViaje < count($this->getColViajes()) && $puedeAgregar){
            $viajeColeccion = $this->getColViajes()[$posViaje];
            $destinoColeccion = $viajeColeccion->getDestino();
            $fechaColeccion = $viajeColeccion->getFecha();
            $partidaColeccion = $viajeColeccion->getHoraPartida();

            //Si ya existe el viaje, entonces no se podrá agregar
            if($destinoViaje == $destinoColeccion &&
            $fechaViaje == $fechaColeccion &&
            $horaPartidaViaje == $partidaColeccion){

                $puedeAgregar = false;
            }

            $posViaje++;
        }

        //Si no existe el viaje, se agrega a la colección y se modifica el atributo colViajes
        if($puedeAgregar){
            $nuevaColViajes = $this->getColViajes();
            array_push($nuevaColViajes, $objViaje);
            $this->setColViajes($nuevaColViajes);
        }
        return $puedeAgregar;
    }

    /**
     * Implementar el método venderViajeADestino($canAsientos, $destino, $fecha) método que
     * recibe por parámetro la cantidad de asientos, el destino, una fecha y se registra la
     * asignación del viaje en caso de ser posible. (invocar al método
     * asignarAsientosDisponibles). El método retorna la instancia del viaje asignado o null
     * en caso contrario.
     * 
     * @param int $cantAsientos
     * @param string $destino
     * @param string $fecha
     * @return Viaje
     */
    public function venderViajeADestino($cantAsientos, $destino, $fecha){
        //int $posViaje
        //boolean $puedeAgregar
        //Viaje $viajeColeccion
        //string $destinoColeccion, $fechaColeccion

        $puedeAgregar = false;
        $posViaje = 0;

        while($posViaje < count($this->getColViajes()) && $puedeAgregar == false){
            $viajeColeccion = $this->getColViajes()[$posViaje];
            $destinoColeccion = $viajeColeccion->getDestino();
            $fechaColeccion = $viajeColeccion->getFecha();

            if($destino == $destinoColeccion && $fecha == $fechaColeccion){
                $puedeAgregar = $viajeColeccion->asignarAsientosDisponibles($cantAsientos);
            }

            $posViaje++;
        }

        if($puedeAgregar == false){
            $viajeColeccion = null;
        }

        return $viajeColeccion;
    }

    /**
     * Implementar el método montoRecaudado que retorna el monto recaudado por la
     * Empresa. (tener en cuenta los asientos vendidos y el importe del viaje)
     * 
     * @return float
     */
    public function montoRecaudado(){
        //int $montoTotal, $asientosOcupados, $montoViaje
        //Viaje $viajeColeccion

        $montoTotal = 0;

        for ($i = 0 ;$i < count($this->getColViajes()); $i++){
            $viajeColeccion = $this->getColViajes()[$i];
            $asientosOcupados = ($viajeColeccion->getAsientosTotales() - $viajeColeccion->getAsientosDisponibles());
            $montoViaje = ($viajeColeccion->getImporte() * $asientosOcupados);
            $montoTotal = $montoTotal + $montoViaje;
        }

        return $montoTotal;
    }
}

?>