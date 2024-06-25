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
    
}