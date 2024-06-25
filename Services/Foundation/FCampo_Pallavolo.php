<?php

class FCampo_Pallavolo extends FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "CampoPallavolo"; 
    private static $valore = "(NULL,:copertura, :id_campo, :pavimento)";
    private static $chiave = "id_campoPallavolo";

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

    //Metodo public che crea un oggetto campo da pallavolo a partire dai risultati di una query
    public static function creaOggCampo_Pallavolo($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un oggetto campo da pallavolo
            $campo_pallavolo = new ECampo_Pallavolo($risultatoQuery[0]['id_campoPallavolo'], $risultatoQuery[0]['copertura'], $risultatoQuery[0]['id_campo'], $risultatoQuery[0]['pavimento'],$risultatoQuery[0]['fotocampo']);
            //Restituisce l'oggetto campo da pallavolo
            return $campo_pallavolo;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi_pallavolo = array();
            //Ciclo for per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo da pallavolo
                $campo_pallavolo = new ECampo_Pallavolo($risultatoQuery[$i]['id_campoPallavolo'], $risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['id_campo'], $risultatoQuery[$i]['pavimento'],$risultatoQuery[0]['fotocampo']);
                //Aggiunge l'oggetto campo da pallavolo nell'array
                $campi_pallavolo[] = $campo_pallavolo;
            }
            //Restituisce l'array di oggetti campi da pallavolo
            return $campi_pallavolo;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo_pallavolo){
        $dichiarazione->bindValue(":id_campoPallavolo", $campo_pallavolo->getIdCampoPallavolo(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":copertura", $campo_pallavolo->getCopertura(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":id_campo", $campo_pallavolo->getId_attrezzatura(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":pavimento", $campo_pallavolo->getPavimento(),PDO::PARAM_STR);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_campoPallavolo){
        //Recupera l'oggetto nel DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_campoPallavolo);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo da pallavolo dal DB
    public static function getOgg($id_campoPallavolo){
        //Recupera l'oggetto dal DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campoPallavolo);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo da pallavolo a partire dai risultati
            $campo_pallavolo = self::creaOggCampo_Pallavolo($risultato);
            //Restituisci l'oggetto campo da pallavolo
            return $campo_pallavolo;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }
}
