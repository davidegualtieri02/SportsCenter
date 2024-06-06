<?php

class FUtenteTesserato{
    //Definizione delle variabili statistiche
    private static $tabella = "UtenteTesserato"; //Nome della tabella nel DB
    private static $valore = "(NULL,:nome,:cognome,:password,:email,:ban)"; //Valori da inserire nella tabella
    private static $chiave = "id_utenteTesserato"; //Chiave primaria della tabella

    //Metodi getter per le variabili statistiche
    public static function getTabella(){
        return self::$tabella; //Restituisce il nome della tabella
    }

    public static function getValore(){
        return self::$valore; //Restituisce i valori da inserire nella tabella
    }

    public static function getClasse(){
        return self::class; // Restituisce il nome della classe
    }

    public static function getChiave(){
        return self::$chiave; //Restituisce la chiave primaria della tabella
    }

    //Metodo per creare un oggetto UtenteTesserato a partire dai risultati di una query
    public static function CreaOggUtenteTesserato($risultatoQuery){
        //Se la query restituisce un solo risultato
        if (count($risultatoQuery)==1){
            //Recupera gli attributi dell'oggetto
            $attributi = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),"IDUtenteTesserato",$risultatoQuery[0]['IDUtenteTesserato']);
            //Crea un nuovo oggetto UtenteTesserato
            $utenteTesserato = new EUtenteTesserato($risultatoQuery[0]['nome'],$risultatoQuery[0]['cognome'],$risultatoQuery[0]['email'],$risultatoQuery[0]['password'],$risultatoQuery[0]['IDUtenteTesserato'], $risultatoQuery[0]['ban']);
            //Imposta l'ID e lo stato del ban
            $utenteTesserato->setId($risultatoQuery[0]['IDUtenteTesserato']);
            $utenteTesserato->setBan($attributi[0]['ban']);
            //Restituisce l'oggetto creato
            return $utenteTesserato;
        }
        //Se la query restituisce più di un risultato
        elseif(count($risultatoQuery)>1){
            $utentiTesserati= array(); //Array per contenere gli oggetti creati
            //Per ogni risultato della query
            for($i=0;$i<count($risultatoQuery);$i++){
                //Recupera gli attributi dell'oggetto
                $attributi = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella()," IDUtenteTesserato",$risultatoQuery[$i]['IDUtenteTesserato']);
                //Crea un nuovo oggetto UtenteTesserato
                $utenteTesserato = new EUtenteTesserato($risultatoQuery[$i]['name'],$risultatoQuery[$i]['surname'],$risultatoQuery[$i]['email'],$risultatoQuery[$i]['password'],$risultatoQuery[$i]['IdUtentetesserato'],$risultatoQuery[$i]['ban']);
                //Imposta l'ID e lo stato del ban
                $utenteTesserato->setId(($risultatoQuery[$i]['IDUtentetesserato']));
                $utenteTesserato->setBan(($attributi[0]['ban']));
                //Aggiunge l'oggetto all'array
                $utentiTesserati[] = $utenteTesserato; 
            }
            return $utentiTesserati; //Restituisce l'array di oggetti
        }else{ //Se la query non restituisce risultati, restituisce un array vuoto
            return array();
        }
    }

    //Metodo per associare i valori dell'oggetto ai parametri della query
    public static function bind($dichiarazione,$UtenteTesserato,$id){
        //Associa il valore del ban al parametro corrispondente nella query
        $dichiarazione->bindvalue(":ban",$UtenteTesserato->isBanned(),PDO::PARAM_BOOL);
    }

    //Metodo per recuperare un oggetto a partire dal suo ID
    public static function getOgg($id){
        //Esegue la query per recuperare l'oggetto
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtente::getTabella(),self::getChiave(),$id);
        //Se la query resitituisce almeno un risultato
        if (count($risultato)>0){
            //Crea un oggetto a partire dal risultato della query
            $utenteTesserato= self::CreaOggUtenteTesserato($risultato);
            //Restituisce l'oggetto creato
            return $utenteTesserato;
        }else{ //Se la query non restituisce risultati, restituisce null
            return null;
        }
    }

    //Metodo per salvare un oggetto nel database
    public static function saveOgg($ogg,$fieldArray = null){
        //Se non sono specificati campi particolari da aggiornare
        if($fieldArray ===null){
            try{
                //Inizia una transazione
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                //Salva l'oggetto UtenteTesserato
                $salvaUtenteTesserato = FEntityManager::getIstanza()->SalvaOgg(FUtente::getClasse(),$ogg);
                //Se l'oggetto è salvato correttamente
                if($salvaUtenteTesserato !==null){
                    //Salva l'oggetto Utente
                    $salvaUtente = FEntityManager::getIstanza()->SalvaOggdaID(self::getClasse(),$ogg,$salvaUtenteTesserato);
                    //Conferma la transazione
                    FEntityManager::getIstanza()->getdb()->commit();
                    //Se l'oggetto Utente è stato salvato correttamente 
                    if($salvaUtente){
                        //Restituisce l'ID dell'oggetto salvato
                        return $salvaUtenteTesserato;
                    }else{ //Se l'oggetto Utente non è salvato correttamente, restituisce false
                        return false;
                    }
                }else{ //Se l'oggetto UtenteTesserato non è salvato correttamente, restituisce false
                    return false;
                }
            }catch (PDOException $errore){ //Se si verifica un errore, stampa il messaggio di errore e annulla la transazione
                echo "ERRORE" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{ //Chiude la connessione al DB
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }else{ //Se sono specificati campi particolari da aggiornare
            try{ //Inizia una transizione
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                //Per ogni campo da aggiornare
                foreach($fieldArray as $array){
                    //Se il campo non è la password
                    if($array[0]!='password'){
                        //Aggiorna il campo corrispondente dell'oggetto UtenteTesserato
                        FEntityManager::getIstanza()->updateOgg(FUtenteTesserato::getTabella(),$array[0],$array[1],self::getChiave(),$ogg->getId());
                    }else{ //Se il campo è la password, aggiorna il campo corrispondente dell'oggetto Utente
                        FEntityManager::getIstanza()->updateOgg(FUtente::getTabella(),$array[0],$array[1],self::getChiave(),$ogg->getId());
                    }
                }
                //Conferma la transizione
                FEntityManager::getIstanza()->getdb()->commit();
                //Restituisce true per indicare che l'opzione è stata eseguita correttamente
                return true;
            }catch(PDOException $errore){
                //Se si verifica un errore, stampa il messaggio di errore e annulla la transizione
                echo "ERRORE" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{
                //Chiudi la connessione al DB
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }
    }
}
