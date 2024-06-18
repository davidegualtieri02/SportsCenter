<?php
require_once(__DIR__ . '/../../../../config/config.php');
/**
 * Classe per accedere all'array superglobale $_SESSION. 
 * $_SESSION contiene per esempio i dati dell'utente , il suo id , nome e cognome , la lingua per esempio in cui l'utente vuole visionare le pagine ect. Cioè $_SESSION contiene i dati della sessione per l'utente corrente .
 */

 class USession{
   /**
    * singleton class
    * Classe per le sessioni, se vogliamo manipolare l'array superglobale $_SESSION dobbiamo usare questa classe 
    */

    private static $istanza;

    private function __construct(){
        session_set_cookie_params(TEMPO_COOKIE); // Questo metodo imposta i parametri del cookie di sessione. 
        session_start(); //avvia la sessione
    }
    public static function getIstanza(){
        if(self::$istanza ==null){
            self::$istanza = new USession(); // se $istanza = null , poniamo $istanza uguale a new Usession , cioè $istanza sarà un oggetto Sessione.
        }
        return self::$istanza;
    }

    /**
     * Il metodo ritorna lo stato della sessione . Se si vuole verificare che la sessione è iniziata , possiamo usare questo metodo .
     */
    public static function getStatoSessione(){
        return session_status(); // metodo di php che mi da lo stato di una sessione.
    }
    
    /**
     * metodo che elimina tutti gli elementi nell'array superglobale $_SESSION
     */
    public static function annullaSessione(){
        session_unset();

    }
    /**
     * metodo che elimina un elemento solo dell'array $_SESSION
     */
    public static function eliminaElementoSessione($id){ 
        unset($_SESSION[$id]); //elimina il valore dell'elemento associato a tale id(chiave) nell'array superglobale $_SESSION . Cioè viene eliminato l'elemento avente $id come chiave 
    }

    /**
     * metodo che distrugge la sessione
     */
    public static function distruggiSessione(){
        session_destroy();
    }
    /**
     * metodo che restituisce un elemento dell'array $_SESSION
     */
    public static function getElementoSessione($id){
        return $_SESSION [$id]; // mi rida il valore dell'elemento associato alla chiave $id nell'array superglobale .
    }
    
    /**
     * metodo che setta un elemento in $_SESSION 
     */
    public static function setElementoSessione($id,$valore){
        $_SESSION[$id] = $valore; // aggiungo in $_SESSION un elemento che ha come chiave $id e come valore il valore contenuto in $valore
    }

    /**
     * metodo che verifica se un elemento è stato aggiunto in $_SESSION oppure no 
     * @return bool
     */
    public static function isSetElementoSessione($id){
        if(isset($_SESSION[$id])){ // il metodo isset() verifica se $_SESSION[$id] non è null cioè se è presente nell'array superglobale , ovvero è stato aggiunto in $_SESSION correttamente 
            return true;// se tale elemento $_SESSION[$id] è presente nell'array allora il metodo ritorna true 
        }else{
            return false;//altrienti false
        }
    }

 }