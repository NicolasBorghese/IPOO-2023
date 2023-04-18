<?php

class Responsable{

    //ATRIBUTOS
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $direccion;
    private $mail;
    private $telefono;

    //CONSTRUCTOR
    public function __construct($nombre, $apellido, $nroDocumento, $direccion, $mail, $telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDocumento = $nroDocumento;
        $this->direccion = $direccion;
        $this->mail = $mail;
        $this->telefono = $telefono;
    }

    //OBSERVADORES
    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getNroDocumento(){
        return $this->nroDocumento;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    //MODIFICADORES
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setNroDocumento($nroDocumento){
        $this->nroDocumento = $nroDocumento;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    //PROPIOS DE LA CLASE
    /**
     * Devuelve un string que contiene toda la información del estado de una instancia de tipo Responsable
     * 
     * @return string
     */
    public function __toString(){
        $cadena = "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena ."Apellido: ".$this->getApellido()."\n";
        $cadena = $cadena ."N° de documento: ".$this->getNroDocumento()."\n";
        $cadena = $cadena ."Dirección: ".$this->getDireccion()."\n";
        $cadena = $cadena ."Mail: ".$this->getMail()."\n";
        $cadena = $cadena ."teléfono: ".$this->getTelefono();

        return $cadena;
    }
}

?>