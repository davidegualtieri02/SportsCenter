<?php
class ECampo_Tennis extends ECampo{
    private String $terreno;

    private static $entità =ECampo_Tennis::class;
 
    public function __construct($copertura,$id_campo,$terreno){
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->terreno = $terreno;
    }
    public function getTerreno(){
        return $this->terreno;
    }
    public function setTerreno($terreno){
        $this->terreno = $terreno ;
    }
    public static function getEntità() :string {
        return self ::$entità;
        }
}