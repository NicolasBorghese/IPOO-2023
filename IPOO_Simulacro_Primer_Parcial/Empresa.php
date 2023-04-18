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
    public function __toString(){
        $cadena = "Identificación: ".$this->getIdentificacion()."\n";
        $cadena = $cadena. "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena. "\n";
        $cadena = $cadena."Colección de viajes: [\n".$this->viajesAString()."]\n";
        return $cadena;
    }

    public function viajesAString(){
        //string $viajesCadena
        $viajesCadena = "";
        for($i = 0; $i < count($this->getColViajes()); $i++){
            $viajesCadena = $viajesCadena. $this->getColViajes()[$i]."\n";
        }
        return $viajesCadena;
    }

    public function darViajeADestino($elDestino){
        //array $destinoMAsiento
        $destinoMAsiento = explode(" ", $elDestino);
        $destino = $destinoMAsiento[0];
        $cantAsientos = $destinoMAsiento[1];

        $viajesDisponibles = [];

        for($i = 0; $i < count($this->getColViajes()); $i++){
            $viajeLeido = $this->getColViajes()[$i];
            $destinoLeido = $viajeLeido->getDestino();
            $asientosDisponibles = $viajeLeido->getAsientosDisponibles();

            if($destino == $destinoLeido && $cantAsientos <= $asientosDisponibles){
                array_push($viajesDiponibles, $viajeLeido);
            }
        }

        return $viajesDisponibles;
    }

    public function incorporarViaje($objViaje){
        $destinoViaje = $objViaje->getDestino();
        $fechaViaje = $objViaje->getFecha();
        $horaPartidaViaje = $objViaje->getHoraPartida();
        $puedeAgregar = true;
        $i = 0;

        while($i < count($this->getColViajes()) && $puedeAgregar){
            $viajeColeccion = $this->getColViajes()[$i];
            $destinoColeccion = $viajeColeccion->getDestino();
            $fechaColeccion = $viajeColeccion->getFecha();
            $partidaColeccion = $viajeColeccion->getHoraPartida();

            if($destinoViaje == $destinoColeccion &&
            $fechaViaje == $fechaColeccion &&
            $horaPartidaViaje == $partidaColeccion){

                $puedeAgregar = false;
            }

            $i++;
        }

        if($puedeAgregar){
            $nuevaColViaje = $this->getColViajes();
            array_push($nuevaColViaje, $objViaje);
            $this->setColViajes($nuevaColViaje);
        }
        return $puedeAgregar;
    }

    public function venderViajeADestino($cantAsientos, $destino, $fecha){
        $puedeAgregar = false;
        $i = 0;

        while($i < count($this->getColViajes()) && $puedeAgregar == false){
            $viajeColeccion = $this->getColViajes()[$i];
            $destinoColeccion = $viajeColeccion->getDestino();
            $fechaColeccion = $viajeColeccion->getFecha();

            if($destino == $destinoColeccion && $fecha == $fechaColeccion){
                $puedeAgregar = $viajeColeccion->asignarAsientosDisponibles($cantAsientos);
            }

            $i++;
        }

        if($puedeAgregar == false){
            $viajeColeccion = null;
        }

        return $viajeColeccion;
    }

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