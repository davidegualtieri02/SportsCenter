<?php
class ETessera{
    private int $codice_tessera;
    private int $id_tessera;
    private static $entità = ETessera ::class;

    public function __construct($cod,$id){
        $this->codice_tessera = $cod;
        $this->id_tessera = $id;
    }
    public function getCodiceTessera(){
        return $this->codice_tessera;
    }
    public function setCodiceTessera($cod){

        $this->codice_tessera= $cod;
    
    }
    public function getIdTessera(){
        return $this->id_tessera;
    }
    public function setIdTessera($id){

        $this->id_tessera= $id;
    }
    public static function getEntità():string{
        return self::$entità;
    }
}