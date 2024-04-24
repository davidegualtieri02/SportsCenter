<?php 
class EAttrezzatura_Padel extends EAttrezzatura{
    private int $numPalla_Padel;
    private int $numRacchetta_Padel;

    private static $entità = EAttrezzatura_Padel::class;

    public function __construct($id_attrezzatura,$numPalla_Padel,$numRacchetta_Padel){
        $this->id_attrezzatura = $id_attrezzatura;
        $this->numPalla_Padel = $numPalla_Padel;
        $this->numRacchetta_Padel = $numRacchetta_Padel;
    }
    public static function getEntità():string {
        return self::$entità;
    }
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
        $this->numRacchetta_Padel= $numRacchetta;
    }
    
}