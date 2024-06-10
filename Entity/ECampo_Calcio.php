<?php
class ECampo_Calcio {
    private static $id_campoCalcio;
    private static $entità =ECampo_Calcio::class;

    public function __construct($id_campoCalcio, $copertura, $id_campo){
        $this->id_campoCalcio = $id_campoCalcio;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
    }
        public static function getEntità():string{
    return self::$entità;
    }
    public function getIdCampoCalcio(){
        return $this->id_campoCalcio;
    }
    public function setIdCampoCalcio($id_campoCalcio){
        $this->id_campoCalcio = $id_campoCalcio;
    }
    //metodo toString esiste predefinito
}