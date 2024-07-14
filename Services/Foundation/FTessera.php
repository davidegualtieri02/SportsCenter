<?php
require_once(__DIR__."/../../Entity/ETessera.php");
class FTessera{
    //Dichiarazione di variabili private statiche che contengono informazioni sulla tabella del DB, i valori e la chiave primaria
    private static $tabella = "Tessera"; 
    private static $valore = "(:id_tessera,:id_utenteRegistrato,:Data_Inizio,:Data_Scadenza)";
    private static $chiave = "id_tessera";

    //Metodi per ottenere il nome della tabella, i valori, la classe e la chiave primaria
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

    //Metodo per creare un oggetto Tessera a partire dai risultati di una query
    public static function creaOggTessera($risultatoQuery){
        //Se c'è solo un risultato, crea un singolo oggetto tessera
        if(count($risultatoQuery) == 1){
            $tessera = new ETessera($risultatoQuery[0]['id_utenteRegistrato'],$risultatoQuery[0]['Data_Scadenza'],$risultatoQuery[0]['Data_Inizio']);
            $tessera->setIdTessera($risultatoQuery[0]['id_tessera']);
            return $tessera;
        }elseif(count($risultatoQuery) > 1){ //Se ci sono più risultati, crea un array di oggetti Tessera
            $tessere = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $tessera = new ETessera($risultatoQuery[$i]['id_utenteRegistrato'],$risultatoQuery[$i]['Data_Scadenza'],$risultatoQuery[$i]['Data_Inizio']);
                $tessera->setIdTessera($risultatoQuery[$i]['id_tessera']);
                $tessere[] = $tessera;
            }
            return $tessere;
        }else{ //Se non ci sono risultati, ritorna un array vuoto
            return array();
        }
    }
 
    //Metodo per associare i valori dell'oggetto Tessera ai parametri della dichiarazione SQL
    public static function bind($dichiarazione,$tessera){
        $dichiarazione->bindValue(':Data_Scadenza',$tessera->getDataScadenza(),PDO::PARAM_STR);
        $dichiarazione->bindValue(':Data_Inizio',$tessera->getDataInizio(),PDO::PARAM_STR);
        $dichiarazione->bindValue(':id_tessera',$tessera->getIdTessera(),PDO::PARAM_INT);
        $dichiarazione->bindValue(':id_utenteRegistrato', $tessera->getIdUtente(), PDO::PARAM_INT);
    }

    //Metodo per verificare se un oggetto esiste nel DB
    public static function verifica($campo,$id_tessera){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_tessera);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo per ottenere un oggetto Tessera dal DB
    public static function getOgg($id_tessera){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_tessera);
        if(count($risultato) > 0){
            $tessera = self::creaOggTessera($risultato);
            return $tessera;
        }else{
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
                    FEntityManager::getIstanza()->updateOgg(self::getTabella(), $fv[0], $fv[1], self::getChiave(), $ogg->getId());
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

    public static function VerificaTesseramentoUtente($pdo,$idutente){
        $sql = "SELECT id_utenteRegistrato FROM Tessera WHERE id_utenteRegistrato = :id_utenteRegistrato";
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([
            ':id_utenteRegistrato' => $idutente
        ]);
        return $dichiarazione->rowCount() > 0; // verifica se la query ha restituita almeno una riga , cioè se quell'utente ha effettuato un tesseramento
   }

}