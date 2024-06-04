<?php
class FAttrezzatura{
    private static $tabella = "Attrezzatura"; 
    private static $valore = "(NULL,:id_attrezzatura)";
    private static $chiave = "IDAttrezzatura";

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

    public static function creaOggAttrezzatura($risultatoQuery){
        if(count($risultatoQuery) == 1){
            $attrezzatura = new EAttrezzatura($risultatoQuery[0]['id_attrezzatura']);
            $attrezzatura->setId_attrezzatura($risultatoQuery[0]['id_attrezzatura']);
            return $attrezzatura;
        }elseif(count($risultatoQuery) > 1){
            $attrezzature = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $attrezzatura = new EAttrezzatura($risultatoQuery[$i]['id_attrezzatura']);
                $attrezzatura->setId_attrezzatura($risultatoQuery[$i]['id_attrezzatura']);
                $attrezzature[] = $attrezzatura;
            }
            return $attrezzature;
        }else{
            return array();
        }
    }

    public static function bind($dichiarazione,$attrezzatura){
        $dichiarazione ->bindValue(":id_attrezzatura",$attrezzatura->getId_attrezzatura(),PDO::PARAM_INT);
    }

    public static function verifica($campo,$id){
        $risultatoQuery = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(),$campo,$id);
        return FEntityManager::getIstanza()->esisteNelDB($risultatoQuery);
    }

    public static function getOgg($id_attrezzatura){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id_attrezzatura);
        if(count($risultato) > 0){
            $attrezzatura = self::creaOggAttrezzatura($risultato);
            return $attrezzatura;
        }else{
            return null;
        }
    }
}
