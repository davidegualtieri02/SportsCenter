<?php
class FUtente{
    //questi attributi sono statici perchè possiamo creare gli oggetti riferiti a tale attributi solo nella classe stessa FUtente .Lo stesso vale per i metodi sono statici e quindi possono essere richiamati senza dover istanziare un oggetto della classe.
    private static $tabella = "Utente"; 

    /**
     * All'attributo $valore viene assegnata una stringa di parametri utilizzata in una query SQL per l'inserimento di dati in un database
     * NULL è usato per un campo(attributo del database) auto-incrementante  come l'ID, il database assegna automaticamente il prossimo numero disponibile.
     * :nome,:cognome,:email,:password  : questi sono dei segnaposto . Ogni segnaposto sarà poi sostituito con un valore reale quando la query viene eseguita.
     */
    private static $valore = "(NULL,:nome,:cognome,:password,:email)";


    private static $chiave = "IDUtente";

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
    /**
     * questo metodo lega il valore dei parametri nome,cognome,email e password  agli attributi nome ,cognome , password e email dell'oggetto utente della classe EUtente 
     * quando creiamo un utente con un certo nome,cognome , una certa email e una certa password attraverso il metodo bind il valore dei segnaposti nome,cognome,password,email vengono sostituiti con i valori posti da noi nell'inizializzazione dell'oggetto utente creato in precedenza 
     * @param $utente è l'utente creato 
     * @param $dichiazione è un oggetto di tipo PDOStatement . Questo oggetto rappresenta una query SQL preparata che può essere esguita sul database.
     * diamo ai parametri nome,cognome,password ed email i valori corrispondenti tramite i metodi della classe EUtente.
     * PDO::PARAM_INT/STR sono costanti che mi dicono di che tipo è quel parametro.Per esempio tale costante nella prima riga del metodo , mi dice di che tipo è "nome" ciòè una stringa.
     */
    public static function bind($dichiarazione,$utente){
        $dichiarazione ->bindValue(":name",$utente->getNome(),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":cognome",$utente->getCognome(),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":email",$utente->getEmail(),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":password",$utente->getPassword(),PDO::PARAM_STR);
    }
    /**
     * Metodo che verifica se un certo oggetto esiste nel database
     * 
     */
    public static function verifica($campo,$id){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery); // il metodo verifica tramite un oggetto FEntityMAnager che richiama il metodo esisteNelDB() restituisce true se esiste l'oggetto che cerchiamo nel db  altrimenti false .
    }
    //FentityManager::getIstanza() è un metodo che viene utilizzato per ottenere un'istanza(oogetto) della classe FEntityManager, questo è un esempio di singleton .
    // Quando scriviamo FentityManager::getIstanza() stiamo facendo riferimento all'unico oggetto  FentityManager che esiste nel nostro programma(applicazione).  Questo singleton permette di utilizzare lo stesso oggetto FEntityManager in diverse parti del codice senza dover creare un tale oggetto ogni volta che ci serve.
    // una volta che abbiamo ottenuto un'oggetto FentityManager tramite il metodo recuperoOggetto() recuperimo un oggetto(non una tupla ma proprio il valore di un certo campo di una certa tupla specificati nei parametri del metodo recuperoOggetto) ponendo in tale metodo recuperaOggetto una certa tabella , un certo campo e un certo valore del campo stesso(id).
}