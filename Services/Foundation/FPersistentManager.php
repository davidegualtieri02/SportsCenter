<?php
class FPersistentManager{
    /**
     * Singleton Class
     */
    private static $istanza;


    private function _construct(){
    // non può essere creato un oggetto di questa classe al di fuori della classe stessa siccome il costruttore è privato
    //in tale modo si implementa il pattern singleton, in cui abbiamo una sola istanza dell'oggetto Persistent Manager contenuta nella classe stessa PersistentManager.
    }
    /**
     * Metodo per creare un'istanza del PersistentManager
     */
    public static function getIstanza(){// self si riferisce alla classe stessa PersistentManager
        if(!self::$istanza){ // se $istanza è null, cioè non è stata creata in passato , viene creata una nuova istanza e viene ritornata l'istanza
            self::$istanza = new self();
        }
        return self::$istanza; // se l'istanza esiste gia viene ritornata semplicemente l'istanza , senza che il metodo getIstanza() ne crei una nuova 
    }

    //---------------------------------------Direttamente con l'Entity Manager-----------------------------------------------------------------


    /**
     * metodo che restituisce un oggetto specificando la classe e un id 
     * @param string $classe si riferisce alla classe entity di appartenenza dell'oggetto da prelevare dal db
     * @param int $id si riferisce all'id dell'oggetto 
     * @return mixed 
     */
    //mixed perchè mi ritorna una tupla i cui valori possono essere di + tipi 
    public static function recuperaOggetto($classe,$id){ // $classe contiene il nome della classe passata come parametro alla funzione 
        $classeFound = "F" . substr($classe,1); 
        //substr($classe,1) estrae una sottostringa dal nome della classe , eliminando il primo carttere e tenendo tutti gli altri. Se per esempio la classe è EUtente , il metodo rimuove la E , ottenendo Utente 
        //e al posto della E , viene posto la lettera F in modo che la classe sarà una classe del paacchetto Foundation .
        $metodoStatico = " getOgg";
        $risultato = call_user_func([$classeFound,$metodoStatico],$id);
        // call_user_func permette di chiamare una funzione o metodo specificato . in questo caso chiama il metodo contenuto in $metodoStatico
        //che è getOgg della classe $classefound che è una delle classi contenute in foundation. $id è l'ID dell'oggetto della classe, che viene usato per prendere tale oggetto dal db.
        // l'id specificato ci serve per prendere quell'oggetto dal db tramite il suo ID .
        return $risultato;// il risultato è una tupla che contiene l'oggetto , essa viene ritornata in array associativo in cui ogni valore di un campo è un elemento dell'array e i campi sono le chiavi degli elementi dell'array
        //[ $classeFound ,$metodoStatico]  specifica che si tratta di una chiamata a un metodo statico di una classe .
    }
    


   /**
    * Metodo che carica un oggetto nel database
    * @param object $ogg si riferisce all'oggetto da caricare nel db
    */
    public static function uploadOgg($ogg){
        $classeFound = "F" . substr(get_class($ogg),1);
        //get_class è un metodo di php che mi rida la classe dell'oggetto passato come paarmetro .
        //per il resto il metodo è molto simile a quello sopra solo che mi aggiorna lo stato di un oggetto nel db
        $metodoStatico = "salvaOgg";
        $risultato = call_user_func([$classeFound,$metodoStatico],$ogg);// viene richiamato con questo metodo il metodo contenuto in $metodoStatico di una delle classi foundation contenute in $classeFound.
        // in questo caso viene richiamato il metodo salvaOgg , infatti carichiamo l'oggetto $ogg nel db .
        return $risultato;
    }

    //-------------------------------------------------------Recensione----------------------------------------------------------------------
    /**
     * Metodo che ritorna una lista di recensioni per ogni campo
     * @param $idcampo si riferisce all'id del campo di cui vogliamo leggere le recensioni
     */
    public static function getListaRecensioni($idCampo){
        $risultato = FRecensione::ListarecensioniNonBannate($idCampo);
        return $risultato; // il metodo ListaRecensioniNonBannate mi rida una lista di recensioni per un determinato campo 
    }


    /**
    * Metodo che richiama un metodo per eliminare una recensione dal database
    * @param $idRecensione si riferisce all'id della recensione che vogliamo elimanare
    *@param $idUtente si riferisce all'utente che ha scritto la recensione che bisogna eliminare
    */
    public static function deleteRecensione($idRecensione,$idUtente){
        $risultato = FRecensione::eliminaRecensioneDalDB($idRecensione,$idUtente);
         return $risultato; // ritorna true se la recensione è stata eleiminata correttamente.
    }
    


    //------------------------------------------------------Prenotazione------------------------------------------------------------------------
                               
    /**
     * Metodo che elimina una prenotazione dal db
     * @param $idPrenotazione si riferisce alla prenotazione che vogliamo annullare
     * @param $idUtente si riferisce all'utente che ha eseguito la prenotazione
     */
    public static function deletePrenotazione($idPrenotazione,$idUtente){
        $risultato = FPrenotazione::eliminaPrenotazioneDalDB($idPrenotazione,$idUtente);
        return $risultato;
    }
    public static function  SalvaPrenotazione($Prenotazione,$fieldArray){
        $risultato= FPrenotazione::salvaOgg($Prenotazione,$fieldArray);
    }

   //------------------------------------------------------------------------------------------------------------------------------------ 


}