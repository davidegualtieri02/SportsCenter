<?php

require_once "EUtente.php";

class EUtenteRegistrato extends EUtente{
    private static $entità = EUtenteRegistrato::class;
    public function __construct($nome, $cognome, $email, $password){
        parent::__construct($nome, $cognome, $email, $password);//parent::__construct è un modo per richiamare il costruttore di EUtente 
        // in modo che il costruttore di EUtenteRegistato ottenga come parametri i parametri del costruttore
        // di EUtente + $id_utenteRegistrato e $ban
    }
    public static function getEntità():string{
        return self::$entità;
    }
   // public function getIdUtenteRegistrato(){
     //   return $this->id_utenteRegistrato;
   // }
   // public function setIdTUtenteRegistrato($id_utenteRegistrato){

      //  $this->id_utenteRegistrato = $id_utenteRegistrato;
    //}
    public function isBanned(){
        return $this->ban;
    }
    public function setBan($boolean){
        $this->ban = $boolean;
    }
    public function getid_tessera(){
        return $this->id_tessera;
    }
    public function getTabella(){
        return "UtenteRegistrato";
    }
    //metodo toString esiste predefinito
}