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
   public function MostraCalendario($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$imageCampo){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     $this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->display('./Smarty/libs/templates/calendario.tpl');
   }
   public function MostraOrari($utente,$giorno,$campo){
     $this->smarty->assign('Utente',$utente);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->assign('Campo',$campo);
     $this->smarty->display('./Smarty/libs/templates/giorno.tpl');
   }
   
   public function MostraListaOrari($utente,$giorno,$campo,$orari){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('giorno',$giorno);
    $this->smarty->assign('Campo',$campo);
    $this->smarty->assign('orari',$orari);
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
     $this->smarty->assign('Utente',$utente); // assign serve per passare delle variabili da php ai template smarty
     //il primo parametro è la variabile che verrà usata nel template di smarty
     // in questo caso nel template la variabile si chiamerà Utente
     // il secondo parametro è il valore che viene assegnato al primo parametro . Quindi questo codice prende il valore della variabile $utente
     // e lo rende disponibile nel template smarty sotto il nome di 'Utente'
     $this->smarty->assign('prenotazione',$prenotazione);
     $this->smarty->display('/Smarty/libs/templates/info.tpl');

   }
   //non credo che sia cosi 
   public function MostraMessaggioConferma(){
     $this->smarty->display('./Smarty/libs/templates/annulla_prenotazione.tpl');
   }

   public function MostraCampiUtente($campi,$utente){
     $this->smarty->assign('campi',$campi);
     $this->smarty->assign('Utente',$utente);
     $this->smarty->display('/Smarty/libs/templates/campi.tpl');


   }
   public function MostraErrore(){
    $this->smarty->assign('errore',true);
    $this->smarty->display('errore.tpl');
   }
   
   public function MostraFormAttrezzaturaBasket($utente,$idcampo,$attrezzatura,$titolocampo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('id_campo',$idcampo);
    $this->smarty->assign('attrezzatura',$attrezzatura);
    $this->smarty->assign('titolocampo',$titolocampo);
    $this->smarty->display('attrezzatura_basket.tpl');
   }
   public function MostraFormAttrezzaturaPadel($utente,$idcampo,$attrezzatura,$titolocampo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('id_campo',$idcampo);
    $this->smarty->assign('attrezzatura',$attrezzatura);
    $this->smarty->assign('titolocampo',$titolocampo);
    $this->smarty->display('attrezzatura_padel.tpl');
   }
   public function MostraFormAttrezzaturaCalcio($utente,$idcampo,$attrezzatura,$titolocampo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('id_campo',$idcampo);
    $this->smarty->assign('attrezzatura',$attrezzatura);
    $this->smarty->assign('titolocampo',$titolocampo);
    $this->smarty->display('attrezzatura_calcio.tpl');
   }
   public function MostraFormAttrezzaturaPallavolo($utente,$idcampo,$attrezzatura,$titolocampo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('id_campo',$idcampo);
    $this->smarty->assign('attrezzatura',$attrezzatura);
    $this->smarty->assign('titolocampo',$titolocampo);
    $this->smarty->display('attrezzatura_pallavolo.tpl');
   }
   public function MostraFormAttrezzaturaTennis($utente,$idcampo,$attrezzatura,$titolocampo){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('id_campo',$idcampo);
    $this->smarty->assign('attrezzatura',$attrezzatura);
    $this->smarty->assign('titolocampo',$titolocampo);
    $this->smarty->display('attrezzatura_tennis.tpl');
   }
  
   public function MostraPrenotazioni($utente,$prenotazioni){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('prenotazioni',$prenotazioni);
    $this->smarty->display('prenotazioni.tpl');
}




}