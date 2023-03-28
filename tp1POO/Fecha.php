<?php

class Fecha
{

    //Atributos
    private $dia;
    private $mes;
    private $anio;
    private $esBisiesto;

    public function __construct()
    {
        //Constructor por default
        $this -> dia = 1;
        $this -> mes = 1;
        $this -> anio = 1900;
        $this -> esBisiesto = false;
    }

    // MODIFICADORES (set)
    public function setDia($nuevoDia)
    {
        $this->dia = $nuevoDia;
    }

    public function setMes($nuevoMes)
    {
        $this->mes = $nuevoMes;
    }

    public function setAnio($nuevoAnio)
    {
        $this->anio = $nuevoAnio;
        $this-> determinaBisiesto();
    }

    // OBSERVADORES (get)
    public function getDia()
    {
        return $this->dia;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function getEsBisiesto()
    {
        return $this->esBisiesto;
    }

    // PROPIAS DE TIPO
    public function fechaAbreviada()
    {
        return "(" . $this->dia . "/" . $this->mes . "/" . $this->anio . ")";
    }

    public function fechaExtendida()
    {
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        return "(" . $this->dia . " de " . $meses[$this->mes -1] . " del " . $this->anio . ")";
    }

    public function incremento_un_dia()
    {
        if ($this->dia == 28 && $this->mes == 2 && $this->esBisiesto == false) {
            $this->dia = 1;
            $this->mes++;
        } else {
            if ($this->dia == 29 && $this->mes == 2) {
                $this->dia = 1;
                $this->mes++;
            } else {
                if ($this->dia == 30 && ($this->mes == 4 || $this->mes == 6 || $this->mes == 9 || $this->mes == 11)) {
                    $this->dia = 1;
                    $this->mes++;
                } else {
                    if ($this->dia == 31 && ($this->mes == 1 || $this->mes == 3 || $this->mes == 5 || $this->mes == 7 || $this->mes == 10)) {
                        $this->dia = 1;
                        $this->mes++;
                    } else {
                        if ($this->dia == 31 && $this->mes == 12) {
                            $this->dia = 1;
                            $this->mes = 1;
                            $this->anio++;
                            $this->determinaBisiesto();
                        } else {
                            $this->dia++;
                        }
                    }
                }
            }
        }
    }

    private function determinaBisiesto()
    {
        if ($this->anio % 4 == 0) {
            if (!($this->anio % 100 == 0 && $this->anio % 400 != 0)) {
                $this->esBisiesto = true;
            } else {
                $this->esBisiesto = false;
            }
        } else {
            $this->esBisiesto = false;
        }
    }
}
