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
        if(USession::isSetElementoSessione('utenteRegistrato')){// isSetElementoSessione('Utente') controlla se esiste un elemento chiamato 'Utente' nell'array superglobale $_SESSION ovvero nella sessione PHP corrente
            //se questo elemento esiste , significa che l'utente è loggato e $loggato viene impostato a true
            $loggato = true;
            self::Bannato();// se loggato = true attraverso questo metodo Bannato() vediamo se l'utente è stato bannato 

        }
        if(!$loggato){ // se l'utente non è ancora loggato , cioè $loggato = false
            header('Location: login');// attraverso questo metodo l'utente viene reindirizzato alla pagina di login 
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
        $utenteRegistrato = FPersistentManager::recuperaOggetto('EUtenteRegistrato', $IDUtente); // $Utenteregistrato punterà ad utente registrato , cioè è una variabile che contiene un utente , poichè recuperaOggetto recupera un oggetto fornendo la classe e l'ID dell'oggetto 
        if(FPersistentManager::isBanned($utenteRegistrato)){
            $view = new VUtente(); // se l'utente è bannato viene creato un oggetto VUtente e viene chiusa e distrutta la sessione perchè giustamente un utente bannato non può prenotare un campo 
            USession::annullaSessione();
            USession::distruggiSessione();
            $view->loginBan();
        }

    }
    /**
     * Metodo che permette all'utente di compilare una form per accedere al proprio account
     */
/* DA AGORA
    public static function login(){
        if(UCookie::cookieSettato('PHPSESSID')){// verifica se un cookie con chiave 'PHPSESSID' è presente nell'array $_COOKIE, cioè è stato settato
            if(session_status()==PHP_SESSION_NONE){//  se la sessione non è iniziata
                USession::getIstanza();//crea un'istanza della sessione

            }
        }
        if(USession ::isSetElementoSessione('utenteRegistrato')){//verifica se un elemento con chiave utenteRegistrato è stato inserito nell'array superglobale $_SESSION
            header('Location: home');// nel caso è presente nell'array , l'utente viene reindirizzato alla pagina home 
        }
        $view = new VUtente();// se l'elemento con chiave Utente è presente in $_SESSION , viene cretao un oggetto VUtente e viene mostrata una form per far si che l'utente faccia il login 
        $view->MostraLoginFormUtente();

    }
*/

    /**
     * Metodo che verifica se l'email e la password esistono se non esistono crea un utente con quelle credenziali.
     * @return void
     */

//DA DAIEG
    public static function login(){
        $view = new VUtente();
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $view->MostraLoginFormUtente();
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //USession::setElementoSessione('email', UMetodiHTTP::post('email'));
            //USession::setElementoSessione('password', UMetodiHTTP::post('password'));
            if(FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'))){
                $utente = FPersistentManager::recuperaUtenteDaEmail(UMetodiHTTP::post('email'));
                $idUtente = $utente->getId();
                $nomeUtente = $utente->getNome();
                USession::getIstanza()::setElementoSessione('utenteRegistrato', $idUtente);
            //echo $idUtente;
            //var_dump($_POST);
            //var_dump($_SESSION);
            //echo $utente->getPassword();
                static::VerificaLogin();
            }else{
                $view->erroreLogin();
            }
            //$view = new VUtente();
            //$view->home($nomeUtente);

        }
    }

/* DA AGORA   
    public static function registrazione(){
        $view = new VUtente();
        if(FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'))==false){// in questa riga di codice vengono verificate le credenziali
            // nell'if viene verificato se l'email non è gia utilizzata cioè è uguale a false , se non è stata utilizzata  viene creato un utente con tali credenziali 
            $utenteRegistrato = new EUtenteRegistrato(UMetodiHTTP::post('nome'),UMetodiHTTP::post('cognome'),UMetodiHTTP::post('email'),UMetodiHTTP::post('password')); // creazione utente con le credenziali fornite
            FPersistentManager::getIstanza()->uploadOgg($utenteRegistrato);// viene caricato l'utente nel db tramite uploadOgg
            $view->MostraLoginFormUtente();// metodo da implementare in VUtenteRegistrato , viene mostrato il login dopo la registarzione per far in modo che l'utente acceda con e credenziali appena registrate
        }else{
            $view->erroreRegistrazione();//metodo da implementare in VUtenteRegistrato . Se le credenziali esistono viene restituito un errore di registrazione 
        }
    }
*/
    
//DA DAIEG
    public static function registrazione(){
        $view = new VUtente();
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $view->MostraFormRegistrazione();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //var_dump($_POST);
            // Verifica se sono stati inviati tutti i campi necessari
            if (isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password'])) {
                if(FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'))==false){
                    // Recupera i dati inviati dal form
                    $nome = UMetodiHTTP::post('nome');
                    $cognome = UMetodiHTTP::post('cognome');
                    $email = UMetodiHTTP::post('email');
                    $password = UMetodiHTTP::post('password');
                
                    // Crea un oggetto EUtenteRegistrato con i dati recuperati
                    $utenteRegistrato = new EUtenteRegistrato($nome, $cognome, $email, $password);
        
                    // Carica l'oggetto utente nel database o in un'altra forma di persistenza
                    FPersistentManager::getIstanza()->uploadOgg($utenteRegistrato);
                    $view->MostraLoginFormUtente();
                }else{
                    $view->erroreRegistrazione();
                }
                // Mostra un messaggio di conferma o redireziona l'utente a una pagina successiva
                //echo "Utente registrato: " . $_POST['nome'];
            }else{
                // Gestisci caso in cui non sono stati inviati tutti i campi necessari
                echo "Errore: tutti i campi sono obbligatori.";
            }
        }
    }

    public static function logout(){
        USession::getIstanza();
        USession::annullaSessione();
        USession::distruggiSessione();
        header('Location: index');
    }
    public static function index(){
        $view = new VUtente();
        $view->index();
    }

/**
 * metodo che verifica se esiste l'email inserita  e per questa email verifica la password. Se tutto è corretto , viene creata la sessione e l'utente registrato
 * viene reindirizzato alla homepage
 */
    public static function VerificaLogin(){
        $view = new VUtente();
        $email = FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'));
        if($email){
            $utenteRegistrato = FPersistentManager::getIstanza()->recuperaUtenteDaEmail(UMetodiHTTP::post('email'));
            //questo if qui sotto controlla se la password di un utenteregistrato ottenuta da getpassword è uguale ad una password digitata dall'utente ed inviata tramite una richiesta HTTP POST al server 
            if(password_verify(UMetodiHTTP::post('password'),FPersistentManager::getPWutente($utenteRegistrato))){
                if(FPersistentManager::isBanned($utenteRegistrato)){// se le password sono uguali viene verificato se l'utente è bannato
                    $view->loginBan(); // forse questo metodo fa vedere una pagina che mi dice che io utente sono stato bannato
                }elseif(USession::getStatoSessione() == PHP_SESSION_ACTIVE){// altrimenti se la sessione non è iniziata 
                    //USession::getIstanza();// viene ridata un istanza sessione 
                    USession::setElementoSessione('utenteRegistrato',FPersistentManager::getId($utenteRegistrato));
                    $nomeUtente = FPersistentManager::getNome($utenteRegistrato);
                    //var_dump($_SESSION);
                    // e viene posto l'id dell'utente registrato , cioè l'id dell'utente di cui è stata verificata la password, viene posto nell'array superglobale $_SESSION
                    //la riga sopra serve per far si che il sistema può utilizzare questo ID per identificare l'utente nelle richieste future(le richieste future sono invio di moduli,logout ect..), cioè in ogni richiesta che l'utente fa (quando un utente interagisce con un applicazione web , ogni azione che richiede una comunicazione con il server genera una nuova richiesta HTTP) , mantenendo cosi lo stato di autenticazione.
                    //Mantenere lo stato di autenticazione è importante per assicurare che le operazioni siano eseguite nel contesto dell'utente corretto
                    header('Location: home');
                    //$view->home($nomeUtente);
                }
            }else {
                //header('Location: https://www.facebook.com/');
                $view->erroreLogin(); 
            }
        }else{
            header('Location: https://www.instagram.com/');
            //$view->erroreLogin();// se l'email non esiste viene dato un errore di login 
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
            header ('Location: home');

        }
     }

    public static function home(){
        //echo "Errore";
        if(CUtente::Loggato()){
            $view = new VUtente();
            $idUtente = USession::getIstanza()::getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::getIstanza()->recuperaoggetto(EUtenteRegistrato::getEntità(),$idUtente);
            $nomeUtente = FPersistentManager::getNome($utente);
            $view->home($nomeUtente);
        }
        else{
            header('Location: https://www.google.it/');
        }
        //var_dump($_SESSION['utenteRegistrato']);
    }

    public static function profilo(){
        if(CUtente::Loggato()){
            $view = new VUtente();
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::getIstanza()->recuperaoggetto(EUtenteRegistrato::getEntità(), $idUtente);
            $nomeUtente = $utente['nome'];
            $cognomeUtente = $utente['cognome'];
            $emailUtente = $utente['email'];
            $id_tesseraUtente = $utente['id_tessera'];
            $view->profilo($nomeUtente,$cognomeUtente,$emailUtente,$id_tesseraUtente);
        }
    }

    public static function prenotazioniUtente(){
        if(CUtente::Loggato()){
            $view = new VUtente();
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $listaPrenotazioni = FPersistentManager::getIstanza()->recuperaoggetti(FPrenotazione::getTabella(), 'id_utenteRegistrato', $idUtente);
            $view->prenotazioniUtente($listaPrenotazioni);
        }
    }
}