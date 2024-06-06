<?php

class FAttrezzatura_Basket extends FAttrezzatura{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Attrezzatura_Basket"; 
    private static $valore = "(NULL,:id_attrezzatura,:numPalla_Basket,:numCasacca)";
    private static $chiave = "IDAttrezzaturaBasket";

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

    //Metodo public che crea un oggetto attrezzatura da basket a partire dai risultati di una query
    public static function creaOggAttrezzatura_Basket($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura da basket
            $attrezzatura_basket = new EAttrezzatura_Basket($risultatoQuery[0]['id_attrezzatura'], $risultatoQuery[0]['numPalla_Basket'], $risultatoQuery[0]['numCasacca']);
            //Restituisce l'oggetto attrezzatura da basket
            return $attrezzatura_basket;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature_basket = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura da basket
                $attrezzatura_basket = new EAttrezzatura_Basket($risultatoQuery[$i]['id_attrezzatura'], $risultatoQuery[$i]['numPalla_Basket'], $risultatoQuery[$i]['numCasacca']);
                //Aggiunge l'oggetto attrezzatura da basket nell'array
                $attrezzature_basket[] = $attrezzatura_basket;
            }
            //Restituisce l'array di oggetti attrezzatura da basket
            return $attrezzature_basket;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura_basket){
        $dichiarazione ->bindValue(":id_attrezzatura",$attrezzatura_basket->getId_attrezzatura(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numPalla_Basket",$attrezzatura_basket->getNumPalla_Basket(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numCasacca",$attrezzatura_basket->getNumCasacca(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id){
        //Recupera l'oggetto dal DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto attrezzatura da basket dal DB
    public static function getOgg($id_attrezzatura){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_attrezzatura);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto attrezzatura da basket a partire dai risultati della query
            $attrezzatura_basket = self::creaOggAttrezzatura_Basket($risultato);
            //Restituisce l'oggetto attrezzatura da basket
            return $attrezzatura_basket;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
