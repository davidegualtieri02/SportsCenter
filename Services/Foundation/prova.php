<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("FEntityManager.php");

//EntityManager::$db = new PDO("mysql:dbname=Prova;host=localhost;charset=utf8", "root");


//new PDO("mysql:dbname=Prova;host=localhost;charset=utf8", "root");

//$db = new PDO("mysql:dbname=Prova;host=localhost;charset=utf8", "root");

//FUNZIONA
$ogg1 = FEntityManager::getIstanza();
print_r($ogg1);

//FUNZIONA
$ogg2 = FEntityManager::recuperaOggetto("Utente", "id_utente", 1); 
print_r($ogg2);

//FUNZIONA
$ogg3 = FEntityManager::recuperaTuple("Utente");
print_r($ogg3);

//FUNZIONA
$ogg4 = FEntityManager::getOggdaAttributi("Utente", "nome", "duz", "cognome", "gual");
print_r($ogg4);

//FUNZIONA
$ogg5 = FEntityManager::deleteOgginDB("UtenteRegistrato", 1, "ban");
/*
$u1 = 
$ogg4 = FEntityManager::SalvaOgg("FUtenteRegistrato", $u1);

da rivedere
require_once(__DIR__."/../../Entity/EUtenteRegistrato.php");
require_once("FUtenteRegistrato.php");
require_once("FUtente.php");
$u1 = new EUtenteRegistrato("Daieg", "Roma", "diego@email.it", "diegopw", false);
//FUtenteRegistrato::salvaOgg($u1);
FUtenteRegistrato::salvaOgg($u1);
echo "ID Utente: " . $u1->getId();
*/
//FUNZIONA
require_once(__DIR__."/../../Entity/EUtente.php");
require_once("FUtente.php");
print_r(FUtente::getOgg(2));
//FUNZIONA
require_once("FUtenteRegistrato.php");
$ok=FEntityManager::getIstanza()->recuperaOggetto(FUtenteRegistrato::getTabella(),FUtenteRegistrato::getChiave(),1); //$ok è una parte di getOgg in FUtenteRegistrato
print_r($ok);
print_r(FUtenteRegistrato::CreaOggUtenteRegistrato($ok));


//Questo getOgg dà problemi
//print_r(FUtenteRegistrato::getOgg(1));

//Questo salvaOgg dà problemi
//$ut = new EUtenteRegistrato("Daieg", "Roman", "diego@email.it", "diegopw", false);
//echo $ut->getId();
//print_r(FEntityManager::salvaOgg("FUtenteRegistrato", $ut));

//Le seguenti due righe non funzionano perché il metodo recuperaOggetto di FPersistentManager richiama getOgg di FUtenteRegistrato, che però non funziona
//require_once("FPersistentManager.php");
//FPersistentManager::recuperaOggetto("EUtenteRegistrato", 99);



require_once("FPersistentManager.php");
$oggA = FPersistentManager::recuperaOggetto("EUtente", 1); 
print_r($oggA);



//PERSISTENT: recuperaOggetto OK, verificaemailutente, recuperaamministratoredaemail,...


















