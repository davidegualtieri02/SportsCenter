<?php

class FImageCampo{

    // Dichiarazione delle variabili private statiche
    private static $tabella = "imageCampo";
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
            $images = [];
            for ($i = 0; $i < count($risultatoQuery); $i++){
                $im = new EImageCampo($risultatoQuery[$i]['nome'], $risultatoQuery[$i]['grandezza'], $risultatoQuery[$i]['tipo'], $risultatoQuery[$i]['imageData']);
                $im->setId($risultatoQuery[$i]['id_image']);
                $images[] = $im;
            }
            return $images;
        }else{
            return [];
        }
    }

    // Metodo per associare i valori dell'oggetto immagine ai parametri della dichiarazione
    public static function bind($dichiarazione, $image){
        $dichiarazione->bindValue(":nome", $image->getNome(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":grandezza", $image->getGrandezza(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":tipo", $image->getTipo(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":imageData", $image->getImageData(), PDO::PARAM_LOB);
        $dichiarazione->bindValue(":id_image", $image->getId(), PDO::PARAM_INT);
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
    public static function salvaOggetto($ogg){
        $saveImage = FEntityManager::getIstanza()->SalvaOgg(self::getClasse(), $ogg);
        if($saveImage !== null){
            return $saveImage;
        }else{
            return false;
        }
    }
}