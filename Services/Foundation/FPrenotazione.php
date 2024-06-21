<?php

//Definisco la classe FPrenotazione
class FPrenotazione {
    //Definisco le variabili statiche private che contengono i nomi della tabella, i valori e la chiave primaria
    private static $tabella = "Prenotazione";
    private static $valore = "(NULL, :data, :orario, :pagata, :id_campo, :id_attrezzatura)";
    private static $chiave = "id_prenotazione";

    //Metodi public che restituiscono il nome della tabella, il valore, la classe e la chiave primaria
    public static function getTabella(){
        return self::$tabella;
    }
    public static function getValore(){
        return self::$valore;
    }
    public static function getClasse(){
        return self::class;
    }

    public static function getChiave(){
        return self::$chiave;
    }

    //Funzione per creare un oggetto Prenotazione da un risultato di una query
    public static function CreaOggPrenotazione($risultatoQuery){
        //Verifico se il risultato della query contiene almeno un elemento
        if(count($risultatoQuery) > 0){
            //Inizializzo l'array delle prenotazioni
            $prenotazioni = array();
            //Ciclo for per ogni elemento del risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Creazione di un nuovo oggetto Prenotazione con i dati ottenuti dalla query
                $pren = new EPrenotazione($risultatoQuery[$i]['data'],$risultatoQuery[$i]['orario'], $risultatoQuery[$i]['pagata'], $risultatoQuery[$i]['id_prenotazione'], $risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['id_attrezzatura']);
                //Aggiungo la recensione all'array delle prenotazioni
                $prenotazioni[] = $pren;
            }
            //Ritorna l'array delle prenotazioni
            return $prenotazioni;
        }else{ //Se il risultato della query non contiene elementi, ritorna un array vuoto
            return array();
        }
    }

    //Funzione per associare i valori dell'oggetto Prenotazione ai parametri della dichiarazione SQL
    public static function bind($dichiarazione, $prenotazione){
        $dichiarazione->bindValue(":data", $prenotazione->getData(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":orario", $prenotazione->getOrario(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":pagata", $prenotazione->getPagata(), PDO::PARAM_BOOL);
        $dichiarazione->bindValue(":id_prenotazione", $prenotazione->getIdPrenotazione(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":id_campo", $prenotazione->getIdCampo(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":id_attrezzatura", $prenotazione->getIdAttrezzatura(), PDO::PARAM_INT);
    }

    //Funzione per ottenere un oggetto Prenotazione dal DB
    public static function getOgg($id_prenotazione){
        //Recupero dell'oggetto Prenotazione dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_prenotazione);
        //Verifica se il risultato contiene almeno un elemento
        if(count($risultato) > 0){
            //Crea un oggetto Prenotazione dal risultato
            $prenotazione = self::CreaOggPrenotazione($risultato);
            //Restituisci l'oggetto Prenotazione
            return $prenotazione;
        }else{ //Se il risultato non contiene elementi, allora restituisci null
            return null;
        }
    }

    //Funzione per salvare un oggetto nel DB
    public static function salvaOgg($ogg, $fieldArray = null){
        //Verifica se l'array dei campi è null
        if($fieldArray === null){
            //Salva l'oggetto nel DB
            $salvaPrenotazione = FEntityManager::getIstanza()->salvaOgg(self::getClasse(), $ogg);
            //Verifica se l'oggetto contiene elementi
            if($salvaPrenotazione !== null){
                //Se è stato salvato correttamente, restituisci l'oggetto
                return $salvaPrenotazione;
            }else{ //Se non è stato salvato nulla, restituisci false
                return false;
            }
        }else{
            //Inizia una transizione
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                //Ciclo for per ogni elemento dell'array dei campi
                foreach($fieldArray as $fv){
                    //Aggiorna l'oggetto nel DB
                    FEntityManager::getIstanza()->updateOgg(FPrenotazione::getTabella(), $fv[0], $fv[1], self::getChiave(), $ogg->getId());
                }
                //Conferma la transizione
                FEntityManager::getIstanza()->getdb()->commit();
                return true;
            }catch(PDOException $errore){
                //Se si verifica un errore, stampa l'errore e annulla la transazione
                echo "ERROR" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{
                //Chiudi la connessione al DB
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }
    }

    //Funzione per eliminare una Prenotazione dal DB
    public static function eliminaPrenotazioneDalDB($id_prenotazione, $id_utente){
        //Inizia una transizione
        try{
            FEntityManager::getIstanza()->getdb()->beginTransaction();
            //Recupera l'oggetto Prenotazione dal DB
            $queryResult = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_prenotazione);
            //Verifica se l'oggetto esiste nel DB e se l'utente è il creatore dell'oggetto
            if(FEntityManager::getIstanza()->esisteNelDb($queryResult) && FEntityManager::getIstanza()->verificaCreatore($queryResult, $id_utente)){
                //Elimina la recensione dal DB
                FEntityManager::getIstanza()->deleteOggInDb(self::getTabella(), self::getChiave(), $id_prenotazione);
                //Conferma le modifiche al DB
                FEntityManager::getIstanza()->getdb()->commit();
                return true;
            }else{ //Se la recensione non esiste o l'utente non è il creatore, allora annulla le modifiche dal DB
                FEntityManager::getIstanza()->getdb()->commit();
                return false;
            }
        }catch(PDOException $errore){
            //In caso di errore, stampa il messaggio di errore e annulla le modifiche al DB
            echo "ERROR " . $errore->getMessage();
            FEntityManager::getIstanza()->getdb()->rollBack();
            return false;
        }finally{
            //Chiudi la connessione al DB
            FEntityManager::getIstanza()->chiusuraConnessione();
        }
    } 
    
    /**
     * Metodo che verifica se la prenotazione è di un utente loggato
     */
    public static function VerificaUtentePrenotazione($pdo, $idPrenotazione, $utenteId) {
        $sql = "SELECT id_utente FROM Prenotazione WHERE id_utente = :id_prenotazione AND id_utente = :id_utente";
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([
            ':id_prenotazione' => $idPrenotazione,
            ':id_utente' => $utenteId
        ]);
        return $dichiarazione->rowCount() > 0;// verifica se la query ha restituita almeno una riga , cioè se quell'utente ha prenotato almeno una prenotazione 
    }
}