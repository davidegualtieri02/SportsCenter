<?php

class CFrontController{
    public function run($requestUri){
        //rimuove eventuali '/' iniziali o finali dall'URI della richiesta
        $requestUri = trim($requestUri, '/');
        //separa l'URI in parti, usando '/' come delimitatore
        $uriParts = explode('/', $requestUri);
        //rimuove il primo elemento dell'array, così poi da avere nel primo elemento di $uriParts il nome del controller e nel secondo quello del metodo
        array_shift($uriParts);
        //assegna il nome del controller con l'operatore ternario (condizione ? valore_se_vera : valore_se_falsa)
        $nomeController = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'Utente'; //se il primo elemento dell'array non è vuoto, allora prendilo e metti la prima lettera maiuscola (con ucfirst); altrimenti assegna 'Utente'
        $nomeMetodo = !empty($uriParts[1]) ? $uriParts[1] : 'login';
        //aggiungi 'C' in testa a $nomeController
        $classeController = 'C'.$nomeController;
        //crea il percorso del file della classe Controller desiderata
        $fileController = __DIR__."/{$classeController}.php"; //__DIR__ indica il percorso dello script corrente
        //se il file esiste, viene incluso
        if (file_exists($fileController)){
            require_once($fileController);
            //controlla se il metodo indicato esiste nella classe controller interessata
            if(method_exists($classeController, $nomeMetodo)){
                //metti in $params eventuali parametri opzionali
                $params = array_slice($uriParts, 2); //e.g. se l’URI è “/Utente/login/param1/param2”, l’array $params conterrà [“param1”, “param2”]
                //chiama il metodo
                call_user_func_array([$classeController, $nomeMetodo], $params);
            } else {
                //metodo non trovato
                header('Location: /SportsCenter/Utente/home');
            }
        //metodo non trovato
        header('Location: /SportsCenter/Utente/home');
        }
    }
}