<?php
class ECampo_Calcio {
    private static $entità =ECampo_Calcio::class;

    public static function getEntità() :string {
    return self :: $entità;
    }  
    public function __construct($copertura,$id_campo) {
        $this->copertura =$copertura;
        $this->id_campo = $id_campo;
    }
    public static getEntità():string{
        
    }
}