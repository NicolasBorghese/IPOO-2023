<?php

include_once("Empresa.php");
include_once("Responsable.php");
include_once("Viaje.php");

class Terminal{

    //ATRIBUTOS
    private $denominacion;
    private $direccion;
    private $colEmpresas;

    //CONSTRUCTOR
    public function __construct($denominacion, $direccion, $colEmpresas){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colEmpresas = $colEmpresas;
    }

    //OBSERVADORES
    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }
    
    public function getColEmpresas(){
        return $this->colEmpresas;
    }

    //MODIFICADORES
    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setColEmpresas($colEmpresas){
        $this->colEmpresas = $colEmpresas;
    }

    //PROPIOS DE CLASE
    /**
     * Devuelve un string que contiene toda la información del estado de una instancia de tipo Terminal
     * 
     * @return string
     */
    public function __toString(){
        //string $cadena

        $cadena = "Denominación: ".$this->getDenominacion()."\n";
        $cadena = $cadena ."Dirección: ".$this->getDireccion()."\n";
        $cadena = $cadena ."\n";
        $cadena = $cadena ."Empresas: [\n".$this->empresasAString()."]\n";

        return $cadena;
    }

    /**
     * Devuelve un string que contiene toda la información de un arreglo que guarda objetos de tipo Empresa
     * 
     * @return string
     */
    public function empresasAString(){
        //string $empresas
        $empresas = "";

        for($i = 0; $i < count($this->getColEmpresas()); $i++){
            $empresas = $empresas. $this->getColEmpresas()[$i]."\n";
        }
        return $empresas;
    }

    /**
     * Implementar el método ventaAutomatica($cantAsientos, $fecha, $destino, $empresa) que
     * recibe por parámetro la cantidad de asientos que se requieren, una fecha, un destino y
     * la empresa con la que se desea viajar. Automáticamente se registra la venta del viaje. (Para
     * la implementación de este método debe utilizarse uno de los métodos implementados en la clase
     * Viaje).
     * 
     * @param int $cantAsientos
     * @param string $fecha
     * @param string $destino
     * @param string $empresa
     */
    public function ventaAutomatica($cantAsientos, $fecha, $destino, $empresa){
        //int $posEmpresa, $posViaje
        //string $fechaLeida, $destinoLeido
        //array $viajesEmpresa, $empresasCopia
        //Empresa $empresaBuscada
        //Viaje $viajeVendido

        $posEmpresa = $this->buscaEmpresa($empresa);

        if($posEmpresa != -1){
            //Empresa seleccionada
            $empresaBuscada = $this->getColEmpresas()[$posEmpresa];

            $viajeVendido = $empresaBuscada->venderViajeADestino($cantAsientos, $destino, $fecha);

            //Si el viaje se vende, se setea la colección de empresas con el viaje vendido
            if($viajeVendido != null){
                $empresasCopia = $this->getColEmpresas();
                $empresasCopia[$posEmpresa] = $empresaBuscada;
                $this->setColEmpresas($empresasCopia);
            }
        }
    }

    /**
     * Método que busca la posición de una empresa y si la encuentra la devuelve
     * Sino retorna -1
     * 
     * @param string $empresa
     */
    public function buscaEmpresa($empresa){
        //int $pos, 
        //string $nombreEmpresa
        //boolean $encontrado
        //Empresa $empresaEnCol

        $pos = 0;
        $encontrado = false;

        while ($pos < count($this->getColEmpresas()) && $encontrado == false){
            $empresaEnCol = $this->getColEmpresas()[$pos];
            $nombreEmpresa = $empresaEnCol->getNombre();

            if ($empresa == $nombreEmpresa){
                $encontrado = true;
            }
            $pos++;

        }
        $pos--;

        if(!$encontrado){
            $pos = -1;
        }

        return $pos;
    }

    /**
     * Implementar el método empresaMayorRecaudacion retorna un objeto de la clase
     * empresa que se corresponde con la de mayor recaudación.
     * 
     * @return Empresa
     */
    public function empresaMayorRecaudacion(){
        //int $recaudacionViaje, $recaudacionTotal, $recaudacionMayor, $asientosOcupados
        //array $colEmpresasCopia, $colViajesCopia
        //Empresa $empMayorRecaudacion, $empActual
        //Viaje $viajeActual
        $empMayorRecaudacion = null;
        $recaudacionMayor = -1;

        //Selecciono la Coleccion de empresas de la terminal
        $colEmpresasCopia = $this->getColEmpresas();
        
        //Recorro todas las empresas para saber cual es la que tuvo la mayor recaudación
        for($i = 0; $i < count($colEmpresasCopia); $i++){

            $empActual = $colEmpresasCopia[$i];

            $recaudacionTotal = $empActual->montoRecaudado();

            if($recaudacionTotal > $recaudacionMayor){
                $empMayorRecaudacion = $empActual;
                $recaudacionMayor = $recaudacionTotal;
            }
        }

        return $empMayorRecaudacion;
    }

    /**
     * Implementar el método responsableViaje($numeroViaje) que recibe por parámetro un
     * numero de viaje y retorna al responsable del viaje.
     * 
     * @param int $numeroViaje
     * @return Responsable
     */
    public function responsableViaje($numeroViaje){
        //array $colEmpresasCopia, $colViajesCopia
        //int $posEmpresa, $posViaje
        //boolean $responsableEncontrado
        //Empresa $empresaActual
        //Viaje $viajeActual
        //Responsable $responsableAsignado

        $responsableAsignado = null;
        $posEmpresa = 0;
        $responsableEncontrado = false;

        //Seleciono la coleccion de empresas de la terminal para recorrerlas
        $colEmpresasCopia = $this->getColEmpresas();

        while($responsableEncontrado == false && $posEmpresa < count($colEmpresasCopia)){

            //Selecciono a una empresa para recorrer sus viajes
            $empresaActual = $colEmpresasCopia[$posEmpresa];
            
            $posViaje = 0;
            //Selecciono a la coleccion de viajes para recorrerlos
            $colViajesCopia = $empresaActual->getColViajes();

            while($responsableEncontrado == false && $posViaje < count($colViajesCopia)){
                
                //Selecciono a una empresa para comparar sus valores
                $viajeActual = $colViajesCopia[$posViaje];

                if($viajeActual->getNumero() == $numeroViaje){
                    $responsableAsignado = $viajeActual->getPersonaResponsable();
                    $responsableEncontrado = true;
                }
                $posViaje++;

            }

            $posEmpresa++;
        }

        return $responsableAsignado;
    }

}

?>