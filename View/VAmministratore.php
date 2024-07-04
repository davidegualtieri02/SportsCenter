<?php
class VAmministratore{
    private $smarty;
    private function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    public function MostraloginForm(){
        $this->smarty->display('Amministratore-login.tpl');
    }
    public function MostraFormPrenotazione($amm,$campo,$data,$orario,$attrezzatura){
        $this->smarty->assign('amministratore',$amm);
        $this->smarty->assign('Campo',$campo);
        $this->smarty->assign('data',$data);
        $this->smarty->assign('orario',$orario);
        $this->smarty->assign('attrezzatura',$attrezzatura);
        $this->smarty->display('form_prenotazione_amministratore.tpl');
    }
    public function ConfermaPrenotazione($amministratore){
        $this->smarty->asssign('amministratore',$amministratore);
        $this->smarty->display('prenotazione_amministratore.tpl');

    }
   
    public function MostraMessaggioConferma($amministratore){
        $this->smarty->assign('attrezzatura',$amministratore);
        $this->smarty->display('messaggio_conferma.tpl');

    }
    public function MostraPrenotazioniAmm($amministratore,$prenotazione){
        $this->smarty->assign('amministratore',$amministratore);
        $this->smarty->assign('prenotazione',$prenotazione);
        $this->smarty->display('prenotazioni_amm.tpl');


    }
}