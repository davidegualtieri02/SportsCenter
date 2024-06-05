<?php

class FAttrezzatura_Padel extends FAttrezzatura{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Attrezzatura_Padel"; 
    private static $valore = "(NULL,:id_attrezzatura,:numPalla_Padel,:numRacchetta_Padel)";
    private static $chiave = "IDAttrezzatura";

    //Metodi public che restituiscono il nome della tabella, il valore, la classe e la chiave
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

    //Metodo public che crea un oggetto attrezzatura a partire dai risultati di una query
    public static function creaOggAttrezzatura_Padel($risultatoQuery){
        //Se la query restituisce un solo risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura
            $attrezzatura_padel = new EAttrezzatura_Padel($risultatoQuery[0]['id_attrezzatura'], $risultatoQuery[0]['numPalla_Padel'], $risultatoQuery[0]['numRacchetta_Padel']);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura_padel;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature_padel = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura
                $attrezzatura_padel = new EAttrezzatura_Padel($risultatoQuery[$i]['id_attrezzatura'], $risultatoQuery[$i]['numPalla_Padel'], $risultatoQuery[$i]['numRacchetta_Padel']);
                //Aggiungi l'oggetto attrezzatura nell'array
                $attrezzature_padel[] = $attrezzatura_padel;
            }
            //Restituisci l'oggetto attrezzatura
            return $attrezzature_padel;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura_padel){
        $dichiarazione ->bindValue(":id_attrezzatura",$attrezzatura_padel->getId_attrezzatura(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numPalla_Padel",$attrezzatura_padel->getNumPalla_Padel(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numRacchetta_Padel",$attrezzatura_padel->getNumRacchetta_Padel(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id){
        //Recupera l'oggetto dal DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto attrezzatura dal DB
    public static function getOgg($id_attrezzatura){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_attrezzatura);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto attrezzatura a partire dai risultati della query
            $attrezzatura_padel = self::creaOggAttrezzatura_Padel($risultato);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura_padel;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
