<?php
class UMetodiHTTP{
    //Classe per accedere all'array $_POST per richieste http come $_POST e $_LIKE
    //L'array $_POST invia al server i dati su una possibile prenotazione (cioè l'ora , il giorno e l'utente che prenota), oppure invia i dati di un annullamento prenotazione etc.. . Invia i dati al server.
    // l'array $_FILES permette all'utente di inviare al server dei file per esempio come delle immagini .

   /**
    * Con tale metodo si accede all'array superglobale $_POST
    */
    public static function post($parametro,$filtro = FILTER_SANITIZE_STRING){
        //$parametro contiene l'oggetto che si vuole ottenere da $_POST. $filtro è posto uguale a "FILTER_SANITIZE_STRING" che sanifica la stringa rimuovendo o codificando i parametri speciali
        return isset($_POST[$parametro]) ? filter_var($_POST[$parametro],$filtro) :null;
        //isset verifica se l'oggetto contenuto in $parametro esiste in $_POST o no , se esiste il metodo ritorna true altrimenti false. Se l'oggetto esiste si usa un filtro , cioè quello presente come argomento del metodo "FILTER ect..."
        // tale filtro si usa tramite la funzione filter_var.
        // se l'oggetto esiste viene ritornato dal return l'oggetto filtrato altrimenti viene ritornato null.
    }
   /**
    * Con tale metodo si accede all'array superglobale $_FILES
    */
    public static function files(...$parametro) {//Con "..." indichiamo che il metodo può prendere un numero variabile di parametri che saranno posti all'interno del array $parametro 
        if (count($parametro)  == 1) return $_FILES[$parametro[0]]; // se viene passato un solo parametro al metodo cioè il count($parametro) ==1 , il metodo restituisce il valore corrispondente di quel parametro  che si trova in $_FILES. Siccome abbiamo un solo parametro $parametro[0] è il valore associato a quel parametro .
        else if (count($parametro) == 2) return $_FILES[$parametro[0]][$parametro[1]];//se vengono passati 2 parametri al metodo cioè il count==1, il metodo restituisce gli elementi corrispondenti a quei parametri che si trovano in $_FIELS
        else if (count($parametro) == 3) return $_FILES[$parametro[0]][$parametro[1]][$parametro[2]];
        else if (count($parametro) == 4) return $_FILES[$parametro[0]][$parametro[1]][$parametro[2]][$parametro[3]];
        else return $_FILES[$parametro[0]][$parametro[1]][$parametro[2]][$parametro[3]][$parametro[4]];
    }
}