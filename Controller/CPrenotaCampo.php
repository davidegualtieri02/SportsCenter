<?php

class CPrenotaCampo{
    public static function prenotacampo(){
        if(CUtente::Loggato()){
            $id_Utente = USession::getIstanza()->getElementoSessione('utente'); //se l'utente è loggato, recupera il suo id dalla sessione
            $utente = FPersistentManager::getIstanza()->recuperaOgg(FUtente::getClasse(), $id_Utente); //utente o utente registrato?. recupera l'oggetto utente tramite il suo id
            //...
        }
    }
}