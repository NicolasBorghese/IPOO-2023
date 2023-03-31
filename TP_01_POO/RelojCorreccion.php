<?php

class RelojCorreccion{

    //Atributos
    private $hora;
    private $minutos;
    private $segundos;

    //METODOS
    public function __construct($hora, $minutos, $segundos){
        $this->hora = $hora;
        $this->minutos = $minutos;
        $this->segundos = $segundos;
    }

    /**
     * Retorna el valor de la hora
     */
    public function getHora(){
        return $this->hora;
    }

    /**
     * Setea el valor de hora
     */
    public function setHora($hora){
        $this->hora = $hora;
    }

    /**
     * Retorna el valor de los minutos
     */
    public function getMinutos(){
        return $this->minutos;
    }

    /**
     * Setea el valor de los minutos
     */
    public function setMinutos($minutos){
        $this->minutos = $minutos;
    }

    /**
     * Retorna el valor de los segundos
     */
    public function getSegundos(){
        return $this->segundos;
    }

    /**
     * Setea el valor de los segundos
     */
    public function setSegundos($segundos){
        $this->segundos = $segundos;
    }

    public function __toString(){
        return "Hora:".$this->hora.":".$this->minutos.":".$this->segundos;
    }

    /**
     * Método que coloca en 0 los atributos
     */
    public function puesta_a_cero(){
        $this->setHora(0);
        $this->setMinutos(0);
        $this->setSegundos(0);
    }

    /**
     * Función que va a incrementar los segundos, minutos y horas.
     * Cuando el contador llegue a 23:59:59 deberá pasar a 00:00:00
     */
    public function incrementar(){
        //Obtengo los valores de los atributos
        $vhora = $this->getHora();
        $vminutos = $this->getMinutos();
        $vsegundos = $this->getSegundos();
        //Aumento el segundo
        $vsegundos++;
        if($vsegundos <=59 ){
            $this->setSegundos($vsegundos);
        }else{ //es mayor a 59
            $this->setSegundos(0);
            $vminutos++;
            if($vminutos <=59 ){
                $this->setMinutos($vminutos);
            }else{
                $this->setMinutos(0);
                $vhora++;
                if($vhora <= 23){
                    $this->setHora($vhora);
                }else{
                    $this->setHora(0);
                }
            }
        }
    }
}

?>