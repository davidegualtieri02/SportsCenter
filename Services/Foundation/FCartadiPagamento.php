<?php

class FCartadiPagamento{
    //Dichiarazione di variabili private statiche che contengono informazioni sulla tabella del DB, i valori e la chiave primaria
    private static $tabella = "CartadiPagamento"; 
    private static $valore = "(NULL,:Nome_Titolare,:Cognome_Titolare,:Numero_Carta,:Data_Scadenza,:CVV)";
    private static $chiave = "id_cartadiPagamento";

    //Metodi per ottenere il nome della tabella, i valori, la classe e la chiave primaria
    public static function getTabella(){
        return self::$tabella;
    }
    public static function getValore(){
        return self::$valore;
    }
    public static function getClasse(){
        return self::class;
    }
    public static function getChiave(){
        return self::$chiave;
    }

    //Metodo per creare un oggetto CartadiPagamento a partire dai risultati di una query
    public static function creaOggCartadiPagamento($risultatoQuery){
        //Se c'è un solo risultato, crea un singolo oggetto CartadiPagamento
        if(count($risultatoQuery) == 1){
            $carta = new ECartadiPagamento($risultatoQuery[0]['id_cartadiPagamento'], $risultatoQuery[0]['Nome_Titolare'], $risultatoQuery[0]['Cognome_Titolare'], $risultatoQuery[0]['Numero_Carta'], $risultatoQuery[0]['Data_Scadenza'], $risultatoQuery[0]['CVV']);
            $carta->setIdCarta($risultatoQuery[0]['id_cartadiPagamento']);
            return $carta;
        }elseif(count($risultatoQuery) > 1){ //Se ci sono più risultati, crea un array di oggetti CartadiPagamento
            $carte = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $carta = new ECartadiPagamento($risultatoQuery[$i]['id_cartadiPagamento'], $risultatoQuery[$i]['Nome_Titolare'], $risultatoQuery[$i]['Cognome_Titolare'], $risultatoQuery[$i]['Numero_Carta'], $risultatoQuery[$i]['Data_Scadenza'], $risultatoQuery[$i]['CVV']);
                $carta->setIdCarta($risultatoQuery[$i]['id_cartadiPagamento']);
                $carte[] = $carta;
            }
            return $carte;
        }else{ //Se non ci sono risultati, ritorna un array vuoto
            return array();
        }
    }

    //Metodo per associare i valori dell'oggetto CartadiPagamento ai parametri della dichiarazione SQL
    public static function bind($dichiarazione,$carta){
        $dichiarazione ->bindValue(":id_cartadiPagamento",$carta->getIdCarta(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":Nome_Titolare",$carta->getNomeTitolare(),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":Cognome_Titolare",$carta->getCognomeTitolare(),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":Numero_Carta",$carta->getNumeroCarta(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":Data_Scadenza",$carta->getDataScadenza()->format('D-m-y H:i:s'),PDO::PARAM_STR);
        $dichiarazione ->bindValue(":CVV",$carta->getCVV(),PDO::PARAM_INT);
    }

    //Metodo per verificare se un oggetto esiste nel DB
    public static function verifica($campo,$id_cartadiPagamento){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_cartadiPagamento);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo per ottenere un oggetto CartadiPagamento dal DB
    public static function getOgg($id_cartadiPagamento){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_cartadiPagamento);
        if(count($risultato) > 0){
            $carta = self::creaOggCartadiPagamento($risultato);
            return $carta;
        }else{
            return null;
        }
    }
    /**
     * Metodo che verifica se una carta di pagamento è scaduta
     * @param $scadenza si riferisce alla scadenza della carta
     */
    public  static function DataScadenza($scadenza){
       $parti = explode('/',$scadenza);//explode divide la stringa $scadenza in due parti ,utilizzando il carattere '/' come delimitatore, : il mese e l'anno
       //il metodo explode restituisce un array $parti contenente due elementi : il mese e l'anno
       if(count($parti)!==2){//se l'array $parti ha un numero di elementi diverso da 2 significa che non è stato messo il delimitatore / tra le due stringhe
        return "per favore porre il delimitatore '/' tra il mese e l'anno di scadenza della carta di pagamento";
       }
       $mese= intval($parti[0]);// converte la stringa del mese in un numero intero utilizzando la funzione intval
       $anno = intval($parti[1]);//converte la stringa dell'anno in un numero intero utilizzando intval
       if($mese<1||$mese>12){// se il mese è minore di 1 e maggiore di 12
        return " Mese non esistente";
        }
        if($anno>1){// consideriamo l'anno corretto se è espresso con due cifre o con 4 . Se l'anno è espresso con due cifre aggiunge automaticamente 2000 per ottenere l'anno con 4 cifre per confrontarlo con l'anno attuale ottenuto da una funzione di php
            $anno +=2000;
        }
        //otteniamo tramite date l'anno e il mese corrente e li trasformiamo in interi tramite intval per confrontarli con $anno e  $mese inseriti dall'utente
        $annoCorrente = intval(date('Y'));
        $meseCorrente = intval(date('m'));
        // se l'anno posto dall'utente è minore dell'anno corrente o l'anno  posto dall'utente è = all'anno corrente e il mese posto dall'utente è minore del mese corrente allora la carta è scaduta
        if ($anno < $annoCorrente || ($anno === $annoCorrente && $mese < $meseCorrente)) {
            return " Carta di pagamento scaduta";
        }
        return " Carta Valida ";

        }

    

    public static function processodiPagamento($numeroCarta,$scadenza,$cvvCarta){
        //Controlliamo se il numero della carta è valido (se ha 16 cifre)
        if(!preg_match('/^\d{16}$/',$numeroCarta)){// se il numero della carta non ha 16 cifre 
            return "il numero della carta è errato ";
        }
        //Controlliamo se la data di scadenza non è scaduta 
        if (!self::DataScadenza($scadenza)){// se la carta non è valida 
            return " Data di scadenza non valida";
        }
        //verifica se il codice cvv ha 3 cifre (numeri)
        if (!preg_match('/^\d{3}$/', $cvvCarta)) {
            return " Codice Cvv errato";
        } 
    }
}
