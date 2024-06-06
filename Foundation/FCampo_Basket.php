<?php

class FCampo_Basket extends FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Campo_Basket"; 
    private static $valore = "(NULL,:id_campo, :copertura, :pavimento)";
    private static $chiave = "IDCampoBasket";

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

    //Metodo public che crea un oggetto campo da basket a partire dai risultati di una query
    public static function creaOggCampo_Basket($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto campo da basket
            $campo_basket = new ECampo_Basket($risultatoQuery[0]['id_campo'], $risultatoQuery[0]['copertura'], $risultatoQuery[0]['pavimento']);
            //Restituisce l'oggetto campo da basket
            return $campo_basket;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi_basket = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo da basket
                $campo_basket = new ECampo_Basket($risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['pavimento']);
                //Aggiunge l'oggetto campo da basket nell'array
                $campi_basket[] = $campo_basket;
            }
            //Restituisce l'array di oggetti campi da basket
            return $campi_basket;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo_basket){
        $dichiarazione->bindValue(":id_campo", $campo_basket->getId_campo(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":copertura", $campo_basket->getCopertura(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":pavimento", $campo_basket->getPavimento(),PDO::PARAM_STR);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id){
        //Recupera l'oggetto nel DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo da basket dal DB
    public static function getOgg($id_campo){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campo);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo da basket a partire dai risultati
            $campo_basket = self::creaOggCampo_Basket($risultato);
            //Restituisci l'oggetto campo da basket
            return $campo_basket;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
