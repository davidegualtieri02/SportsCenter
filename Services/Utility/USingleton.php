<?php
final class USingleton{ // una classe final è una classe che non può essere estesa da altre classi. Questa significa che non è possibile creare una sottoclasse di una classe final.
    //la dichiarazione di una classe final è utile quando si vuole impedire che la classe venga ereditata e modificata.
    //Questa classe gestisce le istanze delle classi singleton ,di cui esiste una e una sola istanza alla volta . Queste classi singleton vengono gestite attraverso i metodi sotto.
    private static $istanza = array();

    /**
     * Metodo che richiama un'istanza di una classe , se non esiste la crea 
     * @param string $NomeClasse
     * @return object
     */
    public static function getIstanza($NomeClasse){//metodo statico cioè può essere chiamato senza creare un'istanza della classe che lo contiene
        if(!class_exists($NomeClasse)){// questa riga verifica se la classe specificata esiste utilizzando il metodo class_exist($NomeClasse). Se la classe non esiste viene eseguito il metodo trigger_error
            trigger_error("La classe".$NomeClasse. "non esiste",E_USER_ERROR);// trigger_error è un metodo che può essere utilizzato per generare un errore a tempo di esecuzione. Utile per segnalare problemi
            //trigger_error prende come parametro il nome della classe e il tipo di errore che nel nostro caso è E_User_Error, che è un errore fatale generato dall'utente.
        }// se la classe esiste viene eseguito il metodo strtolower e le righe sotto
        $NomeClasse= strtolower($NomeClasse);//il metodo converte il nome della classe in minuscolo . Questo aiuta rendere standard le chiavi dell'array $istanza per evitare problemi di distinzione tra nomi maiuscoli e minuscoli

        if (!array_key_exists($NomeClasse,self::$istanza)){// controlla se esiste gia un istanza della classe  $NomeClasse specificata nell'array self::$istanza, Se non esiste , crea una nuova istanza della classe e la memorizza nell'array
            self::$istanza [$NomeClasse] = new $NomeClasse; // se non esiste l'istanza della classe , la crea e la memorizza nell'array
        }
        return self::$istanza[$NomeClasse];//restituisce l'istanza della classe specificata dall'array
    }


    /**
     * Metodo che distrugge l'istanziazione di una classe.
     * @param string $NomeClasse
     * @return object
     */
    public static function DistruzioneIstanza($NomeClasse){//metodo statico cioè può essere chiamato senza creare un'istanza della classe che lo contiene
        if(!class_exists($NomeClasse)){// questa riga verifica se la classe specificata esiste utilizzando il metodo class_exist($NomeClasse). Se la classe non esiste viene eseguito il metodo trigger_error
            trigger_error("La classe".$NomeClasse. "non esiste",E_USER_ERROR);// trigger_error è un metodo che può essere utilizzato per generare un errore a tempo di esecuzione. Utile per segnalare problemi
            //trigger_error prende come parametro il nome della classe e il tipo di errore che nel nostro caso è E_User_Error, che è un errore fatale generato dall'utente.
        }// se la classe esiste viene eseguito il metodo strtolower e le righe sotto
        $NomeClasse= strtolower($NomeClasse);//il metodo converte il nome della classe in minuscolo . Questo aiuta rendere standard le chiavi dell'array $istanza per evitare problemi di distinzione tra nomi maiuscoli e minuscoli

        if (array_key_exists($NomeClasse,self::$istanza)){// controlla se esiste gia un istanza della classe $NomeClasse specificata nell'array self::$istanza.
            self::$istanza [$NomeClasse] = null; // se esiste l'istanza della classe , pone uguale a null il valore del nomeClasse dunque elimina l'istanza
        }
        return self::$istanza[$NomeClasse];//restituisce l'istanza della classe specificata dall'array , cioè restituisce null ,che mi da la non esistenza della classe all'interno dell'array
    
    }
}    