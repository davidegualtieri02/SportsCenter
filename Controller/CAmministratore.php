<?php

class CAmministratore{

    /**
     * Metodo che verifica se un utente è loggato (usando le sessioni)
     * @return boolean 
     */
    public static function Loggato(){
        $loggato = false;
        if(UCookie::cookieSettato('PHPSESSID')){
            if(session_status()==PHP_SESSION_NONE){
                USession::getIstanza();
            }
        }
        if (USession::isSetElementoSessione('Amministratore')){
            $loggato= true;
        }
        if(!$loggato){
            header('Location: /SportsCenter/Amministratore/login');
            exit;
        }
        return true;
    }
    /**
     * Metodo che consente all'amministratore di autenticarsi
     */
    public static function login(){
        if(UCookie::cookieSettato('PHPSESSID')){
            if(session_status()==PHP_SESSION_NONE){
                USession::getIstanza();
            }
        }
        if(USession ::isSetElementoSessione('Amministratore')){
            header('Location : /SportsCenter/Amministratore/home');
        }
        $view = new VAmministratore();
        $view->mostraLoginForm();
    }

    /**
     * Metodo che consente di uscire dal profilo
     * @return void
     */
    public static function logout(){
        USession::getIstanza();
        USession::annullaSessione();
        USession::distruggiSessione();
        header('Location: /SportsCenter/Amministratore/login');
    }
    /**
     * metodo che verifica se esiste l'email inserita e per questa email verifica la password. Se tutto è corretto , viene creata la sessione e l'amministratore
     * viene reindirizzato alla homepage
     */
    public static function VerificaLogin(){
        $view = new VAmministratore();
        $email = FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'));
        if($email){
            $utente = FPersistentManager::getIstanza()->recuperaAmmDaEmail(UMetodiHTTP::post('email'));
            //questo if qui sotto controlla se la password di un utenteregistrato ottenuta da getpassword è uguale ad una password digitata dall'utente ed inviata tramite una richiesta HTTP POST al server 
            if(password_verify(UMetodiHTTP::post('password'),$utente->getPassword())){
                if(USession::getStatoSessione()==PHP_SESSION_NONE){// altrimenti se la sessione non è iniziata 
                    USession::getIstanza();// viene ridata un istanza sessione 
                    USession::setElementoSessione('Amministratore',$utente->getIdAmministratore());// e viene posto l'id dell'utente registrato , cioè l'id dell'utente di cui è stata verificata la password, viene posto nell'array superglobale $_SESSION
                    //la riga sopra serve per far si che il sistema può utilizzare questo ID per identificare l'utente nelle richieste future(le richieste future sono invio di moduli,logout ect..), cioè in ogni richiesta che l'utente fa (quando un utente interagisce con un applicazione web , ogni azione che richiede una comunicazione con il server genera una nuova richiesta HTTP) , mantenendo cosi lo stato di autenticazione.
                    //Mantenere lo stato di autenticazione è importante per assicurare che le operazioni siano eseguite nel contesto dell'utente corretto
                    header ('Location : /SportsCenter/Amministratore/home');
                }
            }else {
                $view->erroreLogin();
            }
        }else{
            $view->erroreLogin();// se l'email non esiste viene dato un errore di login 
        }
    }

    /**
     * Metodo che permette all'amministratore di bannare un utente
     * @param $idUtente si riferisce all'id dell'utente da bannare
     */
    public static function banUtente($idUtente){
        if(CAmministratore::Loggato()){
            $utente = FPersistentManager::getIstanza()->recuperaOggetto(EUtente::getEntità(),$idUtente);
            if($utente !== null){
                $utente->setBan(true);
                FPersistentManager::getIstanza()->updateBanUtente($utente);
                header('Location : /SportsCenter/Amministratore/home');
            }
        }
    }
    
    /**
     * Questo metodo invia un email di spiegazione per il ban ricevuto da un utente
     * @param $ragione è il ban  dell'utente, la ragione è il ban e $ogg  è un oggetto EUtenteRegistrato
     */
    public static function EmailBan($ogg,$ragione){
        $intestazione = "From: noreply@Sportscenter.com";//$intestazione è un 'intestazione specifica del protocollo SMTP che si occupa di inviare email e mi sta dicendo da chi viene inviata l'email cioè da noreply@SportsCenter.com
        if($ragione == "ban"){
            $a= $ogg->getEmail();
            $oggetto = "Bannato da SportsCenter";
            $messaggio = " Tu".$ogg->getNome().$ogg->getCognome(). "sei stato bannato permanentemente dal sito SportsCenter , perchè stai violando le nostre linee guida come:Violenza e contenuti offensivi";
        }
        mail($a,$oggetto,$messaggio,$intestazione);//metodo di php che invia un email
    }

     /**
     * Metodo per confermare la prenotazione
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function MostraConfermaPrenotazioneAmm(){
        $sessione = USession::getIstanza();
        $pm = FPersistentManager::getIstanza();
        $view = new VPrenotaCampo();
        $campo = $_POST['campo'];
        $data = $_POST['data'];
        $orario = $_POST ['orario'];
        $attrezzatura = $_POST['id_attrezzatura'];
        if(UServer::getRichiestaMetodo()=="GET"){
            if(CAmministratore::Loggato()){
                $amm = unserialize($sessione->LeggiValore('Amministratore'));
                $view ->MostraForm($amm,$campo,$data,$orario,$attrezzatura);
            }
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){
            $amministratore = unserialize($sessione->LeggiValore('Utente'));
            $prenotazione = new EPrenotazione($data,$orario,true,$campo->getId_campo(),$attrezzatura);
            $pm::uploadOgg($prenotazione);
            $view->ConfermaPrenotazioneAmministratore($amministratore);


        }

    }
    /**
     * Metodo per annullare una prenotazione
     * @param $idPrenotazione è l'id della prenotazione che l'utente vuole annullare
     */
    public static function annullaPrenotazioneAmm($idPrenotazione) {
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        if (UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            if (CAmministratore::Loggato()) { // Verifica se l'utente è loggato
                $amministratore = unserialize($sessione->LeggiValore('utente'));
                $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
                // Richiama il metodo isUserBookingOwner dalla classe CBooking
                if ($pm::VerificaUtenteprenotazione($pdo, $idPrenotazione, $amministratore->getId())) {
                    FPersistentManager::deleteOgg('Prenotazione',$idPrenotazione,'id_prenotazione');
                    $view->MostraMessaggioConferma("Prenotazione annullata con successo!");
                }
            } else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }

}




