<?php

class CPrenotaCampo{
    public static function prenotaCampo($idCampo){ //Con GET il server invia la form di prenotazione 
        $pm = FPersistentManager::getIstanza();
        $sessione = USession::getIstanza(); // otteniamo un'istanza della sessione utente
        $campo = $pm::uploadOgg($idCampo);// carichiamo l'oggetto campo sportivo nel db
        $view = new VPrenotaCampo();//creiamo un'istanza della view per la prenotazione del campo
        if(UServer::getRichiestaMetodo()=="GET"){//verifichiamo se la richiesta al server è di tipo GET, cioè manda i dati dal server al client , il server manda i dati sui campi disponibili all'utente
            if(CUtente::Loggato()){// se l'utente è loggato
                $utente = unserialize($sessione->LeggiValore('utente'));//ripristina una stringa in un oggetto. Quindi 'utente' viene trasformato da stringa a oggetto utente 
                $view ->MostraFormPrenotazione($campo);//viene mostrata la form per la prenotazione
            }else{// se l'utente non è loggato viene reindirizzato alla pagina di login 
                header('Location: /SportsCenter/Utente/login');
                exit;//fa in modo che il codice dopo non viene eseguito se l'utente non è loggato.
            }    
        }
        if (UServer::getRichiestaMetodo()=="POST"){//Con POST l'utente che prenota i campi invia i dati della prenotazione al server per vedere se sono disponibili
            if(CUtente::Loggato()){
                $utente = unserialize($sessione->LeggiValore('utente'));
                $idUtente = $utente->getId();
                // l'utente invia la data e l'orario  in cui vorrebbe prenotare il campo al server 
                $data = UMetodiHTTP::post('data'); 
                $orario = UMetodiHTTP::post('orario');
                $pdo = new PDO('mysql:host=localhost;dnname =prova','root','password123', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false]);
                if(FPersistentManager::campoDisponibile($pdo,$idCampo,$data,$orario)){
                    //eseguiamo l'inserimento della prenotazione nel database
                    $sql = "INSERT INTO 'Prenotazione' ('id_utente','id_campo','data','orario') VALUES (:id_utente,:id_campo,:data,:orario)";
                    $dichiarazione = $pdo->prepare($sql);
                    $dichiarazione->execute([':id_utente'=>$idUtente,':id_campo' => $idCampo,':data'=> $data,':orario'=>$orario]);
                    $view->MostraMessaggioConferma("Campo prenotato con successo!");
                }
                else{
                    $view->MostraMessaggioErrore("Il campo non è disponibile per la prenotazione");
                }    
        
            }else{
                header('Location: /SportsCenter/Utente/login');
                exit;
            }
        }
    }
}