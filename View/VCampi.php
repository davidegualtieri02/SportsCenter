<?php
class VCampi{
    private $smarty;
    private function __construct(){
        $this->smarty = StartSmarty::configuration();
    }
    public function MostraCampiAmm($campi,$amministratore){
        $this->smarty->assign('campi',$campi);
        $this->smarty->assign('Amministratore',$amministratore);
        $this->smarty->display('/Smarty/libs/templates/campi.tpl');
    }
}