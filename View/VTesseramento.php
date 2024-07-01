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
    public function MostraMessaggioTesseramento($messaggio){
        switch ($messaggio){
            case 'Tesseramento effettuato con successo':
                $this->smarty->assign('Tesseramento effettuato con successo'."Tesseramento effettuato con successo");
                break;
        }
        $this->smarty->display('mostra_confermaTesseramento.tpl');

    }
    public function MostraMessaggioErrore($errore){
        switch ($errore){
            case 'Errore durante il tesseramento':
                $this->smarty->assign(' Errore durante il tesseramento'," Errore durante il tesseramento");
                break;
        }
        $this->smarty->display('errore_Tesseramento.tpl');


    }

}