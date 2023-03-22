<?php

class Reloj{

    // Atributos
    private $hora;
    private $minuto;
    private $segundo;


    public function __construct()
    {
        $this -> hora = 0;
        $this -> minuto = 0;
        $this -> segundo = 0;
    }

    public function puesta_a_cero()
    {
        $this -> hora = 0;
        $this -> minuto = 0;
        $this -> segundo = 0;
    }

    public function incremento(){
        if($this -> segundo == 59){
            $this -> segundo = 0;
            
            if($this -> minuto == 59){
                $this -> minuto = 0;

                if($this -> hora == 23){
                    $this -> hora = 0;
                } else {
                    $this -> hora++;
                }
            }else{
                $this -> minuto++;
            }
        }else{
            $this -> segundo++;
        }
    }

    public function getHora(){
        return $this -> hora;
    }

    public function getMinuto(){
        return $this -> minuto;
    }

    public function getSegundo(){
        return $this -> segundo;
    }

    public function __toString(){
        return "Hora: ".$this->hora."/Minuto: ".$this->minuto."/ Segundo: ".$this->segundo;
    }
}

?>