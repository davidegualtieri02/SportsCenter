<?php

class FImage{

    // Dichiarazione delle variabili private statiche
    private static $tabella = "Image";
    private static $valore = "(:id_image, :nome, :grandezza, :tipo, :imageData)";
    private static $chiave = "id_image";

    // Metodo per ottenere il valore della variabile $tabella
    public static function getTabella(){
        return self::$tabella;
    }

    // Metodo per ottenere il valore della variabile $valore
    public static function getValore(){
        return self::$valore;
    }

    // Metodo per ottenere il nome della classe
    public static function getClasse(){
        return self::class;
    }

    // Metodo per ottenere il valore della variabile $chiave
    public static function getChiave(){
        return self::$chiave;
    }

    // Metodo per creare un oggetto immagine a partire dai risultati di una query
    public static function CreaOggImage($risultatoQuery){
        if(count($risultatoQuery) > 0){
            $images = array();
            for ($i = 0; $i < count($risultatoQuery); $i++){
                $im = new EImage($risultatoQuery[$i]['nome'], $risultatoQuery[$i]['grandezza'], $risultatoQuery[$i]['tipo'], $risultatoQuery[$i]['imageData']);
                $im->setId($risultatoQuery[$i]['id_image']);
                $images[] = $im;
            }
            return $images;
        }else{
            return array();
        }
    }

    // Metodo per associare i valori dell'oggetto immagine ai parametri della dichiarazione
    public static function bind($dichiarazione, $image){
        $dichiarazione->bindValue(":nome", $image->getNome(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":grandezza", $image->getGrandezza(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":tipo", $image->getTipo(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":imageData", $image->getImageData(), PDO::PARAM_LOB);
        $dichiarazione->bindValue(":id_image", $image->getId(), PDO::PARAM_INT);
        //if($image->getRecensione() !== null){
            //$dichiarazione->bindValue(":idRecensione", $image->getRecensione()->getId(), PDO::PARAM_INT);
        //}else{
            //$dichiarazione->bindValue(":idRecensione", null, PDO::PARAM_NULL);
        //}
    }

    // Metodo per ottenere un oggetto immagine a partire dal suo id
    public static function getOgg($id_image){
        $risultato =FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_image);
        if(count($risultato) > 0){
            $image = self::CreaOggImage($risultato);
            if(count($image) == 1){
                return $image[0];
            }
            return $image;
        }else{
            return null;
        }
    }

    // Metodo per salvare un oggetto immagine nel database
    public static function salvaOgg($ogg, $fieldArray = null){
        //Verifica se l'array dei campi è null
        if($fieldArray === null){
            //Salva l'oggetto nel DB
            $salvaPrenotazione = FEntityManager::getIstanza()->salvaOgg(self::getClasse(), $ogg);
            //Verifica se l'oggetto contiene elementi
            if($salvaPrenotazione !== null){
                //Se è stato salvato correttamente, restituisci l'oggetto
                return $salvaPrenotazione;
            }else{ //Se non è stato salvato nulla, restituisci false
                return false;
            }
        }else{
            //Inizia una transizione
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                //Ciclo for per ogni elemento dell'array dei campi
                foreach($fieldArray as $fv){
                    //Aggiorna l'oggetto nel DB
                    FEntityManager::getIstanza()->updateOgg(FImage::getTabella(), $fv[0], $fv[1], self::getChiave(), $ogg->getId());
                }
                //Conferma la transizione
                FEntityManager::getIstanza()->getdb()->commit();
                return true;
            }catch(PDOException $errore){
                //Se si verifica un errore, stampa l'errore e annulla la transazione
                echo "ERROR" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{
                //Chiudi la connessione al DB
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }
    }
    // Metodo per ottenere un oggetto immagine a partire dall'id di una recensione
    public static function getOggDaIdRecensione($id_recensione){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), FRecensione::getChiave(), $id_recensione);
        if(count($risultato) > 0){
            $image = self::CreaOggImage($risultato);
            return $image;
        }else{
            return null;
        }
    }
}