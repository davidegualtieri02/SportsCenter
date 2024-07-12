<?php
class FUtente{
    //questi attributi sono statici perchè possiamo creare gli oggetti riferiti a tale attributi solo nella classe stessa FUtente .Lo stesso vale per i metodi sono statici e quindi possono essere richiamati senza dover istanziare un oggetto della classe.
    private static $tabella = "Utente"; 

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
   //riprende un utente dal db
    public static function creaOggUtente($risultatoQuery){
        if(count($risultatoQuery) == 1){
            $utente = new EUtenteRegistrato($risultatoQuery[0]['nome'], $risultatoQuery[0]['cognome'], $risultatoQuery[0]['email'], $risultatoQuery[0]['password']);
            $utente->setId($risultatoQuery[0]['id_utenteRegistrato']);
            $utente->setHashPassword($risultatoQuery[0]['password']);
            return $utente;
        }elseif(count($risultatoQuery) > 1){
            $utenti = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $utente = new EUtenteRegistrato($risultatoQuery[$i]['nome'], $risultatoQuery[$i]['cognome'], $risultatoQuery[$i]['email'], $risultatoQuery[$i]['password']);
                $utente->setId($risultatoQuery[$i]['id_utenteRegistrato']);
                $utente->setHashPassword($risultatoQuery[$i]['password']);
                $utenti[] = $utente;
            }
            return $utenti;
        }else{
            return array();
        }
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
        $dichiarazione->bindValue(":nome",$utente->getNome(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":cognome",$utente->getCognome(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":email",$utente->getEmail(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":password",$utente->getPassword(),PDO::PARAM_STR);
        $dichiarazione->bindValue(":id_utenteRegistrato",$utente->getId(),PDO::PARAM_INT);
        $dichiarazione->bindValue(":id_tessera",$utente->getid_tessera(), PDO::PARAM_INT);
        $dichiarazione->bindvalue(":ban",$utente->isBanned(),PDO::PARAM_BOOL);
    }
    
    //FentityManager::getIstanza() è un metodo che viene utilizzato per ottenere un'istanza(oogetto) della classe FEntityManager, questo è un esempio di singleton .
    // Quando scriviamo FentityManager::getIstanza() stiamo facendo riferimento all'unico oggetto  FentityManager che esiste nel nostro programma(applicazione).  Questo singleton permette di utilizzare lo stesso oggetto FEntityManager in diverse parti del codice senza dover creare un tale oggetto ogni volta che ci serve.
    // una volta che abbiamo ottenuto un'oggetto FentityManager tramite il metodo recuperoOggetto() recuperimo un oggetto(non una tupla ma proprio il valore di un certo campo di una certa tupla specificati nei parametri del metodo recuperoOggetto) ponendo in tale metodo recuperaOggetto una certa tabella , un certo campo e un certo valore del campo stesso(id).

    public static function getOgg($id_utente){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_utente);
        if(count($risultato) > 0){
            $utente = self::creaOggUtente($risultato);
            return $utente;
        }else{
            return null;
        }
    }

    
}