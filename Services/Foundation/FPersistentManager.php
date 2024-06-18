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
    *@return int|null (ritorna l'id dell'oggetto aggiunta se tale oggetto è stato aggiunto al db)
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

/**
 * Metodo che elimina un elemento dal db
 * @param $tabella è la tabella da cui vogliamo eliminare un elemento
 * @param $id è il valore del campo nella clausola where , se tale campo è uguale al valore contenuto in $id viene eliminata la tupla
 * @param $campo è il campo del valore contenuto in $id
 */
    public static function deleteOgg($tabella,$id,$campo){
        $risultato = FEntityManager::deleteOgginDB($tabella,$id,$campo);
        return $risultato;
    }
   /**
    * Metodo che aggiorna il valore di un attributo di una tupla in base ad una certa condizione where.
    *@param $tabella è la tabella da cui vogliamo aggiornare il valore di un campo
    *@param $campo è il campo che vogliamo sostituire ad un altro
    *@param $campoValore è il valore del campo da sostituire
    *@param $condizione è la condizione presente nella clausola where , aggiorniamo l'elemento solo se la clausola è vera 
    *@param $Valorecondizione è il valore della clausola where
    *@return bool
    */
    public static function UpdateOgg($tabella,$campo,$campoValore,$condizione,$Valorecondizione){
        $risultato = FEntityManager::updateOgg($tabella,$campo,$campoValore,$condizione,$Valorecondizione);
        return $risultato; // ritorna true se l'elemento viene aggiornato correttamente altrimenti false.


    }

    //-------------------------------------------------------Recensione----------------------------------------------------------------------
    /**
     * Metodo che crea una recensione
     * @param $risultatoQuery
     * @return array
     */
     public static function CreaRecensione($risultatoQuery){
        $risultato = FRecensione::CreaOggRecensione($risultatoQuery);
        return $risultato;
    }
   
    /**
     * Metodo per impostare i valori degli attributi di una Recensione 
     * @param $dichiarazione è la dichiarazione del db
     * @param $recensione è la recensione stessa
     */
    public static function bindRecensione($dichiarazione,$recensione){
        FRecensione::bind($dichiarazione,$recensione);
    }
   
    /**
     * Metodo che ritorna una lista di recensioni per ogni campo
     * @param $idcampo si riferisce all'id del campo di cui vogliamo leggere le recensioni
     * @return array
     */
    public static function getListaRecensioni($idCampo){
        $risultato = FRecensione::ListarecensioniNonBannate($idCampo);
        return $risultato; // il metodo ListaRecensioniNonBannate mi rida una lista di recensioni per un determinato campo 
    }


    /**
    * Metodo che richiama un metodo per eliminare una recensione dal database
    * @param $idRecensione si riferisce all'id della recensione che vogliamo elimanare
    *@param $idUtente si riferisce all'utente che ha scritto la recensione che bisogna eliminare
    *@return bool
    */
    public static function deleteRecensione($idRecensione,$idUtente){
        $risultato = FRecensione::eliminaRecensioneDalDB($idRecensione,$idUtente);
         return $risultato; // ritorna true se la recensione è stata eleiminata correttamente.
    }
    


    //------------------------------------------------------Prenotazione------------------------------------------------------------------------
    /**
     * Metodo che crea una prenotazione
     * @param $risultatoQuery è il risultato della query che crea la prenotazione.
     * @return array
     */
    public static function CreaPrenotazione($risultatoQuery){
        $risultato =FPrenotazione::CreaOggPrenotazione($risultatoQuery);
        return $risultato; // ritorna una lista di prenotazioni o una sola se è stata fatta solo una 
    }
     /**
     * Metodo per impostare i valori degli attributi di una prenotazione
     * @param $dichiarazione è la dichiarazione del db
     * @param $prenotazione è la  prenotazione stessa
     */
    public static function bindPrenotazione($dichiarazione,$prenotazione){
        FPrenotazione::bind($dichiarazione,$prenotazione);
    }
    
    /**
     * Metodo che elimina una prenotazione dal db
     * @param $idPrenotazione si riferisce alla prenotazione che vogliamo annullare
     * @param $idUtente si riferisce all'utente che ha eseguito la prenotazione
     * @return bool
     */
    public static function deletePrenotazione($idPrenotazione,$idUtente){
        $risultato = FPrenotazione::eliminaPrenotazioneDalDB($idPrenotazione,$idUtente);
        return $risultato;
    }
   

   //-------------------------------------------------------Utente----------------------------------------------------------------------------- 
   /**
    * Metodo che crea un utente
    * @param $risultatoQuery è il risultato della query
    * @return EUtente
    */

   public static function CreaUtente($risultatoQuery){
    $risultato = FUtente::creaOggUtente($risultatoQuery);
    return $risultato;
   }

    /**
     * Metodo per impostare i valori degli attributi di un utente
     * @param $dichiarazione è la dichiarazione del db
     * @param $utente è l'utente stesso
     */
    public static function bindUtente($dichiarazione,$utente){
        FUtente::bind($dichiarazione,$utente);
    }

   /**
    * Metodo che verifica se esiste l'id di un'utente nella tabella Utente del db
    *@param $campo è il campo ID
    *@param $idUtente è il valore dell'ID
    *@return bool
    */
   public static function Verifica($campo,$idUtente){
    $risultato = FUtente::verifica($campo,$idUtente);
    return $risultato;
   }


   //-----------------------------------------------------UtenteRegistrato--------------------------------------------------------------------
   /**
    * Metodo che crea un utente registrato
    * @param $risultatoQuery è il risultato della query
    *@return EUtenteRegistrato
    */
   public static function  CreaUtenteRegistrato($risultatoQuery){
    $risultato = FUtenteRegistrato::CreaOggUtenteRegistrato($risultatoQuery);
    return $risultato;
   }

    /**
     * Metodo per impostare i valori degli attributi di un utente registrato
     * @param $dichiarazione è la dichiarazione del db
     * @param $utente è l'utente registrato stesso
     * @param $id è l'id dell'utente registrato
     */
    public static function bindUtenteRegistrato($dichiarazione,$utente,$id){
        FUtenteRegistrato::bind($dichiarazione,$utente,$id);
    }
    
  //------------------------------------------------------UtenteTesserato---------------------------------------------------------------------
   
    /**
    * Metodo che crea un utente tesserato
    * @param $risultatoQuery è il risultato della query
    *@return EUtentetesserato
    */
  public static function CreaUtenteTesserato($risultatoQuery){
    $risultato = FUtenteTesserato::CreaOggUtenteTesserato($risultatoQuery);
    return $risultato;
  }

   /**
     * Metodo per impostare i valori degli attributi di un utente tesserato
     * @param $dichiarazione è la dichiarazione del db
     * @param $utente è l'utente tesserato stesso
     * @param $id è l'id dell'utente tesserato
     */
    public static function bindUtenteTesserato($dichiarazione,$utente,$id){
        FUtenteTesserato::bind($dichiarazione,$utente,$id);
    }
//--------------------------------------------------------Image----------------------------------------------------------------------------------

/**
 * Metodo che crea un immagine
 * @param $risultatoQuery è il risultato della query da cui otteniamo l'immagine
 * @return array
 */
 public static function CreaImmagine($risultatoQuery){
    $risultato = FImage::CreaOggImage($risultatoQuery);
    return $risultato;
 }

  /**
     * Metodo per impostare i valori degli attributi di un immagine
     * @param $dichiarazione è la dichiarazione del db
     * @param $immagine è l'immagine stessa
     */
    public static function bindImage($dichiarazione,$immagine){
        FImage::bind($dichiarazione,$immagine);
    }

 //-----------------------------------------------------Carta di Pagamento----------------------------------------------------------------------

 /**
 * Metodo che crea una carta di pagamento
 * @param $risultatoQuery è il risultato della query da cui otteniamo la carta
 * @return array
 */
public static function CreaCartaPagamento($risultatoQuery){
    $risultato = FCartadiPagamento::creaOggCartadiPagamento($risultatoQuery);
    return $risultato;
 }
 /**
  * Metodo che verifica l'esistenza di una carta nel db
  *@param $campo è il campo ID 
  *@param $idCarta è il valore dell'ID 
  *@return bool
  */
public static function VerificaCarta($campo,$idCarta){
    $risultato = FCartadiPagamento::verifica($campo,$idCarta);
    return $risultato;
}
 /**
     * Metodo per impostare i valori degli attributi di una carta di pagamento
     * @param $dichiarazione è la dichiarazione del db
     * @param $carta è la carta di pagamento stessa
     */
    public static function bindCartaPagamento($dichiarazione,$carta){
        FCartadiPagamento::bind($dichiarazione,$carta);
    }


}