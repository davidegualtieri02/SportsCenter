<?php
class VTesseramento{
    private $smarty;
    private function __construct(){
         $this->smarty = StartSmarty::configuration();
    }
    public function MostraFormTesseramento($tessera,$utente){
        $this->smarty->assign('tesseramento',$tessera);
        $this->smarty->assign('Utente',$utente);
        $this->smarty->display('form_tesseramento.tpl');
    }
    public function MostraMessaggioTesseramento(){
        $this->smarty->assign('conferma',true);
        $this->smarty->display('mostra_confermaTesseramento.tpl');

    }
    public function MostraModuloTesseramento($utente){
        $this->smarty->assign('Utente',$utente);
        $this->smarty->display('Tessera.tpl');
    }
    public function MostraAnnullamentoTesseramento(){
        $this->smarty->assign('Conferma',true);
        $this->smarty->display('mostra_conferma.tpl');
    }
    

}