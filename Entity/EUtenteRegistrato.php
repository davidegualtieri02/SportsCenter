<?php

require_once "EUtente.php";

class EUtenteRegistrato extends EUtente{
    protected bool $ban = false;

    protected int $id_utenteRegistrato;
    private static $entità = EUtenteRegistrato::class;
    public function __construct($nome, $cognome, $email, $password,$ban){
        parent::__construct($nome, $cognome, $email, $password);//parent::__construct è un modo per richiamare il costruttore di EUtente 
        // in modo che il costruttore di EUtenteRegistato ottenga come parametri i parametri del costruttore
        // di EUtente + $id_utenteRegistrato e $ban
        $this->ban = $ban;
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
     //metodo toString esiste predefinito
    

}