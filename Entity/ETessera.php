<?php
class ETessera{
    
    private int $id_tessera;
    private DateTime $dataScadenza;
    private DateTime $dataInizio;
    private int $id_utente;
    private static $entità = ETessera ::class;

    public function __construct($idutente, $dataScadenza,$dataInizio){
        $this->dataScadenza = $dataScadenza;
        $this->dataInizio = $dataInizio;
        $this->id_utente = $idutente;
    }
    public function getIdTessera(){
        return $this->id_tessera;
    }
    public function getIdUtente(){
        return $this->id_utente;
    }
    public function setIdTessera($id){

        $this->id_tessera = $id;
    }
    public static function getEntità():string{
        return self::$entità;
    }
     //metodo toString esiste predefinito
}