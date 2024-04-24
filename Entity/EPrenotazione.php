<?php
use Doctrine\ORM \Mapping as ORM;
class EPrenotazione {
    private Data $data;
    private Int $orario;
    private bool $pagata;
    private int $id_prenotazione;
    private static $entità = EPrenotazione::class;

    public function __construct($data,$orario,$pagata,$id_prenotazione){
        $this->data =$data;
        $this->orario = $orario;
        $this->pagata = $pagata;
        $this->id_prenotazione = $id_prenotazione;

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
    //metodo toString esiste predefinito
}