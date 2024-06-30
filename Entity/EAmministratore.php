<?php

//use Doctrine \ORM\Mapping as ORM;

require_once "EUtente.php";
class EAmministratore extends EUtente{

    private static $id_amministratore;

    private static string $entità = EAmministratore::class;
    
    public function __construct($nome, $cognome, $email, $password){
        parent::__construct($nome, $cognome, $email, $password);

    }
    public static function getEntità():string{
        return self::$entità;
    }
    public function getIdAmministratore(){
        return $this->id_amministratore;
    }
    public function setIdAmministratore($id_amministratore){

        $this->id_amministratore = $id_amministratore;
    }
 //metodo toString esiste predefinito
}