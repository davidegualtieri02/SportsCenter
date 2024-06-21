<?php
/**
 * Per accedere all'array superglobale $_SERVER è necessario utilizzare questo array, invece di utilizzare l'array _SERVER
 */
class UServer {
    /**
     * singleton class
     */
    private static $istanza = null; // è l'istanza di UServer 

    /**
     * Metodo che restituisce l'istanza di Userver
     * @return UServer::$istanza , cioè restituisce l'istanza di UServer .
     */
    public static function getIstanza(){
        if (UServer::$istanza == null){ // questa linea controlla se l'istanza della classe UServer è gia stata creata . Se UServer::$istanza è null significa che non esiste ancora l'istanza UServer.
            if(isset($_SERVER['single'])){ // controlla se c'è gia un'istanza di UServer salvata in $_SERVER['single']
                UServer::$istanza = $_SERVER['single'];// se esiste uguagliamo tale istanza all'istanza UServer::$istanza, usiamo dunque tale istanza  , cioè il metodo getIstanza mi restituisce tale istanza.
            }else {
                UServer::$istanza = new UServer(); // altrimenti se l'stanza non esiste la creaimo
                $_SERVER['single'] = UServer::$istanza; // e uguagliamo l'elemento $_SERVER['single'] a UServer::$istanza , cioè poniamo l'istanza del Server nell'array $_SERVER , tale elemento avrà come chiave 'single'
            }    

        }
        return UServer::$istanza;//ritorniamo l'istanza del server 
    }

    /**
     * Metodo che restituisce il metodo di richiesta http utilizzato per accedere alla pagina corrente 
     */
        public static function getRichiestaMetodo(){
            return $_SERVER['REQUEST_METHOD'];// $_SERVER['REQUEST_METHOD'] è una variabile superglobale che contiene il metodo di richiesta utilizzato per accedere ad una pagina.
            // i valori associati alla chiave 'REQUEST_METHOD nell'array $_SERVER posso essere:
            //GET: Utilizzato per richiedere al server.
            //POST: Utilizzato per inviare dati al server per elaborazione.
            //HEAD: Simile a GET, ma viene utilizzato per ottenere solo le intestazioni di risposta, senza il corpo della risposta.
            //PUT: Utilizzato per caricare un'entità specificata su una risorsa destinata all'URI di destinazione.
            //DELETE: Utilizzato per rimuovere la risorsa specificata.
            //OPTIONS: Utilizzato per descrivere le opzioni di comunicazione per la risorsa di destinazione.
            //TRACE: Esegue un test di loopback completo di percorso di richiesta diagnostica.

        }
    
}