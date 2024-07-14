<?php
require_once(__DIR__ . "/../install/StartSmarty.php");
class VTesseramento{
    private $smarty;
    public function __construct(){
         $this->smarty = StartSmarty::configuration();
    }
    public function MostraFormTesseramento($nomeUtente,$cognomeUtente,$emailUtente){
        $this->smarty->assign('nomeUtente',$nomeUtente);
        $this->smarty->assign('cognomeUtente',$cognomeUtente);
        $this->smarty->assign('emailUtente',$emailUtente);
        $this->smarty->display('./smarty/libs/templates/tesseramento.tpl');
    }
    public function MostraMessaggioTesseramento(){
        $this->smarty->assign('conferma',true);
        $this->smarty->display('mostra_confermaTesseramento.tpl'); //NON ESISTE

    }
    public function MostraModuloTesseramento($utente){
        $this->smarty->assign('Utente',$utente);
        $this->smarty->display('Tessera.tpl'); //NON ESISTE
    }
    public function MostraAnnullamentoTesseramento(){
        $this->smarty->assign('Conferma',true);
        $this->smarty->display('mostra_conferma.tpl'); //NON ESISTE
    }
}