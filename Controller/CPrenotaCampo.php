<?php

class CPrenotaCampo{

    public static function servizi(){
        //$idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
        //$utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato', $idUtente);
        //$view = new VPrenotaCampo();
        //$view->MostraCampiUtente($utente);
        if (CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato', $idUtente);
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto        
            if(UServer::getRichiestaMetodo() == 'GET'){
                //$campi = FPersistentManager::RecuperaTuple(FCampo::getTabella());
            // Aggiunge tutti i campi contenuti negli array sopra in un unico array campi

            // quando aggiungiamo un campo , siccome fotocampo è un attributo del campo viene caricata e visualizzata anche l'immagine del campo insieme a tutto il campo
             // Passa i dati alla vista per la visualizzazione
                $view->MostraCampiUtente($utente);
            }    
        else{
            header("Location: login");
            exit;
            }
        }
    }
    /**
     * Metodo che dopo aver cliccato sul campo da prenotare mostra le info del campo e il calendario
     */
    public static function MostraCalendario($idCampo){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $nomeUtente = $utente->getNome();
            $id_tesseraUtente = FPersistentManager::getId_tessera($utente);
            //$id_imageCampo = $campo->getIdimageCampo();
            //$imageCampo = FPersistentManager::recuperaOggetto('EImageCampo',$id_imageCampo);
            if(UServer::getRichiestaMetodo() == "GET"){
                $view->MostraCalendario($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo);
            }elseif(UServer::getRichiestaMetodo() == "POST"){
                $giorno = UMetodiHTTP::post('selectedDay');
                header("Location: /SportsCenter/PrenotaCampo/MostraOrari/{$idCampo}/{$giorno}");
            }
        }
    } 
    /**
     * Metodo che mostrerà una volta che l'utente fornisce la data gli orari disponibili per quel campo e quel giorno
     * qui clicchiamo il giorno
     */
    public static function MostraOrari($idCampo,$giorno){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo(); 
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            //$id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = FPersistentManager::getId_tessera($utente); 
            if(UServer::getRichiestaMetodo() == "GET"){
                $orariDisponibili = FPersistentManager::orariDisponibili($giorno,$idCampo);
                $view->MostraOrari($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orariDisponibili);
            }
            if(UServer::getRichiestaMetodo() == "POST"){
                $orario = UMetodiHTTP::post('selected_time');
                header("Location: /SportsCenter/PrenotaCampo/MostraAttrezzatura/{$idCampo}/{$giorno}/{$orario}");
            }
        }
    }
    /**
     * Metodo che mostra l'array di orari disponibili per la prenotazione di quel campo in quel giorno 
     * e fa scegliere all'utente uno di questi orari per prenotare il campo
     */
    public static function MostraAttrezzatura($idCampo,$giorno,$orario){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            //$id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente = $utente->getNome();
            $id_tesseraUtente = FPersistentManager::getId_tessera($utente);
            if(UServer::getRichiestaMetodo() == 'GET'){
                $view->MostraAttrezzatura($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario);
            }
            elseif(UServer::getRichiestaMetodo() == 'POST'){
                $attrezzatura = UMetodiHTTP::post('hidden_attrezzatura');
                header("Location: /SportsCenter/PrenotaCampo/MostraPagamento/{$idCampo}/{$giorno}/{$orario}/{$attrezzatura}");
            }
       }
    }

    /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function MostraPagamento($idCampo,$giorno,$orario,$attrezzatura){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            //$id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = FPersistentManager::getId_tessera($utente);
            if(UServer::getRichiestaMetodo() == "GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
                $view->MostraFormPagamento($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario,$attrezzatura); 
            }
            elseif(UServer::getRichiestaMetodo() == "POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server 
                header("Location: /SportsCenter/PrenotaCampo/MostraConfermaPrenotazione/{$idCampo}/{$giorno}/{$orario}/{$attrezzatura}");
            }
        }
    }
    /**
     * Metodo che mi rida la form con i dati del pagamento
     */
    public static function MostraConfermaPrenotazione($idCampo,$giorno,$orario,$attrezzatura){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = FPersistentManager::getId_tessera($utente);
            if(UServer::getRichiestaMetodo()=="GET"){
                $prenotazione = new EPrenotazione($giorno,$orario,true,$idCampo,$attrezzatura,$idUtente);
                FPrenotazione::salvaOgg($prenotazione);
                //print(FEntityManager::$db->lastInsertId());
                //FPersistentManager::updateOgg("Prenotazione","id_campo",$idCampo,"id_prenotazione",FEntityManager::$db->lastInsertId());
                header("Location: /SportsCenter/Utente/prenotazioni"); //mostra la lista delle prenotazioni DA IMPLEMENTARE
                //$view->ConfermaPrenotazione($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario,$attrezzatura);
            }
            /*if(UServer::getRichiestaMetodo()=="POST"){
                $nome = UMetodiHTTP::post('Nome_Titolare');
                $cognome = UMetodiHTTP::post('Cognome_Titolare');
                $scadenza = UMetodiHTTP::post('Data_Scadenza');
                $numero = UMetodiHTTP::post('Numero_Carta');
                $cvv = UMetodiHTTP::post('CVV');
                $prenotazione = new EPrenotazione($data,$orario,true,$idCampo,$attrezzatura->getId_attrezzatura(),$utente->getId());
                FPersistentManager::uploadOgg($prenotazione);
                $view->ConfermaPrenotazione($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$data,$orario,$attrezzatura, $nome, $cognome, $scadenza, $numero, $cvv);
            }*/
        }
    }

    /**
     * Metodo che viene interpellato quando si clicca su una delle prenotazioni effettuate dall'utente
     */
    public static function MostraPrenotazione($id_prenotazione){
        if (CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $idUtente = USession::getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::getIstanza()->recuperaoggetto(EUtenteRegistrato::getEntità(), $idUtente);
            $prenotazione = FPersistentManager::recuperaOggetto('EPrenotazione',$id_prenotazione);
            $dataPrenotazione = $prenotazione->getData();
            $orarioPrenotazione = $prenotazione->getOrario();
            $idCampo = $prenotazione->getIdCampo();
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $attrezzatura = $prenotazione->getIdAttrezzatura();
            $view->MostraInfoPrenotazione($idUtente,$utente,$id_prenotazione,$dataPrenotazione,$orarioPrenotazione,$idCampo,$titoloCampo,$attrezzatura);
        }
    }
    
    /**
     * Metodo per annullare una prenotazione
     * @param $idPrenotazione è l'id della prenotazione che l'utente vuole annullare
     */
    public static function annullaPrenotazione($id_prenotazione) {
        if (CUtente::Loggato()){
            $idUtente = USession::getElementoSessione('utenteRegistrato');
            FPersistentManager::deletePrenotazione($id_prenotazione,$idUtente);
            ;
            header("Location: /SportsCenter/Utente/prenotazioni");
        }
    }
    
}