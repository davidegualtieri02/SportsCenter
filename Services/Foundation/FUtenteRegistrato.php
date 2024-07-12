<?php
require_once(__DIR__."/../../Entity/EUtenteRegistrato.php");
class FUtenteRegistrato{
    private static $tabella = "UtenteRegistrato";
     /**
     * All'attributo $valore viene assegnata una stringa di parametri utilizzata in una query SQL per l'inserimento di dati in un database
     * NULL è usato per un campo(attributo del database) auto-incrementante  come l'ID, il database assegna automaticamente il prossimo numero disponibile.
     * :nome,:cognome,:email,:password  : questi sono dei segnaposto . Ogni segnaposto sarà poi sostituito con un valore reale quando la query viene eseguita.
     */
    private static $valore = "(:id_utenteRegistrato,:nome,:cognome,:password,:email,:ban,:id_tessera)";

    private static $chiave = "id_utenteRegistrato";

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
    public static function CreaOggUtenteRegistrato($risultatoQuery){
        if (count($risultatoQuery)==1){// se l'array ottenuto come risultato dalla query ha un solo elemento viene creato un solo oggetto UtenteRegistrato con i dati presenti nel primo ed unico elemento  nell'array risultatoquery
            $attributi = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),"id_utenteRegistrato",$risultatoQuery[0]['id_utenteRegistrato']);//questo metodo recupera la tupla che ha nella colonna IDUtenteRegistrato il valore dell'id presente nell'array $risultatoQuery nel primo elemento cioè [0] e in corrispondenza della chiave IDUtenteRegistrato.
            $utenteRegistrato = new EUtenteRegistrato($risultatoQuery[0]['nome'],$risultatoQuery[0]['cognome'],$risultatoQuery[0]['email'],$risultatoQuery[0]['password']);
            $utenteRegistrato->setId($risultatoQuery[0]['id_utenteRegistrato']);
            //$utenteRegistrato->setHashPassword($risultatoQuery[0]['password']);
            $utenteRegistrato->setBan($attributi[0]['ban']);//qui al posto di $risultatoQuery utilizziamo $arrayUtente anche se entrambi gli array contengono un solo elemento cioè quell'utente che ci interessa
            return $utenteRegistrato;
        }
        elseif(count($risultatoQuery)>1){// se $risultatoQuery contiene più di un elemento , il metodo ritorna una lista di utenti registrati  
            $utentiRegistrati= array();
            for($i=0;$i<count($risultatoQuery);$i++){//ripeto il ciclo un numero di volte  pari al numero di elementi contenuti in $risultatoquery
                $attributi = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),"id_utenteRegistrato",$risultatoQuery[$i]['id_utenteRegistrato']);//la funzione recuperaOggetto viene chiamata per ogni utente nell'array $risultatoQuery e restitusce un array di attributi per quell'utente specifico 
                $utenteRegistrato = new EUtenteRegistrato($risultatoQuery[$i]['nome'],$risultatoQuery[$i]['cognome'],$risultatoQuery[$i]['email'],$risultatoQuery[$i]['password']);// per ogni elemento di $risultatoQuery viene creato un Utente registrato. Per esempio iò secondo elemento dell'array avra un certo nome in corrispondenza della chiave nome , un certo cognome in corrispondenza della chiave cognome ect per ogni nome , cognome ect viene creato un elemento diverso.
                $utenteRegistrato->setId(($risultatoQuery[$i]['id_utenteRegistrato']));
                $utenteRegistrato->setBan(($attributi[0]['ban']));// scriviamo attributi[0] perchè per ogni iterazione del ciclo $attributi contiene un solo elemento (cioè un array di attributi) quindi si usa $attributi [0] per accedere a quell'array di attributi che ha un solo elemento cioè  gli attributi dell 'utente che stiamo analizzando in quella iterazione del ciclo 
                $utentiRegistrati[] = $utenteRegistrato; // ad ogni iterazione ogni utente viene posto nella lista utenti registrati
            }
            return $utentiRegistrati;

        }else{
            return array();// se $risultatoQuery non contiene nessun elemento significa che non ci sono utenti registrati e il meetodo ritorna un array vuoto .
        }
    }
    /**
     * Questo metodo associa tramite la funzione bindvalue il valore del parametro ban con il risultato del metodo isbanned() , se isbanned() rida true il valore del parametro ban è true altrimenti false
     */
    public static function bind($dichiarazione,$UtenteRegistrato){
        $dichiarazione->bindValue(":nome",$UtenteRegistrato->getNome(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":cognome",$UtenteRegistrato->getCognome(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":email",$UtenteRegistrato->getEmail(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":password",$UtenteRegistrato->getPassword(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":id_utenteRegistrato",$UtenteRegistrato->getId(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":id_tessera",$UtenteRegistrato->getid_tessera(), PDO::PARAM_INT);
        $dichiarazione->bindvalue(":ban",$UtenteRegistrato->isBanned(),PDO::PARAM_BOOL);
    }
    /**
     * Il metodo restituisce un oggetto Utente Registrato.
     * @param $id si riferisce all'id passato come parametro al metodo.
     */
    public static function getOgg($id){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),FUtenteRegistrato::getChiave(),$id);
        //questa linea recupera un oggetto dalla tabella FUtenteRegistrato specificando un Id . self::getkey() mi rida la chiave primaria della tabella del database ovvero mi rida l'attributo ID. $id contiene il valore dell'id associato alla chiave ID . Quindi accediamo alla tabella  Utente del database , si accede alla colonna con l'attributo primario cioè Id e poi viene recuperata la tupla della tabella che ha quell'id posto come parametro al metodo nella colonna degli Id.
        if (count($risultato)>0){//se c'è un elemento nell array risultato allora
            $utenteRegistrato= self::CreaOggUtenteRegistrato($risultato);//creo un utente registrato tramite i dati recuperati dalla tabella Utente tramite il metodo statico creaOggUtenteRegistrato() . Un metodo statico implementato in una classe se richiamato nella stessa classe deve essere richiamato tramite self::,self indica che il metodo è statico ed è della stessa classe.
            return $utenteRegistrato;//ritorno l'utente creato nella roga precedente.
        }else{
            return null;//se nella tabella utente non si trova nessun utente registrato con quell'id posto come parametro al metodo , viene ritornato null.
        }
    }
    /**
     * Il metodo salva un oggetto UtenteRegistrato nel database
     * @param $ogg si riferisce all'oggetto da salvare
     * @param $fieldArray si riferisce all'array formato da array interni formati da due elementi : il nome del campo da aggiornare e il nuovo valore del campo.
     * @return int : il metodo ritorna l'id dell'utente registrato salvato se qualche valore di qualche campo non deve essere aggiornato , si ritorna l'id e l'utente viene salvato.Se non viene salvato l'utente si ritorna false . Se si aggiorna qualche valore di qualche campo di un utenteRegistrato viene ritornato true , se si verifica un eccezione nell'aggiornamento di un valore di un campo  nella tabella Utente viene ritornato false.
     */
    public static function salvaOgg($ogg,$fieldArray = null){// $fieldArray è un array che contiene altri array che hanno due elementi ciascuno : il nome del campo da aggiornare e il nuovo valore del campo.
    //dire che $fieldArray è null significa dire che non ha valore iniziale.
    // nel metodo se $fieldArray è null , l'oggetto $ogg viene salvato nel database senza apportare alcuna modifica ai suoi campi. Se $fieldArray non è null , i campi specificati in $fieldArray vengono aggiornati per l'oggetto quando viene salvato nel database.
        if($fieldArray ===null){
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();//tramite l'unico oggetto entity manager viene richiamato il metodo getdb() che mi rida un riferimento ad un database ovvero mi rida una variabile o oggetto che rappresenta il database e tramite tale variabile(variabile e non oggetto perchè senno credo che non potevo richiamre il metodo begintransaction()) richiamo il metodo begintransaction().
                //begintransaction() viene richiamato per iniziare una nuova transazione . Una transazione è un insieme di operazionii sul database che vengono eseguite come un'unità , cioè come un unica azione. Se una delle operazioni fallisce , tutte le altre operazioni nella transazione vengono annullate e il database rimane invariato.
                $salvaUtenteRegistrato = FEntityManager::getIstanza()->SalvaOgg(FUtenteRegistrato::getClasse(),$ogg);//Questa riga salva l'oggetto utente Registrato nel database nella tabella Utente e restituisce l'ID dell'oggetto appena inserito. Questo ID viene assegnato alla variabile $salvaUtenteRegistrato
                if($salvaUtenteRegistrato !==null){
                    //$salvaUtente = FEntityManager::getIstanza()->SalvaOggdaID(self::getClasse(),$ogg,$salvaUtenteRegistrato);//se $salvaUtenteRegistrato non è null ma è pari all'id dell'utente registrato, salviamo l'oggetto utente registrato  tramite l'id nel database. L'oggetto da salvare è contenuto nella variabile $salvautenteregistrato.
                    //SalvaOggdaID restituisce true o false se l'oggetto è stato salvato o no quindi $salvaUtente è = true o false a seconda se l'utente è stato salvato o no.
                    FEntityManager::getIstanza()->getdb()->commit(); // fino a commit con l'oggetto Entity Manager richiamo il metodo getDB che mi rida un riferimento al db , cioè tramite ciò otteniamo un oggetto db ovvero un db, tramite il metodo commit() le modifiche che abbiamo fatto al database aggiungendo un oggetto Utente registrato tramite il suo ID vengono rese permanenti finchè non viene richiamato il metodo commit() di nuovo.
                    //le modifiche vengono fatte in una transazione temporanea . Queste modifiche non diventano permanenti finchè non si richiama il metodo commit().
                    //if($salvaUtente){// se il metodo salvaOggdaID mi rida true, cioè l'oggetto utente viene salvato nel DB, viene ritornato l'id dell'utente salvato.
                        //return $salvaUtenteRegistrato;
                    //}else{
                        //return false;//se il metodo salvaOggdaID mi rida false, cioè l'oggetto utente non viene salvato nel DB, ritorna false.
                    //}
                    return $salvaUtenteRegistrato;
                }else{
                    return false; // se  l'oggetto utente non è stato salvato e si ritorna false.
                }

            }catch (PDOException $errore){// se si verifica un eccezione(errore) durante il salvaggio di un oggetto UtenteRegistrato nel db viene eseguito questo codice
                echo "ERRORE" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();//FentityManager::getIstanza() richiama l'istanza dell'oggetto entity manager , se non esiste la crea, il metodo getdb() restituisce un'istanza del database a cui FentityManager è attualmente connesso
                // il metodo rollBack() usato con l'istanza del db , annulla tutte le modifiche non salvate nel db effettuate durante l'attuale transazione SQL sulla connessione al database gestita da FentityManager.
                return false;// restituendo false indichiamo che si è verificato un errore.
            }finally{//la clausola finally viene eseguita indipendentemente dal fatto che un'eccezione sia stata sollevata o meno 
                FEntityManager::getIstanza()->chiusuraConnessione();// questa metodo chiude la connessione al db
            }
        }else{//se l'array $fieldArray ha uno o più valori da aggiornare  per  uno o più campi di una tabella , cioè non ha valore null
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                foreach($fieldArray as $array){//una alla volta tutti gli elementi di $fieldArray li pongo pari a $array
                    //$array avrà due elementi l'elemento zero che il campo e l'elemento 1 che è il valore del campo.
                    if($array[0]!='password'){// aggiorno il valore di un campo se il campo non è pari alla password
                        FEntityManager::getIstanza()->updateOgg(self::getTabella(),$array[0],$array[1],self::getChiave(),$ogg->getId());                            //il metodo updateOgg prende come parametro la tabella in cui vogliamo cambiare il valore del campo , $array[0] rappresenta il campo di cui vogliamo aggiornare il valore , $array[1] rappresenta il valore del campo da aggiornare , self::getChiave() rappresenta la condizione del metodo cioè cambiamo il valore del campo dove la chiave primaria ha un determinato valore , l'ultimo parametro rappresenta il valore della chiave primaria , cioè il valore dell'id
                        //quindi il metodo aggiorna il valore del campo di una tupla dove la chiave primaria cioè l'id ha un determinato valore dato da $ogg->getId.
                    
                    }else{
                        FEntityManager::getIstanza()->updateOgg(self::getTabella(),$array[0],$array[1],self::getChiave(),$ogg->getId());
                        //se il campo è pari a password il valore della password viene aggiornato nella tabella Utente che è la stessa di Utenteregistrato e dunque l'aggiornamento è corretto.
                        //ovviamente aggiorniamo solo il valore del campo password della tupla che ha un certo ID.
                    }
                }
                FEntityManager::getIstanza()->getdb()->commit();// commit lo uso per salvare le modifiche
                return true;//ritorna true se il valore aggiornato è stato aggiornato correttamente.
            }catch(PDOException $errore){
                echo "ERRORE" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }
    }
    public static function getUtenteByEmail($email){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),'email',$email);//viene recuperato un oggetto dalla tabella utente avente nel campo email un valore dell'email contenuto in $email
        if(count($risultato)>0){ // se esiste un utente con quella email crea un utente registrato con quella email
            $Utente = self::CreaOggUtenteRegistrato($risultato);//se esiste l'utente viene 
            return $Utente;
        }else{// se non esiste ritorna null
            return null;
        }
    }
    public static function getId($ut){
        $risultato = self::getUtenteByEmail($ut->getEmail());
        return $risultato->getId();
    }
    //public static function setBan($ut){
        //$risultato = self::getUtenteByEmail($ut->getEmail());
        //return $risultato->isBanned();
    //}
    public static function isBanned($ut){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),'id_utenteRegistrato',self::getId($ut));
        if ($risultato[0]['ban'] == 1){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Metodo che verifica se un certo oggetto esiste nel database
     * 
     */
    public static function verifica($campo,$id){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery); // il metodo verifica tramite un oggetto FEntityMAnager che richiama il metodo esisteNelDB() restituisce true se esiste l'oggetto che cerchiamo nel db  altrimenti false .
    }

    public static function verificaCredenziali() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $emailInserita = $_POST['email'];
            $passwordInserita = $_POST['password'];
    
            // Connessione al database (modifica i parametri in base alla tua configurazione)
            try {
                $pdo = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8", DB_USER, DB_PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // Query per ottenere l'utente con l'email inserita
                $stmt = $pdo->prepare('SELECT email, password FROM utenti WHERE email = :email');
                $stmt->bindParam(':email', $emailInserita);
                $stmt->execute();
    
                $utente = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($utente && $passwordInserita === $utente['password']) {
                    echo 'Credenziali corrette!';
                    // Puoi eseguire ulteriori azioni qui, come avviare una sessione utente
                } else {
                    echo 'Email o password errate!';
                }
            } catch (PDOException $e) {
                echo 'Errore di connessione: ' . $e->getMessage();
            }
        } else {
            echo 'Inserisci email e password!';
        }
    }
}