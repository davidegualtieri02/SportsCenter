<?php
use DateTime; //Utilizzo di una classe di default
//use Doctrine\ORM \Mapping as ORM;

class EPrenotazione {
    private int $id_prenotazione = 0;
    private DateTime $data;
    private int $orario; //L'orario non è di tipo DateTime perchè gli orari disponibili saranno predefiniti all'ora spaccata (es. ore 18, ore 19, ore 20, etc.)
    private bool $pagata;
    private $id_campo; //ID dell'oggetto Campo
    private $id_attrezzatura; //ID dell'oggetto Attrezzatura
    private $id_utenteRegistrato;
    private static $entità = EPrenotazione::class;

    public function __construct($data,$orario,$pagata,$id_campo,$id_attrezzatura,$id_utenteRegistrato){
        $this->data = $data;
        $this->orario = $orario;
        $this->pagata = $pagata;
        $this->id_campo = $id_campo;
        $this->id_attrezzatura = $id_attrezzatura;
        $this->id_utenteRegistrato = $id_utenteRegistrato;
    }
    public function getData():DateTime{
        return $this->data;
    }
    public function setData(DateTime $data):void{
        $this->data = $data;
    }
    public function getOrario(){
        return $this->orario;
    }
    public function setOrario($orario):void{
        $this->giorno = $orario;
    }
    public function getPagata(){
        return $this->pagata;
    }
    public function setPagata($pagata):void{
        $this->giorno = $pagata;
    }
    public function getIdPrenotazione(){
        return $this->id_prenotazione;
    }
    public function setIdPrenotazione($id_prenotazione):void{
        $this->giorno = $id_prenotazione;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdCampo(){
        return $this->id_campo;
    }
    public function setIdCampo($id_campo){
        $this->id_campo = $id_campo;
    }
    public function getIdAttrezzatura(){
        return $this->id_attrezzatura;
    }
    public function setIdAttrezzatura($id_attrezzatura){
        $this->id_attrezzatura = $id_attrezzatura;
    }
    public function getIdUtente(){
        return $this->id_utenteRegistrato;
    }
    public function setIdUtente($id_utenteRegistrato){
        $this->id_utenteRegistrato = $id_utenteRegistrato;
    }
    //metodo toString esiste predefinito
}