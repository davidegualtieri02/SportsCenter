<?php 
require_once "EAttrezzatura.php";
class EAttrezzatura_Padel extends EAttrezzatura{
    private static $id_attrezzaturaPadel;
    private int $numPalla_Padel;
    private int $numRacchetta_Padel;

    private static $entità = EAttrezzatura_Padel::class;

    public function __construct( $numPalla_Padel, $numRacchetta_Padel){
        parent::__construct();
        $this->numPalla_Padel = $numPalla_Padel;
        $this->numRacchetta_Padel = $numRacchetta_Padel;
    
    }
    public static function getEntità():string{
        return self::$entità;
    }
    /*
    public function getIdAttrezzaturaPadel(){
        return $this->id_attrezzaturaPadel;
    }
    public function setIdAttrezzaturaPadel($id_attrezzaturaPadel){

        $this->id_attrezzaturaPadel = $id_attrezzaturaPadel;
    }
   */
    public function getNumPalla_Padel(){
        return $this->numPalla_Padel;
    }
    public function setNumPalla_Padel($numpalle){
        $this->numPalla_Padel = $numpalle;
    }
    public function getNumRacchetta_Padel(){
        return $this->numRacchetta_Padel;
    }
    public function setNumRacchetta_Padel($numRacchetta){
        $this->numRacchetta_Padel = $numRacchetta;
    }
     //metodo toString esiste predefinito
}