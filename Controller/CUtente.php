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
        if (USession::isSetElementoSessione('utenteRegistrato')){// isSetElementoSessione('Utente') controlla se esiste un elemento chiamato 'Utente' nell'array superglobale $_SESSION ovvero nella sessione PHP corrente
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
        $IDUtente = USession::getElementoSessione('utenteRegistrato');//IDUtente assume come valore il valore della chiave Utente in $_SESSION , cioè assume come valore il valore dell'ID dell'utente
        $utenteRegistrato = FPersistentManager::getIstanza()->recuperaOggetto(EUtenteRegistrato::getEntità(), $IDUtente); // $Utenteregistrato punterà ad utente registrato , cioè è una variabile che contiene un utente , poichè recuperaOggetto recupera un oggetto fornendo la classe e l'ID dell'oggetto 
        if($utenteRegistrato->Bannato()){
            $view = new VUtenteRegistrato(); // se l'utente è bannato viene creato un oggetto VUtente e viene chiusa e distrutta la sessione perchè giustamente un utente bannato non può prenotare un campo 
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
        if(USession ::isSetElementoSessione('utenteRegistrato')){//verifica se un elemento con chiave utenteRegistrato è stato inserito nell'array superglobale $_SESSION
            header('Location : /SportsCenter/UtenteRegistrato/home');// nel caso è presente nell'array , l'utente viene reindirizzato alla pagina home 
        }
        $view = new VUtenteRegistrato();// se l'elemento con chiave Utente è presente in $_SESSION , viene cretao un oggetto VUtente e viene mostrata una form per far si che l'utente faccia il login 
        $view->mostraLoginForm();

    }
    /**
     * Metodo che verifica se l'email e la password esistono se non esistono crea un utente con quelle credenziali.
     * @return void
     */
    public static function registrazione(){
        $view = new VUtenteRegistrato();
        if(FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'))==false && FPersistentManager::getIstanza()->VerificaPasswordUtente(UMetodiHTTP::post('password'))==false){// in questa riga di codice vengono verificate le credenziali
            // nell'if viene verificato se l'email , la password non sono gia state utilizzate , cioè sono uguali a false , se non sono state utilizzate  viene creato un utente con tali credenziali 
            $utenteRegistrato = new EUtenteRegistrato(UMetodiHTTP::post('nome'),UMetodiHTTP::post('cognome'),UMetodiHTTP::post('password'),UMetodiHTTP::post('email'),UMetodiHTTP::post('ban')); // creazione utente con le credenziali fornite
            FPersistentManager::getIstanza()->uploadOgg($utenteRegistrato);// viene caricato l'utente nel db tramite uploadOgg
            $view->mostraLoginForm();// metodo da implementare in VUtenteRegistrato , viene mostrato il login dopo la registarzione per far in modo che l'utente acceda con e credenziali appena registrate
        }else{
            $view->erroreRegistrazione();//metodo da implementare in VUtenteRegistrato . Se le credenziali esistono viene restituito un errore di registrazione 
        }
     /**
     * Metodo per uscire dal profilo , viene reindirizzato l'utente alla pagina di login 
     */
    }
    public static function logout(){
        USession::getIstanza();
        USession::annullaSessione();
        USession::distruggiSessione();
        header('Location: /SportsCenter/Utente/login');
    }

/**
 * metodo che verifica se esiste l'email inserita  e per questa email verifica la password. Se tutto è corretto , viene creata la sessione e l'utente registrato
 * viene reindirizzato alla homepage
 */
    public static function VerificaLogin(){
        $view = new VUtenteRegistrato();
        $email = FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'));
        if($email){
            $utenteRegistrato = FPersistentManager::getIstanza()->recuperaUtenteDaEmail(UMetodiHTTP::post('email'));
            //questo if qui sotto controlla se la password di un utenteregistrato ottenuta da getpassword è uguale ad una password digitata dall'utente ed inviata tramite una richiesta HTTP POST al server 
            if(password_verify(UMetodiHTTP::post('password'),$utenteRegistrato->getPassword())){
                if($utenteRegistrato->isBanned()){// se le password sono uguali viene verificato se l'utente è bannato
                    $view->erroreLogin('bannato'); // forse questo metodo fa vedere una pagina che mi dice che io utente sono stato bannato
                }elseif(USession::getStatoSessione()==PHP_SESSION_NONE){// altrimenti se la sessione non è iniziata 
                    USession::getIstanza();// viene ridata un istanza sessione 
                    USession::setElementoSessione('utenteRegistrato',$utenteRegistrato->getIdUtenteRegistrato());// e viene posto l'id dell'utente registrato , cioè l'id dell'utente di cui è stata verificata la password, viene posto nell'array superglobale $_SESSION
                    //la riga sopra serve per far si che il sistema può utilizzare questo ID per identificare l'utente nelle richieste future(le richieste future sono invio di moduli,logout ect..), cioè in ogni richiesta che l'utente fa (quando un utente interagisce con un applicazione web , ogni azione che richiede una comunicazione con il server genera una nuova richiesta HTTP) , mantenendo cosi lo stato di autenticazione.
                    //Mantenere lo stato di autenticazione è importante per assicurare che le operazioni siano eseguite nel contesto dell'utente corretto
                    header ('Location : /SportsCenter/UtenteRegistrato/home');
                }
            }else {
                $view->erroreLogin('passworderrata');
            }
        }else{
            $view->erroreLogin('emailerrata');// se l'email non esiste viene dato un errore di login 
        }
    }
    /**
     * Metodo che fa compilare una form e aggiorna la password dell'utente
     */
    
     public static function setPassword(){
        if(CUtente::Loggato()){
            $utenteId = USession::getIstanza()->getElementoSessione('utenteRegistrato');//mi da l'id dell'utente autenticato dalla sessione, le cui informazioni sono memorizzate nella sessione
            $utente = FPersistentManager::getIstanza()->recuperaoggetto(EUtenteRegistrato::getEntità(),$utenteId);
            $NuovaPass = UMetodiHTTP::post('password'); // la nuova password viene posta come valore della chiave password nell'array $_POST
            $utente->setPassword($NuovaPass);
            FPersistentManager::getIstanza()->updatePasswordUtente($utente);
            header ('Location : /SportsCenter/UtenteRegistrato/home');

        }
     }
}