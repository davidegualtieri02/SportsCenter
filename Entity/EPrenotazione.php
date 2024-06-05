<?php
use Doctrine\ORM \Mapping as ORM;
class EPrenotazione {
    private Data $data;
    private Int $orario;
    private bool $pagata;
    private int $id_prenotazione;
    private $id_campo; //ID dell'oggetto Campo
    private $id_attrezzatura; //ID dell'oggetto Attrezzatura
    private static $entità = EPrenotazione::class;

    public function __construct($data,$orario,$pagata,$id_prenotazione, $id_campo, $id_attrezzatura){
        $this->data =$data;
        $this->orario = $orario;
        $this->pagata = $pagata;
        $this->id_prenotazione = $id_prenotazione;
        $this->id_campo = $id_campo;
        $this->id_attrezzatura = $id_attrezzatura;

    }
    public function getData(){
        return $this->data;
    }
    public function setData($data):void{
        $this->data = $data;
    
    }
    public function getOrario(){
        return $this->orario;
    }
    public function setOrario($orario):void {
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
        $this->id_campo =$id_campo;
    }

    public function getIdAttrezzatura(){
        return $this->id_attrezzatura;
    }

    public function setIdAttrezzatura($id_attrezzatura){
        $this->id_attrezzatura = $id_attrezzatura;
    }

    //metodo toString esiste predefinito
}