<?php
//use DateTime; //??
require_once("EUtenteRegistrato.php");
class ERecensione{
    private int $id_recensione = 0;
    private int $valutazione;
    private string $commento;
    private int $id_campo;
    protected EUtenteRegistrato $utenteRegistrato;
    private DateTime $data; //DateTime o String??
    private $removed = false;
    private array $images;
    
    private static $entità = ERecensione::class;

    public function __construct($valutazione,$commento,$id_campo, EUtenteRegistrato $utenteRegistrato,$data){
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->id_campo = $id_campo;
        $this->id_utenteRegistrato = $utenteRegistrato->getId();
        $this->data = $data;
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
    public function getTime(){
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
    public function getUtente(){
        return $this->utenteRegistrato;
    }
    public function setUtente(EUtenteRegistrato $utenteRegistrato): void{
        $this->utenteRegistrato = $utenteRegistrato;
    }
    public function getIdCampo(){
        return $this->id_campo;
    }
    public function getIdUtente(){
        return $this->utenteRegistrato->getId();
    }
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
     //metodo toString esiste predefinito
}