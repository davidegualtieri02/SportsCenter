<?php
class EAttrezzatura_Calcio extends EAttrezzatura{
    private int $numPalloni_Calcio;
    private int $numCasacca;
    private static $entità = EAttrezzatura_Calcio::class;

    public function __construct($id_attrezzatura,$numpalloni_Calcio,$numCasacca){
        $this->id_attrezzatura = $id_attrezzatura;
        $this->numPalloni_Calcio =$numpalloni_Calcio;
        $this->numCasacca = $numCasacca;
 
    }
    public static function getEntità():string {
        return self::$entità;
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
        $this->numCasacca= $numCasacca;
    }
     //metodo toString esiste predefinito
}