<?php
class ECampo_basket extends ECampo{
    private String $pavimento;
    private static $entità = ECampo_basket::class;

    public function __construct($copertura, $id_campo,$pavimento){
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->pavimento = $pavimento;
    }
    public static function getEntità(): string{
        return self ::$entità;
    }
    public function getPavimento(){
        return $this->pavimento;
    }
    public function setPavimento($pavimento){
        $this->pavimento = $pavimento;
    }
     //metodo toString esiste predefinito
}