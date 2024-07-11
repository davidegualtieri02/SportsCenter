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
        $view->MostraLoginForm();
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
        $view = new VUtente();
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

    //primo metodo per la prenotazione di un campo 
    /**public static function mostraCampi(){
        if (CAmministratore::Loggato()){
            $view = new VCampi();
            $amministratore= USession::getElementoSessione('Amministratore');
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto        
            if(UServer::getRichiestaMetodo()=='GET'){
                $campi = $pm::RecuperaTuple(FCampo_Basket::getTabella());
                 $campi_pallavolo[] = $pm::RecuperaTuple(FCampo_Pallavolo::getTabella());
                $campi_calcio[] = $pm::RecuperaTuple(FCampo_Calcio::getTabella());
                $campi_tennis[] = $pm::RecuperaTuple(FCampo_Tennis::getTabella());
                 $campi_padel[] = $pm::RecuperaTuple(FCampo_Padel::getTabella());
            // Aggiunge tutti i campi contenuti negli array sopra  in un unico array campi
                 $campi = array_merge($campi_basket[], $campi_pallavolo[], $campi_calcio[], $campi_tennis[],$campi_padel[]);

            // quando aggiungiamo un campo , siccome fotocampo è un attributo del campo viene caricata e visualizzata anche l'immagine del campo insieme a tutto il campo
             // Passa i dati alla vista per la visualizzazione
                $view->MostraCampiAmm($campi,$amministratore);
            }    
        else{
            header("Location: SportsCenter/Amministratore/login");
            }

        }

   }
/** */

   //secondo metodo per prenotare un campo
   /**
     * Metodo che dopo aver cliccato sul campo da prenotare mostra le info del campo e il calendario
     */
      /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function SceltaAttrezzatura(){ //Con GET il server invia la form di prenotazione 
        if(CAmministratore::Loggato()){
            $view = new VAmministratore();
            $idAmm = USession::getIstanza()->getElementoSessione('amministratore');
            $amministratore = FPersistentManager::recuperaOggetto('EAmministratore',$idAmm);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeAmministratore=$amministratore->getNome();
            $giorno =  USession::getElementoSessione('data');
            $orario = USession::getElementoSessione('orario');
            if(UServer::getRichiestaMetodo() == "GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
                $view->MostraFormPrenotazioneAmm($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario,false); 
            }
             elseif(UServer::getRichiestaMetodo() == "POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
                $attrezzatura = UMetodiHTTP::post('attrezzatura'); //viene mandato al server l'id dell'attrezzatura che ha scelto l'utente
                $view->MostraFormPrenotazioneAmm($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario,$attrezzatura);
            }
        }
    }
    public static function ConfermaPrenotazioneAmm(){
        if(CAmministratore::Loggato()){
            $view = new VAmministratore();
            $idAmm = USession::getIstanza()->getElementoSessione('amministratore');
            $amministratore = FPersistentManager::recuperaOggetto('EAmministratore',$idAmm);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeAmministratore=$amministratore->getNome();
            $giorno =  USession::getElementoSessione('data');
            $orario = USession::getElementoSessione('orario');
            $attrezzatura = USession::getElementoSessione('attrezzatura');
            $view->ConfermaPrenotazioneAmm($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario,$attrezzatura);

        }
    }
    
    public static function SceltaGiorno(){
        if(CAmministratore::Loggato()){
            $view = new VAmministratore(); 
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idAmministratore = USession::getIstanza()->getElementoSessione('amministratore');
            $amministratore = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idAmministratore);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $imageCampo = FPersistentManager::recuperaOggetto('EImageCampo',$id_imageCampo);
            if(UServer::getRichiestaMetodo() == "GET"){
                $nomeAmministratore = $amministratore->getNome();
                $view->MostraGiorno($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo);
            }
        }
    }

    public static function SceltaOrari(){
        if(CAmministratore::Loggato()){
            $view = new VAmministratore(); 
            $idAmministratore= USession::getIstanza()->getElementoSessione('amministratore');
            $amministratore = FPersistentManager::recuperaOggetto('EAmministratore',$idAmministratore);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeAmministratore =$amministratore->getNome();
            if(UServer::getRichiestaMetodo() == "POST"){
                $giornoStr = UMetodiHTTP::post('data');
                $giorno = new DateTime($giornoStr);
                $view->MostraOra($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno);
            }
        }
    }

}





