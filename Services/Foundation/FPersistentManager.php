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
        //substr($classe,1) estrae una sottostringa dal nome della classe , eliminando il primo carattere e tenendo tutti gli altri. Se per esempio la classe è EUtente , il metodo rimuove la E , ottenendo Utente 
        //e al posto della E , viene posto la lettera F in modo che la classe sarà una classe del paacchetto Foundation .
        $metodoStatico = "getOgg";
        $risultato = call_user_func([$classeFound,$metodoStatico],$id);
        // call_user_func permette di chiamare una funzione o metodo specificato . in questo caso chiama il metodo contenuto in $metodoStatico
        //che è getOgg della classe $classefound che è una delle classi contenute in foundation. $id è l'ID dell'oggetto della classe, che viene usato per prendere tale oggetto dal db.
        // l'id specificato ci serve per prendere quell'oggetto dal db tramite il suo ID .
        return $risultato;// il risultato è una tupla che contiene l'oggetto , essa viene ritornata in array associativo in cui ogni valore di un campo è un elemento dell'array e i campi sono le chiavi degli elementi dell'array
        //[ $classeFound ,$metodoStatico]  specifica che si tratta di una chiamata a un metodo statico di una classe .
    }
    /**
     * Metodo che recupera le tuple di una tabella 
     */
    public static function recuperaTuple($tabella){
        $risultato = FEntityManager::recuperaTuple($tabella);
        return $risultato;
    }
    public static function recuperaOggetti($tabella,$campo,$id){
        $risultato = FEntityManager::recuperaOggetto($tabella,$campo,$id);
        return $risultato;
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
    /**
     * Metodo che aggiunge uno o più foto in una recensione
     * @param $recensione si riferisce alla recensione in cui aggiungere la/le immagini
     * @param $images si riferisce all'array di immagini
     */
    public static function AggiungiImmagini($recensione,$images){
        FRecensione::addImagesARecensione($recensione,$images);
    }
    public static function NumVolte($utente,$idcampo){
        $risultato = FRecensione::NumVoltePrenotazioni($utente,$idcampo);
        return $risultato;
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
    public static function VerificaUtenteprenotazione($pdo, $idPrenotazione, $utenteId){
        $risultato = FPrenotazione::VerificaUtentePrenotazione($pdo, $idPrenotazione, $utenteId);
        return $risultato;
    }
    
    public static function orariDisponibili($giorno){
        $risultato= FPrenotazione::orariDisponibili($giorno);
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
   //-----------------------------------------------------Amministratore-------------------------------------------------------------------------------
   /**
    * Metodo che crea un amministratore
    * @param $risultatoQuery è il risultato della query
    * @return EAmministratore
    */

    public static function CreaAmministratore($risultatoQuery){
        $risultato = FAmministratore::CreaOggAmministratore($risultatoQuery);
        return $risultato;
       }
    
        /**
         * Metodo per impostare i valori degli attributi di un amministratore
         * @param $dichiarazione è la dichiarazione del db
         * @param $amministratore è l'amministratore stesso
         */
        public static function bindAmministratore($dichiarazione,$id,$amministratore){
            FAmministratore::bind($dichiarazione,$id,$amministratore);
        }


   //-----------------------------------------------------UtenteRegistrato-------------------------------------------------------------------------------
   /**
    * Metodo che crea un utente registrato
    * @param $risultatoQuery è il risultato della query
    *@return EUtenteRegistrato
    */
   public static function CreaUtenteRegistrato($risultatoQuery){
    $risultato = FUtenteRegistrato::CreaOggUtenteRegistrato($risultatoQuery);
    return $risultato;
   }

    /**
     * Metodo per impostare i valori degli attributi di un utente registrato
     * @param $dichiarazione è la dichiarazione del db
     * @param $utente è l'utente registrato stesso
     * @param $id è l'id dell'utente registrato
     */
    public static function bindUtenteRegistrato($dichiarazione,$id){
        FUtenteRegistrato::bind($dichiarazione,$id);
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

    //--------------------------------------------------------ImageCampo----------------------------------------------------------------------------------

/**
 * Metodo che crea un immagine
 * @param $risultatoQuery è il risultato della query da cui otteniamo l'immagine
 * @return array
 */
 public static function CreaImmagineCampo($risultatoQuery){
    $risultato = FImageCampo::CreaOggImage($risultatoQuery);
    return $risultato;
 }

  /**
     * Metodo per impostare i valori degli attributi di un immagine
     * @param $dichiarazione è la dichiarazione del db
     * @param $immagine è l'immagine stessa
     */
    public static function bindImageCampo($dichiarazione,$immagine){
        FImageCampo::bind($dichiarazione,$immagine);
    }

    public static function campoeImageCampo($id_campo){
        $campo = self::recuperaOggetto(FCampo::getClasse(), $id_campo);
        $arrayData = array($campo, self::recuperaOggetto(FImageCampo::getClasse(), $campo->getIdimageCampo()));
        $result[] = $arrayData;
        return $result;
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
     * Metodo per verficare se il pagamento è andato a buon fine 
     * @param $numeroCarta si riferisce al numero della carta
     * @param $scadenza si riferisce alla data di scadenza della carta
     * @param $cvvCarta ri riferisce al codice CVV della carta
     */
    public static function ProcessoPag($nomeProprietario,$cognomeProprietario,$numeroCarta,$scadenza,$cvvCarta){
        $risultato = FCartadiPagamento::processodiPagamento($nomeProprietario,$cognomeProprietario,$numeroCarta,$scadenza,$cvvCarta);
        return $risultato;

    }
    public static function bindCartaPagamento($dichiarazione,$carta){
        FCartadiPagamento::bind($dichiarazione,$carta);
    }
    
//----------------------------------------------------Campo------------------------------------------------------------------------------------
    /**
     * Metodo che crea un oggetto Campo
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampo($risultatoQuery){
        $risultato = FCampo::creaOggCampo($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto campo
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo
     */
    public static function bindCampo($dichiarazione,$campo){
        FCampo::bind($dichiarazione,$campo);
    }
     /**
    * Metodo che verifica l'esistenza di un campo nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampo($campo,$idCampo){
    $risultato = FCampo::verifica($campo,$idCampo);
   return $risultato;
   }
   
   /**
    * Metodo che verifica la disponibilità del campo 
    *@param $idCampo è l'id del campo
    *@param $Dprenotazione è a data della prenotazione 
    *@param $Oprenotazione è l'orario della prenotazione
    *@return boolean
    */
    public static function campoDisponibile($pdo,$idCampo,$Dprenotazione,$Oprenotazione){
        $risultato = Fcampo::CampoDisponibile($pdo,$idCampo,$Dprenotazione,$Oprenotazione);
        return $risultato;
   }

//----------------------------------------------------CampoTennis---------------------------------------------------------------------------
 /**
     * Metodo che crea un oggetto Campo da tennis
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampotennis($risultatoQuery){
        $risultato = FCampo_Tennis::creaOggCampo_Tennis($risultatoQuery);
        return $risultato;
    }

    /**
     * Metodo che associa valori ad un oggetto campo da tennis
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo da tennis
     */
    public static function bindCampoTennis($dichiarazione,$campo){
        FCampo_Tennis::bind($dichiarazione,$campo);
    }

     /**
    * Metodo che verifica l'esistenza di un campo da tennis nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampoTennis($campo,$idCampo){
    $risultato = FCampo_Tennis::verifica($campo,$idCampo);
   return $risultato;
   }

   //-------------------------------------------------CampoPallavolo---------------------------------------------------------------------------
    /**
     * Metodo che crea un oggetto Campo da pallavolo
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampoPallavolo($risultatoQuery){
        $risultato = FCampo_Pallavolo::creaOggCampo_Pallavolo($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto campo da pallavolo
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo da pallavolo
     */
    public static function bindCampoPallavolo($dichiarazione,$campo){
        FCampo_Pallavolo::bind($dichiarazione,$campo);
    }
     /**
    * Metodo che verifica l'esistenza di un campo da pallavolo nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampoPallavolo($campo,$idCampo){
    $risultato = FCampo_Pallavolo::verifica($campo,$idCampo);
   return $risultato;
   }

   //-----------------------------------------------CampoPadel-----------------------------------------------------------------------------------
    /**
     * Metodo che crea un oggetto Campo da padel
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampoPadel($risultatoQuery){
        $risultato = FCampo_Padel::creaOggCampo_Padel($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto campo da padel
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo da padel
     */
    public static function bindCampoPadel($dichiarazione,$campo){
        FCampo_Padel::bind($dichiarazione,$campo);
    }
     /**
    * Metodo che verifica l'esistenza di un campo da padel nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampoPadel($campo,$idCampo){
    $risultato = FCampo_Padel::verifica($campo,$idCampo);
   return $risultato;
   }

   //-----------------------------------------------Campocalcio---------------------------------------------------------------------------------
    /**
     * Metodo che crea un oggetto Campo da calcio
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampoCalcio($risultatoQuery){
        $risultato = FCampo_Calcio::creaOggCampo_Calcio($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto campo da calcio
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo da calcio
     */
    public static function bindCampoCalcio($dichiarazione,$campo){
        FCampo_Calcio::bind($dichiarazione,$campo);
    }
     /**
    * Metodo che verifica l'esistenza di un campo da calcio nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampoCalcio($campo,$idCampo){
    $risultato = FCampo_Calcio::verifica($campo,$idCampo);
   return $risultato;
   }
   //---------------------------------------------Campobasket--------------------------------------------------------------------------------------

    /**
     * Metodo che crea un oggetto Campo da basket
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaCampoBasket($risultatoQuery){
        $risultato = FCampo_Basket::creaOggCampo_Basket($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto campo da basket
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $campo si riferisce all'oggetto campo da basket
     */
    public static function bindCampoBasket($dichiarazione,$campo){
        FCampo_Basket::bind($dichiarazione,$campo);
    }
     /**
    * Metodo che verifica l'esistenza di un campo da basket nel db
    *@param $campo è il campo ID 
    *@param $idCampo è il valore dell'ID 
    *@return bool
    */
   public static function VerificaCampoBasket($campo,$idCampo){
    $risultato = FCampo::verifica($campo,$idCampo);
   return $risultato;
   }
//---------------------------------------------------Attrezzatura-------------------------------------------------------------------------------------

 /**
     * Metodo che crea un oggetto attrezzatura
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzatura($risultatoQuery){
        $risultato = FAttrezzatura::creaOggAttrezzatura($risultatoQuery);
        return $risultato;
    }
    
    
     /**
    * Metodo che verifica l'esistenza di una attrezzatura nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzatura($campo,$idAttrezzatura){
    $risultato = FAttrezzatura::verifica($campo,$idAttrezzatura);
   return $risultato;
   }
   //---------------------------------------------AttrezzaturaTennis----------------------------------------------------------------------------------
   /**
     * Metodo che crea un oggetto attrezzatura da tennis
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzaturaTennis($risultatoQuery){
        $risultato = FAttrezzatura_Tennis::creaOggAttrezzatura_Tennis($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto attrezzatura da tennis
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $attrezzatura si riferisce all'oggetto attrezzatura da tennis
     */
    public static function bindAttrezzaturaTennis($dichiarazione,$attrezzatura){
        FAttrezzatura_Tennis::bind($dichiarazione,$attrezzatura);
    }
     /**
    * Metodo che verifica l'esistenza di una attrezzatura da tennis nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzaturaTennis($campo,$idAttrezzatura){
    $risultato = FAttrezzatura_Tennis::verifica($campo,$idAttrezzatura);
   return $risultato;
   }

   //------------------------------------------------AttrezzaturaPallavolo----------------------------------------------------------------------
   /**
     * Metodo che crea un oggetto attrezzatura da pallavolo
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzaturaPallavolo($risultatoQuery){
        $risultato = FAttrezzatura_Pallavolo::creaOggAttrezzatura_Pallavolo($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto attrezzatura da Pallavolo
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $attrezzatura si riferisce all'oggetto attrezzatura da pallavolo
     */
    public static function bindAttrezzaturaPallavolo($dichiarazione,$attrezzatura){
        FAttrezzatura_Pallavolo::bind($dichiarazione,$attrezzatura);
    }
     /**
    * Metodo che verifica l'esistenza di una attrezzatura da pallavolo nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzaturaPallavolo($campo,$idAttrezzatura){
    $risultato = FAttrezzatura_Pallavolo::verifica($campo,$idAttrezzatura);
   return $risultato;
   }
   //--------------------------------------------AttrezzaturaPadel---------------------------------------------------------------------------------
   /**
     * Metodo che crea un oggetto attrezzatura da padel
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzaturaPadel($risultatoQuery){
        $risultato = FAttrezzatura_Padel::creaOggAttrezzatura_Padel($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto attrezzatura da padel
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $attrezzatura si riferisce all'oggetto attrezzatura da padel
     */
    public static function bindAttrezzaturaPadel($dichiarazione,$attrezzatura){
        FAttrezzatura_Padel::bind($dichiarazione,$attrezzatura);
    }
     /**
    * Metodo che verifica l'esistenza di una attrezzatura da padel nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzaturaPadel($campo,$idAttrezzatura){
    $risultato = FAttrezzatura_Padel::verifica($campo,$idAttrezzatura);
   return $risultato;
   }

   //------------------------------------------------AttrezzaturaCalcio----------------------------------------------------------------------------
   /**
     * Metodo che crea un oggetto attrezzatura da calcio
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzaturaCalcio($risultatoQuery){
        $risultato = FAttrezzatura_Calcio::creaOggAttrezzatura_Calcio($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto attrezzatura da calcio
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $attrezzatura si riferisce all'oggetto attrezzatura da calcio
     */
    public static function bindAttrezzaturaCalcio($dichiarazione,$attrezzatura){
        FAttrezzatura_Calcio::bind($dichiarazione,$attrezzatura);
    }
     /**
    * Metodo che verifica l'esistenza di una attrezzatura da calcio nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzaturaCalcio($campo,$idAttrezzatura){
    $risultato = FAttrezzatura_Calcio::verifica($campo,$idAttrezzatura);
   return $risultato;
   }
   //---------------------------------------------AttrezzaturaBasket------------------------------------------------------------------------------
   /**
     * Metodo che crea un oggetto attrezzatura da basket
     * @param $risultatoQuery si riferisce al risultato della query
     * @return array
     */
    public static function CreaAttrezzaturaBasket($risultatoQuery){
        $risultato = FAttrezzatura_Basket::creaOggAttrezzatura_Basket($risultatoQuery);
        return $risultato;
    }
    /**
     * Metodo che associa valori ad un oggetto attrezzatura da basket
     * @param $dichiarazione si riferisce all'oggetto dichiarazione del db
     * @param $attrezzatura si riferisce all'oggetto attrezzatura da basket
     */
    public static function bindAttrezzaturaBasket($dichiarazione,$attrezzatura){
        FAttrezzatura_Basket::bind($dichiarazione,$attrezzatura);
    }
     /**
    * Metodo che verifica l'esistenza di una attrezzatura da basket nel db
    *@param $campo è il campo ID 
    *@param $idAttrezzatura è il valore dell'ID 
    *@return bool
    */
   public static function VerificaAttrezzaturaBasket($campo,$idAttrezzatura){
    $risultato = FAttrezzatura_Basket::verifica($campo,$idAttrezzatura);
   return $risultato;
   }

   //--------------------------------------------------Verifica--------------------------------------------------------------------------------------------
   /**
    * Metodo che verifica un'email se si trova nel db
    *@param $email è l'id dell'email 
    *@return boolean
    */
   public static function VerificaEmailUtente($email){
    $risultato = FUtenteRegistrato::verifica('email',$email);
    return $risultato;
   }
   
   public static function VerificaPasswordUtente($pass){
    $risultato = FUtenteRegistrato::verifica('password', $pass);
    return $risultato;
   }
   //---------------------------------------------------------------------------------------------------------------------------------------------------
   public static function recuperaUtenteDaEmail($email){
    $risultato= FUtenteRegistrato::getUtenteByEmail($email);
    return $risultato;
   }
   public static function recuperaAmmDaEmail($email){
    $risultato = FAmministratore::getAmmByEmail($email);
    return $risultato;
   }
    public static function updatePasswordUtente($utenteRegistrato){
        $campo = [['password',$utenteRegistrato->getPassword()]];// campo è un arraymultidimensionale che ha una coppia chiave valore che sono 'password' (chiave) e $utenteRegistrato->getPassword() (valore)
        $risultato= FUtenteRegistrato::salvaOgg($utenteRegistrato,$campo);
        return $risultato;
    }
    public static function updateBanUtente($utente) {
        $newBanState = !(FUtenteRegistrato::isBanned($utente));
        $risultato = self::UpdateOgg(FUtenteRegistrato::getTabella(),'ban',(int)$newBanState,'id_utenteRegistrato',FUtenteRegistrato::getId($utente));
        return $risultato;
    }
    public static function VerificaTesseramento($pdo,$idutente){
        $risultato = FTessera::VerificaTesseramentoUtente($pdo,$idutente);
        return $risultato;
    }
}