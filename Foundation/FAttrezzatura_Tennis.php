<?php

class FAttrezzatura_Tennis extends FAttrezzatura{
    //Definizione delle variabili private che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Attrezzatura_Tennis"; 
    private static $valore = "(NULL,:id_attrezzatura,:numPalla_Tennis,:numRacchetta_Tennis)";
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
    public static function creaOggAttrezzatura_Tennis($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura
            $attrezzatura_tennis = new EAttrezzatura_Tennis($risultatoQuery[0]['id_attrezzatura'], $risultatoQuery[0]['numPalla_Tennis'], $risultatoQuery[0]['numRacchetta_Tennis']);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura_tennis;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature_tennis = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura
                $attrezzatura_tennis = new EAttrezzatura_Tennis($risultatoQuery[$i]['id_attrezzatura'], $risultatoQuery[$i]['numPalla_Tennis'], $risultatoQuery[$i]['numRacchetta_Tennis']);
                //Aggiunge l'oggetto attrezzatura nell'array
                $attrezzature_tennis[] = $attrezzatura_tennis;
            }
            //Restituisce l'array di oggetti attrezzatura
            return $attrezzature_tennis;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura_tennis){
        $dichiarazione ->bindValue(":id_attrezzatura",$attrezzatura_tennis->getId_attrezzatura(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numPalla_Tennis",$attrezzatura_tennis->getNumPalla_Tennis(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numRacchetta_Tennis",$attrezzatura_tennis->getNumRacchetta_Tennis(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id){
        //Recupera l'oggetto nel DB
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
            $attrezzatura_tennis = self::creaOggAttrezzatura_Tennis($risultato);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura_tennis;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
