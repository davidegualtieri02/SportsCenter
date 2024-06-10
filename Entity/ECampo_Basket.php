<?php
class ECampo_basket extends ECampo{
    private static $id_campoBasket;
    private String $pavimento;
    private static $entità = ECampo_basket::class;

    public function __construct($id_campoBasket, $copertura, $id_campo, $pavimento){
        $this->id_campoBasket = $id_campoBasket;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->pavimento = $pavimento;
    }
    public static function getEntità(): string{
        return self::$entità;
    }
    public function getIdCampoBasket(){
        return $this->id_campoBasket;
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