<?php
class ERecensione{
    private int $valutazione;
    private string $commento;
    private $image;
    private int $idRecensione;
    private static $entità = ERecensione::class;

    public function __construct($valutazione,$commento,$image,$idRecensione){
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->image=$image;
        $this->id_recensione = $idRecensione;
    }
    public function getValutazione(){
        return $this->valutazione;
    }
    public function setValutazione($valutazione){
        $this->valutazione = $valutazione;
    }
    public function getCommento(){
        return $this->commento;
    }
    public function setCommento($commento){
        $this->commento = $commento;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->foto = $image;
    }
    public static function getEntità(){
        return self::$entità;
    }
     //metodo toString esiste predefinito
}