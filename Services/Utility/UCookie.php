<?php 
/**
 * per accedere all'array superglobale $_COOKIE, È necessario utilizzare questa classe
 *  e non direttamente l'array _COOKIE
 */
class UCookie{
    /**
     * metodo che verifica se un  cookie con un preciso ID è stato impostato , cioè se un cookie con quell'ID è stato creato e memorizzato nel browser dell'utente .
     * @param $id è la chiave  del cookie , cioè il nome ,che poniamo come parametro al metodo
     * @return bool 
     */

     // L'array superglobale $_COOKIE è un array associativo che  contiene tutti i cookie inviati dal browser dell'utente al server 
     //i cookie sono memorizzati nel browser dell'utente e vengono inviati al server automaticamente con ogni richiesta HTTP al server.
     // Una volta che un cookie è stato impostato e memorizzato nel browser dell'utente , sarà disponibile in $_COOKIE su tutte le richieste successive al server .
     // L'array $_COOKIE contiene coppie chiave-valore,  dove la chiave è il nome del cookie e il valore è il valore del cookie (che può essere per esempio l'ID di un utente, utilizzato per identificare l'utente nelle successsive richieste al server).
    // All'array superglobale $_COOKIE ci si accede come si accede ad un array associativo.
    public static function cookieSettato($id){
        if(isset($_COOKIE[$id])){ // il metodo isset() verifica che esiste un cookie nell'array $_COOKIE  con un certo nome specificato dal parametro $id,$id è la chiave del cookie.
            return true; // se esiste ,si ritorna true 
        }else{
            return false;
        }
    }
}