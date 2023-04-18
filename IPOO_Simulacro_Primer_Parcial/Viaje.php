<?php
include_once("Responsable.php");

class Viaje{

    //ATRIBUTOS
    private $destino;
    private $horaPartida;
    private $horaLlegada;
    private $numero;
    private $importe;
    private $fecha;
    private $asientosTotales;
    private $asientosDisponibles;
    private $personaResponsable;

    //CONSTRUCTOR
    public function __construct(
        $destino, 
        $horaPartida, 
        $horaLlegada, 
        $numero, 
        $importe, 
        $fecha, 
        $asientosTotales, 
        $asientosDisponibles, 
        $personaResponsable){
            
        $this->destino = $destino;
        $this->horaPartida = $horaPartida;
        $this->horaLlegada = $horaLlegada;
        $this->numero = $numero;
        $this->importe = $importe;
        $this->fecha = $fecha;
        $this->asientosTotales = $asientosTotales;
        $this->asientosDisponibles = $asientosDisponibles;
        $this->personaResponsable = $personaResponsable;
    }

    //OBSERVADORES
    public function getDestino(){
        return $this->destino;
    }

    public function getHoraPartida(){
        return $this->horaPartida;
    }

    public function getHoraLlegada(){
        return $this->horaLlegada;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getImporte(){
        return $this->importe;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getAsientosTotales(){
        return $this->asientosTotales;
    }

    public function getAsientosDisponibles(){
        return $this->asientosDisponibles;
    }

    public function getPersonaResponsable(){
        return $this->personaResponsable;
    }

    //MODIFICADORES
    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function setHoraPartida($horaPartida){
        $this->horaPartida = $horaPartida;
    }

    public function setHoraLlegada($horaLlegada){
        $this->horaLlegada = $horaLlegada;
    }

    public function setImporte($importe){
        $this->importe = $importe;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setAsientosTotales($asientosTotales){
        $this->asientosTotales = $asientosTotales;
    }

    public function setAsientosDisponibles($asientosDisponibles){
        $this->asientosDisponibles = $asientosDisponibles;
    }

    public function setPersonaResponsable($personaResponsable){
        $this->personaResponsable = $personaResponsable;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve un string que contiene toda la información del estado de una instancia de tipo Viaje
     * 
     * @return string
     */
    public function __toString(){

        $cadena = "Destino: ".$this->getDestino()."\n";
        $cadena = $cadena ."Hora de partida: ".$this->getHoraPartida()."\n";
        $cadena = $cadena ."Hora de llegada: ".$this->getHoraLlegada()."\n";
        $cadena = $cadena ."Número de viaje: ".$this->getNumero()."\n";
        $cadena = $cadena ."Importe: ".$this->getImporte()."\n";
        $cadena = $cadena ."Fecha: ".$this->getFecha()."\n";
        $cadena = $cadena ."Asientos totales: ".$this->getAsientosTotales()."\n";
        $cadena = $cadena ."Asientos disponibles: ".$this->getAsientosDisponibles()."\n";
        $cadena = $cadena ."Persona responsable:\n[".$this->getPersonaResponsable()."]\n";

        return $cadena;
    }

    /**
     * Implementar el método asignarAsientosDisponibles($catAsientos) que recibe por
     * parámetros la canti- dad de asientos que desean asignarse. El método retorna
     * verdadero en caso que la asignación pueda concretarse y falso en caso contrario
     * 
     * @param int $cantAsientos
     * @return boolean
     */
    public function asignarAsientosDisponibles($cantAsientos){
        //boolan $puedenAsignarse
        //int $nuevosADisponibles
        $puedenAsignarse = false;

        if($this->getAsientosDisponibles() >= $cantAsientos){
            $puedenAsignarse = true;
            $nuevosADisponibles = $this->getAsientosDisponibles() - $cantAsientos;
            $this->setAsientosDisponibles($nuevosADisponibles);
        }

        return $puedenAsignarse;
    }
}
