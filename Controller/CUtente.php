<?php
class CUtente {
    /**
     * Metodo che verifica se un utente è loggato (usando le sessioni)
     * @return boolean 
     */
    public static function Loggato(){
        $loggato = false;
        if(UCookie::cookieSettato('PHPSESSID')){ // vede se è presente un cookie nell'array superglobale $_COOKIE avente come chiave del cookie 'PHPSESSID'. 
            //PHPSESSID sarà la chiave dell'ID , cioè la chiave che punta all'ID della sessione. Quando un utente entra nel nostro sito web , php gestisce una sessione per lui , il valore dell'ID della sessione è memorizzato nel valore del cookie avente come chiave 'PHPSESSID'.
            //PHPSESSID è un nome convenzionale 
            if(session_status()==PHP_SESSION_NONE){ // il metodo sessio_status () controlla lo stato della sessione , se la sessione non è stata avviata , quindi è vero che session_status == PHP_SESSION_NONE
                USession::getIstanza();// questa riga di codice ,questo metodo crea la sessione
            }
        }
        if (USession::isSetElementoSessione('Utente')){// isSetElementoSessione('Utente') controlla se esiste un elemento chiamato 'Utente' nell'array superglobale $_SESSION ovvero nella sessione PHP corrente
            //se questo elemento esiste , significa che l'utente è loggato e $loggato viene impostato a true
            $loggato= true;
            self::Bannato();// se loggato = true attraverso questo metodo Bannato() vediamo se l'utente è stato bannato 
        }
        if(!$loggato){ // se l'utente non è ancora loggato , cioè $loggato = false
            header('Location : /SportsCenter/Utente/login');// attraverso questo metodo l'utente viene reindirizzato alla pagina di login 
            exit;// viene terminato l'esecuzione dello script per farsi che l'utente venga reindirizzato alla pagina di login
        }
        return true; // viene ritornato true se l'utente è loggato correttamente
    }

     /**
      * Metodo che verifica se l'utente è bannato
      */
    public static function Bannato()
    {
        $IDUtente = USession::getElementoSessione('Utente');//IDUtente assume come valore il valore della chiave Utente in $_SESSION , cioè assume come valore il valore dell'ID dell'utente
        $Utente = FPersistentManager::getIstanza()->recuperaOggetto(EUtente::getEntità(), $IDUtente); // $Utente punterà ad utente , cioè è una variabile che contiene un utente , poichè recuperaOggetto recupera un oggetto fornendo la classe e l'ID dell'oggetto 
        if($Utente->Bannato()){
            $view = new VUtente(); // se l'utente è bannato viene creato un oggetto VUtente e viene chiusa e distrutta la sessione perchè giustamente un utente bannato non può prenotare un campo 
            USession::annullaSessione();
            USession::distruggiSessione();
            $view->loginBan();
        }

    }
    /**
     * Metodo che permette all'utente di compilare una form per accedere al proprio account
     */
    public static function login(){
        if(UCookie::cookieSettato('PHPSESSID')){// verifica se un cookie con chiave 'PHPSESSID' è presente nell'array $_COOKIE, cioè è stato settato
            if(session_status()==PHP_SESSION_NONE){//  se la sessione non è iniziata
                USession::getIstanza();//crea un'istanza della sessione

            }
        }
        if(USession ::isSetElementoSessione('Utente')){//verifica se un elemento con chiave Utente è stato inserito nell'array superglobale $_SESSION
            header('Location : /SportsCenter/Utente/home');// nel caso è presente nell'array , l'utente viene reindirizzato alla pagina home 
        }
        $view = new VUtente();// se l'elemento con chiave Utente è presente in $_SESSION , viene cretao un oggetto VUtente e viene mostrata una form per far si che l'utente faccia il login 
        $view->mostraLoginform();

    }
    public static function registrazione(){
        $view = newVUtente();
        if(FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email')==false) && FPersistentManager::)


    }
}