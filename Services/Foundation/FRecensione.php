<?php

//Definisco la classe FRecensione
class FRecensione{
    //Dichiaro le variabili statiche private che contengono i nomi della tabella, i valori e la chiave primaria
    private static $tabella = "Recensione";
    private static $valore = "(NULL, :commento, :valutazione, :DataOra, :removed, :id_utente)";
    private static $chiave = "id_recensione";

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
    
    //Funzione per creare un oggetto recensione da un risultato di query
    public static function CreaOggRecensione($risultatoQuery){
        if(count($risultatoQuery) == 1){
            $recensione = new ERecensione($risultatoQuery[0]['valutazione'], $risultatoQuery[0]['commento'], $risultatoQuery[0]['id_campo'], $risultatoQuery[0]['id_utente'], $risultatoQuery[0]['ora']);
            $recensione->setIdRecensione($risultatoQuery[0]['id_recensione']);
            return $recensione;
        }
        //Verifico se il risultato della query contiene almeno un elemento
        elseif(count($risultatoQuery) > 1){
            //Inizializzo l'array delle recensioni.
            $recensioni = array();
            //Ciclo for per ogni elemento del risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Creazione di un nuovo oggetto Recensione con i dati ottenuti dalla query
                $recensione = new ERecensione($risultatoQuery[$i]['valutazione'],$risultatoQuery[$i]['commento'],$risultatoQuery[$i]['id_campo'],$risultatoQuery[$i]['id_utente'],$risultatoQuery[$i]['ora']);
            
                //Imposto l'ID della recensione
                $recensione->setIdRecensione($risultatoQuery[$i]['id_recensione']);
                //Creo un oggetto DateTime dal formato Giorno-mese-anno Ora-minuto-secondo
                $DataOra = DateTime::createFromFormat('D-m-y H:i:s', $risultatoQuery[$i]['DataOra']);
                //Imposto la data e l'ora della recensione
                $recensione->setDataOra($DataOra);
                //Imposto lo stato di ban della recensione
                $recensione->setBan($risultatoQuery[$i]['removed']);
                //Aggiungo la recensione all'array delle recensioni
                $recensioni[] = $recensione;
            }
            //ritorna array delle recensioni
            return $recensioni;
        }else{ //Se il risultato della query non contiene elementi, ritorna un array vuoto
            return array();
        }
    }
    
    //Funzione per associare i valori dell'oggetto Recensione ai parametri della dichiarazione SQL
    public static function bind($dichiarazione, $recensione){
        //Associo tutte le variabili (commento, valutazione, etc.) ai rispettivi parametri della dichiarazione SQL
        $dichiarazione->bindValue(" :id_recensione",$recensione->getIdRecensione(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":commento", $recensione->getCommento(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":valutazione", $recensione->getValutazione(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":DataOra", $recensione->getDataOra(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":removed", $recensione->isBanned(), PDO::PARAM_BOOL);
        $dichiarazione->bindValue(":id_Utente", $recensione->getUtente()->getId(), PDO::PARAM_INT);
    }

    //Funzione per ottenere un oggetto Recensione dal DB
    public static function getOgg($id_recensione){
        //Recupero l'oggetto Recensione dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_recensione);
        //Verifica se il risultato contiene almeno un elemento
        if(count($risultato) > 0){
            //Creo un oggetto Recensione dal risultato
            $recensione = self::CreaOggRecensione($risultato);
            //Restituisci l'oggetto Recensione
            return $recensione;
        }else{ //Se il risultato non contiene elementi, allora restituisci null
            return null;
        }
    }

    //Funzione per salvare un oggetto nel DB
    public static function salvaOgg($ogg, $fieldArray = null){
        //Verifica se l'array dei campi è null
        if($fieldArray === null){
            //Salva l'oggetto nel DB
            $salvaRecensione = FEntityManager::getIstanza()->SalvaOgg(self::getClasse(), $ogg);
            //Verifica se l'oggetto contiene elementi
            if($salvaRecensione !== null){
                //Se è stato salvato correttamente, restituisci l'oggetto
                return $salvaRecensione;
            }else{ //Se non è stato salvato nulla, restituisci false
                return false;
            }
        }else{
            //Inizia una transazione
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                //Ciclo for per ogni elemento dell'array dei campi
                foreach($fieldArray as $fv){
                    //Aggiorna l'oggetto nel DB
                    FEntityManager::getIstanza()->updateOgg(FRecensione::getTabella(), $fv[0], $fv[1], self::getChiave(), $ogg->getId());
                }
                //Conferma la transazione
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

    //Funzione per eliminare una recensione dal DB
    public static function eliminaRecensioneDalDB($id_recensione, $id_utente){
        //Inizia una transazione       
        try{
            FEntityManager::getIstanza()->getdb()->beginTransaction();
            //Recupera l'oggetto Recensione dal DB
            $queryResult = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_recensione);
            //Verifica se l'oggetto esiste nel DB e se l'utente è il creatore dell'oggetto
            if(FEntityManager::getIstanza()->esisteNelDb($queryResult) && FEntityManager::getIstanza()->verificaCreatore($queryResult, $id_utente)){
                //Recupera la lista delle immagini associate alla recensione
                $imagesList = FEntityManager::getIstanza()->recuperaOggetto(FImage::getTabella(), self::getChiave(), $id_recensione);
                //Elimina tutte le immagini associate alla recensione dal DB
                for($i = 0; $i < count($imagesList); $i++){
                    FEntityManager::getIstanza()->deleteOggInDb(FImage::getTabella(), FImage::getChiave(), $imagesList[$i][FImage::getChiave()]);
                }
                //Elimina la recensione dal DB
                FEntityManager::getIstanza()->deleteOggInDb(self::getTabella(), self::getChiave(), $id_recensione);
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

    //Funzione statica pubblica che restituisce una lista di recensioni non bannate
    public static function listaRecensioniNonBannate($id_campo){
        //Recupera la lista delle recensioni non bannate di un utente
        $risultatoQuery = FEntityManager::getIstanza()->ListaOggnonrimossi(self::getTabella(), FCampo::getChiave(), $id_campo);
        //Crea gli oggetti Recensione a partire dai risultati della query
        $recensioni = self::getRecensioneCompleta($risultatoQuery);
        return $recensioni;
    }

    public static function getRecConUtente($risultatoQuery){
        //Crea un array vuoto per le recensioni
        $recensioni = array();
        //Se il risultato della query non è nullo
        if(count($risultatoQuery) > 0){
            //Crea gli oggetti Recensione a partire dai risultati della query
            $recensioni = self::CreaOggRecensione($risultatoQuery);
            //Ciclo for per ogni elemento del risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Recupera l'ID dell'utente
                $id_utente = $risultatoQuery[$i][FUtente::getChiave()];
                //Recupera l'oggetto utente a partire dall'ID
                $utente = FUtente::getOgg($id_utente);
                //Associa l'utente alla recensione
                $recensioni[$i]->setUtente($utente);
            }
        }
        //Restituisci la lista di recensioni
        return $recensioni;
    }

    //Funzione statica pubblica che restituisce una lista completa di recensioni
    public static function getRecensioneCompleta($risultatoQuery){
        //Crea un array vuoto per le recensioni
        $recensioni = array();
        //Se il risultato della query contiene elementi
        if(count($risultatoQuery) > 0){
            //Crea gli oggetti Recensione a partire dai risultati della query
            $recensioni = self::CreaOggRecensione($risultatoQuery);
            //Ciclo for per ogni elemento del risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Recupera l'ID dell'utente
                $id_utente = $risultatoQuery[$i][FUtente::getChiave()];
                //Recupera l'oggetto Utente a partire dall'ID
                $utente = FUtente::getOgg($id_utente);
                //Associa l'utente alla recensione
                $recensioni[$i]->setUtente($utente);

                //Recupera le immagini associate alla recensione
                $images = FImage::getOggDaIdRecensione($recensioni[$i]->getIdRecensione());
                //Se ci sono immagini
                if($images !== null){
                    //Per ogni immagine
                    foreach($images as $im){
                        //Aggiungi l'immagine alla recensione
                        $recensioni[$i]->addImage($im);
                    }
                }
            }
        }
        //Restituisci recensioni
        return $recensioni;
    }
    /**
     * Metodo che aggiunge ad una recensione uno o più immagini e salva la recensione nel db
     */
    public static function addImagesARecensione(ERecensione $recensione, array $images): void {
        foreach ($images as $image) {
            $recensione->addImage($image);
    }
        FRecensione::salvaOgg($recensione);

    
    }
    /**
     * Metodo per verificare se l'utente che vuole scrivere una recensione ha almeno una volta prenotato quel campo
     */
    public static function NumVoltePrenotazioni($utente,$idcampo){
        $pdo = new PDO('mysql:host=localhost;dbname=Prova', 'root', ' ');
        $sql = "SELECT COUNT(*) FROM Prenotazione WHERE id_utente = :id_utente AND id_campo = :id_campo"; // si verifica se l'utente che vuole commentare ha prenotato almeno una volta quel campo con quel id
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([':id_utente'=>$utente->getId(),'id_campo'=>$idcampo]);// qui sto andando ad eseguire la query specificando che al posto di :id_campo ci va l'id del campo e la stessa cosa per l'utente
        $count = $dichiarazione->fetchColumn(); //tramite fetchColumn otteniamo il valore del COUNT della Select , cioè otteniamo il numero
        //di prenotazioni efettuate da quell'utente
        return $count>0; // se count è >0 allora l'utente ha prenotato almeno una volta quel campo 
    }
}