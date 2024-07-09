<?php
class VTesseramento{
    private $smarty;
    private function __construct(){
         $this->smarty = StartSmarty::configuration();
    }
    public function MostraFormTesseramento($tessera,$utente){
        $this->smarty->assign('tesseramento',$tessera);
        $this->smarty->assign('Utente',$utente);
        $this->smarty->display('tesseramento.tpl');
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