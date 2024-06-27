<?php
require_once "ECampo.php";
require_once "EImage.php";
class ECampo_Pallavolo extends ECampo{
    private static $id_campoPallavolo;
    private String $pavimento;
    private static $entità = ECampo_Pallavolo::class;
    private EImage $fotoCampo;

    public function __construct($copertura,$TitoloCampo, $prezzo, EImage $fotoCampo,$pavimento){ 
        parent::__construct($copertura, $TitoloCampo, $prezzo);
        $this->fotoCampo=$fotoCampo;
        $this->pavimento= $pavimento;
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