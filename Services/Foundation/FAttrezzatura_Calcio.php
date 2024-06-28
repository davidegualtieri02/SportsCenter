<?php

class FAttrezzatura_Calcio extends FAttrezzatura{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "AttrezzaturaCalcio"; 
    private static $valore = "(NULL,:numPalloni_Calcio,:id_attrezzatura,:numCasacca)";
    private static $chiave = "id_attrezzaturaCalcio";

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

    //Metodo public che crea un oggetto attrezzatura da calcio a partire dai risultati di una query
    public static function creaOggAttrezzatura_Calcio($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura da calcio
            $attrezzatura_calcio = new EAttrezzatura_Calcio($risultatoQuery[0]['numPalloni_Calcio'], $risultatoQuery[0]['numCasacca']);
            $attrezzatura_calcio->setIdAttrezzaturaCalcio('id_attrezzaturaCalcio');
            //Restituisce l'oggetto attrezzatura da calcio
            return $attrezzatura_calcio;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature_calcio = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura da calcio
                $attrezzatura_calcio = new EAttrezzatura_Calcio($risultatoQuery[$i]['numPalloni_Calcio'],$risultatoQuery[$i]['numCasacca']);
                $attrezzatura_calcio->setIdAttrezzaturaCalcio('id_attrezzaturaCalcio');
                //Aggiunge l'oggetto attrezzatura da calcio nell'array
                $attrezzature_calcio[] = $attrezzatura_calcio;
            }
            //Restituisce l'array di oggetti attrezzatura da calcio
            return $attrezzature_calcio;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura_calcio){
        $dichiarazione ->bindValue(":id_attrezzaturaCalcio",$attrezzatura_calcio->getIdAttrezzaturaCalcio(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numPalloni_Calcio",$attrezzatura_calcio->getNumPalloni_Calcio(),PDO::PARAM_INT);
       // $dichiarazione ->bindValue("id_attrezzatura",$attrezzatura_calcio->getId_attrezzatura(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numCasacca",$attrezzatura_calcio->getNumCasacca(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_attrezzaturaCalcio){
        //Recupera l'oggetto dal DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_attrezzaturaCalcio);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto attrezzatura da calcio dal DB
    public static function getOgg($id_attrezzaturaCalcio){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_attrezzaturaCalcio);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto attrezzatura da calcio a partire dai risultati della query
            $attrezzatura_calcio = self::creaOggAttrezzatura_Calcio($risultato);
            //Restituisce l'oggetto attrezzatura da calcio
            return $attrezzatura_calcio;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
