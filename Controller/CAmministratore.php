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
     */
    public static function logout(){
        USession::getIstanza();
        USession::annullaSessione();
        USession::distruggiSessione();
        header('Location: /SportsCenter/Amministratore/login');
    }
}
