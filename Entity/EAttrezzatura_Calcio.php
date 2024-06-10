<?php
class EAttrezzatura_Calcio extends EAttrezzatura{
    private static $id_attrezzaturaCalcio;    
    private int $numPalloni_Calcio;
    private int $numCasacca;
    private static $entità = EAttrezzatura_Calcio::class;

    public function __construct($id_attrezzaturaCalcio, $numpalloni_Calcio, $numCasacca, $id_attrezzatura){
        $this->id_attrezzaturaCalcio = $id_attrezzaturaCalcio;
        $this->numPalloni_Calcio = $numpalloni_Calcio;
        $this->numCasacca = $numCasacca;
        $this->id_attrezzatura = $id_attrezzatura;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdAttrezzaturaCalcio(){
        return $this->id_attrezzaturaCalcio;
    }
    public function setIdAttrezzaturaCalcio($id_attrezzaturaCalcio){

        $this->id_attrezzaturaCalcio = $id_attrezzaturaCalcio;
    }
    public function getNumPalloni_Calcio(){
        return $this->numPalloni_Calcio;
    }
    public function setNumPalloni_Calcio($numpalloni){
        $this->numPalloni_Calcio = $numpalloni;
    }
    public function getNumCasacca(){
        return $this->numCasacca;
    }
    public function setNumCasacca($numCasacca){
        $this->numCasacca = $numCasacca;
    }
     //metodo toString esiste predefinito
}