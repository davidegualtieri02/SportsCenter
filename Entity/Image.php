<?php
class Image {
    private  int $larghezza;
    private int $lunghezza;
    private static $entità = Image::class;

    public function __construct($larghezza,$lunghezza){
        $this->larghezza = $larghezza;
        $this->lunghezza = $lunghezza;
    }
    public function getlarghezza(){
        return $this->larghezza;
    }
    public function setlarghezza($larghezza){
        $this->larghezza = $larghezza;
    }
    public function getlunghezza(){
        return $this->lunghezza;
    }
    public function setlunghezza($lunghezza){
        $this->lunghezza = $lunghezza;
    }
    
 //metodo toString esiste predefinito
}