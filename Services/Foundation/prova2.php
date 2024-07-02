<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("FEntityManager.php");
require_once("FUtenteRegistrato.php");
//print_r(FEntityManager::getIstanza()->recuperaOggetto("UtenteRegistrato" ,"id_utenteRegistrato", 1));
$risultato = FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),FUtenteRegistrato::getChiave(), 2);
//print_r($risultato);



require_once(__DIR__."/../../Entity/EUtenteRegistrato.php");
$utreg = new EUtenteRegistrato("Nom", "Cogn", "emaill", "pass");

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