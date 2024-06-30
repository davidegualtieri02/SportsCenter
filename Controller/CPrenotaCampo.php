<?php

class CPrenotaCampo{
    /**
     * Metodo per confermare ed inviare  la prenotazione 
     * @param $idCampo è l'id del campo che l'utente vuole prenotare
     */
    public static function MostraPagamento($idAttrezzatura){ //Con GET il server invia la form di prenotazione 
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza(); // otteniamo un'istanza della sessione utente  
        //prendendo un oggetto attrezzatura viene preso un kit standard di attrezzatura per esempio un attrezzatura calcio fa prendere 5 casacche e 2 palloni , il num casacca e il num palloni sono contentuti nella tupla dell'attrezzatura
        //nel db
        $attrezzatura = $pm::recuperaOggetto('FAttrezzatura',$idAttrezzatura);// recuperiamo l'oggetto campo sportivo nel db
        //if($attrezzatura == FAttrezzatura_Basket::getOgg($idAttrezzatura))
        $view = new VPrenotaCampo();//creiamo un'istanza della view per la prenotazione del campo
        $campo = $sessione::getElementoSessione('campo');
        $data = $sessione::getElementoSessione('data');
        $orario = $sessione::getElementoSessione('orario');
        if(UServer::getRichiestaMetodo()=="GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
            $utente = unserialize($sessione->LeggiValore('Utente'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente 
            $idcampo = $campo->getId();
            $titolocampo = $campo->getTitolo();
            if(($titolocampo = "Campo Basket 1") || ($titolocampo = "Campo Basket 2")){
                $view->MostraFormAttrezzaturaBasket($utente,$idcampo,$attrezzatura,$titolocampo); //viene mostrata la form per la prenotazione
            }
            if(($titolocampo = "Campo Calcio 1") || ($titolocampo = "Campo Calcio 2")){
                $view->MostraFormAttrezzaturaCalcio($utente,$idcampo,$attrezzatura,$titolocampo);
            }
            if(($titolocampo = "Campo Padel 1") ||($titolocampo = " Campo Padel 2")){
                $view->MostraFormAttrezzaturaPadel($utente,$idcampo,$attrezzatura,$titolocampo);
            }
            if(($titolocampo = "Campo Pallavolo 1") ||($titolocampo = " Campo Pallavolo 2")){
                $view->MostraFormAttrezzaturaPallavolo($utente,$idcampo,$attrezzatura,$titolocampo);
            }
            if(($titolocampo = "Campo Tennis 1") || ($titolocampo= " Campo Tennis 2")){
                $view->MostraFormAttrezzaturaTennis($utente,$idcampo,$attrezzatura,$titolocampo);
            }
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $idAttrezzatura = UMetodiHTTP::post('id_attrezzatura'); //viene mandato al server l'id dell'attrezzatura che ha scelto l'utente
            $view->MostraFormPagamento($utente,$idAttrezzatura,$campo,$data,$orario);
    
        }
        
    }
    /**
     * Metodo che mi rida la form con i dati del pagamento
     */
    public static function MostraConfermaPrenotazione($idcarta){
        $sessione = USession::getIstanza();
        $pm = FPersistentManager::getIstanza();
        $carta = FPersistentManager::recuperaOggetto("ECartadiPagamento",$idcarta);
        $idcarta= $carta->getIdCarta();
        $view = new VPrenotaCampo();
        $campo = $sessione::getElementoSessione('campo');
        $data = $sessione::getElementoSessione('data');
        $orario = $sessione::getElementoSessione('orario');
        $attrezzatura = $sessione::getElementoSessione('id_attrezzatura');
        if(UServer::getRichiestaMetodo()=="GET"){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $view ->MostraFormPagamento($utente,$campo,$data,$orario,$attrezzatura);
            
        }
        elseif(UServer::getRichiestaMetodo()=="POST"){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $nome = UMetodiHTTP::post('Nome_Titolare');
            $cognome = UMetodiHTTP::post('Cognome_Titolare');
            $scadenza = UMetodiHTTP::post('Data_Scadenza');
            $numero = UMetodiHTTP::post('Numero_Carta');
            $cvv = UMetodiHTTP::post('CVV');
            $prenotazione = new EPrenotazione($data,$orario,true,$campo->getId_campo(),$attrezzatura);
            $pm::uploadOgg($prenotazione);
            $view->ConfermaPrenotazione($utente,$nome,$cognome,$scadenza,$numero,$cvv);


        }

    }
    /**
     * Metodo che dopo aver cliccato sul campo da prenotare mostra le info del campo e il calendario
     */
    public static function MostraCalendario($idCampo){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        $campo = FPersistentManager::recuperaOggetto('ECampo',$idCampo);
        if(UServer::getRichiestaMetodo()=="GET"){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $view->MostraCalendario($utente,$campo);
             
        }
    }
    /**
     * Metodo che mostrerà una volta che l'utente fornisce la data gli orari disponibili per quel campo e quel giorno
     */
    public static function MostraOrari($giorno){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo(); 
        if(UServer::getRichiestaMetodo()=="POST"){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $campo = $sessione::getElementoSessione('campo');// la sessione mantiene il campo scelto in sessione e viene ripreso
            $giornoStr = UMetodiHTTP::post('data');
            $giorno = new DateTime($giornoStr);
            $view->MostraOrari($utente,$campo,$giorno);
        }
    }
    /**
     * Metodo che mostra l'array di orari disponibili per la prenotazione di quel campo in quel giorno 
     * e fa scegliere all'utente uno di questi orari per prenotare il campo
     */
    public static function MostraAttrezzatura($orario){
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
       if(UServer::getRichiestaMetodo()=='GET'){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $campo = $sessione::getElementoSessione('campo');
            $giorno = $sessione::getElementoSessione('data');
            $orari = FPersistentManager::orariDisponibili($giorno);
            $view->MostraListaOrari($utente,$campo,$giorno,$orari);
         }
        elseif(UServer::getRichiestaMetodo()=='POST'){
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $campo = $sessione::getElementoSessione('campo');
            $giorno = $sessione::getElementoSessione('data');
            $orario = UMetodiHTTP::post('orario') ;

            $view->MostraPagAttrezzatura($utente,$orario,$giorno,$campo);
        }
    }

    /**
     * Metodo che viene interpellato quando si clicca su una delle prenotazioni effettuate dall'utente
     */
    public function MostraPrenotazione($idPrenotazione){
        $view = new VPrenotaCampo();
        $sessione = USession::getIstanza();
        $utente =  unserialize($sessione->LeggiValore('Utente'));
        $prenotazione = FPersistentManager::recuperaOggetto('EPrenotazione',$utente->getId());
        $idPrenotazione = $prenotazione->getIdPrenotazione();
        $view->mostraInfoPrenotazione($utente,$prenotazione);
    }
    
    /**
     * Metodo per annullare una prenotazione
     * @param $idPrenotazione è l'id della prenotazione che l'utente vuole annullare
     */
    public static function annullaPrenotazione($idPrenotazione) {
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VPrenotaCampo();
        if(UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            $utente = unserialize($sessione->LeggiValore('Utente'));
            $idPrenotazione = $sessione::getElementoSessione('id_prenotazione');
            $pm::deletePrenotazione($idPrenotazione,$utente->getId());
            $view->MostraMessaggioConferma("Prenotazione annullata con successo!"); // se l array $dichiarazione ha più di 0 elementi  allora l'eliminazione della prenotazione è avvenuta con successo
        }
    }

    public static function mostraCampi(){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VCampi();
        if (CUtente::Loggato()){
            $utente= unserialize($sessione->LeggiValore('Utente'));
            // Recupera i campi da tutte le tabelle specificate usando recuperaOggetto        
            if(UServer::getRichiestaMetodo()=='GET'){
                $campi_basket[] = $pm::RecuperaTuple(FCampo_Basket::getTabella());
                 $campi_pallavolo[] = $pm::RecuperaTuple(FCampo_Pallavolo::getTabella());
                $campi_calcio[] = $pm::RecuperaTuple(FCampo_Calcio::getTabella());
                $campi_tennis[] = $pm::RecuperaTuple(FCampo_Tennis::getTabella());
                 $campi_padel[] = $pm::RecuperaTuple(FCampo_Padel::getTabella());
            // Aggiunge tutti i campi contenuti negli array sopra  in un unico array campi
                 $campi = array_merge($campi_basket, $campi_pallavolo, $campi_calcio, $campi_tennis,$campi_padel);

            // quando aggiungiamo un campo , siccome fotocampo è un attributo del campo viene caricata e visualizzata anche l'immagine del campo insieme a tutto il campo
             // Passa i dati alla vista per la visualizzazione
                $view->mostraCampi($campi,$utente);
            }    
        else{
            header("Location: SportsCenter/Utente/login");
            exit;
            }

        }
   }
}

