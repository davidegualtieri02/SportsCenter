<?php
class CRecensione{
    /**
     * Metodo che permette all'utente di scrivere una recensione per il campo sportivo che ha prenotato o prenotato in passato
     * e permette di allegare anche foto del campo sportivo in caso l'utente voglia farlo, altrimenti può solo scrivere la recensione
     * @param $idcampo è il campo di cui si vuole scrivere una recensione 
     */
    public static function scriviRecensione($idcampo){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VRecensione;
        
        if(CUtente::Loggato()){
            $utente = unserialize($sessione->LeggiValore('utente'));
            $pdo = new PDO('mysql:host=localhost;dbname=prova', 'root', 'password123');
            $sql = "SELECT COUNT(*) FROM Prenotazione WHERE id_utente = :id_utente AND id_campo = :id_campo"; // si verifica se l'utente che vuole commentare ha prenotato almeno una volta quel campo con quel id
            $dichiarazione = $pdo->prepare($sql);
            $dichiarazione->execute([':id_utente'=>$utente->getId(),'id_campo'=>$idcampo]);// qui sto andando ad eseguire la query specificando che al posto di :id_campo ci va l'id del campo e la stessa cosa per l'utente
            $counts = $dichiarazione->fetchColumn();// questo metodo contiene il risultato della query ,cioè il numero di righe in cui compare l'id dell'utente che ha prenotato quel campo almeno una volta
            if($counts >0 ){// se il numero di righe in cui compare quell'id  di quell'utente sono >0, cioè se quell'utente ha prenotato almeno una volta quel campo allora può commentare il campo
                if(Userver::getRichiestaMetodo() =="GET"){
                    //se il metodo di richiesta è GET viene mostrato il form per una nuova recensione, cioè il server manda al browser dell'utente  la form per recensire il campo
                    $view->formNuovaRecensione($utente,$idcampo,null);
                }//se la richiesta è POST l'utente scrive il commento e aggiunge la recensione al db
                elseif(UServer::getRichiestaMetodo()=="POST"){
                    $valutazione = VRecensione::getValutazione();
                    $messaggio = VRecensione::getMessaggio();
                    $ora = VRecensione::getOra();
                    $recensione = new ERecensione($valutazione,$messaggio,$utente->getId(),$idcampo,$ora)
                    $pm::uploadOgg($recensione);
                    // carica l'immagine dal browser dell'utente fino al server
                    if(isset(UMetodiHTTP::files('immagini'))){ //tramite isset() vediamo se nell'array $_FILES sono state caricate già le immagini con chiave 'immagini'. isset() restituisce true se le immagini sono state caricate nella recensione
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
                            $pm= FPersistentManager::AggiungiImmagini($recensione,$percorsoTemporaneo);
                        }

                    }
                    // Aggiorna la recensione nel database con le immagini aggiunte
                    $pm::updateOgg($recensione);
            
                    header("Location: /SportsCenter/home/Campo");
                     exit;
                //l'utente non ha prenotato questo campo , viene mostrato un messaggio di errore
                }else{
                    $view ->mostraErrore("Non hai prenotato questo campo e non puoi recensirlo");
                }
            }
        }else{
            //l'utente non è loggato ,reindirizza alla pagina di login
            header('Location : /SportsCenter/home/login');

        }
    }
    /**
     * Metodo che elimina una recensione con annessa eliminazione di foto presenti nella stessa recensione
     * @param $idRecensione si riferisce alla recensione da eliminare
     */
    public static function eliminaRecensione($idRecensione) {
        // Verifica se l'utente è loggato
        if (CUtente::Loggato()) {
            $utente = unserialize(USession::getIstanza()->LeggiValore('utente'));
    
            // Recupera la recensione dal database
            $recensione = FPersistentManager::uploadOgg('ERecensione', $idRecensione);
    
            // Verifica se l'utente è l'autore della recensione o ha i permessi per eliminarla
            if ($recensione && $recensione->getIdUtente() == $utente->getId()) {
                // Elimina la recensione dal database
                FPersistentManager::deleteOgg($recensione);
    
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
    


}