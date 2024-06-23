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
            //allora daieg , il risultato della query è una o + tuple che contiengono i dati di una o + tessere , che vengono   restituite in un array multidimensionale dove ogni elemento di questo array è una tessera .  I dati della tessera sono allora volta inseriti in un altro array
            //quindi l'array multidimensionale può contentere altri  array con + tessere
        }
    }
}