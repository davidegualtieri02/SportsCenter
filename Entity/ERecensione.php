<?php
class ERecensione{
    private int $valutazione;
    private string $commento;
    private Image $foto;
    private int $id_recensione;
    private static $entità = ERecensione::class;

    public function __construct($valutazione,$commento,$foto,$id_recensione){
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->foto=$foto;
        $this->id_recensione = $id_recensione;
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
    public function getFoto(){
        return $this->foto;
    }
    public function setFoto($foto){
        $this->foto = $foto;
    }
    public static function getEntità(){
        return self::$entità;
    }
     //metodo toString esiste predefinito
}