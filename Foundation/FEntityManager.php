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
            self::$db = new PDO ("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8;",DB_USER,DB_PASS); // DB_USER e DB_PASS sono le credenziali di accesso al database.
            //la stringa dentro le parentesi specifica il tipo di database in questo caso Mysql , il nome del database(DB_NAME), l'host(DB_HOST) e il set di caratteri per
            // per la connessione .Questo set definisce l’insieme dei caratteri che possono essere memorizzati e identificati nel database durante le operazioni di inserimento, estrazione e manipolazione dei dati
            //Se la connessione ha successo l'oggetto $db conterrà la connessione attiva al database
        } catch(PDOException $errore){
            echo "ERRORE".$errore->getMEssage(); // se c'è un errore di accesso al database vero eseguito il codice sotto 
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
     public static function getdb(){
        return self::$db;

    }
    /**
     * metodo che recupera un oggetto da un database utilizzando PDO
     * (è un metodo static,può essere richiamato senza istanziare un oggetto della classe)
     */
    public static function recuperaOggetto($tabella,$campo,$id){ 
        try{
            $query = "SELECT * FROM".$tabella. "WHERE".$campo."=".$id .";";
            $dichiarazione =self::$db->prepare($query);//questa riga sta preparando la query SQL per la propria esecuzione 
            // self::$db si riferisce all'oggetto $db che rappresenta una comnnessione al database
            //l'oggetto dichiarazione viene creato quando si prepara una query SQL utilizzando il metodo prepare() di un oggetto PDO
            //Il metodo prepare() restituisce un ogettto dichiarazione che incapsula la query SQL
            //questo oggetto dichiarazione può essere utilizzato per eseguire la query SQL
            $dichiarazione->execute();// esecuzione della query
            $countRighe = $dichiarazione->rowCount()//restituisce il numero di tuple(righe) presenti in una tabella del database
            if($countRighe >0){ // verifica se il numero di tuple è > 0 , cioè verifica se la query ha restituito almeno un risultato
                $risultato = array();// se c'è almeno un risultato viene creato un array vuoto chiamato $risultato.
                //$risulato sarà un array che contiene i risultati della query 
                $dichiarazione->setFetchMode(PDO::FETCH_ASSOC);//questa riga imposta la modalità di recupero dei risultati della query su PDO::FETCH_ASSOC, cioè significa  che i risultati saranno recuperati come array associativi.
                //l'array associativo che otteniamo come risultato varà una struttura di questo tipo:
                /**
                 * ogni chiave è il nome di una colonna del risulato della query e ogni valore è il valore di quella colonna per la riga corrispondente 
                 * per esempio: se avessimo una tabella con attributi : id , nome, email
                 * se campo = id ( cioè se l'id posto come parametro è uguale a uno della tabella , allora tale tupla viene considerata e ogni atrributo sarà la chiave del valore associato a quell attributo nella riga consideraata)
                 * la tupla sarà rappresentata cosi nell'array,attraverso 3 elementi:
                 * ["id" =>123," nome"=>"lorenzo" ,"email"=>"lor.frac@gmail.com"]
                 */
                while ($righe = $dichiarazione->fetch()){ //il metodo fetch() restituirà nel nostro codice le prossime tuple(righe che verificano la condizione dell'if) come un array associativo 
                    // questo ciclo while si ripete fino a che ci sono righe da recuperare dal risulatto della query.Ogni riga viene recuperata come un array associativo e assegnata alla varibile $righe .   
                    $risultato[] = $righe; //per ogni 


                }

                   

            }     
        }

    }
}