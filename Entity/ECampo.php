<?php
class ECampo {
    private string $titoloCampo;
    private int $prezzo;
    protected String $id_campo = '';

    //protected string $id_imageCampo;

    private static $entità = ECampo::class;

    public function __construct($titoloCampo,$prezzo){
        $this->titoloCampo = $titoloCampo;
        $this->prezzo = $prezzo;
        //$this->id_imageCampo = $id_imageCampo;
    }
    //public function getCopertura(){
        //return $this->copertura;
    //}
    //public function setCopertura($coper){
        //$this->copertura = $coper;
    //}
    public static function getId_campo(){
        return self::$id_campo;
    }
    public function setId_campo($id){
        $this->id_campo = $id;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getTitolo(){
        return $this->titoloCampo;
    }
    public function setTitolo($titolo){
        $this->titoloCampo = $titolo;
    }
    public function getPrezzo(){
        return $this->prezzo;
    }
    public function setPrezzo($prezzo){
        $this->prezzo = $prezzo;
    }

    //public function getIdimageCampo(){
        //return $this->id_imageCampo;
    //}
     //metodo toString esiste predefinito
   
}