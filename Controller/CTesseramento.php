<?php

class CTesseramento{
    //serve un metodo formTesseramento per mostrare la form? Si
    /**
     * Metodo per effettuare il tesseramento.
     */
     //...la funzione creaOggTessera in FTessera prende in input una query che contiene cosa?
            //allora daieg , il risultato della query è una o + tuple che contiengono i dati di una o + tessere , che vengono   restituite in un array multidimensionale dove ogni elemento di questo array è una tessera .  I dati della tessera sono allora volta inseriti in un altro array
            //quindi l'array multidimensionale può contentere altri  array con + tessere

     //  Durante la fase GET, mostra il form vuoto. Durante la fase POST, valida i dati e salva l'utente nel database.      
    public static function tesseramento($idtessera,$idUtente,$dataScadenza){
        //if(CUtente::Loggato()){
            //recupera l'id dell'utente dalla sessione
           // $id_utente = USession::getIstanza()->getElementoSessione('Utente');
          
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VTesseramento();
        if(CUtente::Loggato()){
            //con questi due metodi unserialize  e Leggivalore otteniamo l'utente loggato dalla sessione
            $utente = unserialize($sessione->LeggiValore('utente'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente e viene preso l'utente dall'oggetto sessione
            $tessera = $pm::recuperaOggetto('ETessera',$idtessera); //ha senso porre uploadOgg sia perchè la form prende come parametro la tessera  e anche perchè il form dovrà prendere i dati della tessera.
            if(UServer::getRichiestaMetodo()=="GET"){
                $view ->MostraFormTesseramento($tessera,$utente); // viene mostrata la form per il tesseramento
            }
            elseif(UServer::getRichiestaMetodo()=="POST"){
                $utente = unserialize($sessione->LeggiValore('utente'));
                $idUtente = $utente->getId();
                $nome = UMetodiHTTP::post('Nome_Titolare');
                $cognome = UMetodiHTTP::post('Cognome_Titolare');
                $numeroCarta = UMetodiHTTP::post('Numero_Carta');
                $scadenzaCarta = UMetodiHTTP::post('Data_Scadenza');
                $cvvCarta = UMetodiHTTP::post('CVV');
                $dataInizioStr = UMetodiHTTP::post("Data_Inizio"); // l'utente insersice una stringa perciò dobbiamo convertire la stringa in un oggetto DateTime
                // conversione della data di inizio in oggetto DateTime
                try{
                    $dataInizio = new DateTime($dataInizioStr);
                } catch(Exception $errore){
                     return " Errore: la data inserita non è corretta " . $errore->getMessage();
                }
                $dataScadenza = clone $dataInizio; // la data scadenza è ottenuta dalla clonazione di $dataInizio
                $dataScadenza->modify('+1 year'); // siccome il tesseramento dura un anno $dataScadenza viene modificata di un anno rispetto a dataInizio, dunque la dataSacdenza è pari a dataInizio + un anno.
                //questo perchè il tesseramento dura un anno
                if(FPersistentManager::ProcessoPag($nome, $cognome, $numeroCarta, $scadenzaCarta, $cvvCarta)) {
                    $tesseramento = new ETessera($idUtente,$dataScadenza, $dataInizio); // Sostituire con i dati effettivi del tesseramento
                    $pm->uploadOgg($tesseramento); // Aggiunta del tesseramento nel database
                    $view->mostraMessaggioConferma("Tesseramento effettuato con successo!");
                }else {
                    $view->mostraMessaggioErrore("Errore durante il pagamento del tesseramento. Riprova più tardi.");
                }
        }else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }  
        }  
        
    }
}

