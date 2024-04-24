<?php
class EAttrezzatura_Basket extends EAttrezzatura{
    private int $numPalla_Basket;
    private int $numCasacca;
    private static $entità = EAttrezzatura_Basket::class;

    public function __construct($id_attrezzatura,$numpalla_Basket,$numCasacca){
        $this->id_attrezzatura = $id_attrezzatura;
        $this->numPalla_Basket =$numpalla_Basket;
        $this->numCasacca = $numCasacca;
 
    }
    public static function getEntità():string {
        return self::$entità;
    }
    public function getNumPalla_Basket(){
        return $this->numPalla_Basket;
    }
    public function setNumPalla_Basket($numpalla){
        $this->numPalla_Basket = $numpalla;
    }
    public function getNumCasacca(){
        return $this->numCasacca;
    }
    public function setNumCasacca($numCasacca){
        $this->numCasacca= $numCasacca;
    }
}