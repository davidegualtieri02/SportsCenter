<?php
require_once(__DIR__ . "/../install/StartSmarty.php");
class VRecensione{
    private $smarty;
    public function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    public static function getMessaggio(){
        return UMetodiHTTP::post('recensione_text');
    }
    public static function getData(){
        return UMetodiHTTP::post('data');
    }

    public function FormNuovaRecensione($utente,$prenotazione,$campo){
        $this->smarty->assign('Utente',$utente);
        $this->smarty->assign('prenotazione',$prenotazione);
        $this->smarty->assign('Campo',$campo);
        $this->smarty->display('./smarty/libs/templates/scrivi_recensione.tpl'); //é GIUSTO???
    }
    public function MostraRecensioni($recensioni,$idUtente){
        $this->smarty->assign('recensioni',$recensioni);
        $this->smarty->assign('idUtente',$idUtente);
        $this->smarty->display('./smarty/libs/templates/recensioni.tpl');
    }

    public function MostraRecensioniNoLog($recensioni){
        $this->smarty->assign('recensioni',$recensioni);
        $this->smarty->display('./smarty/libs/templates/recensioniNoLog.tpl');
    }

    public function MostraPrenotazioni($prenotazioni,$utente){
        $this->smarty->assign('prenotazioni',$prenotazioni);
        $this->smarty->assign('Utente',$utente);
        $this->smarty->display('./smarty/libs/templates/prenotazioni.tpl');
    }
}