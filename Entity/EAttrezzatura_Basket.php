<?php
require_once "EAttrezzatura.php";
class EAttrezzatura_Basket extends EAttrezzatura{
    private static $id_attrezzaturaBasket;
    private int $numPalla_Basket;
    private int $numCasacca;
    private static $entità = EAttrezzatura_Basket::class;

    public function __construct($numpalla_Basket, $numCasacca){
        parent::__construct();
        $this->numPalla_Basket = $numpalla_Basket;
        $this->numCasacca = $numCasacca;
        
    }
    public function getIdAttrezzaturaBasket(){
        return $this->id_attrezzaturaBasket;
    }
    public function setIdAttrezzaturaBasket($id_attrezzaturaBasket){

        $this->id_attrezzaturaBasket = $id_attrezzaturaBasket;
    }
    public static function getEntità():string{
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
        $this->numCasacca = $numCasacca;
    }
 //metodo toString esiste predefinito
}