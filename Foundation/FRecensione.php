<?php

class FRecensione{
    private static $tabella = "recensione";
    private static $valore = "(NULL, :commento, :valutazione, :DataOra, :removed, :id_Utente)";
    private static $chiave = "idRecensione";
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

    public static function CreaOggRecensione($risultatoQuery){
        if(count($risultatoQuery) > 0){
            $recensioni = array();
            for($i = 0; $i < count($risultatoQuery); $i++){
                $rec = new ERecensione($risultatoQuery[$i]['commento'],$risultatoQuery[$i]['valutazione']);
                $rec->setId($risultatoQuery[$i]['idRecensione']);
                $DataOra = DateTime::createFromFormat('D-m-y H:i:s', $risultatoQuery[$i]['DataOra']);
                $rec->setDataOra($DataOra);
                $rec->setBan($risultatoQuery[$i]['removed']);
                $recensioni[] = $rec;
            }
            return $recensioni;
        }else{
            return array();
        }
    }

    public static function bind($dichiarazione, $recensione){
        $dichiarazione->bindValue(":commento", $recensione->getCommento(), PDO::PARAM_STR);
        
    }
}