<?php
class ECampo_Tennis extends ECampo{
    private static $id_campoTennis;
    private String $terreno;

    private static $entità =ECampo_Tennis::class;
    private EImage $fotoCampo;
 
    public function __construct($id_campoTennis, $copertura, $id_campo, $terreno,$fotoCampo){
        $this->id_campoTennis = $id_campoTennis;
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->terreno = $terreno;
        $this->fotoCampo=$fotoCampo;

    }
    public static function getEntità():string{
    return self::$entità;
    }
    public static function getIdCampoTennis(){
        return self::$id_campoTennis;
    }
    public function setIdCampoTennis($id_campoTennis){

        $this->id_campoTennis = $id_campoTennis;
    }
    public function getTerreno(){
        return $this->terreno;
    }
    public function setTerreno($terreno){
        $this->terreno = $terreno ;
    }

      //metodo toString esiste predefinito   
}