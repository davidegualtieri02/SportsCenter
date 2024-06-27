<?php
require_once "ECampo.php";
require_once "EImage.php";
class ECampo_basket extends ECampo{
    private static $id_campoBasket;
    private String $pavimento;
    private static $entità = ECampo_basket::class;
    private EImage $fotoCampo;

    public function __construct($copertura , $pavimento, EImage $fotoCampo, $TitoloCampo, $prezzo){ //?
        parent::__construct($copertura, $TitoloCampo, $prezzo);
        $this->pavimento = $pavimento;
        $this->fotoCampo=$fotoCampo;
    }
    public static function getEntità(): string{
        return self::$entità;
    }
    public static function getIdCampoBasket(){
        return self::$id_campoBasket;
    }
    public function setIdCampoBasket($id_campoBasket){
        $this->id_campoBasket = $id_campoBasket;
    }
    public function getPavimento(){
        return $this->pavimento;
    }
    public function setPavimento($pavimento){
        $this->pavimento = $pavimento;
    }
     //metodo toString esiste predefinito
}