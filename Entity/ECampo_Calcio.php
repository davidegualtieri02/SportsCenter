<?php
require_once "ECampo.php";
class ECampo_Calcio  extends ECampo{
    private static $id_campoCalcio;
    private static $entità =ECampo_Calcio::class;
    private EImage $fotoCampo;

    public function __construct($id_campoCalcio, $copertura, $id_campo,$fotoCampo){
        $this->id_campoCalcio = $id_campoCalcio;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->fotoCampo = $fotoCampo;
    }
        public static function getEntità():string{
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