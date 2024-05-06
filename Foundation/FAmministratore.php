<?php
class FAmministratore{ // self è una parola chiave che si riferisce alla classe stessa che stiamo implementando,attraverso self accediamo ai metodi o attributi statici della classe stessa.
    private static $tabella = "Amministratore";
    private static $valore = " (:idUtente)";
    private static $chiave = " idUtente";

    public static function getTabella(){
        return self::$tabella;//tramite self accediamo all'attributo statico tabella della classe e ritorniamo tale elemento una volta che abbiamo ottenuto l'elemento.
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
    /**
     * Il metodo con precisione prende i dati relativi all'Amministratore contenuti nella tabella Amministratore(che contiene solo un amministratore) tramite una query e crea un oggetto amministratore.
     * Metodo che crea un oggetto Amministratore utilizzando i dati del primo elemento del risultato della query . La query accede alla tabella Amministartore e siccome stiamo ipotizzando che ci sia un solo amministartore , la query recupera tali dati che saranno utili per la creazione di un oggetto amministratore e viene creto tale oggetto amministratore.
     * RisultatoQuery è il risultato di una query al database
     * Questo metodo è utile perchè quando recuperi i dati di un amministratore da un database abbiamo solo i dati grezzi , per lavorare con questi dati nel nostro codice abbiamo bisogno di un oggetto Amministratore perciò lo creiamo.
     * nella riga della creazione dell'oggetto EAmministratore con $risultatoQuery [0]['nome'] accediamo al valore del campo nome,nella prima tupla della tabella Amministratore,ovvero accediamo al valore della chiave nome nel primo array contenuto nell'arraymultidimensionale $risultatoQuery. Tale Array Multidimensionale è formato da un solo  sottoarray.
     * Con $risultato[0]['cognome'] accediamo al valore della chiave cognome(cioè al cognome vero e proprio) dell'unico Amministratore contenuto nel sottoarray dell'array multidimens.
     * La stessa logica per tutti gli altri attributi
     */
    public static function CreaOggAmministratore($risultatoQuery){
        if(count($risultatoQuery)>0){// se ci sono elementi nell'array risultatoQuery ,se c'e ne è, c'è ne è solo uno perchè abbiamo un solo amministratore.
            $amm = new EAmministratore($risultatoQuery[0]['idUtente'], $risultatoQuery[0]['nome'],$risultatoQuery[0]['cognome'],$risultatoQuery[0]['email'],$risultatoQuery[0]['password']);
           // $amm->setId($risultatoQuery[0]['IdUtente']);senza specificare(mettere) l'id nella creazione dell'oggetto mi da errore, specificando l'id nell'inizializzazione dell'oggetto non mi da l'errore
            $amm->setHashPassword($risultatoQuery[0]['password']);
            return $amm;
        }else{// se la query rida una tabella con zero righe, il metodo rida un array vuoto.
            return array();
        }
    }

}