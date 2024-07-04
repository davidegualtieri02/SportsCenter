<?php
class EAttrezzatura{
    protected int $id_attrezzatura = 0;
    protected String $descrizione;

    private static $entità = EAttrezzatura::class;

    public function __construct($descrizione){
        $this->descrizione = $descrizione;
 }
    public function getId_attrezzatura(){
        return $this->id_attrezzatura;
    }
    public function setId_attrezzatura($id){
        $this->id_attrezzatura = $id;
    }
    public static function getEntità():string{
        return self::$entità;
    }
     //metodo toString esiste predefinito
}