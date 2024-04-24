<?php
class EAttrezzatura_Pallavolo extends EAttrezzatura{
    private int $numPalla_Pallavolo;
    private static $entità = EAttrezzatura_Pallavolo::class;
    
    public function __construct($id_attrezzatura,$numPalla_Pallavolo){
        $this->id_attrezzatura = $id_attrezzatura;
        $this->numPalla_Pallavolo =$numPalla_Pallavolo;
        
 
    }
    public static function getEntità():string {
        return self::$entità;
    }
    public function getNumPalla_Pallavolo(){
        return $this->numPalla_Pallavolo;
    }
    public function setNumPalla_Pallavolo($numpalla){
        $this->numPalla_Pallavolo = $numpalla;
    }
     //metodo toString esiste predefinito
}