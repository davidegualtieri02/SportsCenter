<?php
class VPrenotaCampo{
    private function __construct(){
         $this->smarty = StartSmarty::configuration();
        }
   public function getTitolo(){
    return UMetodiHTTP::post('titoloCampo');
    }
   public function getPrezzo(){
    return UMetodiHTTP::post('prezzo');
    }

   public function MostraFormPrenotazione($campo){
    if(CUtente::Loggato()){
        $this->smarty->assign('UtenteLoggato','Loggato');
   }
   else{$this->smarty->assign('UtenteLoggato','Loggato');
    $this->smarty->assign('Campo',$campo);
    $this->smarty->display('./Smarty/libs/templates/pagamento.tpl');

    }
   }
}