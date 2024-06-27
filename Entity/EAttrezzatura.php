<?php
class EAttrezzatura{
    protected int $id_attrezzatura;


    private static $entità = EAttrezzatura::class;

    public function __construct(){
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