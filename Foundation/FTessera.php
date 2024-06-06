<?php

class FTessera{
    //Dichiarazione di variabili private statiche che contengono informazioni sulla tabella del DB, i valori e la chiave primaria
    private static $tabella = "Tessera"; 
    private static $valore = "(NULL,:Codice_Tessera,:Id_Tessera)";
    private static $chiave = "Id_Tessera";

    //Metodi per ottenere il nome della tabella, i valori, la classe e la chiave primaria
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

    //Metodo per creare un oggetto Tessera a partire dai risultati di una query
    public static function creaOggTessera($risultatoQuery){
        //Se c'è solo un risultato, crea un singolo oggetto tessera
        if(count($risultatoQuery) == 1){
            $tessera = new ETessera($risultatoQuery[0]['Codice_Tessera'], $risultatoQuery[0]['Id_Tessera']);
            $tessera->setIdTessera($risultatoQuery[0]['Id_Tessera']);
            return $tessera;
        }elseif(count($risultatoQuery) > 1){ //Se ci sono più risultati, crea un array di oggetti Tessera
            $tessere = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $tessera = new ETessera($risultatoQuery[$i]['Codice_Tessera'], $risultatoQuery[$i]['Id_Tessera']);
                $tessera->setIdTessera($risultatoQuery[$i]['Id_Tessera']);
                $tessere[] = $tessera;
            }
            return $tessere;
        }else{ //Se non ci sono risultati, ritorna un array vuoto
            return array();
        }
    }

    //Metodo per associare i valori dell'oggetto Tessera ai parametri della dichiarazione SQL
    public static function bind($dichiarazione,$tessera){
        $dichiarazione ->bindValue(":Codice_Tessera",$tessera->getCodiceTessera(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":Id_Tessera",$tessera->getIdTessera(),PDO::PARAM_INT);
    }

    //Metodo per verificare se un oggetto esiste nel DB
    public static function verifica($campo,$id){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo per ottenere un oggetto Tessera dal DB
    public static function getOgg($Id_Tessera){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $Id_Tessera);
        if(count($risultato) > 0){
            $tessera = self::creaOggTessera($risultato);
            return $tessera;
        }else{
            return null;
        }
    }
}
