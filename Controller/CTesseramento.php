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
    public static function annullaTesseramento($idtessera,$idUtente,$dataScadenza){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VTesseramento();

        if (UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            if (CUtente::Loggato()) { // Verifica se l'utente è loggato
                $utente = unserialize($sessione->LeggiValore('utente'));
                $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
                if ($pm::VerificaTesseramento($pdo,$utente->getId())) {
                    $sql = "DELETE FROM Tessera WHERE id_utente = :id_utente";
                    $dichiarazione = $pdo->prepare($sql);
                    $dichiarazione->execute([':id_utente' => $utente->getId()]);
                   // Controlla se la cancellazione è avvenuta , DELETE restituisce le righe rimosse e rowCount conta tali righe 
                    if ($dichiarazione->rowCount() > 0) {//se l'array dichiarazione contiene almeno una riga cioè quando viene eliminato una riga , $dichiarazione contiene l'elemento eliminato e dunque ha + di 0 elementi 
                        $view->MostraMessaggioConferma("Tesseramento annullato con successo!"); // se l array $dichiarazione ha più di 0 elementi  allora l'eliminazione del tesseramento è avvenuto con successo
                    } else {
                        $view->MostraMessaggioErrore("Errore nell'annullamento del tesseramento");// se la prenotazione non viene rimossa , viene printato questo messaggio 
                    }
                } else {
                    $view->MostraMessaggioErrore("Impossibile annullare il Tesseramento, al momento non disponi di un tesseramento"); // se rowCount=0 non viene rimosso il tesseramento , cioè l'utente non ha effettuato il tesseramento e dunque non lo può eliminare
                }
            } else {
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }
        
}


