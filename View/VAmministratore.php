<?php
class VAmministratore{
    private $smarty;
    private function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    public function MostraloginForm(){
        $this->smarty->display('Amministratore-login.tpl'); //NON ESISTE, va messo login.tpl?
    }
    public function MostraFormPrenotazioneAmm($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$imageCampo,$data,$orario,$attrezzatura){
        $this->smarty->assign('NomeAmministratore',$nomeAmministratore);
        $this->smarty->assign('campo',$idCampo);
        $this->smarty->assign('data',$data);
        $this->smarty->assign('orario',$orario);
        $this->smarty->assign('titoloCampo',$titoloCampo);
        $this->smarty->assign('prezzoCampo',$prezzoCampo);
        $this->smarty->assign('imageCampo',$imageCampo);
        $this->smarty->assign('attrezzatura',$attrezzatura);
        $this->smarty->display('./smarty/libs/templates/attrezzatura.tpl');
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
   
    public function MostraGiorno($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$imageCampo){
        $this->smarty->assign('NomeAmministratore',$nomeAmministratore);
        $this->smarty->assign('campo',$idCampo);
        $this->smarty->assign('titoloCampo',$titoloCampo);
        $this->smarty->assign('prezzoCampo',$prezzoCampo);
        $this->smarty->assign('imageCampo',$imageCampo);
        $this->smarty->display('./smarty/libs/templates/calendario.tpl');
    }
    public function MostraOra($nomeAmministratore,$idCampo,$titoloCampo,$prezzoCampo,$imageCampo,$giorno){
        $this->smarty->assign('NomeAmministratore',$nomeAmministratore);
        $this->smarty->assign('campo',$idCampo);
        $this->smarty->assign('titoloCampo',$titoloCampo);
        $this->smarty->assign('prezzoCampo',$prezzoCampo);
        $this->smarty->assign('imageCampo',$imageCampo);
        $this->smarty->assign('data',$giorno);

    }

   
}