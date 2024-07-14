<?php
class CRecensione{
    /**
     * Metodo che permette all'utente di scrivere una recensione per il campo sportivo che ha prenotato o prenotato in passato
     * e permette di allegare anche foto del campo sportivo in caso l'utente voglia farlo, altrimenti può solo scrivere la recensione
     * @param $idcampo è il campo di cui si vuole scrivere una recensione 
     */
    public static function scriviRecensione($id_prenotazione){
        $view = new VRecensione();
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $idUtente = $sessione->getElementoSessione('utenteRegistrato');
        $prenotazione = $pm::recuperaOggetto(EPrenotazione::getEntità(),$id_prenotazione);
        $idCampo = $prenotazione->getIdCampo();
        $campo = $pm::recuperaOggetto(ECampo::getEntità(),$idCampo);
        if(UServer::getRichiestaMetodo() == "POST"){
            //print_r($_POST);
            $messaggio = UMetodiHTTP::post('recensione_text');
            $datetime = new DateTime();
            $giorno = $datetime->format('Y-m-d');
            //$imm = UMetodiHTTP::files('recensione_image');
            //print_r($imm);
            //$recensione = new ERecensione($messaggio,$giorno,$idUtente,$idCampo);
            //$pm::uploadOgg($recensione);
            //header('Location: /SportsCenter/Recensione/mostraRecensioni');
            if (isset($_FILES['recensione_image'])) {
                // Recupera i dettagli del file
                $nome = $_FILES['recensione_image']['name'];
                $grandezza = $_FILES['recensione_image']['size'];
                $tipo = $_FILES['recensione_image']['type'];
                $imageData = file_get_contents($_FILES['recensione_image']['tmp_name']);
                $immagine = new EImage($nome,$grandezza,$tipo,$imageData);
                FPersistentManager::uploadOgg($immagine);
                $id_image = FEntityManager::$db->lastInsertId();
                $recensione = new ERecensione($messaggio,$giorno,$idUtente,$idCampo, $id_image);
                $pm::uploadOgg($recensione);
                header('Location: /SportsCenter/Recensione/mostraRecensioni');
            }
        }
        /*
        $prenotazione = $sessione::getElementoSessione('id_prenotazione');
        if(Userver::getRichiestaMetodo() == "GET"){
        //se il metodo di richiesta è GET viene mostrato il form per una nuova recensione, cioè il server manda al browser dell'utente  la form per recensire il campo
            $view->formNuovaRecensione($utente,$prenotazione,$campo);
        }//se la richiesta è POST l'utente scrive il commento e aggiunge la recensione al db
        elseif(UServer::getRichiestaMetodo() == "POST"){
            $valutazione = VRecensione::getValutazione();
            $messaggio = VRecensione::getMessaggio();
            $data = VRecensione::getData();
            $recensione = new ERecensione($valutazione,$messaggio,$idcampo,$utente,$data);
            $pm::uploadOgg($recensione);
            $imm=UMetodiHTTP::files('immagini');
                        // carica l'immagine dal browser dell'utente fino al server
            if(isset($imm)){ //tramite isset() vediamo se nell'array $_FILES sono state caricate già le immagini con chiave 'immagini'. isset() restituisce true se le immagini sono state caricate nella recensione
                $immagini = UMetodiHTTP::files('immagini'); // se isset() rida true, $immagini contiene le informazioni sulle immagini appena caricate
                        // tali informazioni sono : i nomi originali dei file (immagini) caricate , il formato delle immagini se jpeg o image , il percorso temporaneo in cui le immagini sono state salvate sul server, le dimensioni delle immagini 
                        // e contiene anche i codici di errore associati al caricamento di ciascun file
                }
                    // per ogni immagine caricata il ciclo foreach itera per ogni file temporaneo caricato e associato uno alla volta alla chiave 'tmp_name' nell'array immagini
                    //$immagini['tmp_name'] è un array che contiene i percorsi temporanei dei file caricati sul server. SICCOME IL FILE E' STATO CARICATO , CONOSCENDO IL PERCORSO TEMPORANEO DEL FILE NEL SERVER POSSIMAO
                    //SPOSTARE TALE IMMAGINE DAL PERCORSO TEMPORANEO E PORLA NELLA RECENSIONE.
                    // l'array che contiene i percorsi delle immagini è proprio $immagini[tmp_name]
                foreach ($immagini['tmp_name'] as $index => $percorsoTemporaneo) {//$index assume una alla volta tutti i valori delle chiavi dell'array $immagini e quindi $percorsoTemporaneo assume una alla volta tutti i valori delle chiavi assunte da $index, cioè assume come valori i valori dei percorsi temporanei delle immagini caricate nel server .
                        //index assume come valore un id dei percorsi , perchè nell'array abbiamo chiave(id)=>percorso
                    if ($immagini['error'][$index] === UPLOAD_ERR_OK) { //UPLOAD_ERR_OK verifica che i file sono stati caricati senza errori
                            // Aggiunge l'immagine all'oggetto ERecensione  e salva la recensione
                        $pm::AggiungiImmagini($recensione,$percorsoTemporaneo);
                    }

                }        
                    // Aggiorna la recensione nel database con le immagini aggiunte
                $pm::updateOgg(FRecensione::getTabella(),'image',$immagini,'id_utenteRegistrato',$utente->getId()); // al posto del valore della colonna image poniamo le immagini relative al commento 
        }
                    
                //l'utente non ha prenotato questo campo , viene mostrato un messaggio di errore*/
    }  
            
     //MostraPrenotazione sta su CPrenotaCampo
    
    /**
     * Metodo che restituisce tutte le prenotazioni effettuate dall'utente cliccando sul bottone prenotazioni 
     * presente nel menù a tendina ottenuto cliccando sul bottone profilo nella home   
     */
    public function MostraPrenotazioni(){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        if(CUtente::Loggato()){
            $utente = unserialize($sessione->LeggiValore('utenteRegistrato'));
            $idUtente = $utente->getId();
            $prenotazioni =FPersistentManager::recuperaOggetti(FUtenteRegistrato::getTabella(),'id_utenteRegistrato', $idUtente);
            if(UServer::getRichiestaMetodo() == 'GET'){
                $view->MostraPrenotazioni($prenotazioni,$utente);
             }
        }else {
            header('Location: /SportsCenter/Utente/login');
            exit;
        }
    }
    /**
     * Metodo che elimina una recensione con annessa eliminazione di foto presenti nella stessa recensione
     * @param $idRecensione si riferisce alla recensione da eliminare
     */
    public static function eliminaRecensione($idRecensione) {
        // Verifica se l'utente è loggato
        if (CUtente::Loggato()) {
            $utente = unserialize(USession::getIstanza()->LeggiValore('utenteRegistrato'));
    
            // Recupera la recensione dal database
            $recensione = FPersistentManager::recuperaOggetto(ERecensione::getEntità(), $idRecensione);
    
            // Verifica se l'utente è l'autore della recensione o ha i permessi per eliminarla
            if ($recensione && $recensione->getIdUtente() == $utente->getId()) {
                // Elimina la recensione dal database
                FPersistentManager::deleteOgg(FRecensione::getTabella(),$idRecensione,'id_prenotazione');
    
                // Eventualmente elimina anche le immagini associate se gestito separatamente
    
                //l'utente viene rimandato alla pagina dei commenti del campo
                header("Location: /SportsCenter/home/Campo");
                exit;
            } else {
                // Utente non autorizzato a eliminare la recensione ,viene reindirizzato alla pagina del campo
                header('Location: /SportsCenter/home/Campo/');
                exit;
            }
        } else {
            // Utente non loggato, reindirizza al login
            header('Location: /SportsCenter/home/login');
            exit;
        }
    }
    /**
     * Metodo che mostra le recensioni di tutti i campi una volta cliccato sul 'recensioni campo' nella home
     */
    public static function mostraRecensioni(){
        $view = new VRecensione();
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $idUtente = $sessione->getElementoSessione('utenteRegistrato');
        if(CUtente::Loggato()){
            $recensioniinordine = $pm::RecuperaTuple(FRecensione::getTabella());
            $recensioni = array_reverse($recensioniinordine);
            if(UServer::getRichiestaMetodo() == 'GET'){
                foreach ($recensioni as &$recensione) {
                    $idCampo = $recensione['id_campo'];
                    $campo = FPersistentManager::recuperaOggetto('ECampo', $idCampo);
                    $titoloCampo = $campo->getTitolo();
                    $recensione['titoloCampo'] = $titoloCampo;
                    $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato', $recensione['id_utenteRegistrato']);
                    $nomeUtente = $utente->getNome();
                    $recensione['nomeUtente'] = $nomeUtente;
                    $image = FPersistentManager::recuperaOggetto('EImage', $recensione['id_image']);
                    $nomeImg = $image->getNome();
                    $recensione['nomeImg'] = $nomeImg;
                    $grandezzaImg = $image->getGrandezza();
                    $recensione['grandezzaImg'] = $grandezzaImg;
                    $tipoImg = $image->getTipo();
                    $recensione['tipoImg'] = $tipoImg;
                    $imageDataImg = $image->getImageData();
                    $encodedDataImg = $image->getEncodedData();
                    $recensione['encodedDataImg'] = $encodedDataImg;
                }
                unset($recensione);
                $view->MostraRecensioni($recensioni,$idUtente);
            }
        }


            /*
            $recensioniinordine = $pm::RecuperaTuple(FRecensione::getTabella());
            $recensioni = array_reverse($recensioniinordine);
            if(UServer::getRichiestaMetodo() == 'GET'){
                foreach ($recensioni as &$recensione) {
                    $idCampo = $recensione['id_campo'];
                    $campo = FPersistentManager::recuperaOggetto('ECampo', $idCampo);
                    $titoloCampo = $campo->getTitolo();
                    $recensione['titoloCampo'] = $titoloCampo;
                    $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato', $recensione['id_utenteRegistrato']);
                    $nomeUtente = $utente->getNome();
                    $recensione['nomeUtente'] = $nomeUtente;
                    $image = FPersistentManager::recuperaOggetto('EImage', $recensione['id_image']);
                    $nomeImg = $image->getNome();
                    $recensione['nomeImg'] = $nomeImg;
                    $grandezzaImg = $image->getGrandezza();
                    $recensione['grandezzaImg'] = $grandezzaImg;
                    $tipoImg = $image->getTipo();
                    $recensione['tipoImg'] = $tipoImg;
                    $imageDataImg = $image->getImageData();
                    $encodedDataImg = $image->getEncodedData();
                    $recensione['encodedDataImg'] = $encodedDataImg;
                }
                unset($recensione);
                $view->MostraRecensioniNoLog($recensioni);
            }
        }*/
    }

}











