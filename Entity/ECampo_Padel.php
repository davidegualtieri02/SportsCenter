<?php 
require_once "ECampo.php";
class ECampo_Padel extends ECampo{
    private static $id_campoPadel;
    private static $entità = ECampo_Padel::class;
    private EImage $fotoCampo;
    public static function getEntità():string{
        return self ::$entità;
    }
    public function __construct($id_campoPadel, $copertura, $id_campo,$fotoCampo){
        $this->id_campoPadel = $id_campoPadel;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
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