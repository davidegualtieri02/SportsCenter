<?php
class ERecensione{
    private int $idRecensione;
    private string $commento;
    private int $valutazione;
    private DateTime $DataOra;
    private $removed = false;
    protected EUtente $utente;
    private $images;
    private static $entità = ERecensione::class;

    public function __construct($valutazione,$commento){
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->setTime();
        $this->images= [];
    }

    public static function getEntità(): string{
        return self::$entità;
    }

    public function getId(){
        return $this->idRecensione;
    }

    public function setId($id){
        $this->idPost = $id;
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
        return $this->DataOra;
    }

    public function setTime(){
        $this->DataOra = new DateTime("now");
    }

    public function getTimeStr(){
        return $this->DataOra->format('D-m-y H:i:s');
    }

    public function setDataOra($DataOra){
        $this->DataOra = $DataOra;
    }

    public function isBanned(): bool{
        return $this->removed;
    }

    public function setBan(bool $removed): void{
        $this->removed = $removed;
    }

    public function getUtente(){
        return $this->utente;
    }

    public function setUtente(EUtente $utente): void{
        $this->utente = $utente;
    }

    public function getImages(){
        return $this->images;
    }
    public function setImage($image){
        $this->foto = $image;
    }

    public function addImage(EImage $image): void{
        $idImg = $image->getId();

        //Ora controllo se l'immagine è già presente nell'array tramite il suo ID
        $imageExists = false;
        foreach($this->images as $existingImage){
            if ($existingImage->getId() === $idImg){
                $imageExists = true;
                break; //interrompi l'esecuzione del ciclo se viene trovato un ID corrispondente
            }
        }

        //Se l'immagine non esiste nell'array, aggiungila
        if (!$imageExists){
            $this->images[] = $image;
            $image->setRecensione($this);
        }
    }
     //metodo toString esiste predefinito
}