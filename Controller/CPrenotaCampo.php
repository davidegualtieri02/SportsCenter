<?php

class CPrenotaCampo{
    /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function MostraPagamento(){ //Con GET il server invia la form di prenotazione 
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = $utente->getid_tessera();
            $giorno =  USession::getElementoSessione('data');
            $orario = USession::getElementoSessione('orario');
            if(UServer::getRichiestaMetodo() == "GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
                $view->MostraFormPagamento($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario,false); 
            }
             elseif(UServer::getRichiestaMetodo() == "POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
                $attrezzatura = UMetodiHTTP::post('attrezzatura'); //viene mandato al server l'id dell'attrezzatura che ha scelto l'utente
                $view->MostraFormPagamento($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario,$attrezzatura);
            }
        }
        
    }
    /**
     * Metodo che mi rida la form con i dati del pagamento
     */
    public static function MostraConfermaPrenotazione(){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = $utente->getid_tessera();
            $data = USession::getElementoSessione('data');
            $orario = USession::getElementoSessione('orario');
            $attrezzatura = USession::getElementoSessione('attrezzatura');
            if(UServer::getRichiestaMetodo()=="POST"){
                $nome = UMetodiHTTP::post('Nome_Titolare');
                $cognome = UMetodiHTTP::post('Cognome_Titolare');
                $scadenza = UMetodiHTTP::post('Data_Scadenza');
                $numero = UMetodiHTTP::post('Numero_Carta');
                $cvv = UMetodiHTTP::post('CVV');
                $prenotazione = new EPrenotazione($data,$orario,true,$idCampo,$attrezzatura->getId_attrezzatura(),$utente->getId());
                FPersistentManager::uploadOgg($prenotazione);
                $view->ConfermaPrenotazione($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$data,$orario,$attrezzatura, $nome, $cognome, $scadenza, $numero, $cvv);
            }
        }
    }
    
    /**
     * Metodo che dopo aver cliccato sul campo da prenotare mostra le info del campo e il calendario
     */
    public static function MostraCalendario($idCampo){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo(); 
            //$idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            //$id_imageCampo = $campo->getIdimageCampo();
            //$imageCampo = FPersistentManager::recuperaOggetto('EImageCampo',$id_imageCampo);
            if(UServer::getRichiestaMetodo() == "GET"){
                $nomeUtente = $utente->getNome();
                $id_tesseraUtente = FPersistentManager::getId_tessera($utente);
                $view->MostraCalendario($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo);
            }
        }
    }
    /**
     * Metodo che mostrerà una volta che l'utente fornisce la data gli orari disponibili per quel campo e quel giorno
     * qui clicchiamo il giorno
     */
    public static function MostraOrari(){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo(); 
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = $utente->getid_tessera(); 
            if(UServer::getRichiestaMetodo() == "POST"){
                $giornoStr = UMetodiHTTP::post('data');
                $giorno = new DateTime($giornoStr);
                $view->MostraOrari($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno);
            }
        }
    }
    /**
     * Metodo che mostra l'array di orari disponibili per la prenotazione di quel campo in quel giorno 
     * e fa scegliere all'utente uno di questi orari per prenotare il campo
     */
    public static function MostraAttrezzatura(){
        if(CUtente::Loggato()){
            $view = new VPrenotaCampo();            
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            $idCampo = USession::getIstanza()->getElementoSessione('campo');
            $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
            $titoloCampo = $campo->getTitolo();
            $prezzoCampo = $campo->getPrezzo();
            $id_imageCampo = $campo->getIdimageCampo();
            $nomeUtente=$utente->getNome();
            $id_tesseraUtente = $utente->getid_tessera();
            $giorno =  USession::getIstanza()->getElementoSessione('data');
            if(UServer::getRichiestaMetodo() == 'GET'){
                $orari = FPersistentManager::orariDisponibili($giorno);
                $view->MostraListaOrari($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orari);// metodo che mostra la lista di orari 
            }
            elseif(UServer::getRichiestaMetodo() == 'POST'){
                $orario = UMetodiHTTP::post('orario') ;
                $view->MostraPagAttrezzatura($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$id_imageCampo,$giorno,$orario);
            }
       }
    }
    /**
     * Metodo che viene interpellato quando si clicca su una delle prenotazioni effettuate dall'utente
     */
    public function MostraPrenotazione($idPrenotazione){
        if (CUtente::Loggato()){
            $view = new VPrenotaCampo();
            $idUtente =  USession::getElementoSessione('utenteRegistrato');
            $prenotazione = FPersistentManager::recuperaOggetto('EPrenotazione',$idPrenotazione);
            $view->MostraInfoPrenotazione($idUtente,$prenotazione);
        }

    }
    
    /**
     * Metodo per annullare una prenotazione
     * @param $idPrenotazione è l'id della prenotazione che l'utente vuole annullare
     */
    public static function annullaPrenotazione($idPrenotazione) {
        if (CUtente::Loggato()){
            $idutente = USession::getElementoSessione('utenteRegistrato');
            $idPrenotazione = USession::getElementoSessione('id_prenotazione');
            if(UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
                FPersistentManager::deletePrenotazione($idPrenotazione,$idutente);
            }//quando si elimina una prenotazione si torna all pagina delle prenotazioni per vedere che la prenotazione è stata eliminata
        }
    }
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
}