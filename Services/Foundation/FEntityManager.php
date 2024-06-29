<?php
//Il singleton è utile per gestire connessioni al database in modo efficiente e sicuro. Ecco come:

//1)Unica istanza: Il singleton garantisce che esista solo un’istanza della classe di connessione al database. 
//Questo è cruciale per evitare la creazione di connessioni multiple che potrebbero sovraccaricare il server del database.
//2)Riutilizzo: Una volta creata l’istanza del singleton, può essere riutilizzata in tutto il codice.
// Questo evita la necessità di creare nuove connessioni ogni volta che si accede al database.
//3)Configurazione centralizzata: Il singleton consente di centralizzare la configurazione della connessione al database.
// Puoi impostare le credenziali, l’host e altre opzioni una sola volta e utilizzarle ovunque nel tuo codice.
//4)Gestione delle risorse: Il singleton può gestire la chiusura automatica della connessione al database quando non è più necessaria.
// Questo aiuta a evitare perdite di risorse e a mantenere pulito il codice.

require_once(__DIR__."/../../config/config.php"); //include config.php per i dati del DB

class FEntityManager{
    // dovrebeb essere un singleton ma anche nel progetto Agora non viene specificato il fatto che sia un singleton 
    //come dovrebbe essere in realtà

    private static $istanza;
    private static $db;

    private function __construct(){// quando il costruttore è privato non può essere invocato fuori dalla classe ma solo dentro 
        //la classe stessa, quindi non possiamo richiamare un oggetto FEntityManager fuori la classe ma solo dentro tale classe EntityManager
        try{//self::$db mi dice che stiamo a accedendo alla  variabile statica $db e ponendola uguale a new PDO ect creaiamo un nuovo oggetto
            // di connessione al database relazionale utilizzando la classe PDO.PDO è una classe predefinita PHP che fornisce un'interfaccia per comunicare  con
            //database relazionali . E'una parte fondamentale per eseguire query e interagire con il database.
            //("mysql:dbname ...ect) è il parametro che viene passato al costruttore della classe PDO.
            self::$db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8", DB_USER, DB_PASS); // DB_USER e DB_PASS sono le credenziali di accesso al database.
            //la stringa dentro le parentesi specifica il tipo di database in questo caso Mysql , il nome del database(DB_NAME), l'host(DB_HOST) e il set di caratteri per
            // per la connessione .Questo set definisce l’insieme dei caratteri che possono essere memorizzati e identificati nel database durante le operazioni di inserimento, estrazione e manipolazione dei dati
            //Se la connessione ha successo l'oggetto $db conterrà la connessione attiva al database
        } catch(PDOException $errore){
            echo "ERRORE:".$errore->getMessage(); // se c'è un errore di accesso al database vero eseguito il codice sotto 
            // a catch , verrà stampato l'echo , quindi la stringa ERRORE e insieme a tale stringa verrà stamapato il metodo getMessage() che darà informazioni 
            //sulla natura dell'errore di connessione.
            // se c'è un errore di connessione al db viene eseguito il codice sotto il catch che gestisce l'eccezione.
            die;// die mi dice che se abbiamo un errore nella connessione al db , dopo aver printato l'errore si esce dall'esecuzione del codice sotto il catch tramite il costrutto die.
            
        
        }

    }

    public static function getIstanza(){// siccome il costruttore di questa classe non può essere richiamato perciò utilizziamo questo metodo per creare un istanza(oggetto) entity manager secondo
        //singleton cioè se un oggetto EntityManager  esiste si richiama quello ogni volta, se non esiste si crea l'oggetto e nei prossimi richiami
        //all'oggetto sarà richiamato sempre l'oggetto creato in precedenza. Il singleton crea l'oggetto dunque e richiama semrpe quello, non possaiamo creare altri oggetti con il singleton.
        //
        if(!self::$istanza){ //se l'istanza (oggetto della classe entitymanager non esiste )
            self::$istanza = new self();

        }
        return self::$istanza;
    }
    /**
     * Metodo per chiudere la connessione con il databse distrugendo l'istanza dell'entity manager
     */
    public static function chiusuraConnessione(){
        static ::$istanza = null; // questa riga di codice imposta il valore di istanza a null cioè distrugge l'istanza corrente della classe entitymanager.
    }
    /**
     * metodo che mi rida la connessione al db cioè PDO,la variabile che contiene la connessione è db
     */
     public static function getdb(){//getdb mi da un riferimento al database , cioè mi da un oggetto che rappresenta un database 
        return self::$db;

    }
    /**
     * metodo che recupera le tuple tramite una query SELECT FROM @tabella WHERE @campo = @id
     * (è un metodo static,può essere richiamato senza istanziare un oggetto della classe)
     * @param string $tabella fa riferimento ad una tabella del database
     * @param string $campo fa riferimento al campo nella tabella 
     * @param mixed $id fa riferimento al valore nella clausola where
     */
    public static function recuperaOggetto($tabella,$campo,$id){ 
        try{
            $query = "SELECT * FROM ".$tabella. " WHERE ".$campo."=".$id .";";
            $dichiarazione =self::$db->prepare($query);//questa riga sta preparando la query SQL per la propria esecuzione 
            // self::$db si riferisce all'oggetto $db che rappresenta una connessione al database
            //l'oggetto dichiarazione viene creato quando si prepara una query SQL utilizzando il metodo prepare() di un oggetto PDO
            //Il metodo prepare() restituisce un ogettto dichiarazione che incapsula la query SQL
            //questo oggetto dichiarazione può essere utilizzato per eseguire la query SQL
            $dichiarazione->execute();// esecuzione della query
            $countRighe = $dichiarazione->rowCount();//restituisce il numero di tuple(righe) presenti in una tabella del database
            if($countRighe >0){ // verifica se il numero di tuple è > 0 , cioè verifica se la query ha restituito almeno un risultato
                $risultato = array();// se c'è almeno un risultato viene creato un array vuoto chiamato $risultato.
                //$risulato sarà un array che contiene i risultati della query 
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);//questa riga imposta la modalità di recupero dei risultati della query su PDO::FETCH_ASSOC, cioè significa  che i risultati saranno recuperati come array associativi.
                //l'array associativo che otteniamo come risultato avrà una struttura di questo tipo:
                /**
                 * ogni chiave è il nome di una colonna del risulato(ogni chiave è un attributo) della query e ogni valore è il valore di quella colonna per la riga corrispondente (ovvero ogni valore associato alla chiave è il valore di quell'attributo di quella determinata tupla)
                 * per esempio: se avessimo una tabella con attributi : id , nome, email
                 * se campo = id ( cioè se l'id posto come parametro si trova in una tupla sotto un certo attributo(campo, attributo che ha come colonna gli id), allora tale tupla viene considerata e ogni attributo sarà la chiave del valore associato a quell attributo nella riga considerata)
                 * field è un attributo della tabella 
                 * la tupla sarà rappresentata cosi nell'array,attraverso 3 elementi:
                 * ["id" =>123," nome"=>"lorenzo" ,"email"=>"lor.frac@gmail.com"]
                 */
                while ($righe = $dichiarazione->fetch()){ //il metodo fetch() restituirà nel nostro codice le prossime tuple(righe che verificano la condizione dell'if) come un array associativo 
                    // questo ciclo while si ripete fino a che ci sono righe da recuperare dal risulatto della query.Ogni riga viene recuperata come un array associativo e assegnata alla varibile $righe .   
                    $risultato[] = $righe;// ogni volta righe assume un valore diverso e aggiungo in questo modo tutti i valori che assume righe nell'array risultato creando un array con n elementi , tutti assunti da righe 
                }
                return $risultato;                   

            }else{
                return array();// se  in risultato non c'e nessun valore , cioè è un array vuoto , ritorno l'array vuoto.
            }     
        }catch (PDOException $errore){// se si verifica un errore durante l'esecuzione della query , viene generata un eccezione gestita dalla classe PDOException . $errore contiene i dettagli dell'eccezione.
            echo "ERRORE:".$errore->getMessage();
            return array();//viene ritornato l'array vuoto
        }

    }


    /**
     * Metodo per recuperare tutte le tuple di una tabella mettendole in un array
     */
    public static function recuperaTuple($tabella) { 
        try {
            $query = "SELECT * FROM " . $tabella . ";";
            $dichiarazione = self::$db->prepare($query); // Preparazione della query SQL
    
            $dichiarazione->execute(); // Esecuzione della query
            $countRighe = $dichiarazione->rowCount(); // Restituisce il numero di righe presenti nella tabella , cioè il numero di righe ottenuto da execute()
    
            if ($countRighe > 0) { // Verifica se la query ha restituito almeno un risultato
                $risultato = array(); // Creazione di un array vuoto per contenere i risultati
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC); // Impostazione della modalità di recupero dei risultati come array associativi
    
                while ($righe = $dichiarazione->fetch()) { // Recupero delle righe come array associativi
                    $risultato[] = $righe; // Aggiunta delle righe all'array risultato
                }
                return $risultato; // Restituzione dell'array contenente tutti i risultati
    
            } else {
                return array(); // Restituzione di un array vuoto se non ci sono risultati
            }     
        } catch (PDOException $errore) { // Gestione degli errori durante l'esecuzione della query
            echo "ERRORE: " . $errore->getMessage();
            return array(); // Restituzione di un array vuoto in caso di errore
        }
    }
    /**
     * Metodo che ritorna tuple da una query SELECT FROM WHERE con 2 campi
     * @param string $tabella fa riferimento alla tabella nel database
     * @param string $campo1 fa riferimento al primo attributo in base al quale prendiamo uno o più tuple
     * @param mixed $id1 fa riferimento al valore nella clausala where
     * @param string $campo2 fa riferimento al secondo attributo  in base al quale prendiamo le tuple (o una sola)
     * @param mixed $id2 fa riderimento al valore nella clausola where
     */
    public static function getOggdaAttributi($tabella, $campo1, $id1, $campo2, $id2){
        try{
            $query = "SELECT * FROM " . $tabella . " WHERE " . $campo1 . " = '" . $id1 . "' AND " . $campo2 . " = '" . $id2 . "';"; // prendiamo tutte quelle tuple che hanno campo1(attributo1) = id1(può essere un qualsiasi valore non per forza un id ) e campo2(attributo2) = id2(che può essere qualsiasi valore) dove id1 è il valore di campo1(attributo1) e id2 è il valore di campo2(attributo2)
            $dichiarazione = self::$db->prepare($query);// cosi si prepara la query
            $dichiarazione->execute();// con il metodo execute() viene eseguita la query 
            $countrighe = $dichiarazione->rowCount();//conta le righe restituite dalla query
            if($countrighe>0){//l'if mi dice che se il numero di righe è maggiore di zero , viene impostata la modalità di recupero PDO::FETCH_ASSOC per ottenere i risultati come un array associativo
                $risultato = array();//creo un arary vuoto(inizialmente)
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);
                while($righe = $dichiarazione->fetch()){//il metodo fetch recupera tutte le righe una per una e le aggiunge all'array $risultato.
                    $risultato[] = $righe;
                }
                return $risultato;

            } else{ //se $countrighe = 0 , cioè la query non ha avuto risultati , viene ritornato un array vuoto.
                return array();
            }

        }catch (PDOException $errore){// se invece si verifica un eccezione durante l'esecuzione della query viene eseguita questa parte di codice.
            echo "ERRORE:".$errore->getMEssage();
            return array();
        }

    }
    /**
     * Metodo per verificare se la query restituisce o meno una riga
     * @param array $Risultatoquery è l'output di una query .
     * @return bool
     */
    public static function esisteNelDB($Risultatoquery){//public indica che il metodo per essere richiamato in qualsiasi classe non solo nella stessa Entity Manager, static indica che la funzione può essere richiamata senza creare un'istanza della classe.
        if(count($Risultatoquery)>0){// se il numero di elementi nell'array Risultatoquery,ovvero l'array che contiene le righe ottenute dalla query, è >0 allora il metodo restituisce true
            return true;
        }else{// altrimenti il metodo restituisce false
            return false;
        }
    }
    /**
     * Metodo per aggiornare(cambiare)un attributo e  il valore di tale attributo utilizzando una query di questo tipo:UPDATE table(nome tabella) SET field(attributo) = fieldvalue WHERE condizione = valoreCondizione
     * @param string $tabella si riferisce alla tabella del database
     * @param string $campo si riferisce all'attributo da cambiare dove viene rispettata la condizione 
     * @param mixed $campoValore è il valore da aggiornare a quell'attributo aggiornato , cioè è il valore da dare a quell'attributo cambiato 
     * @param string $condizione si riferisce al condizione del clausola WHERE
     * @param mixed $valoreCondizione si riferisce al valore della condizione in base alla quale dobbiamo cambiare l'attributo.
     * @return bool
     */
    public static function updateOgg($tabella,$campo,$campoValore,$condizione,$valoreCondizione){
        try{
            $query = "UPDATE".$tabella ."SET".$campo." = '".$campoValore. " 'WHERE ".$condizione." = '".$valoreCondizione . "';"; // Questa è la query che sarà eseguita via SQL. In SQL le stringhe per esempio " = ' " vengono messe sempre tra un apice singolo (') e quindi mettiamo sia " " che sono gli apici di php e poi poniamo ' che è l'apice per le stringhe in SQL.
            $dichiarazione = self::$db->prepare($query);// self::$db si riferisce a una variabile di classe statica cioè $db che dovrebbe essere un'istanza di un oggetto di connessione al db. il metodo prepare è un metodo dell'oggetto di connessione al database che prepara la query SQL per l'esecuzione . La query da preparare è quella contenuta nella variabile $query.
            $dichiarazione->execute();
            return true; //se l'attributo e il valore dell'attributo vengono aggiornati il metodo ritorna true , altrinenti se avviene un errore , viene ritornato false.
        }catch (Exception $errore){// invece di PDOException poniamo Exception che è una classe di eccezioni in php che gestisce tutti i tipi di errori. L'uso di  Exception al posto di PDOException mi dice che qualsiasi tipo di errore si verifica nel blocco try sarà catturato , non solo gli errori specifici PDO .
            echo "ERRORE: " .$errore->getMessage();
            return false;
        }
    }
    /**
     * Metodo per salvare un oggetto nel database usando la query INSERT TO.
     *@param string $ClasseFound si riferisce al nome di una classe foundation , in modo da ottenere la tabella relativa alla classe foundation in cui inserire una tupla e il valore della tupla nei diversi attributi 
     *@param object $ogg si riferisce all'Oggetto Entity da salvare nel database , per oggetto intendiamo una tupla che vogliamo salvare in una tabella del database.
     *@return int| null 
     */
    public static function SalvaOgg($ClasseFound,$ogg){
        try{
            $query = " INSERT INTO". $ClasseFound::getTable() ." VALUES" . $ClasseFound::getValue();// query viene posta uguale a questa stringa che inizia la query SQL. INSERT INTO  è un comando SQL che viene utilizzato per inserire nuove righe in una tabella del database
            // $ClasseFound ::getTable() è un metodo statico della classe indicata dalla variabile $classefound( cioè è il metodo di una classe entity contenuta in foundation),questo metodo restituisce il nome della tabella del database in cui si desidera inserire la nuova riga.
            // Values è un costrutto SQL che precede i valori da inserire nella riga per ogni attributo.
            //$ClasseFound::getValue() è un metodo statico xkè invocato con ::, questo metodo restituisce i valori da inserire nella riga da aggiungere  per ogni attributo .
            $dichiarazione = self ::$db->prepare($query); // prende come parametro la query da preparare
            $ClasseFound::bind($dichiarazione,$ogg);// metodo presente nella classe entity poste in foundation
            $dichiarazione->execute();
            $id = self::$db->lastInsertId(); // Dopo l'esecuzione della query , questa linea  di codice recupera l'ID dell'ultima riga inserita in una tabella del db. Recuperare tale ID e restituirlo con return $id è utile per verificare che la riga sia stata aggiunta correttamanete alla tabella del db in questione.
            return $id;
         } catch (Exception $errore){
            echo " ERRORE: " . $errore->getMessage();// errore->getMEssage() è un metodo della classe Exception che mi rida l'origine dell'errore.
            return null;
         }


    }
    /**
     * Metodo per memomirizzare un oggetto(riga) nel Database utilizzando l'id dell'oggetto,cioè questo metodo prende una riga e un ID come parametri e crea una nuova riga nel database.
     * @param string $ClasseFound si riferisce al nome della classe Foundation , attraverso tale classe possiamo ottenere la tabella e i valori associati agli attributi della tabella .
     */
    public static function SalvaOggdaID($ClasseFound,$ogg,$id){// classeFound può assumere come valore il valore di una classe entity riscritta nel package Foundation 
        try{
            $query = "INSERT INTO ". $ClasseFound::getTabella(). " VALUES ". $ClasseFound::getValore();//tramite classeFound::getTable() accedo alla tabella relativa a quella classe di Foundation e classeFound::getValue()  mi restituisce i valori degli attributi da porre nella riga che stiamo aggiungendo. Questi valori che aggiungiamo alla tupla della tabella  sono i valori dati agli attributi della classe in Foundation, valori dati dall'utente o da noi.
             $dichiarazione = self::$db->prepare($query);
             $ClasseFound::bind($dichiarazione,$ogg,$id); // questo metodo viene utilizzato per legare i parametri alla dichiarazione SQL preparata
             $dichiarazione->execute();
             return true;// ritorna true il metodo se la riga e l'id sono stati aggiunti ad una tabella del database.
        }catch(Exception $errore){// se si verifica un eccezione il metodo ritorna un eccezione.
            echo " ERRORE :" . $errore->getMessage();
            return false;
        }
    }
    
    /**
     * Metodo che ritorna le righe da una SELCT FROM WHERE ma se il campo removed = 0,ovvero  il metodo restituisce le righe da una tabella specificata($tabella) dove un certo campo = id e il campo removed è impostato su 0, cioè fa recuperare dalla tabella tutti quelle righe che non sono state rimosse.
     * @param string $tabella si riferisce alla tabella del database.
     * @param string $campo si riferisce al campo nella tabella 
     * @param mixed $id si riferisce al valore nella clausola where
     */
    public static function ListaOggnonrimossi($tabella,$campo,$id){
        try{
            $query = " SELECT * FROM ".$tabella. "WHERE ".$campo. " = ".$id. " ' AND removed = 0 ;"; //il punto e virgola dentro i doppi apici indicano la fine della query.( è un pò il punto e virgola di php).
            $dichiarazione = self::$db->prepare($query);// dichiarazione diventa la variabile con la quale richiamo un oggetto connessione al db e preparo la query
            $dichiarazione->execute();//attraverso dichiarazione posso eseguire la query , siccome dichiarazione punta ad un oggetto connessione al db
            $countrighe = $dichiarazione->rowCount(); // countrighe è il numero di righe della tabella che ho ottenuto come risultato dalla query.
            if($countrighe > 0 ){// se tale numero di righe è >0
                $risultato = array(); // creo un array.Utilizzando PDO::FETCH_ASSOC come parametro a setFetchMode() significa che ogni riga sarà restituita come un array associativo . Le chiavi degli array saranno gli attributi della tabella.
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);//con setFetchMode recupero tutti i risultati della query (cioè tutte le righe) e le pongo in un array
                while ($righe = $dichiarazione->fetch()){// Con fetch() recupero una alla volta tutte le righe dalla tabella ottenuta come risultato e quando non ci sono più righe da recuperare restituisce false. il metodo fetch() dentro il ciclo while significa che stiamo recuperando una alla volta tutte le righe fino a che non sono state recuperate tutte le righe dalla tabella
                    $risultato[] = $righe;// scrivendo questo significa  che ogni array che contiene una riga della tabella viene aggiunta una alla volta nell'array $risultato ottenendo un array multidimensionale.
            }
                self::chiusuraConnessione();// indica la chiusura della connesione al db(metodo fatto in precedenza)
                return $risultato;// ritorna l'array multidimensionale
            }else{
                return array();// se non viene prelevata nessuna riga della tabella corrispondente , viene ritornato un arry vuoto
            }

        }catch(Exception $errore){ // solita gestione dell'eccezioni.
            echo " ERRORE :".$errore->getMessage();
            return array();
        }

    }
    /**
     * Metodo per eliminare una riga dal database con la query DELETE FROM WHERE.
     * @param string $tabella si riferisce alla tabella del Database
     * @param string $campo si riferisce al campo della tabella 
     * @param mixed $id si riferisce al valore nella clausola where
     * @return boolean
     */
    public static function deleteOgginDB($tabella,$id,$campo){// la funzione costruisce una stringa di query SQL per eliminare una tupla da una tabella specificata(ovvero $tabella) dove un certo campo(attributo) $campo ha come valore un certo valore $id che non è necessariamente l'id di qualcosa ma può essere un qualsiasi valore per esempio il nome mario , cioè $campo = nome e $id = mario ,cosi eliminiamo tutte quelle tuple che hanno come valore dell'attributo 'nome' il nome 'mario' 
        try{
            $query = "DELETE FROM " . $tabella . " WHERE " . $campo . " = '".$id."';";// query DELETE per eliminare una tupla da una tabella del db
            $dichiarazione = self::$db->prepare($query);//self::$db è un oggetto della classe PDO
            $dichiarazione->execute();
            return true;// se viene eliminata la tupla che rispetta la clausola WHERE con successo il metodo ritorna true.
        }catch(Exception $errore){ // se si verifica una eccezione il metodo ritorna false
            echo " ERRORE :".$errore->getMessage(); // messaggio di errore dato da getMEssage() + ERRORE se si verifica un eccezione. 
            return false;
        }
    }
    /**
     *metodo che controlla se l'id di una certa tupla di una tabella del database è uguale all'id posto come parametro
     *@param array $risultatoQuery
     *@param int $idUtente 
     *@return bool
     */
    /**
     * Questa funzione VerificaCreatore() accede solo alla prima tupla perchè è progettata per verificare un singolo risultato della query, cioè è progettata per verificare il risultato di una query che dovrebbe restituire una singola riga e quindi accede solo alla prima riga(array) dell'array multidimensionale perchè ho un solo array interno all'array multidimensionale e accedo all'id di questa tupla per verificare i due id.
     * Con $risultatoQuery[0] accedo alla prima riga (array) contenuta nell'arraymultimediale e con [FUtente::getChiave()] accedo alla chiave dell'id , cioè accedo all'attributo id della tupla
     * quindi con $risultatoQuery[0][FUtente::getChiave()==$idUtente] accedo al valore dell'id della prima tupla(e unica) contenuta nell'arraymultimediale e ponendo [FUtente::getChiave() ==$idUtente] controllo se l'id dell'utente nella prima tupla del risultato della query è lo stesso id posto come parametro nel metodo
     * il metodo fa questo dunque:controlla se l'id dell'utente nella prima tupla del risultato della query è lo stesso id posto come parametro nel metodo.
     * se si ritorna true altrimenti false.
     */
    public static function VerificaCreatore($risultatoQuery,$idUtente){//risultatoQuery è il risultato di una query , IdUtente è l'id dell'utente. Questo metodo verifica se  l'id dell'utente posto come parametro al metodo è uguale ad un id posto in una tupla di una tabella  del database, cioè stiamo vedendo se per esempio un commento di un utente che ha un certo id è stato fatto da quell'utente controllando l'id posto come parametro con id posti nelle tuple della tabella commenti.
        if(self::esisteNelDB($risultatoQuery) && $risultatoQuery[0] [FUtente::getChiave() == $idUtente]){ // self::esisteNelDB(risultatoQuery) questa funzione controlla se il risultatoQuery, che è un array dove ogni elemento dell'array è un array a sua volta che contiene delle tuple, esiste nel database, cioè controlla che i dati restituiti dalla query (cioè risultatoQuery)corrispondono effettivamente a delle tuple presenti nel database
            //  se il risultato della query esiste nel db,con $risultatoQuery[0] ect... si controlla se l'ID dell'utente nel primo elemento (della tupla)(dell'array , Id utente è il valore  nella prima colonna della tupla) del risultato della query (cioè un array) corrisponde a $idUtente.
            return true; // se gli id corrispondono si ritorna true
        }else{
            return false;//se non corrispondono si ritorna false
        }
    }
    /**
     * Metodo che ritorna un array con dentro le tuple che hanno una certa stringa specificata nel parametro del metodo come valore di un certo attributo delle tuple stesse , attributo specificato anche esso nei parametri del metodo.
     * @param string $tabella si riferisce alla tabella del db da cui si vuole recuperare i dati.
     * @param string $campo si riferisce al campo della/e tupla/e
     * @param string $stringa si riferisce al valore del campo in base a cui selezioniamo (prendiamo) la/e tupla/e che hanno quella stringa nel field $campo.
     * @return array 
     */
    public static function getOggCercato($tabella,$campo,$stringa){
        try{
            $query = " SELECT * FROM ".$tabella."WHERE".$campo." LIKE '%".$stringa." %'";
            $dichiarazione = self::$db->prepare($query);
            $dichiarazione->execute();
            $countRighe= $dichiarazione->rowCount();
            if($countRighe>0){
                $risultato = array();
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);
                while ($riga = $dichiarazione->fetch()){
                    $risultato = $riga;
                }
                self::chiusuraConnessione();
                return $risultato;
            }else{
                return array();
            }
        }catch (Exception $errore){
            echo " ERRORE :".$errore->getMessage();
            return array();
        }

    }
    /**
     * Metodo che ritorna le tuple da una SELECT FROM WHERE in cui un certo @campoha vlore NULL
     * @param string $tabella si riferisce alla tabella del database
     * @param string $campo si riferisce al campo della tabella, in una certa tupla  ,da passare come parametro che ha il campo = NULL
     * @return array();
     */
    public static function ListaOggCampoNULL($tabella,$campo){
        try{
            $query = " SELECT * FROM ".$tabella." WHERE" .$campo." IS NULL;";
            $dichiarazione = self::$db->prepare($query);
            $dichiarazione->execute();
            $countRighe = $dichiarazione->rowCount();
            if($countRighe>0){
                $risultato = array();
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);
                while($riga = $dichiarazione->fetch()){
                    $risultato[] = $riga;
                }
                return $risultato;
            }else{
                return array();
            }
        }catch(PDOException $errore){// credo che in ogni metodo potrei mettere Exception o PDOException perchè PDOException è una classe per la gestione di eccezioni della classe PDO mentre Excpetion è una classe che gestisce tutti i tipi di eccezione tra cui anche quelli della classe PDO.
            echo " ERRORE: ".$errore->getMessage();
            return array();      
        }
    }
}