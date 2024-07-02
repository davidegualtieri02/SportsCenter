<?php

class EUtente{
    
    protected String $nome;
    protected String $cognome;
    protected String $email;
    protected String $password;
    protected int $id_utenteRegistrato = 0;
    protected int $id_tessera = 0;
    protected bool $ban = false;

    private static $entità = EUtente::class;//Quando usi EPerson::class in PHP, ottieni il nome completamente qualificato della classe EPerson. 
    //Quindi, se EPerson è definita nel namespace App\Entities,
    // EPerson::class restituirà la stringa 'App\Entities\EPerson'.
  //Questo è particolarmente utile quando si lavora con i namespaces, perché ti permette di riferirti alle classi
    // in modo sicuro e coerente, senza dover preoccuparti di conflitti di nomi o di dover ricordare il namespace esatto in cui una classe è definita.
    //namespace  è un modo per incapsulare gli elementi di un codice ,namespace è tipo un contenitore che contiene le classi , si comporta come un directory 
    // con i files 
    public function __construct($nome, $cognome, $email, $password){
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);//password_hash crea un hash di una password,$password è la password che vogliamo hashare
        // PASSWORD_DEFAULT :Questo è un algoritmo di hashing predefinito che PHP userà per creare l’hash della password. 
        //$hashpassword = password_hash(..) ect..la riga crea un has e assegna alla variabile $hashpassword , l'hash stesso.
        //L’hashing delle password è una pratica di sicurezza importante. Quando memorizzi le password come hash,
        // anche se qualcuno dovesse ottenere accesso al tuo database, non sarebbe in grado di leggere le password degli utenti.
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this ->email = $email;
        $this->password = $hashPassword; 
        
    }
    public static function getEntità():string{// static indica che il metodo è statico
        //cioè non appartiene ad un oggetto della classe ma alla classe stessa 
        return self::$entità;// questo return fa assumere ad $entità il valore di una stringa 
        // che è il nome della classe stessa. self specifica che si sta parlando della classe stessa che stiamo creando cioè EUtente
    }

    
    public function getId(){
        return $this->id_utenteRegistrato;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getCognome(){
        return $this->cognome;

    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setId($id_utenteRegistrato){
        $this->id_utenteRegistrato = $id_utenteRegistrato;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setCognome($cognome){
        $this->cognome = $cognome;
    }
    public function setPassword($password){
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $this->password = $hashPassword;
    }
    public function setHashPassword($hashPassword){
        $this->password = $hashPassword;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    //metodo toString esiste predefinito
}