<?php

class CAmministratore{

    /**
     * Metodo che verifica se un utente è loggato (usando le sessioni)
     * @return boolean 
     */
    public static function Loggato(){
        $loggato = false;
        if(UCookie::cookieSettato('PHPSESSID')){
            if(session_status()==PHP_SESSION_NONE){
                USession::getIstanza();
            }
        }
        if (USession::isSetElementoSessione('Amministratore')){
            $loggato= true;
        }
        if(!$loggato){
            header('Location : /SportsCenter/Amministratore/login');
            exit;
        }
        return true;
    }
    /**
     * Metodo che consente all'amministratore di autenticarsi
     */
    public static function login(){
        if(UCookie::cookieSettato('PHPSESSID')){
            if(session_status()==PHP_SESSION_NONE){
                USession::getIstanza();
            }
        }
        if(USession ::isSetElementoSessione('Amministratore')){
            header('Location : /SportsCenter/Amministratore/home');
        }
        $view = new VAmministratore();
        $view->mostraLoginForm();
    }

    /**
     * Metodo che consente di uscire dal profilo
     * @return void
     */
    public static function logout(){
        USession::getIstanza();
        USession::annullaSessione();
        USession::distruggiSessione();
        header('Location: /SportsCenter/Amministratore/login');
    }
    /**
     * metodo che verifica se esiste l'email inserita e per questa email verifica la password. Se tutto è corretto , viene creata la sessione e l'amministratore
     * viene reindirizzato alla homepage
     */
    public static function VerificaLogin(){
        $view = new VAmministratore();
        $email = FPersistentManager::getIstanza()->VerificaEmailUtente(UMetodiHTTP::post('email'));
        if($email){
            $utente = FPersistentManager::getIstanza()->recuperaAmmDaEmail(UMetodiHTTP::post('email'));
            //questo if qui sotto controlla se la password di un utenteregistrato ottenuta da getpassword è uguale ad una password digitata dall'utente ed inviata tramite una richiesta HTTP POST al server 
            if(password_verify(UMetodiHTTP::post('password'),$utente->getPassword())){
                if(USession::getStatoSessione()==PHP_SESSION_NONE){// altrimenti se la sessione non è iniziata 
                    USession::getIstanza();// viene ridata un istanza sessione 
                    USession::setElementoSessione('Amministratore',$utente->getIdAmministratore());// e viene posto l'id dell'utente registrato , cioè l'id dell'utente di cui è stata verificata la password, viene posto nell'array superglobale $_SESSION
                    //la riga sopra serve per far si che il sistema può utilizzare questo ID per identificare l'utente nelle richieste future(le richieste future sono invio di moduli,logout ect..), cioè in ogni richiesta che l'utente fa (quando un utente interagisce con un applicazione web , ogni azione che richiede una comunicazione con il server genera una nuova richiesta HTTP) , mantenendo cosi lo stato di autenticazione.
                    //Mantenere lo stato di autenticazione è importante per assicurare che le operazioni siano eseguite nel contesto dell'utente corretto
                    header ('Location : /SportsCenter/Amministratore/home');
                }
            }else {
                $view->erroreLogin();
            }
        }else{
            $view->erroreLogin();// se l'email non esiste viene dato un errore di login 
        }
    }

    /**
     * Metodo che permette all'amministratore di bannare un utente
     * @param $idUtente si riferisce all'id dell'utente da bannare
     */
    public static function banUtente($idUtente){
        if(CAmministratore::Loggato()){
            $utente = FPersistentManager::getIstanza()->recuperaOggetto(EUtente::getEntità(),$idUtente);
            if($utente !== null){
                $utente->setBan(true);
                FPersistentManager::getIstanza()->updateBanUtente($utente);
                header('Location : /SportsCenter/Amministratore/home');
            }
        }
    }
}
