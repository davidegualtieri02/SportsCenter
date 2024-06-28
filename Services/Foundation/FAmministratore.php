<?php
class FAmministratore{ // self è una parola chiave che si riferisce alla classe stessa che stiamo implementando, attraverso self accediamo ai metodi o attributi statici della classe stessa.
    private static $tabella = "Amministratore";
    private static $valore = "(NULL, :nome, :cognome, :password, :email, :id_utente)";
    private static $chiave = "id_amministratore";

    public static function getTabella(){
        return self::$tabella;//tramite self accediamo all'attributo statico tabella della classe e restituiamo tale elemento una volta che abbiamo ottenuto l'elemento.
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
     * Metodo che crea un oggetto Amministratore utilizzando i dati del primo elemento del risultato della query . La query accede alla tabella Amministartore e siccome stiamo ipotizzando che ci sia un solo amministartore , la query recupera i dati dell'amministratore dal database che saranno utili per la creazione di un oggetto amministratore e viene creato tale oggetto amministratore.
     * RisultatoQuery è il risultato di una query al database
     * Questo metodo è utile perchè quando recuperi i dati di un amministratore da un database abbiamo solo i dati grezzi , per lavorare con questi dati nel nostro codice abbiamo bisogno di un oggetto Amministratore perciò lo creiamo.
     * nella riga della creazione dell'oggetto EAmministratore con $risultatoQuery [0]['nome'] accediamo al valore del campo nome,nella prima tupla della tabella Amministratore,ovvero accediamo al valore della chiave nome nel primo array contenuto nell'arraymultidimensionale $risultatoQuery. Tale Array Multidimensionale è formato da un solo  sottoarray.
     * Con $risultato[0]['cognome'] accediamo al valore della chiave cognome(cioè al cognome vero e proprio) del primo elemento(cioè l'elemento 0) dell'array contenuto nell'array multidimensionale, cioè accediamo al cognome  dell'unico Amministratore contenuto nel sottoarray dell'array multidimens.
     * La stessa logica per tutti gli altri attributi
     * credo che l'array multidimensionale sia fatto cosi [['idUtente'->'1000','nome'->'mario','cognome'->rossi , 'password'->'123']], quindi con $risultato[0]['idUtente'] accediamo al valore della chiave idUtente nel primo elemento dell'array multidimensionale che è a sua volta un array(nell'array multidimensionale ho solo un array che contiene i dati dell'unico Amministratore).
     */
    public static function CreaOggAmministratore($risultatoQuery){
        if(count($risultatoQuery)>0){ // se ci sono elementi nell'array risultatoQuery ,se c'e ne è, c'è ne è solo uno perchè abbiamo un solo amministratore.
            $amm = new EAmministratore($risultatoQuery[0]['nome'],$risultatoQuery[0]['cognome'],$risultatoQuery[0]['email'],$risultatoQuery[0]['password'], $risultatoQuery[0]['id_utente']);
            $amm->setId($risultatoQuery[0]['id_utente']);//senza specificare(mettere) l'id nella creazione dell'oggetto mi da errore, specificando l'id nell'inizializzazione dell'oggetto non mi da l'errore
            $amm->setHashPassword($risultatoQuery[0]['password']);
            return $amm;
        }else{// se la query rida una tabella con zero righe, cioè non esiste l'amministratore (o meglio i dati dell'amministratore), il metodo rida un array vuoto.
            return array();
        }
    }
    /**
     * Il metodo bind assegna al segnaposto "idUtente" il valore dell'id contenuto nel parametro $id posto come parametro al metodo
     * @param $dichiarazione è la variabile con cui preparo le query . Utilizziamo il metodo preprae su un oggetto PDO per preparare la dichiarazione SQL ovvero in questo modo: $dichiarazione = $q->preprae($query) . Infine si richiama il metodo execute() sull'oggetto dichiarazione  per eseguire la query.
     * @param $id contiene l'oggetto id ( cioè il valore dell'id ) da associare al segnoposto "idUtente"-.
     */
    public static function bind ($dichiarazione,$idutente,$amministratore){
        $dichiarazione->bindValue(" :id_utente",$idutente,PDO::PARAM_INT);
        $dichiarazione->bindValue(":nome",$amministratore->getNome(),PDO::PARAM_STR); // PDO::_PARAM_INT mi dice di che tipo è il parametro (oggetto) assegnato al segnaposto, in questo caso è un intero. 
        $dichiarazione->bindValue(":cognome",$amministratore->getCognome(),PDO::PARAM_STR);
        $dichiarazione->bindValue(" :email",$amministratore->getEmail(),PDO::PARAM_STR);
        $dichiarazione->bindValue(" :password",$amministratore->getPassword(),PDO::PARAM_STR);
    }
    /**
     * Questo metodo ritorna un oggetto Amministratore.
     * siccome la classe Amministratore estende la classe Utente e utente e amministratore hanno gli stessi attributi conviene creare un database in cui tutte le classi che estendono altre classi abbiamo una sola tabella nel database ovvero se abbiamo la classe Amministratore , utentetesserato e utenteRegistrato che estendono la classe Utente e le classi che estendono la classe Utente non hanno tanti attributi in più della classe utente (classe padre) allora conviene creare nel database solo la tabella Utente in cui aggiungiamo tutti gli attributi della classe utente e gli attributi che le classi che estendono la classe utente  hanno in più rispetto alla  classe utente  ,creando nuove colonne nella tabella Utente.
     * il metodo fa si che $result sia un array che contiene tutte le tuple(contenute in altri array interni) prese dalla tabella utente che hanno come valore della chiave(attributo) = " idUtente" pari all id posto come parametro , cioè contenuto in $id. Siccome c'è un solo amministratore $result contiene un array i cui elementi sono i dati dell'amministratore che ha quell'id posto come parametro al metodo.
     *  Ricordiamo che il nostro Database è implementato in questo modo : Table per Hierarchy: In questo caso, avresti una sola tabella per tutte le classi nella gerarchia. La tabella avrebbe colonne per tutti i campi di tutte le classi. Quindi, se la classe Amministratore estende la classe Utente e ha un campo extra chiamato AmministratoreField, la nostra tabella utente avrebbe una colonna per AmministratoreField. Potremmo avere un’altra colonna per indicare il tipo di ogni riga.
     */
    public static function getOgg($id_amministratore){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto( FUtente::getTabella(),FAmministratore::getChiave(),$id_amministratore);//il metodo recuperaOggetto mi rida un array . FentityManager::getIstanza() è un metodo statico che mi rida l'unica istanza della classe entity manager con la quale richiamo il metodo recuperaOgetto(). A tale metodo passo come parametro una tabella contenuta nel database cioè la tabella Utente, con FAmministratore::getChiave() accedo al campo id , cioè accedo alla colonna degli id (potrei farlo sia con  FAmministraotore che con FUtente visto che sia  Famministratore che FUtente hanno gli stessi attributi tra cui l'attributo  id e dunque pongo FAmministratore::getChiave per risaltare il fatto che sto accedendo al valore dell'id dell'amministratore nella tabella Utente del database che ha gli stessi attributi di Amministratore)
        if (count($risultato)>0){// se $result contiene l'unico array con i dati dell'unico amministratore  , cioè se $risultato contiene almeno un elemento
            $amm = self::CreaOggAmministratore($risultato);// cosi con self usiamo un metodo della classe amministratore che crea un oggetto amministratore passando al metodo CreaOggAmministratore() l'array multidimensionale $risultato
            return $amm;
        }else{
            return null;
        }
    }
    /**
     * Il metodo salva un oggetto Amministratore nel db associando a tale oggetto un Id.
     * @param $obj si riferisce all'oggetto amministratore da salvare nel db
     * 
     */
    public static function salvaOgg($obj){
        $salvaUtente = FEntityManager::getIstanza()->SalvaOgg(FUtente::getClasse(),$obj); // tramite FentityManager::getIstanza() richiamo l unica istanza della classe entity manager, tramite questa istanza richiamo il metodo SalvaOgg() e passo come parametro a questo metodo la classe dell'oggetto da salvare e l'oggetto stesso. Scrivo FUtente::getClasse() perchè la classe FAmministratore è una estensione della classe FUtente e dunque utilizzo FUtente getclasse() per generalizzare ma credo che sia corretto anche scrivere FAmministratore al posto di FUtente. Quindi $salvaUtente contiene un id //$salvaUtente contiene un id
        if($salvaUtente !== null){// se $salvaUtente è diversa da null ,cioè ha come valore un id 
            $salvaAmm = FEntityManager::getIstanza()->SalvaOggdaID(self::getClasse(),$obj,$salvaUtente);//$salvaAmm salva un oggetto amministratore nel database tramite l'id. Accedo all'unico oggetto FentityManager e tramite esso richiamo il metodo saveOggdaID con cui salvo l'oggetto tramite il suo id
            return $salvaAmm;// $salvaAmm ritorna l'output del metodo SalvaOggdaID , cioè $salvaAmm contiene true e dunque return $salvaAmm ritorna true se l'oggetto viene salvato nel db , altrimenti si ritorna false.
        }else{
            return false; // se non ha salvato l'oggetto amministratore, viene ritornato false
        }
    }
    public static function getAmmByEmail($email){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(FAmministratore::getTabella(),'email',$email);//viene recuperato un oggetto dalla tabella  amministratore avente nel campo email un valore dell'email contenuto in $email
        if(count($risultato)>0){ // se esiste un utente con quella email crea un utente registrato con quella email
            $amm = self::CreaOggAmministratore($risultato);//se esiste l'utente viene 
            return $amm;
        }else{// se non esiste ritorna null
            return null;
        }

    }
    
    


}