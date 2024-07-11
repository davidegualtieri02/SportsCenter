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
    public static function MostraTesseramento(){
        if(CUtente::Loggato()){
            $view = new VTesseramento();
            //recupera l'id dell'utente dalla sessione
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $utente = FPersistentManager::recuperaOggetto('EUtenteRegistrato',$idUtente);
            //con questi due metodi unserialize  e Leggivalore otteniamo l'utente loggato dalla sessione
           //ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente e viene preso l'utente dall'oggetto sessione
        
            if(UServer::getRichiestaMetodo()=="GET"){
                $view ->MostraModuloTesseramento($idUtente); // viene mostrata la form per il tesseramento
            }
            elseif(UServer::getRichiestaMetodo()=="POST"){
                $nome = UMetodiHTTP::post('Nome_Titolare');
                $cognome = UMetodiHTTP::post('Cognome_Titolare');
                $numeroCarta = UMetodiHTTP::post('Numero_Carta');
                $scadenzaCarta = UMetodiHTTP::post('Data_Scadenza');
                $cvvCarta = UMetodiHTTP::post('CVV');
                $dataInizioStr = UMetodiHTTP::post("Data_Inizio"); // l'utente insersice una stringa perciò dobbiamo convertire la stringa in un oggetto DateTime
                // conversione della data di inizio in oggetto DateTime
                $dataInizio = new DateTime($dataInizioStr); // la dataInizio può essere solo la data giornaiera di quel giorno 
                $dataScadenza = clone $dataInizio; // la data scadenza è ottenuta dalla clonazione di $dataInizio
                $dataScadenza->modify('+1 year'); // siccome il tesseramento dura un anno $dataScadenza viene modificata di un anno rispetto a dataInizio, dunque la dataSacdenza è pari a dataInizio + un anno.
                //questo perchè il tesseramento dura un anno
                    $tesseramento = new ETessera($idUtente,$dataScadenza, $dataInizio); // Sostituire con i dati effettivi del tesseramento
                    FPersistentManager::uploadOgg($tesseramento); // Aggiunta del tesseramento nel database
                    $utenteRegistratoTesserato = new EUtenteTesserato($nome,$cognome,$utente->getEmail(),$utente->getPassword(),false);// se l'utente si sta tesserando il ban è impostato a false
                    FPersistentManager::uploadOgg($utenteRegistratoTesserato);//aggiungo l'utente tesserato al database 
                    $view->MostraMessaggioTesseramento();
                }
            
        }else{
            header('Location: /SportsCenter/Utente/login');
            exit;
        }  
          
    }   
    
    //se l'utente è tesserato al posto di tesseramento sulla sbarra in alto abbiamo annulla tesseramento e questo caso d'uso annulla il tesseramento
    /**public static function annullaTesseramento($idtessera,$idUtente,$dataScadenza){
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza();
        $view = new VTesseramento();
        if(Userver::getRichiestaMetodo()=='GET'){
            $utente = unserialize($sessione->LeggiValore('utenteRegistrato'));
            $view->MostraModuloTesseramento($utente);
        }
        elseif(UServer::getRichiestaMetodo() == "POST") { // Verifica se la richiesta è POST
            $utente = unserialize($sessione->LeggiValore('utenteRegistrato'));
            $pdo = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
            if($pm::VerificaTesseramento($pdo,$utente->getId())) {
                $pm::deleteOgg(FTessera::getTabella(),$utente->getId(),'id_utenteRegistrato') ;
                $view->MostraAnnullamentoTesseramento(); // se l array $dichiarazione ha più di 0 elementi  allora l'eliminazione del tesseramento è avvenuto con successo
            }
        }
    }
    /** */
    
    //cliccando su Tesseramento nel menù a tendina dopo aver cliccato su profilo appare tramite questo metodo un modulo di tesseramento 
    /* public static function MostraTesseramento(){
        if(CUtente::Loggato()){
            $idUtente = USession::getIstanza()->getElementoSessione('utenteRegistrato');
            $view = new VTesseramento();
            if(UServer::getRichiestaMetodo()=='GET'){
                $view->MostraModuloTesseramento($idUtente);
            }
       }else{
            header('Location: /SportsCenter/Utente/login');
            exit;

        }

        }

    }
/** */

        
}