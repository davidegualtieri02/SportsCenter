<?php
class ETessera{
    //ATTENZIONE: dataScadenza e dataInizio dovrebbero essere in formato DateTime, non String!
    private int $id_tessera = 0;
    private String $dataScadenza;
    private String $dataInizio;
    private int $id_utenteRegistrato;
    private static $entità = ETessera ::class;

    public function __construct($id_utenteRegistrato, $dataScadenza, $dataInizio){
        $this->dataScadenza = $dataScadenza;
        $this->dataInizio = $dataInizio;
        $this->id_utenteRegistrato = $id_utenteRegistrato;
    }
    public function getIdTessera(){
        return $this->id_tessera;
    }
    public function getIdUtente(){
        return $this->id_utenteRegistrato;
    }
    public function setIdTessera($id){
        $this->id_tessera = $id;
    }
    public static function getEntità(){
        return self::$entità;
    }
    public  function getDataScadenza(){
        return $this->dataScadenza;
    }
    public function getDataInizio(){
        return $this->dataInizio;
    }
    public function setDataInizio($data){
        $this->dataInizio = $data;
    }

    //metodo toString esiste predefinito
}