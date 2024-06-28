<?php

class FAttrezzatura_Pallavolo extends FAttrezzatura{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "AttrezzaturaPallavolo"; 
    private static $valore = "(NULL,:numPalla_Pallavolo,:id_attrezzatura)";
    private static $chiave = "id_attrezzaturaPallavolo";

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

    //Metodo public che crea un oggetto attrezzatura da pallavolo a partire dai risultati di una query
    public static function creaOggAttrezzatura_Pallavolo($risultatoQuery){
        //Se la query restituisce un solo risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto attrezzatura da pallavolo
            $attrezzatura_pallavolo = new EAttrezzatura_Pallavolo($risultatoQuery[0]['numPalla_Pallavolo']);
            //Restituisce l'oggetto attrezzatura da pallavolo
            return $attrezzatura_pallavolo;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $attrezzature_pallavolo = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto attrezzatura da pallavolo
                $attrezzatura_pallavolo = new EAttrezzatura_Pallavolo($risultatoQuery[$i]['numPalla_Pallavolo']);
                //Aggiunge l'oggetto attrezzatura da pallavolo nell'array
                $attrezzature_pallavolo[] = $attrezzatura_pallavolo;
            }
            //Restituisce l'array di oggetti attrezzatura da pallavolo
            return $attrezzature_pallavolo;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$attrezzatura_pallavolo){
        //$dichiarazione ->bindValue(":id_attrezzaturaPallavolo",$attrezzatura_pallavolo->getIdAttrezzaturaPallavolo(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":numPalla_Pallavolo",$attrezzatura_pallavolo->getNumPalla_Pallavolo(),PDO::PARAM_INT);
       // $dichiarazione ->bindValue(":id_attrezzatura", $attrezzatura_pallavolo->getId_attrezzatura(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_attrezzaturaPallavolo){
        //Recupera l'oggetto dal DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_attrezzaturaPallavolo);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto attrezzatura da pallavolo dal DB
    public static function getOgg($id_attrezzaturaPallavolo){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_attrezzaturaPallavolo);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto attrezzatura da pallavolo a partire dai risultati della query
            $attrezzatura_pallavolo = self::creaOggAttrezzatura_Pallavolo($risultato);
            //Restituisce l'oggetto attrezatura da pallavolo
            return $attrezzatura_pallavolo;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
