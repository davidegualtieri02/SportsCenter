<?php

//Definisco la classe FPrenotazione
class FPrenotazione {
    //Definisco le variabili statiche private che contengono i nomi della tabella, i valori e la chiave primaria
    private static $tabella = "Prenotazione";
    private static $valore = "(:id_prenotazione,:data,:orario,:pagata,:id_campo,:attrezzatura,:id_utenteRegistrato)";
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
            $prenotazione = new EPrenotazione($risultatoQuery[0]['data'], $risultatoQuery[0]['orario'], $risultatoQuery[0]['pagata'], $risultatoQuery[0]['id_campo'], $risultatoQuery[0]['attrezzatura'], $risultatoQuery[0]['id_utenteRegistrato']);
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
                $prenotazione = new EPrenotazione($risultatoQuery[$i]['data'],$risultatoQuery[$i]['orario'], $risultatoQuery[$i]['pagata'],$risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['attrezzatura'], $risultatoQuery[$i]['id_utenteRegistrato']);
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
        $dichiarazione->bindValue(":id_prenotazione", $prenotazione->getIdPrenotazione(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":data", $prenotazione->getData(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":orario", $prenotazione->getOrario(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":pagata", $prenotazione->getPagata(), PDO::PARAM_BOOL);
        $dichiarazione->bindValue(":id_campo", $prenotazione->getIdCampo(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":attrezzatura", $prenotazione->getIdAttrezzatura(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":id_utenteRegistrato", $prenotazione->getIdUtente(), PDO::PARAM_INT);
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
    public static function eliminaPrenotazioneDalDB($id_prenotazione, $id_utenteRegistrato) {
    try {
        // Inizia una transazione
        $db = FEntityManager::getIstanza()->getdb();
        $db->beginTransaction();
        
        // Recupera l'oggetto Prenotazione dal DB
        $queryResult = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_prenotazione);
        
        // Verifica se l'oggetto esiste nel DB e se l'utente è il creatore dell'oggetto
        if (FEntityManager::getIstanza()->esisteNelDb($queryResult) && FEntityManager::getIstanza()->verificaCreatore($queryResult, $id_utenteRegistrato)) {
            // Elimina la prenotazione dal DB
            FEntityManager::getIstanza()->deleteOggInDb(self::getTabella(), $id_prenotazione, self::getChiave());
            // Conferma le modifiche al DB
            $db->commit();
            return true;
        } else {
            // Annulla le modifiche al DB
            $db->rollBack();
            return false;
        }
    } catch (PDOException $errore) {
        // Log dell'errore
        error_log("Errore durante l'eliminazione della prenotazione: " . $errore->getMessage());
        // Annulla le modifiche al DB
        FEntityManager::getIstanza()->getdb()->rollBack();
        return false;
    }
}

    
    /**
     * Metodo che verifica se la prenotazione è di un utente loggato
     */
    public static function VerificaUtentePrenotazione($pdo,$idPrenotazione,$id_utenteRegistrato) {
        $sql = "SELECT id_utenteRegistrato FROM Prenotazione WHERE id_prenotazione = :id_prenotazione AND id_utenteRegistrato = :id_utenteRegistrato";
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([
            ':id_prenotazione' => $idPrenotazione,
            ':id_utenteRegistrato' => $id_utenteRegistrato
        ]);
        return $dichiarazione->rowCount() > 0;// verifica se la query ha restituita almeno una riga , cioè se quell'utente ha prenotato almeno una prenotazione 
    }
    /**
     * Metodo che gestisce l'accesso sincrono di due utenti che prenotano ad uno stesso orario
     * Se due utenti prenotano contemporaneamente , il primo che clicca su un orario per quel giorno fa si che all'altro utente scompaia l'orario prenotabile 
     * cioè quell'orario sta per essere prenotato .
     */
    public static function OrariDisponibili($giorno,$idCampo){
        try{
            //creiamo una connessione al database e impostiamo nella seconda riga
            //l'attributo di errore per lanciare eccezioni in caso di errori
            $pdo = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8", DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //avvia la transazione
            $pdo->exec('LOCK TABLES Prenotazione WRITE');
            $pdo->beginTransaction();
            //viene bloccata la tabella Prenotazioni in modalità scrittura ( che scrive dati sul db) per evitare conflitti con altre transazioni
            //ponendo nella select alla fine FOR UPDATE se un utente che sta prenotando uno stesso campo in uno stesso giorno clicca su un ora per esempio le 14:30
            // un'altro utente che sta prenotando anche lui quel campo in quel giorno , non vedrà più le ore 14:30 tra gli orari disponibili
            $sql = "SELECT o.orario FROM Orario o LEFT JOIN Prenotazione p ON o.orario = p.orario AND p.data = :giorno AND p.id_campo = :idCampo WHERE p.orario IS NULL FOR UPDATE"; //mi restituisce gli orari non prenotati per un dato giorno
            $dichiarazione =$pdo->prepare($sql);
            //viene usato un parametro per prevenire sql injection 
            $dichiarazione->bindParam(':giorno',$giorno,PDO::PARAM_STR);
            $dichiarazione->bindParam(':idCampo',$idCampo,PDO::PARAM_STR);
            $dichiarazione->execute();//esegue la query 
            // Recupera gli orari disponibili
            $orariDisponibili = $dichiarazione->fetchAll(PDO::FETCH_COLUMN, 0);//restituisce i risultati come un array associativo utilizzando i nomi delle colonne come chiavi 
            // Tutte le ore possibili
            $tutteLeOre = [];
            for ($oraint = 8; $oraint <= 23; $oraint++) {
                //$oracompleta = sprintf('%02d:00', $i);
                $tutteLeOre[] = [
                    'orario' => $oraint,
                    'disponibile' => in_array($oraint, $orariDisponibili)
                ];
            }
            $pdo->exec('UNLOCK TABLES');
            $pdo->commit();
            return $tutteLeOre;
        }catch (PDOEXception $e){
            $pdo->rollBack();
            $pdo->exec('UNLOCK TABLES');
            throw $e;
        }
    }
}