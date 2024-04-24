<?php 
use Doctrine \ORM\Mapping as ORM;
require_once "EUtente";
class EUtenteTesserato extends EUtente{
    protected bool $ban;
    
    private static $entità = EUtenteTesserato::class;
    
    public function __construct($name, $surname, $mail, $password, $id, $ban){
        parent::__construct($name,$surname,$mail,$password,$id);//parent::__construct è un modo per richiamare il costruttore di EUtente 
        // in modo che il costruttore di EUtenteRegistato ottenga come parametri i parametri del costruttore
        // di EUtente + $ban 
        $this->ban = $ban;
    }
    public static function getEntità():string{
        return self:: $entità;
    }
    public function isBanned(){
        return $this->ban;
    }
    public function setBan($boolean){
        $this->ban= $boolean;
    }
     //metodo toString esiste predefinito
}