<?php
class ETessera{
    private int $Codice_Tessera;
    private int $id_tessera;
    private static $entità = ETessera ::class;

    public function __construct($cod, $id){
        $this->Codice_Tessera = $cod;
        $this->id_tessera = $id;
    }
    public function getCodiceTessera(){
        return $this->Codice_Tessera;
    }
    public function setCodiceTessera($cod){

        $this->Codice_Tessera = $cod;
    
    }
    public function getIdTessera(){
        return $this->id_tessera;
    }
    public function setIdTessera($id){

        $this->id_tessera = $id;
    }
    public static function getEntità():string{
        return self::$entità;
    }
     //metodo toString esiste predefinito
}