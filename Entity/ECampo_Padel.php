<?php 
require_once "ECampo.php";
class ECampo_Padel extends ECampo{
    private static $id_campoPadel;
    private static $entità = ECampo_Padel::class;
    private EImage $fotoCampo;
    public static function getEntità():string{
        return self ::$entità;
    }
    public function __construct($copertura,$TitoloCampo, $prezzo,$fotoCampo){ 
        parent::__construct($copertura, $TitoloCampo, $prezzo);
        $this->fotoCampo=$fotoCampo;
    }
    
    public static function getIdCampoPadel(){
        return self::$id_campoPadel;
    }
    public function setIdCampoPadel($id_campoPadel){

        $this->id_campoPadel = $id_campoPadel;
    }
    //metodo toString esiste predefinito
}