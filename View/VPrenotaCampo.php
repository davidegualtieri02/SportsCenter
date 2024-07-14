<?php
require_once(__DIR__ . "/../install/StartSmarty.php");
class VPrenotaCampo{
   private $smarty;
   public function __construct(){
         $this->smarty = StartSmarty::configuration();
        }
   public function getTitolo(){
    return UMetodiHTTP::post('titoloCampo');
    }
   public function getPrezzo(){
    return UMetodiHTTP::post('prezzo');
    }

   public function MostraFormPagamento($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario,$attrezzatura){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     //$this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->assign('orario',$orario);
     $this->smarty->assign('attrezzatura',$attrezzatura);
     $this->smarty->display('./smarty/libs/templates/pagamento.tpl');
   }
   public function ConfermaPrenotazione($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario,$attrezzatura){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     //$this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->assign('data',$giorno);
     $this->smarty->assign('ora',$orario);
     $this->smarty->assign('attrezzatura',$attrezzatura);
     //$this->smarty->assign('Nome_Titolare',$nome);
     //$this->smarty->assign('Cognome_Titolare',$cognome);
     //$this->smarty->assign('Data_Scadenza',$scadenza);
     //$this->smarty->assign('Numero_Carta',$numerocarta);
     //$this->smarty->assign('CVV',$cvv);
     $this->smarty->display('./smarty/libs/templates/confermaPrenotazione.tpl');

   }
   public function MostraCalendario($nomeUtente, $id_tesseraUtente, $idCampo, $titoloCampo, $prezzoCampo){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     //$this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->display('./smarty/libs/templates/calendario.tpl');
   }
   /*
   public function MostraOrari($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     //$this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->display('./smarty/libs/templates/orari.tpl');
   }
   */
   public function MostraOrari($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orari){
    $this->smarty->assign('nomeUtente',$nomeUtente);
    $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
    $this->smarty->assign('idCampo',$idCampo);
    $this->smarty->assign('titoloCampo',$titoloCampo);
    $this->smarty->assign('prezzoCampo',$prezzoCampo);
    //$this->smarty->assign('imageCampo',$imageCampo);
    $this->smarty->assign('giorno',$giorno);
    $this->smarty->assign('orari',$orari);
    $this->smarty->display('./smarty/libs/templates/orari.tpl');
  }

   public function MostraAttrezzatura($nomeUtente,$id_tesseraUtente,$idCampo,$titoloCampo,$prezzoCampo,$giorno,$orario){
     $this->smarty->assign('nomeUtente',$nomeUtente);
     $this->smarty->assign('id_tesseraUtente',$id_tesseraUtente);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('prezzoCampo',$prezzoCampo);
     //$this->smarty->assign('imageCampo',$imageCampo);
     $this->smarty->assign('giorno',$giorno);
     $this->smarty->assign('orario',$orario);
     $this->smarty->display('./smarty/libs/templates/attrezzatura.tpl');
   }
   // è legata ad un metodo che fa vedere le informazioni su una prenotazione
   public function MostraInfoPrenotazione($idUtente,$utente,$id_prenotazione,$dataPrenotazione,$orarioPrenotazione,$idCampo,$titoloCampo,$attrezzatura){
     $this->smarty->assign('utente',$utente); // assign serve per passare delle variabili da php ai template smarty
     $this->smarty->assign('idUtente',$idUtente);
     //il primo parametro è la variabile che verrà usata nel template di smarty
     // in questo caso nel template la variabile si chiamerà Utente
     // il secondo parametro è il valore che viene assegnato al primo parametro . Quindi questo codice prende il valore della variabile $utente
     // e lo rende disponibile nel template smarty sotto il nome di 'Utente'
     $this->smarty->assign('id_prenotazione',$id_prenotazione);
     $this->smarty->assign('dataPrenotazione',$dataPrenotazione);
     $this->smarty->assign('orarioPrenotazione',$orarioPrenotazione);
     $this->smarty->assign('idCampo',$idCampo);
     $this->smarty->assign('titoloCampo',$titoloCampo);
     $this->smarty->assign('attrezzatura',$attrezzatura);
     $this->smarty->display('./smarty/libs/templates/scrivi_recensione.tpl');

   }
 
   public function MostraMessaggioConferma(){
     $this->smarty->display('./Smarty/libs/templates/annulla_prenotazione.tpl');
   }

   public function MostraCampiUtente($utente){
    //$this->smarty->assign('utente',$utente);
    $this->smarty->display('./smarty/libs/templates/servizi.tpl');


   }
   public function MostraErrore(){
    $this->smarty->assign('errore',true);
    $this->smarty->display('./smarty/libs/templates/errore.tpl'); //NON ESISTE
   }
  
   

   //Funzioni commentate: non dovrebbero servire
   
   //public function MostraFormAttrezzaturaBasket($utente,$idcampo,$attrezzatura,$titolocampo){
    //$this->smarty->assign('Utente',$utente);
    //$this->smarty->assign('id_campo',$idcampo);
    //$this->smarty->assign('attrezzatura',$attrezzatura);
    //$this->smarty->assign('titolocampo',$titolocampo);
    //$this->smarty->display('./smarty/libs/templates/attrezzatura_basket.tpl');
   //}
   //public function MostraFormAttrezzaturaPadel($utente,$idcampo,$attrezzatura,$titolocampo){
    //$this->smarty->assign('Utente',$utente);
    //$this->smarty->assign('id_campo',$idcampo);
    //$this->smarty->assign('attrezzatura',$attrezzatura);
    //$this->smarty->assign('titolocampo',$titolocampo);
    //$this->smarty->display('./smarty/libs/templates/attrezzatura_padel.tpl');
   //}
   //public function MostraFormAttrezzaturaCalcio($utente,$idcampo,$attrezzatura,$titolocampo){
    //$this->smarty->assign('Utente',$utente);
    //$this->smarty->assign('id_campo',$idcampo);
    //$this->smarty->assign('attrezzatura',$attrezzatura);
    //$this->smarty->assign('titolocampo',$titolocampo);
    //$this->smarty->display('./smarty/libs/templates/attrezzatura_calcio.tpl');
   //}
   //public function MostraFormAttrezzaturaPallavolo($utente,$idcampo,$attrezzatura,$titolocampo){
    //$this->smarty->assign('Utente',$utente);
    //$this->smarty->assign('id_campo',$idcampo);
    //$this->smarty->assign('attrezzatura',$attrezzatura);
    //$this->smarty->assign('titolocampo',$titolocampo);
    //$this->smarty->display('./smarty/libs/templates/attrezzatura_pallavolo.tpl');
   //}
   //public function MostraFormAttrezzaturaTennis($utente,$idcampo,$attrezzatura,$titolocampo){
    //$this->smarty->assign('Utente',$utente);
    //$this->smarty->assign('id_campo',$idcampo);
    //$this->smarty->assign('attrezzatura',$attrezzatura);
    //$this->smarty->assign('titolocampo',$titolocampo);
    //$this->smarty->display('./smarty/libs/templates/attrezzatura_tennis.tpl');
   //}
  
   public function MostraPrenotazioni($utente,$prenotazioni){
    $this->smarty->assign('Utente',$utente);
    $this->smarty->assign('prenotazioni',$prenotazioni);
    $this->smarty->display('./smarty/libs/templates/prenotazioni.tpl');
}

}