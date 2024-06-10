<?php 
use Doctrine \ORM\Mapping as ORM;
require_once "EUtente";

class EUtenteTesserato extends EUtente{
    protected bool $ban;

    private static $id_utenteTesserato;
    
    private static $entità = EUtenteTesserato::class;
    
    public function __construct($id_utenteTesserato, $nome, $cognome, $email, $password, $ban, $id_utente){
        parent::__construct($nome, $cognome, $email, $password, $id_utente);//parent::__construct è un modo per richiamare il costruttore di EUtente 
        // in modo che il costruttore di EUtenteRegistato ottenga come parametri i parametri del costruttore
        // di EUtente + $id_utenteTesserato e $ban 
        $this->id_utenteTesserato = $id_utenteTesserato;
        $this->ban = $ban;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdUtenteTesserato(){
        return $this->id_utenteTesserato;
    }
    public function setIdTUtenteTesserato($id_utenteTesserato){

        $this->id_utenteTesserato = $id_utenteTesserato;
    }
    public function isBanned(){
        return $this->ban;
    }
    public function setBan($boolean){
        $this->ban = $boolean;
    }
     //metodo toString esiste predefinito
}