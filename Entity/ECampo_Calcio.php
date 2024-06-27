<?php
require_once "ECampo.php";
require_once "EImage.php";
class ECampo_Calcio  extends ECampo{
    private static $id_campoCalcio;
    private static $entità =ECampo_Calcio::class;
    private EImage $fotoCampo;

    public function __construct($copertura,$TitoloCampo, $prezzo, EImage $fotoCampo){ 
        parent::__construct($copertura, $TitoloCampo, $prezzo);
        $this->fotoCampo=$fotoCampo;
    }
       

        public  function getEntità():string{
    return self::$entità;
    }
    public static function getIdCampoCalcio(){
        return self::$id_campoCalcio;
    }
    public function setIdCampoCalcio($id_campoCalcio){
        $this->id_campoCalcio = $id_campoCalcio;
    }
    //metodo toString esiste predefinito
}