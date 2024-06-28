<?php

class FCampo_Calcio extends FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "CampoCalcio"; 
    private static $valore = "(NULL,:copertura,:id_campo)";
    private static $chiave = "id_campoCalcio";

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

    //Metodo public che crea un oggetto campo da calcio a partire dai risultati di una query
    public static function creaOggCampo_Calcio($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto campo da calcio
            $campo_calcio = new ECampo_Calcio($risultatoQuery[0]['copertura'], $risultatoQuery[0]['fotocampo'], $risultatoQuery[0]['titoloCampo'],$risultatoQuery[0]['prezzo']);
            $campo_calcio->setId_campo($risultatoQuery[0]['id_campoCalcio']);
            //Aggiunge l'oggetto campo da calcio nell'array);
            //Restituisce l'oggetto campo da calcio
            return $campo_calcio;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi_calcio = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo da calcio
                $campo_calcio = new ECampo_Calcio($risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['fotocampo'], $risultatoQuery[$i]['titoloCampo'],$risultatoQuery[$i]['prezzo']);
                $campo_calcio->setId_campo($risultatoQuery[$i]['id_campoCalcio']);
                //Aggiunge l'oggetto campo da calcio nell'array
                $campi_calcio[] = $campo_calcio;
            }
            //Restituisce l'array di oggetti campi da calcio
            return $campi_calcio;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo_calcio){
        $dichiarazione->bindValue(":id_campoCalcio", $campo_calcio->getId_campo(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":copertura", $campo_calcio->getCopertura(),PDO::PARAM_STR);
       // $dichiarazione->bindValue(":copertura", $campo_calcio->getId_attrezzatura(),PDO::PARAM_INT);
       $dichiarazione->bindValue(" :fotocampo",$campo_calcio->getFotoCampo(),PDO::PARAM_LOB);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_campoCalcio){
        //Recupera l'oggetto nel DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_campoCalcio);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo da calcio dal DB
    public static function getOgg($id_campoCalcio){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campoCalcio);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo da calcio a partire dai risultati
            $campo_calcio = self::creaOggCampo_Calcio($risultato);
            //Restituisci l'oggetto campo da calcio
            return $campo_calcio;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
