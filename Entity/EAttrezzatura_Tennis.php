<?php 
class EAttrezzatura_Tennis extends EAttrezzatura{
    private int $numPalla_Tennis;
    private int $numRacchetta_Tennis;

    private static $entità = EAttrezzatura_Tennis::class;

    public function __construct($id_attrezzatura,$numPalla_Tennis,$numRacchetta_Tennis){
        $this->id_attrezzatura = $id_attrezzatura;
        $this->numPalla_Tennis = $numPalla_Tennis;
        $this->numRacchetta_Tennis = $numRacchetta_Tennis;
    }
    public static function getEntità():string {
        return self::$entità;
    }
    public function getNumPalla_Tennis(){
        return $this->numPalla_Tennis;
    }
    public function setNumPalla_Tennis($numpalle){
        $this->numPalla_Tennis = $numpalle;
    }
    public function getNumRacchetta_Tennis(){
        return $this->numRacchetta_Tennis;
    }
    public function setNumRacchetta_Tennis($numRacchetta){
        $this->numRacchetta_Tennis= $numRacchetta;
    }
    
}