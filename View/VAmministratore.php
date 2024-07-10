<?php
class VAmministratore{
    private $smarty;
    private function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    public function MostraloginForm(){
        $this->smarty->display('Amministratore-login.tpl'); //NON ESISTE, va messo login.tpl?
    }
    public function MostraFormPrenotazione($amm,$campo,$data,$orario,$attrezzatura){
        $this->smarty->assign('amministratore',$amm);
        $this->smarty->assign('Campo',$campo);
        $this->smarty->assign('data',$data);
        $this->smarty->assign('orario',$orario);
        $this->smarty->assign('attrezzatura',$attrezzatura);
        $this->smarty->display('./smarty/libs/templates/form_prenotazione_amministratore.tpl'); //NON ESISTE
    }
    public function ConfermaPrenotazione($amministratore){
        $this->smarty->asssign('amministratore',$amministratore);
        $this->smarty->display('./smarty/libs/templates/prenotazione_amministratore.tpl'); //NON ESISTE

    }
   
    public function MostraMessaggioConferma($amministratore){
        $this->smarty->assign('attrezzatura',$amministratore);
        $this->smarty->display('./smarty/libs/templates/messaggio_conferma.tpl'); //NON ESISTE

    }
    public function MostraPrenotazioniAmm($amministratore,$prenotazione){
        $this->smarty->assign('amministratore',$amministratore);
        $this->smarty->assign('prenotazione',$prenotazione);
        $this->smarty->display('./smarty/libs/templates/prenotazioni_amm.tpl'); //NON ESISTE, modificare prenotazioni.tpl in modo tale che, con un if, se l'id è 1 (quindi dell'amministratore), mostra tutte le prenotazioni, altrimenti mostra solo le prenotazioni fatte dall'utente a cui è collegato l'id


    }
}