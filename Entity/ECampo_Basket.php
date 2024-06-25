<?php
class ECampo_basket extends ECampo{
    private static $id_campoBasket;
    private String $pavimento;
    private static $entità = ECampo_basket::class;
    private EImage $fotoCampo;

    public function __construct($id_campoBasket, $copertura, $id_campo, $pavimento, $fotoCampo){
        parent::__construct($copertura, $id_campo, $TitoloCampo, $prezzo) //???
        $this->id_campoBasket = $id_campoBasket;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
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