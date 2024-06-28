<?php

class FCampo_Padel extends FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "CampoPadel"; 
    private static $valore = "(NULL,:copertura,:id_campo)";
    private static $chiave = "id_campoPadel";

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

    //Metodo public che crea un oggetto campo da padel a partire dai risultati di una query
    public static function creaOggCampo_Padel($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto campo da padel
            $campo_padel = new ECampo_Padel($risultatoQuery[0]['id_campoPadel'], $risultatoQuery[0]['copertura'], $risultatoQuery[0]['id_campo'],$risultatoQuery[0]['fotocampo']);
            $campo_padel->setId_campo($risultatoQuery[0]['id_campoPadel']);
            //Restituisce l'oggetto campo da padel
            return $campo_padel;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi_padel = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo da padel
                $campo_padel = new ECampo_Padel($risultatoQuery[$i]['id_campoPadel'], $risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['id_campo'],$risultatoQuery[0]['fotocampo']);
                $campo_padel->setId_campo($risultatoQuery[$i]['id_campoPadel']);
                //Aggiunge l'oggetto campo da padel nell'array
                $campi_padel[] = $campo_padel;
            }
            //Restituisce l'array di oggetti campi da padel
            return $campi_padel;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo_padel){
        $dichiarazione->bindValue(":id_campoPadel", $campo_padel->getId_campo(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":copertura", $campo_padel->getCopertura(),PDO::PARAM_STR);
        //$dichiarazione->bindValue("id_campo", $campo_padel->getId_attrezzatura(),PDO::PARAM_INT);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_campoPadel){
        //Recupera l'oggetto nel DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_campoPadel);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo da padel dal DB
    public static function getOgg($id_campoPadel){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campoPadel);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo da padel a partire dai risultati
            $campo_padel = self::creaOggCampo_Padel($risultato);
            //Restituisci l'oggetto campo da padel
            return $campo_padel;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
