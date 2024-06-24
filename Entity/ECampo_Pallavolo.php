<?php
class ECampo_Pallavolo extends ECampo{
    private static $id_campoPallavolo;
    private String $pavimento;
    private static $entità = ECampo_Pallavolo::class;

    public function __construct($id_campoPallavolo, $copertura, $id_campo,$pavimento){
        $this->id_campoPallavolo = $id_campoPallavolo;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->pavimento = $pavimento;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public static function getIdCampoPallavolo(){
        return self::$id_campoPallavolo;
    }
    public function setIdCampoPallavolo($id_campoPallavolo){

        $this->id_campoPallavolo = $id_campoPallavolo;
    }
    public function getPavimento(){
        return $this->pavimento;
    }
    public function setPavimento($pavimento){
        $this->pavimento = $pavimento;
    }
     //metodo toString esiste predefinito
}