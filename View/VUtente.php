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
    public function MostraLoginFormUtente(){
        $this->smarty->assign('errore',false);
        $this->smarty->assign('ban',false);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('./smarty/libs/templates/login_form.tpl');
    }
    public function MostraFormRegistrazione(){
        $this->smarty->display('./smarty/libs/templates/form_registrazione.tpl');
    }
    public function loginBan(){
        $this->smarty->assign('errore',false);
        $this->smarty->assign('ban',true);
        $this->smarty->assign('regErr',false);
        $this->smarty->display('./smarty/libs/templates/login_form.tpl');
    }
    public function erroreLogin($errore){
        switch($errore){
            case 'ban':
                $this->smarty->assign('ban', true);
                break;
            case 'passwordErrata':
                $this->smarty->assign('passwordErrata',false);
                break;
            case 'emailErrata':
                $this->smarty->assign('emailErrata', false);
                break;
        }
        $this->smarty->display('.smarty/libs/templates/login_form.tpl'); //quindi login_form.tpl deve prevedere di mostrare un eventuale messaggio di errore in caso di accesso negato
    }
    public function erroreRegistrazione($errore){
        switch ($errore){
            case 'emailEsistente':
                $this->smarty->assign('emailEsistente', false);
                break;
        }
        $this->smarty->display('.smarty/libs/templates/form_registrazione.tpl');
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
        $this->smarty->display('./smarty/libs/templates/mod_password.tpl'); //NON ESISTE
    }

    public function home($nomeUtente){
        $this->smarty->assign('nomeUtente', $nomeUtente);
        $this->smarty->display('./smarty/libs/templates/home.tpl');
    }

    public function profilo($nomeUtente,$cognomeUtente,$emailUtente,$id_tesseraUtente){
        $this->smarty->assign('nomeUtente', $nomeUtente);
        $this->smarty->assign('cognomeUtente', $cognomeUtente);
        $this->smarty->assign('emailUtente', $emailUtente);
        $this->smarty->assign('id_tesseraUtente', $id_tesseraUtente);
        $this->smarty->display('./smarty/libs/templates/profilo.tpl');
    }

    public function prenotazioniUtente($listaPrenotazioni){
        $this->smarty->assign('listaPrenotazioni', $listaPrenotazioni);
        $this->smarty->display('./smarty/libs/templates/prenotazioni.tpl');
    }

}






