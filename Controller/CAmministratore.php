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

    //primo metodo per la prenotazione di un campo 
    public static function mostraCampi(){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VCampi();
        if (CAmministratore::Loggato()){
            $amministratore= unserialize($sessione->LeggiValore('Amministratore'));
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto        
            if(UServer::getRichiestaMetodo()=='GET'){
                $campi_basket[] = $pm::RecuperaTuple(FCampo_Basket::getTabella());
                 $campi_pallavolo[] = $pm::RecuperaTuple(FCampo_Pallavolo::getTabella());
                $campi_calcio[] = $pm::RecuperaTuple(FCampo_Calcio::getTabella());
                $campi_tennis[] = $pm::RecuperaTuple(FCampo_Tennis::getTabella());
                 $campi_padel[] = $pm::RecuperaTuple(FCampo_Padel::getTabella());
            // Aggiunge tutti i campi contenuti negli array sopra  in un unico array campi
                 $campi = array_merge($campi_basket[], $campi_pallavolo[], $campi_calcio[], $campi_tennis[],$campi_padel[]);

            // quando aggiungiamo un campo , siccome fotocampo è un attributo del campo viene caricata e visualizzata anche l'immagine del campo insieme a tutto il campo
             // Passa i dati alla vista per la visualizzazione
                $view->mostraCampi($campi,$amministratore);
            }    
        else{
            header("Location: SportsCenter/Amministratore/login");
            }

        }
   }

   //secondo metodo per prenotare un campo
   /**
     * Metodo che dopo aver cliccato sul campo da prenotare mostra le info del campo e il calendario
     */
    public static function MostraCalendario($idCampo){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
        if(UServer::getRichiestaMetodo()=="GET"){
            if(CAmministratore::Loggato()){
                $amministratore = unserialize($sessione->LeggiValore('Amministratore'));
                $view->mostraCalendario($amministratore,$campo);
            }
         }
    }
    //terzo passaggio per la prenotazione di un campo
     /**
     * Metodo che mostrerà una volta che l'utente fornisce la data gli orari disponibili per quel campo e quel giorno
     */
    public static function MostraOrari($giorno){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        if(UServer::getRichiestaMetodo()=="POST"){
            $campo  = $sessione::getElementoSessione('campo');// la sessione mantiene il campo scelto in sessione e viene ripreso
            $amministratore = unserialize($sessione->LeggiValore('Amministratore'));
            $giornoStr = UMetodiHTTP::post('data');
            $giorno = new DateTime($giornoStr);
            $view->mostraOrari($amministratore,$giorno,$campo);
        }
    }

    //quarto passaggio per la prenotazione di un campo
    /**
     * Metodo che mostra l'array di orari disponibili per la prenotazione di quel campo in quel giorno 
     * e fa scegliere all'utente uno di questi orari per prenotare il campo
     */
    public static function MostraAttrezzatura($orario){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        if(UServer::getRichiestaMetodo()=='GET'){
            $amministratore = unserialize($sessione->LeggiValore('Utente'));
            $campo = $sessione::getElementoSessione('campo');//riprendo dalla sessione la data e il campo
            $giorno = $sessione::getElementoSessione('data');
            $orari = FPersistentManager::orariDisponibili($giorno);
            $view->MostraOrari($orari);
         }
        elseif(UServer::getRichiestaMetodo()=='POST'){
            $amministratore = unserialize($sessione->LeggiValore('Utente'));
            $campo = $sessione::getElementoSessione('campo');//riprendo dalla sessione la data e il campo
            $giorno = $sessione::getElementoSessione('data');
            $orario = UMetodiHTTP::post('orario') ;//viene scelto un orario tra quelli disponibili

            $view->MostraPagAttrezatura($orario,$amministratore,$giorno,$campo);
        }
    }
   


    //quinto passaggio
     /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function ScegliAttrezzatura($idAttrezzatura){ //Con GET il server invia la form di prenotazione 
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza(); // otteniamo un'istanza della sessione utente  
        //prendendo un oggetto attrezzatura viene preso un kit standard di attrezzatura per esempio un attrezzatura calcio fa prendere 5 casacche e 2 palloni , il num casacca e il num palloni sono contentuti nella tupla dell'attrezzatura
        //nel db
        $attrezzatura = $pm::recuperaOggetto('FAttrezzatura',$idAttrezzatura);// recuperiamo l'oggetto campo sportivo nel db
        //if($attrezzatura == FAttrezzatura_Basket::getOgg($idAttrezzatura))
        $view = new VPrenotaCampo();//creiamo un'istanza della view per la prenotazione del campo
        if(UServer::getRichiestaMetodo()=="GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
            if(CAmministratore::Loggato()){
                $amministratore = unserialize($sessione->LeggiValore('Amministratore'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente 
                $campo = $sessione::getElementoSessione('campo');
                $data = $sessione::getElementoSessione('data');
                $orario = $sessione::getElementoSessione('orario');
                $idcampo = $campo->getId();
                $titolocampo = $campo->getTitolo();
                if(($titolocampo = "Campo Basket 1") || ($titolocampo = "Campo Basket 2")){
                    $view->MostraFormAttrezzaturaBasket($amministratore,$idcampo,$attrezzatura,$titolocampo); //viene mostrata la form per la prenotazione
                }
                if(($titolocampo = "Campo Calcio 1") || ($titolocampo = "Campo Calcio 2")){
                    $view->MostraFormAttrezzaturaCalcio($amministratore,$idcampo,$attrezzatura,$titolocampo);
                }
                if(($titolocampo = "Campo Padel 1") ||($titolocampo = " Campo Padel 2")){
                    $view->MostraFormAttrezzaturaPadel($amministratore,$idcampo,$attrezzatura,$titolocampo);
                }
                if(($titolocampo = "Campo Pallavolo 1") ||($titolocampo = " Campo Pallavolo 2")){
                    $view->MostraFormAttrezzaturaPallavolo($amministratore,$idcampo,$attrezzatura,$titolocampo);
                }
                if(($titolocampo = "Campo Tennis 1") || ($titolocampo= " Campo Tennis 2")){
                    $view->MostraFormAttrezzaturaTennis($amministratore,$idcampo,$attrezzatura,$titolocampo);
                }
               
            }else{// se l'utente non è loggato viene reindirizzato alla pagina di login 
                header('Location: /SportsCenter/Amministratore/login');
                exit;//fa in modo che il codice dopo non viene eseguito se l'utente non è loggato.
            }    
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
            $amministratore= unserialize($sessione->LeggiValore('Amministratore'));
            $campo = $sessione::getElementoSessione('campo');
            $data = $sessione::getElementoSessione('data');
            $orario = $sessione::getElementoSessione('orario');
            $idAttrezzatura = UMetodiHTTP::post('id_attrezzatura'); //viene mandato al server l'id dell'attrezzatura che ha scelto l'utente
            $view->MostraFormPagamento($amministratore,$idAttrezzatura,$campo,$data,$orario);
    
        }
    }
    //ultimo metodo prenotazione
    /**
     * Metodo per confermare la prenotazione
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function MostraConfermaPrenotazioneAmm(){
        $sessione = USession::getIstanza();
        $pm = FPersistentManager::getIstanza();
        $view = new VPrenotaCampo();
        if(UServer::getRichiestaMetodo()=="GET"){
            if(CAmministratore::Loggato()){
                $amm = unserialize($sessione->LeggiValore('Amministratore'));
                $campo = $sessione::getElementoSessione('campo');
                $data = $sessione::getElementoSessione('data');
                $orario = $sessione::getElementoSessione('orario');
                $attrezzatura = $sessione::getElementoSessione('id_attrezzatura');
                $view->MostraFormPrenotazioneAmm($amm,$campo,$data,$orario,$attrezzatura);
            }
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){
            $amministratore = unserialize($sessione->LeggiValore('Amministratore'));
            $amm = unserialize($sessione->LeggiValore('Amministratore'));
            $campo = $sessione::getElementoSessione('campo');
            $data = $sessione::getElementoSessione('data');
            $orario = $sessione::getElementoSessione('orario');
            $attrezzatura = $sessione::getElementoSessione('id_attrezzatura');
            $prenotazione = new EPrenotazione($data,$orario,true,$campo->getId_campo(),$attrezzatura);
            $pm::uploadOgg($prenotazione);
            $view->ConfermaPrenotazioneAmm($amministratore);


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
        if(UServer::getRichiestaMetodo()=="GET"){
            $amministratore =  unserialize($sessione->LeggiValore('amministratore'));
            $prenotazioni = FPersistentManager::RecuperaTuple('Prenotazione');
            $view->mostraPrenotazioni($prenotazioni);
        }
        if(UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            if (CAmministratore::Loggato()) { // Verifica se l'utente è loggato
                $amministratore = unserialize($sessione->LeggiValore('utente'));
                FPersistentManager::deleteOgg('Prenotazione',$idPrenotazione,'id_prenotazione');
                    $view->MostraMessaggioConferma("Prenotazione annullata con successo!");
                
            } else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }
}




