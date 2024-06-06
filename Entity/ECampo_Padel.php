<?php 
class ECampo_Padel extends ECampo{

    private static $entità = ECampo_Padel::class;
    public static function getEntità() :string {
        return self ::$entità;
    }
    public function __construct($copertura, $id_campo){
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
    }
    //metodo toString esiste predefinito
}