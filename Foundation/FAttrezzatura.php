<?php

class FAttrezzatura{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Attrezzatura"; 
    private static $valore = "(NULL,:id_attrezzatura)";
    private static $chiave = "IDAttrezzatura";

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

    //Metodo public che crea un oggetto attrezzatura a partire dai risultati di una query
    public static function creaOggAttrezzatura($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura
            $attrezzatura = new EAttrezzatura($risultatoQuery[0]['id_attrezzatura']);
            //Imposta l'ID dell'attrezzatura
            $attrezzatura->setId_attrezzatura($risultatoQuery[0]['id_attrezzatura']);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature = array();
            //Ciclo if per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura
                $attrezzatura = new EAttrezzatura($risultatoQuery[$i]['id_attrezzatura']);
                //Imposta l'ID dell'attrezzatura
                $attrezzatura->setId_attrezzatura($risultatoQuery[$i]['id_attrezzatura']);
                //Aggiunge l'oggetto attrezzatura nell'array
                $attrezzature[] = $attrezzatura;
            }
            //Restituisce l'array di oggetti attrezzatura
            return $attrezzature;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori (in questo caso solo l'ID dell'attrezzatura) ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura){
        //Lega l'ID dell'attrezzatura al parametro ":id_attrezzatura" nella dichiarazione SQL
        $dichiarazione ->bindValue(":id_attrezzatura",$attrezzatura->getId_attrezzatura(),PDO::PARAM_INT);
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
            $attrezzatura = self::creaOggAttrezzatura($risultato);
            //Restituisce l'oggetto attrezzatura
            return $attrezzatura;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
