<?php
use Doctrine \ORM\Mapping as ORM;
require_once "EUtente";
class EAmministratore extends EUtente{
    private static string $entità = EAmministratore::class;
    
    public function __construct($name, $surname, $mail, $password, $id){
        parent::__construct($name,$surname ,$mail,$password,$id);
 }
    public static function getEntità():string {
        return self::$entità;
    }
 //metodo toString esiste predefinito
}