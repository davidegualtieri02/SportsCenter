<?php

class CPrenotaCampo{
    /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function prenotaCampo($idCampo){ //Con GET il server invia la form di prenotazione 
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza(); // otteniamo un'istanza della sessione utente  
        $campo = $pm::recuperaOggetto('ECampo',$idCampo);// recuperiamo l'oggetto campo sportivo nel db
        $view = new VPrenotaCampo();//creiamo un'istanza della view per la prenotazione del campo
        if(UServer::getRichiestaMetodo()=="GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
            if(CUtente::Loggato()){
            $utente = unserialize($sessione->LeggiValore('Utente'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente 
            $view ->MostraFormPrenotazione($campo);//viene mostrata la form per la prenotazione
            }else{// se l'utente non è loggato viene reindirizzato alla pagina di login 
                header('Location: /SportsCenter/Utente/login');
                exit;//fa in modo che il codice dopo non viene eseguito se l'utente non è loggato.
            }    
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
            $utente = unserialize($sessione->LeggiValore('utente'));
            $idUtente = $utente->getId();
                // l'utente invia la data e l'orario  in cui vorrebbe prenotare il campo al server 
            $data = UMetodiHTTP::post('data'); 
            $orario = UMetodiHTTP::post('orario');
                //e invia anche l'attrezzatura che vorrebbe
            $idAttrezzatura = UMetodiHTTP::post('id_attrezzatura');
            $numeroCarta = UMetodiHTTP::post('Numero_Carta');
            $scadenzaCarta = UMetodiHTTP::post('Data_Scadenza');
            $cvvCarta = UMetodiHTTP::post('CVV');
            $nome = UMetodiHTTP::post('Nome_Titolare');
            $cognome = UMetodiHTTP::post('Cognome_Titolare');
            $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
            if(FPersistentManager::campoDisponibile($pdo,$idCampo,$data,$orario)){
                if(FPersistentManager::ProcessoPag($nome,$cognome,$numeroCarta,$scadenzaCarta,$cvvCarta)){// se il pagamento è avvenuto con successo
                    //eseguiamo l'inserimento della prenotazione nel database
                    $sql = "INSERT INTO 'Prenotazione' ('data','orario','id_campo','id_attrezzatura','id_utente') VALUES (:data,:orario,:id_campo,:id_attrezzatura,:id_utente)"; // la prenotazione viene creata e aggiunta nel db cosi 
                    $dichiarazione = $pdo->prepare($sql);
                    $dichiarazione->execute([':id_utente'=>$idUtente,':id_campo' => $idCampo,':data'=> $data,':orario'=>$orario,':id_attrezzatura'=>$idAttrezzatura]);
                    $view->MostraMessaggioConferma("Campo prenotato con successo!");
                }
                else{
                    $view->MostraMessaggioErrore("Il campo non è disponibile per la prenotazione");
                }    
        
            }else{
                header('Location: /SportsCenter/Utente/login');
                exit;
                }
        }
        
    }
    //mostra il campo per poi poter prenotare il campo stesso
    public function InfoCampo($idCampo){
        $view = new VPrenotaCampo();
        $sessione = USession::getIstanza();
        $utente =  unserialize($sessione->LeggiValore('Utente'));
        $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
        if(isset($campo)){
            $view->mostraInfo($campo,$utente);//l'utente è l'utente della sessione.
        }
        else{
            header('Location:/SportsCenter');
        }
    }
    public function InfoPrenotazione($idPrenotazione){
        $view = new VPrenotaCampo();
        $sessione = USession::getIstanza();
        $utente =  unserialize($sessione->LeggiValore('Utente'));
        $prenotazione = FPersistentManager::recuperaOggetto('EPrenotazione',$utente->getId());
        $idPrenotazione = $prenotazione->getIdPrenotazione();
        $view->mostraInfoPrenotazione($utente,$prenotazione);
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
                
                if ($pm::VerificaUtenteprenotazione($pdo, $idPrenotazione, $utente->getId())) {
                    $pm::deletePrenotazione($idPrenotazione,$utente->getId());
                    $view->MostraMessaggioConferma("Prenotazione annullata con successo!"); // se l array $dichiarazione ha più di 0 elementi  allora l'eliminazione della prenotazione è avvenuta con successo
                } else {
                    $view->MostraMessaggioErrore("Non hai i permessi per annullare questa prenotazione."); //  cioè l'utente non ha prenotato nessuna prenotazione e dunque non la può eliminare 
                    }
            } else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }
    public static function mostraCampi(){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VCampi();
        if (CUtente::Loggato()){
            $utente= unserialize($sessione->LeggiValore('Utente'));
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
                $view->mostraCampi($campi,$utente);
            }    
        else{
            header("Location: SportsCenter/Utente/login");
            }

        }
   }
}

