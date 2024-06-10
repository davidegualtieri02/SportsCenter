<?php
class EAttrezzatura_Pallavolo extends EAttrezzatura{
    private static $id_attrezzaturaPallavolo;
    private int $numPalla_Pallavolo;
    private static $entità = EAttrezzatura_Pallavolo::class;
    
    public function __construct($id_attrezzaturaPallavolo, $numPalla_Pallavolo, $id_attrezzatura){
        $this->id_attrezzaturaPallavolo = $id_attrezzaturaPallavolo;
        $this->numPalla_Pallavolo = $numPalla_Pallavolo;
        $this->id_attrezzatura = $id_attrezzatura;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdAttrezzaturaPallavolo(){
        return $this->id_attrezzaturaPallavolo;
    }
    public function setIdAttrezzaturaPallavolo($id_attrezzaturaPallavolo){

        $this->id_attrezzaturaPallavolo = $id_attrezzaturaPallavolo;
    }
    public function getNumPalla_Pallavolo(){
        return $this->numPalla_Pallavolo;
    }
    public function setNumPalla_Pallavolo($numpalla){
        $this->numPalla_Pallavolo = $numpalla;
    }
     //metodo toString esiste predefinito
}