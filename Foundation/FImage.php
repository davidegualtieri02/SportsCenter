<?php

class FImage{

    private static $tabella = "image";

    private static $valore = "(NULL, :nome, :grandezza, :tipi, :imageData, :idPost)";

    private static $chiave = "idImage";

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

    public static function getOgg($id){
        
    }
}