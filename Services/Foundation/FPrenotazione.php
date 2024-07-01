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
        if(count($risultatoQuery) == 1){
            $prenotazione = new EPrenotazione($risultatoQuery[0]['data'], $risultatoQuery[0]['orario'], $risultatoQuery[0]['pagata'], $risultatoQuery[0]['id_campo'], $risultatoQuery[0]['id_attrezzatura']);
            $prenotazione->setIdPrenotazione($risultatoQuery[0]['id_prenotazione']);
            return $prenotazione;
        }
        //Verifico se il risultato della query contiene almeno un elemento
        elseif(count($risultatoQuery) > 1){
            //Inizializzo l'array delle prenotazioni
            $prenotazioni = array();
            //Ciclo for per ogni elemento del risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Creazione di un nuovo oggetto Prenotazione con i dati ottenuti dalla query
                $prenotazione = new EPrenotazione($risultatoQuery[$i]['data'],$risultatoQuery[$i]['orario'], $risultatoQuery[$i]['pagata'],$risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['id_attrezzatura']);
                $prenotazione->setIdPrenotazione($risultatoQuery[$i]['id_prenotazione']);
                //Aggiungo la recensione all'array delle prenotazioni
                $prenotazioni[] = $prenotazione;
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
    public static function VerificaUtentePrenotazione($pdo,$idPrenotazione, $id_utente) {
        $sql = "SELECT id_utente FROM Prenotazione WHERE id_prenotazione = :id_prenotazione AND id_utente = :id_utente";
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([
            ':id_prenotazione' => $idPrenotazione,
            ':id_utente' => $id_utente
        ]);
        return $dichiarazione->rowCount() > 0;// verifica se la query ha restituita almeno una riga , cioè se quell'utente ha prenotato almeno una prenotazione 
    }
    /**
     * Metodo che gestisce l'accesso sincrono di due utenti che prenotano ad uno stesso orario
     * Se due utenti prenotano contemporaneamente , il primo che clicca su un orario per quel giorno fa si che all'altro utente scompaia l'orario prenotabile 
     * cioè quell'orario sta per essere prenotato .
     */
    public static function OrariDisponibili($giorno){
        try{
            //creiamo una connessione al database e impostiamo nella seconda riga
            //l'attributo di errore per lanciare eccezioni in caso di errori
            $pdo = new PDO('mysql:host=localhost;dbname=prova', 'root', ' ');
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //avvia la transazione
            $pdo->beginTransaction();
            //viene bloccata la tabella Prenotazioni in modalità scrittura ( che scrive dati sul db) per evitare conflitti con altre transazioni
            $pdo->exec('LOCK TABLES Prenotazione WRITE');
            //ponendo nella select alla fine FOR UPDATE se un utente che sta prenotando uno stesso campo in uno stesso giorno clicca su un ora per esempio le 14:30
            // un'altro utente che sta prenotando anche lui quel campo in quel giorno , non vedrà più le ore 14:30 tra gli orari disponibili
            $sql = "SELECT o.id_orario, o.orario FROM Orario o LEFT JOIN Prenotazione p ON o.orario = p.orario AND p.data = $giorno WHERE p.orario IS NULL FOR UPDATE";
            $dichiarazione =$pdo->prepare($sql);
            //viene usato un parametro per prevenire sql injection 
            $dichiarazione->bindParam(':giorno',$giorno,PDO::PARAM_STR);
            $dichiarazione->execute();//esegue la query 
            //vengono recuperati i risultati della query e vengono memorizzati in un array associativo 
            $risultato = array();
            $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);//restituisce i risultati come un array associativo utilizzando i nomi delle colonne come chiavi 
             while ($riga = $dichiarazione->fetch()){ //ripete il ciclo fino a che non ci sono righe nella colonna
                $risultato = $riga;
            }
            $pdo->exec('UNBLOCK TABLES');
            $pdo->commit();
            return $risultato;
        }catch (PDOEXception $e){
            $pdo->rollBack();
            $pdo->exec('UNLOCK TABLES');
            throw $e;
        }
    }
}