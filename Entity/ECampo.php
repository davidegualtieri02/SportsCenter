<?php
class ECampo {
    protected String $copertura;
    protected int $id_campo;

    private static $entità = ECampo::class;

    public function __construct($copertura,$id_campo){
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
    }
    public function getCopertura(){
        return $this->copertura;
    }
    public function setCopertura($coper){
        $this->copertura = $coper;
    }
    public function getId_campo(){
        return $this->id_campo;
    }
    public function setId_campo($id){
        $this->id_campo = $id;
    }
    public function getEntità():string{
        return self::$entità;
    }
     //metodo toString esiste predefinito
}