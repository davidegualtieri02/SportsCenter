<?php

class VUtente{
    private $smarty;
    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }
    static function getNome(){
        return UMetodiHTTP::post('nome');
    }
    static function getCognome(){
        return UMetodiHTTP::post('cognome');
    }
    static function getEmail(){
        return UMetodiHTTP::post('email');
    }
    static function getPassword(){
        return UMetodiHTTP::post('password');
    }
    /**
     * Funzione che indirizza alla pagina con il form di login 
     */
    public function mostraLoginForm(){
        $this->smarty->assign('errore',false);
        $this->smarty->assign('ban',false);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('./Smarty/libs/templates/login_form.tpl');
    }
    public function mostraFormRegistrazione(){
        $this->smarty->display('.Smarty/libs/templates/form_registrazione.tpl');
    }
    public function loginBan(){
        $this->smarty->assign('errore',false);
        $this->smarty->assign('ban',true);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('.Smarty/libs/templates/login_form.tpl');
    }
    public function erroreLogin($errore){
        switch($errore){
            case 'bannato':
                $this->smarty->assign('banErrore', "banErrore");
                break;
            case 'password errata':
                $this->smarty->assign('passworderrata', "passworderrata");
                break;
            case 'email Errata':
                $this->smarty->assign('emailerrata', "emailerrata");
                break;
        }
        $this->smarty->display('.Smarty/libs/templates/login_form.tpl'); //quindi login_form.tpl deve prevedere di mostrare un eventuale messaggio di errore in caso di accesso negato
    }
    public function erroreRegistrazione($errore){
        switch ($errore){
            case 'emailEsistente':
                $this->smarty->assign('emailEsistente', "emailEsistente");
                break;
        }
        $this->smarty->display('.Smarty/libs/templates/form_registrazione.tpl');
    }
    public function profilo($utente,$idutente){
        if(CUtente::Loggato()) $this->smarty->assign('utenteloggato','loggato');
        else $this->smarty->assign('utenteloggato','nonloggato');
        $this->smarty->assign('Utente', $utente);
        $this->smarty->assign('idutente', $idutente);

    }
    public function ModificaPassword($utente, $error){

        if (CUtente::Loggato()) $this->smarty->assign('utenteloggato', 'loggato');
        else $this->smarty->assign('utenteloggato', 'nonloggato');

        switch ($error){
            case 'passwordErrata':
                $this->smarty->assign('passwordErrata', "passwordErrata");
                break;
        }
        $this->smarty->assign('utente', $utente);
        $this->smarty->display('./smarty/libs/templates/mod_password.tpl');
    }
    
}