<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("FEntityManager.php");
require_once("FUtenteRegistrato.php");
//print_r(FEntityManager::getIstanza()->recuperaOggetto("UtenteRegistrato" ,"id_utenteRegistrato", 1));
$risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),FUtenteRegistrato::getChiave(), 2);
//print_r($risultato);



require_once(__DIR__."/../../Entity/EUtenteRegistrato.php");
$utreg = new EUtenteRegistrato("Fede", "Dido", "fede@dido.it", "passfede");

//FUNZIONA
//$risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),FUtenteRegistrato::getChiave(), 1);
//print_r(FUtenteRegistrato::CreaOggUtenteRegistrato($risultato));

//FUNZIONA
//print_r(FEntityManager::recuperaOggetto("UtenteRegistrato", "nome", "Diego"));

//FUNZIONA
//print_r(FUtenteRegistrato::getOgg(1));

//FUNZIONA
//$salvaOgg = FEntityManager::salvaOgg("FUtenteRegistrato", $utreg);
//print_r($salvaOgg);

//FUNZIONA
//print_r(FEntityManager::recuperaTuple("UtenteRegistrato"));

//FUNZIONA
//print_r(FEntityManager::updateOgg("UtenteRegistrato", "email", "di@ego.it", "nome", "Diego"));

require_once("FPersistentManager.php");
//FUNZIONA
//print_r(FPersistentManager::recuperaOggetto("EUtenteRegistrato", 3));

//FUNZIONA
//print_r(FPersistentManager::RecuperaTuple("Tessera"));

//FUNZIONA
//print_r(FPersistentManager::uploadOgg($utreg));

//FUNZIONA
//print_r(FPersistentManager::CreaUtenteRegistrato($risultato));

require_once("FTessera.php");
//FUNZIONA
//print_r(FTessera::creaOggTessera(FEntityManager::getIstanza()->recuperaOggetto("Tessera" ,"id_tessera", 2)));

//FUNZIONA
//print_r(FTessera::getOgg(2));

//att.ne: verificatesseramento non testato
