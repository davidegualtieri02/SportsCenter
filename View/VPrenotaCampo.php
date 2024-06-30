<?php
class VPrenotaCampo{
     private $smarty;
    private function __construct(){
         $this->smarty = StartSmarty::configuration();
        }
   public function getTitolo(){
    return UMetodiHTTP::post('titoloCampo');
    }
   public function getPrezzo(){
    return UMetodiHTTP::post('prezzo');
    }

   public function MostraFormPagamento($utente,$campo,$data,$orario,$idattrezzatura){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('Campo',$campo);
     $this->smarty->assign('data',$data);
     $this->smarty->assign('orario',$orario);
     $this->smarty->assign('id_attrezzatura',$idattrezzatura);
     $this->smarty->display('./Smarty/libs/templates/pagamento.tpl');
   }
   public function ConfermaPrenotazione($utente,$nome,$cognome,$scadenza,$numerocarta,$cvv){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('Nome_Titolare',$nome);
     $this->smarty->assign('Cognome_Titolare',$cognome);
     $this->smarty->assign('Data_Scadenza',$scadenza);
     $this->smarty->assign('Numero_Carta',$numerocarta);
     $this->smarty->assign('CVV',$cvv);
     $this->smarty->display('./Smarty/libs/templates/info_pagamento.tpl');

   }
   public function MostraCalendario($utente,$campo){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('Campo',$campo);
     $this->smarty->display('./Smarty/libs/templates/calendario.tpl');
   }
   public function MostraOrari($utente,$giorno,$campo){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->assign('Campo',$campo);
     $this->smarty->display('./Smarty/libs/templates/orari.tpl');

   }
   public function MostraPagAttrezzatura($utente,$orario,$giorno,$campo){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('orario',$orario);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->assign('Campo',$campo);
     $this->smarty->display('./Smarty/libs/templates/attrezzatura.tpl');
   }
   // è legata ad un metodo che fa vedere le informazioni su una prenotazione
   public function MostraInfoPrenotazione($utente,$prenotazione){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('prenotazione',$prenotazione);
     $this->smarty->display('/Smarty/libs/templates/info.tpl');

   }
   //non credo che sia cosi 
   public function MostraMessaggioConferma($conferma){
     $this->smarty->assign('conferma',$conferma);
     $this->smarty->display('./Smarty/libs/templates/annulla_prenotazione.tpl');
   }

   public function MostraCampi($campi,$utente){
     $this->smarty->assign('campi',$campi);
     $this->smarty->assign('Utente',$utente);
     $this->smarty->display('/Smarty/libs/templates/campi.tpl');


   }
   

}