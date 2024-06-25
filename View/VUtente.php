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
    public function mostraLoginForm(){
        $this->smarty->display('./Smarty/libs/templates/login_form.tpl');
    }
    public function mostraFormRegistrazione(){
        $this->smarty->display('.Smarty/libs/templates/form_registrazione.tpl');
    }
    public function loginBan(){
        $this->smarty->display('.Smarty/libs/templates/');
    }
    public function erroreLogin($errore){
        switch($errore){
            case 'bannato':
                $this->smarty->assign('banErrore', "banErrore");
                break;
            case 'passworderrata':
                $this->smarty->assign('passworderrata', "passworderrata");
                break;
            case 'emailerrata':
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
    
}