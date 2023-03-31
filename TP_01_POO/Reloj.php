<?php

class Reloj{

    //ATRIBUTOS
    private $hora;
    private $minutos;
    private $segundos;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->hora = 0;
        $this->minutos = 0;
        $this->segundos = 0;
    }

    //OBSERVADORES
    public function getHora(){
        return $this->hora;
    }

    public function getMinutos(){
        return $this->minutos;
    }

    public function getSegundos(){
        return $this->segundos;
    }

    //PROPIAS DE CLASE
    public function puesta_a_cero()
    {
        $this->hora = 0;
        $this->minutos = 0;
        $this->segundos = 0;
    }

    public function incremento(){
        if($this->segundos == 59){
            $this->segundos = 0;
            
            if($this->minutos == 59){
                $this->minutos = 0;

                if($this->hora == 23){
                    $this->hora = 0;
                } else {
                    $this->hora++;
                }
            }else{
                $this->minutos++;
            }
        }else{
            $this->segundos++;
        }
    }

    public function __toString(){
        return "Hora: ".$this->hora."/Minutos: ".$this->minutos."/ Segundos: ".$this->segundos;
    }
}

?>