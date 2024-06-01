<?php

class FImage{

    // Dichiarazione delle variabili private statiche
    private static $tabella = "image";
    private static $valore = "(NULL, :nome, :grandezza, :tipi, :imageData, :idPost)";
    private static $chiave = "idImage";

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
                $im = new EImage($risultatoQuery[$i]['nome'], $risultatoQuery[$i]['grandezza'], $risultatoQuery[$i]['tipi'], $risultatoQuery[$i]['imageData']);
                $im->setId($risultatoQuery[$i]['idImage']);
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
        $dichiarazione->bindValue(":tipi", $image->getTipo(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":imageData", $image->getImageData(), PDO::PARAM_LOB);
        if($image->getRecensione() !== null){
            $dichiarazione->bindValue(":idRecensione", $image->getRecensione()->getId(), PDO::PARAM_INT);
        }else{
            $dichiarazione->bindValue(":idPost", null, PDO::PARAM_NULL);
        }
    }

    // Metodo per ottenere un oggetto immagine a partire dal suo id
    public static function getOgg($id){
        $risultato =FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id);
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
    public static function salvaOggetto($ogg){
        $saveImage = FEntityManager::getIstanza()->SalvaOgg(self::getClasse(), $ogg);
        if($saveImage !== null){
            return $saveImage;
        }else{
            return false;
        }
    }

    // Metodo per ottenere un oggetto immagine a partire dall'id di una recensione
    public static function getOggDaIdRecensione($idRecensione){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), FRecensione::getChiave(), $idRecensione);
        if(count($risultato) > 0){
            $image = self::CreaOggImage($risultato);
            return $image;
        }else{
            return null;
        }
    }
}
