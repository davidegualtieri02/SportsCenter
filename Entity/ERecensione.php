<?php

//require_once("EUtenteRegistrato.php");
class ERecensione{
    private int $id_recensione = 0;
    private string $commento;
    private string $id_campo;
    protected int $id_utenteRegistrato;
    private string $data; 
    //private bool $removed = false;
    private int $id_image;
    
    private static $entità = ERecensione::class;

    public function __construct($commento,$data,$id_utenteRegistrato,$id_campo,$id_image){
        $this->commento = $commento;
        $this->id_campo = $id_campo;
        $this->id_utenteRegistrato = $id_utenteRegistrato;
        $this->data = $data;
        $this->id_image = $id_image;
    }

    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdRecensione(){
        return $this->id_recensione;
    }
    public function setIdRecensione($id_recensione){
        $this->id_recensione = $id_recensione;
    }
    public function getCommento(){
        return $this->commento;
    }
    public function setCommento($commento){
        $this->commento = $commento;
    }
    public function getData(){
        return $this->data;
    }
    public function setTime(){
        $this->data = new DateTime("now");
    }
    public function getTimeStr(){
        return $this->data->format('D-m-y');
    }
    public function setdata($data){
        $this->data = $data;
    }
    public function isBanned():bool{
        return $this->removed;
    }
    public function setBan(bool $removed):void{
        $this->removed = $removed;
    }
    public function getIdUtente(){
        return $this->id_utenteRegistrato;
    }
    public function setUtente(EUtenteRegistrato $utenteRegistrato): void{
        $this->utenteRegistrato = $utenteRegistrato;
    }
    public function getIdCampo(){
        return $this->id_campo;
    }
    //public function getIdUtente(){
       //return $this->utenteRegistrato->getId();
    //}
    public function setImages($images){
        $this->images= $images;
    }

   /**
    * Metodo che aggiunge una o più immagini ad una recensione non permettendo l'inserimento di una stessa immagine
    *@param $image è l'immagine da aggiungere
    */
    public function addImage(EImage $image): void {
        $idImg = $image->getId();

        // Ora controllo se l'immagine è già presente nell'array tramite il suo ID
        $imageExists = false;
        foreach ($this->images as $existingImage) {
            if ($existingImage->getId() === $idImg) {
                $imageExists = true;
                break; // interrompi l'esecuzione del ciclo se viene trovato un ID corrispondente
            }
        }

        // Se l'immagine non esiste nell'array, aggiungila
        if (!$imageExists) {
            $this->images[] = $image;
            $image->setRecensione($this);
        }
    }
    public function getIdImage(){
        return $this->id_image;
    }
     //metodo toString esiste predefinito
}