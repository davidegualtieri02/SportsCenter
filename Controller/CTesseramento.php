<?php

class CTesseramento{
    //serve un metodo formTesseramento per mostrare la form?
    /**
     * Metodo per effettuare il tesseramento.
     */
    public static function tesseramento(){
        if(CUtente::Loggato()){
            //recupera l'id dell'utente dalla sessione
            $id_utente = USession::getIstanza()->getElementoSessione('Utente');
            //...la funzione creaOggTessera in FTessera prende in input una query che contiene cosa?
        }
    }
}