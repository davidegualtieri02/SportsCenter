<?php
class ECampo {
    private string $TitoloCampo;
    private int $prezzo;
    protected String $copertura;
    protected int $id_campo;

    private static $entità = ECampo::class;

    public function __construct($copertura,$id_campo,$TitoloCampo,$prezzo){
        $this->copertura = $copertura;
        $this->id_campo = $id_campo;
        $this->TitoloCampo=$TitoloCampo;
        $this->prezzo = $prezzo;
    }
    public function getCopertura(){
        return $this->copertura;
    }
    public function setCopertura($coper){
        $this->copertura = $coper;
    }
    public static function  getId_campo(){
        return self::$id_campo;
    }
    public function setId_campo($id){
        $this->id_campo = $id;
    }
    public function getEntità():string{
        return self::$entità;
    }
    public function getTitolo(){
        return $this->TitoloCampo;
    }
    public function setTitolo($titolo){
        $this->TitoloCampo = $titolo;
    }
    public function getPrezzo(){
        return $this->TitoloCampo;
    }
    public function setPrezzo($titolo){
        $this->TitoloCampo = $titolo;
    }
     //metodo toString esiste predefinito
}