<?php

class FCampo_Tennis extends FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "CampoTennis"; 
    private static $valore = "(NULL, :copertura, :id_campo, :terreno)";
    private static $chiave = "id_campoTennis";

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

    //Metodo public che crea un oggetto campo da tennis a partire dai risultati di una query
    public static function creaOggCampo_Tennis($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto campo da tennis
            $campo_tennis = new ECampo_Tennis($risultatoQuery[0]['id_campoTennis'], $risultatoQuery[0]['copertura'], $risultatoQuery[0]['id_campo'], $risultatoQuery[0]['terreno'],$risultatoQuery[0]['fotocampo']);
            //Restituisce l'oggetto campo da tennis
            return $campo_tennis;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi_tennis = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo da tennis
                $campo_tennis = new ECampo_Tennis($risultatoQuery[$i]['id_campoTennis'], $risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['terreno'],$risultatoQuery[0]['fotocampo']);
                //Aggiunge l'oggetto campo da tennis nell'array
                $campi_tennis[] = $campo_tennis;
            }
            //Restituisce l'array di oggetti campi da tennis
            return $campi_tennis;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisci un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo_tennis){
        $dichiarazione->bindValue(":id_campoTennis", $campo_tennis->getIdCampoTennis(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":copertura", $campo_tennis->getCopertura(),PDO::PARAM_STR);
        $dichiarazione->bindValue("id_campo", $campo_tennis->getId_attrezzatura(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":terreno", $campo_tennis->getTerreno(),PDO::PARAM_STR);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_campoTennis){
        //Recupera l'oggetto nel DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_campoTennis);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo da tennis dal DB
    public static function getOgg($id_campoTennis){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campoTennis);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo da tennis a partire dai risultati
            $campo_tennis = self::creaOggCampo_Tennis($risultato);
            //Restituisci l'oggetto campo da tennis
            return $campo_tennis;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
