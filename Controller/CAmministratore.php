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
            header('Location : /SportsCenter/Amministratore/login');
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
     * Metodo per prenotare un campo sportivo
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function prenotaCampo($idCampo){ //Con GET il server invia la form di prenotazione 
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza(); // otteniamo un'istanza della sessione utente
        $campo = $pm::uploadOgg($idCampo);// carichiamo l'oggetto campo sportivo nel db
        $view = new VPrenotaCampo();//creiamo un'istanza della view per la prenotazione del campo
        if(UServer::getRichiestaMetodo()=="GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'amministratore che sta effettuando la prenotazione
            if(CAmministratore::Loggato()){// se l'utente è loggato
                //$utente = unserialize($sessione->LeggiValore('utente'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente 
                $view ->MostraFormPrenotazione($campo);//viene mostrata la form per la prenotazione
            }else{// se l'amministratore non è loggato viene reindirizzato alla pagina di login 
                header('Location: /SportsCenter/Amministratore/login');
                exit;//fa in modo che il codice dopo non viene eseguito se l'utente non è loggato.
            }    
        }
        if (UServer::getRichiestaMetodo()=="POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
            if(CAmministratore::Loggato()){
                // l'amministratore invia per l'utente la data e l'orario  in cui vorrebbe prenotare il campo al server 
                // a prescinde dall'utente che prenota il campo , l'amministra
                $data = UMetodiHTTP::post('data'); 
                $orario = UMetodiHTTP::post('orario');
                //e invia anche l'attrezzatura che vorrebbe prenotare l'utente
                $idAttrezzatura = UMetodiHTTP::post('id_attrezzatura');
                $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
                if(FPersistentManager::campoDisponibile($pdo,$idCampo,$data,$orario)){
                    //eseguiamo l'inserimento della prenotazione nel database
                    $sql = "INSERT INTO 'Prenotazione' ('data','orario','id_campo','id_attrezzatura','id_utente') VALUES (:data,:orario,:id_campo,:id_attrezzatura,:id_utente)";
                    $dichiarazione = $pdo->prepare($sql);
                    $dichiarazione->execute([':id_utente'=>$idUtente,':id_campo' => $idCampo,':data'=> $data,':orario'=>$orario,':id_attrezzatura'=>$idAttrezzatura]);
                    $view->MostraMessaggioConferma("Campo prenotato con successo!");
                }
                else{
                    $view->MostraMessaggioErrore("Il campo non è disponibile per la prenotazione");
                }    
        
            }else{
                header('Location: /SportsCenter/Amministratore/login');
                exit;
            }
        }
    }
    /**
     * Metodo per annullare una prenotazione
     * @param $idPrenotazione è l'id della prenotazione che l'utente vuole annullare
     */
    public static function annullaPrenotazione($idPrenotazione) {
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();

        if (UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            if (CUtente::Loggato()) { // Verifica se l'utente è loggato
                $utente = unserialize($sessione->LeggiValore('utente'));
                $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
                // Richiama il metodo isUserBookingOwner dalla classe CBooking
                if ($pm::VerificaUtenteprenotazione($pdo, $idPrenotazione, $utente->getId())) {
                    $sql = "DELETE FROM Prenotazione WHERE id_prenotazione = :id_prenotazione AND id_utente = :id_utente";
                    $dichiarazione = $pdo->prepare($sql);
                    $dichiarazione->execute([
                        ':id_prenotazione' => $idPrenotazione,
                        ':id_utente' => $utente->getId()
                    ]);

                    // Controlla se la cancellazione è avvenuta , DELETE restituisce le righe rimosse e rowCount conta tali righe 
                    if ($dichiarazione->rowCount() > 0) {//se l'array dichiarazione contiene almeno una riga cioè quando viene eliminato una riga , $dichiarazione contiene l'elemento eliminato e dunque ha + di 0 elementi 
                        $view->MostraMessaggioConferma("Prenotazione annullata con successo!"); // se l array $dichiarazione ha più di 0 elementi  allora l'eliminazione della prenotazione è avvenuta con successo
                    } else {
                        $view->MostraMessaggioErrore("Errore nell'annullamento della prenotazione.");// se la prenotazione non viene rimossa , viene printato questo messaggio 
                    }
                } else {
                    $view->MostraMessaggioErrore("Non hai i permessi per annullare questa prenotazione."); // se rowCount=0 non viene rimossa la prenotazione , cioè l'utente non ha prenotato nessuna prenotazione e dunque non la può eliminare
                }
            } else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }

}




