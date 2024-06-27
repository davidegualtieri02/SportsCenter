<?php
require_once "ECampo.php";
class ECampo_Tennis extends ECampo{
    private static $id_campoTennis;
    private String $terreno;

    private static $entità =ECampo_Tennis::class;
    private EImage $fotoCampo;
 
    public function __construct($copertura,$TitoloCampo, $prezzo,$fotoCampo,$terreno){ 
        parent::__construct($copertura, $TitoloCampo, $prezzo);
        $this->fotoCampo=$fotoCampo;
        $this->terreno=$terreno;
    }

    
    public static function getEntità():string{
    return self::$entità;
    }
    public static function getIdCampoTennis(){
        return self::$id_campoTennis;
    }
    public function setIdCampoTennis($id_campoTennis){

        $this->id_campoTennis = $id_campoTennis;
    }
    public function getTerreno(){
        return $this->terreno;
    }
    public function setTerreno($terreno){
        $this->terreno = $terreno ;
    }

      //metodo toString esiste predefinito   
}