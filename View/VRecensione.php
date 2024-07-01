<?php
class VRecensione{
 private $smarty;
 private function __construct(){
     $this->smarty = StartSmarty::configuration();
    }
static function getMessaggio(){
    return UMetodiHTTP::post('messaggio');
}
static function getValutazione(){
    return UMetodiHTTP::post('valutazione');
}
static function getOra(){
    return UMetodiHTTP::post('orario');
}

public function FormNuovaRecensione($utente,$prenotazione,$campo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('prenotazione',$prenotazione);
    $this->smarty->assign('Campo',$campo);
    $this->smarty->display('nuova_recensione.tpl');
}
public function MostraRecensioni($recensioni,$utente){
    $this->smarty->assign('recensioni',$recensioni);
    $this->smarty->assign('Utente',$utente);
    $this->smarty->display('mostra_recensioni.tpl');
}
}