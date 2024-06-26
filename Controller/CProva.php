<?php
 if(FPersistentManager::campoDisponibile($idCampo,$data,$orario)){
    if(FPersistentManager::ProcessoPag($nome,$cognome,$numeroCarta,$scadenzaCarta,$cvvCarta)){// se il pagamento è avvenuto con successo
        //eseguiamo l'inserimento della prenotazione nel database
        $sql = "INSERT INTO 'Prenotazione' ('data','orario','id_campo','id_attrezzatura','id_utente') VALUES (:data,:orario,:id_campo,:id_attrezzatura,:id_utente)"; // la prenotazione viene creata e aggiunta nel db cosi 
        $dichiarazione = $pdo->prepare($sql);
        $dichiarazione->execute([':id_utente'=>$idUtente,':id_campo' => $idCampo,':data'=> $data,':orario'=>$orario,':id_attrezzatura'=>$idAttrezzatura]);

        $view->MostraMessaggioConferma("Campo prenotato con successo!");
    }
    else{
        $view->MostraMessaggioPopUpErrore("Il campo non è disponibile per la prenotazione");
    }    