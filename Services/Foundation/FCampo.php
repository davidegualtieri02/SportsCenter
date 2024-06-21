<?php

class FCampo{
    //Definizione delle variabili private static che contengono il nome della tabella nel DB, il valore e la chiave primaria da inserire nel DB
    private static $tabella = "Campo"; 
    private static $valore = "(NULL,:id_campo,:copertura)";
    private static $chiave = "id_campo";

    //Metodi public che restituiscono il nome della tabella, il valore, la classe e la chiave primaria
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

    //Metodo public che crea un oggetto campo a partire dai risultati di una query
    public static function creaOggCampo($risultatoQuery){
        //Se la query restituisce solo un risultato
        if(count($risultatoQuery) == 1){
            //Crea un nuovo oggetto campo. Non è necessario impostare l'ID del campo perchè l’ID del campo viene effettivamente impostato nel costruttore della classe ECampo quando viene creato un nuovo oggetto ECampo.
            $campo = new ECampo($risultatoQuery[0]['copertura'], $risultatoQuery[0]['id_campo']);
            //Restituisci l'oggetto campo
            return $campo;
        }elseif(count($risultatoQuery) > 1){ //Se la query restituisce più di un risultato
            //Crea un array vuoto
            $campi = array();
            //Ciclo if per ogni risultato della query
            for($i = 0; $i < count($risultatoQuery); $i++){
                //Crea un nuovo oggetto campo. Non va impostato l'ID del campo per lo stesso motivo spiegato nella riga 27
                $campo = new ECampo($risultatoQuery[$i]['copertura'], $risultatoQuery[$i]['id_campo']);
                //Aggiunge l'oggetto campo nell'array
                $campi[] = $campo;
            }
            //Restituisci l'array di oggetti campi
            return $campi;
        }else{ //Altrimenti (se la query non restituisce risultati) restituisce un array vuoto
            return array();
        }
    }

    //Metodo public che lega i valori ai rispettivi parametri nella dichiarazione SQL
    public static function bind($dichiarazione,$campo){
        $dichiarazione ->bindValue(":id_campo",$campo->getId_campo(),PDO::PARAM_INT);
        $dichiarazione ->bindValue(":copertura",$campo->getCopertura(),PDO::PARAM_STR);
    }

    //Metodo public che verifica se un oggetto esiste nel DB
    public static function verifica($campo,$id_campo){
        //Recupera l'oggetto dal DB
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id_campo);
        //Verifica se l'oggetto esiste nel DB
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    //Metodo public che recupera un oggetto campo nel DB
    public static function getOgg($id_campo){
        //Recupera l'oggetto del DB
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_campo);
        //Se la query restituisce almeno un risultato
        if(count($risultato) > 0){
            //Crea un oggetto campo a partire dai risultati della query
            $campo = self::creaOggCampo($risultato);
            //Restituisce l'oggetto campo
            return $campo;
        }else{ //Se la query non restituisce risultati, restituisci null
            return null;
        }
    }

    /**
     * Metodo che verifica se un campo è disponibile o no 
     * 
     */
    public static function CampoDisponibile($pdo,$idCampo,$Dprenotazione,$Oprenotazione){
        $sql = "SELECT id FROM Prenotazione WHERE id_campo = :id_campo AND orario = :orario AND data= :data";
        $dichiarazione = $pdo->prepare($sql);// prepara la query per essere esguita
        $dichiarazione->execute([':id_campo' => $idCampo,':data'=> $Dprenotazione,':orario'=>$Oprenotazione]);// esegue la query prendendo l'id del campo che è quello contenuto in $idCampo, con la data cche è quella contenuta in $Dprenotazione e con l'orario che è quello contenuto in $Oprenotazione
        return $dichiarazione->rowCount()===0;//ritorna true se non ci sono righe nell'array dichiarazione , cioè se il campo è libero in quella data e in quell'orario
        // altrimenti ritorna false e $dichiarazione contiene un elemento contenente l'id del campo, la data e l'orario.
    }
    

}
