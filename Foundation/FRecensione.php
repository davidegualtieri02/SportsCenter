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
        $dichiarazione->bindValue(":valutazione", $recensione->getValutazione(), PDO::PARAM_INT);
        $dichiarazione->bindValue(":DataOra", $recensione->getDataOra(), PDO::PARAM_STR);
        $dichiarazione->bindValue(":removed", $recensione->isBanned(), PDO::PARAM_BOOL);
        $dichiarazione->bindValue(":id_Utente", $recensione->getUtente()->getId(), PDO::PARAM_INT);
    }

    public static function getOgg($id){
        $risultato = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $id);
        if(count($risultato) > 0){
            $recensione = self::CreaOggRecensione($risultato);
            return $recensione;
        }else{
            return null;
        }
    }

    public static function salvaOgg($ogg, $fieldArray = null){
        if($fieldArray === null){
            $salvaRecensione = FEntityManager::getIstanza()->salvaOgg(self::getClasse(), $ogg);
            if($salvaRecensione !== null){
                return $salvaRecensione;
            }else{
                return false;
            }
        }else{
            try{
                FEntityManager::getIstanza()->getdb()->beginTransaction();
                foreach($fieldArray as $fv){
                    FEntityManager::getIstanza()->updateOgg(FRecensione::getTabella(), $fv[0], $fv[1], self::getChiave(), $ogg->getId());
                }
                FEntityManager::getIstanza()->getdb()->commit();
                return true;
            }catch(PDOException $errore){
                echo "ERROR" . $errore->getMessage();
                FEntityManager::getIstanza()->getdb()->rollBack();
                return false;
            }finally{
                FEntityManager::getIstanza()->chiusuraConnessione();
            }
        }
    }

    public static function eliminaRecensioneDalDB($idRecensione, $id_Utente){        
        try{
            FEntityManager::getIstanza()->getdb()->beginTransaction();
            $queryResult = FEntityManager::getIstanza()->recuperaOggetto(self::getTabella(), self::getChiave(), $idRecensione);

            if(FEntityManager::getIstanza()->esisteNelDb($queryResult) && FEntityManager::getIstanza()->verificaCreatore($queryResult, $id_Utente)){

                $imagesList = FEntityManager::getIstanza()->recuperaOggetto(FImage::getTabella(), self::getChiave(), $idRecensione);
                for($i = 0; $i < count($imagesList); $i++){
                    FEntityManager::getIstanza()->deleteOggInDb(FImage::getTabella(), FImage::getChiave(), $imagesList[$i][FImage::getChiave()]);
                }

                $reportList = FEntityManager::getIstanza()->recuperaOggetto(FReport::getTable(), self::getChiave(), $idRecensione);
                for($i = 0; $i < count($reportList); $i++){
                    FEntityManager::getIstanza()->deleteOggInDb(FReport::getTabella(), FReport::getChiave(), $reportList[$i][FReport::getChiave()]);
                }

                FEntityManager::getIstanza()->deleteOggInDb(self::getTabella(), self::getChiave(), $idRecensione);

                FEntityManager::getIstanza()->getdb()->commit();
                return true;
            }else{
                FEntityManager::getIstanza()->getdb()->commit();
                return false;
            }
        }catch(PDOException $errore){
            echo "ERROR " . $errore->getMessage();
            FEntityManager::getIstanza()->getdb()->rollBack();
            return false;
        }finally{
            FEntityManager::getIstanza()->chiusuraConnessione();
        }
    }

    
}