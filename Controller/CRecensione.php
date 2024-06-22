<?php
class CRecensione{
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
                }//se la richiesta è POST l'utente scrive il commento e aggiunge l'immagine/i del campo nel commento 
                elseif(UServer::getRichiestaMetodo()=="POST"){
                    $valutazione = VRecensione::getValutazione();
                    $messaggio = VRecensione::getMessaggio();
                    $ora = VRecensione::getOra();
                    $recensione = new ERecensione($valutazione,$messaggio,$utente->getId(),$idcampo,$ora)
                    $pm::uploadOgg($recensione);
                    // carica l'immagine dal browser dell'utente fino al server
                    if(isset(UMetodiHTTP::files('immagini'))){
                        $immagini = UMetodiHTTP::files('immagini');
                     }
                    
                    foreach ($immagini['tmp_name'] as $index => $percorsoTemporaneo) {
                        if ($immagini['error'][$index] === UPLOAD_ERR_OK) {
                            // Aggiungi l'immagine alla recensione e ottieni il percorso dell'immagine salvata
                            $percorsoImmagine = FPersistentManager::AggiungiImmagini($percorsoTemporaneo);
                            //aggiungi l'immagine all'oggetto ERecensione
                            $recensione ->setImages($percorsoImmagine);
                            
                        }

                    }
                    // Aggiorna la recensione nel database con le immagini aggiunte
                    FPersistentManager::getInstance()->updateOgg($recensione);
            
                    header("Location: /percorso/di/destinazione");
                     exit;
        
                } else {
                    header('Location: /percorso/login');
                     exit;
                }

            }
        }

    }
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
                header("Location: /SportsCenter/home/Campo/");
                exit;
            } else {
                // Utente non autorizzato a eliminare la recensione
                header('Location: /SportsCenter/home');
                exit;
            }
        } else {
            // Utente non loggato, reindirizza al login
            header('Location: /SportsCenter/login');
            exit;
        }
    }
    


}