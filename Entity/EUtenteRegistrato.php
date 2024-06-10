<?php
use Doctrine\ORM\Mapping as ORM;
require_once "EUtente";

class EUtenteRegistrato extends EUtente{
    protected bool $ban;

    private static $id_utenteRegistrato;

    private static $entità = EUtente::class;

    public function __construct($id_utenteRegistrato, $nome, $cognome, $email, $password, $ban, $id_utente){
        parent::__construct($nome, $cognome, $email, $password, $id_utente);//parent::__construct è un modo per richiamare il costruttore di EUtente 
        // in modo che il costruttore di EUtenteRegistato ottenga come parametri i parametri del costruttore
        // di EUtente + $id_utenteRegistrato e $ban
        $this->id_utenteRegistrato = $id_utenteRegistrato;
        $this->ban = $ban;
    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdUtenteRegistrato(){
        return $this->id_utenteRegistrato;
    }
    public function setIdTUtenteRegistrato($id_utenteRegistrato){

        $this->id_utenteRegistrato = $id_utenteRegistrato;
    }
    public function isBanned(){
        return $this->ban;
    }
    public function setBan($boolean){
        $this->ban = $boolean;
    }
     //metodo toString esiste predefinito
    

}