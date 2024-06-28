<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("FEntityManager.php");

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

//sbagliata query in qualche modo
$ogg4 = FEntityManager::getOggdaAttributi("Utente", "nome", "duz", "cognome", "gual");

//FUNZIONA
$ogg5 = FEntityManager::deleteOgginDB("UtenteRegistrato", 1, "ban");
/*
$u1 = 
$ogg4 = FEntityManager::SalvaOgg("FUtenteRegistrato", $u1);

da rivedere
include(__DIR__."/../../Entity/EUtenteRegistrato.php");
include("FUtenteRegistrato.php");
include("FUtente.php");
$u1 = new EUtenteRegistrato("Daieg", "Roma", "diego@email.it", "diegopw", false);
FUtenteRegistrato::salvaOgg($u1);

*/

//u->recuperaOggetto("Utente","id_utente",1);

//print_r(FUtente::verifica("id_utente", 1));


/*
$query = "SELECT * FROM Utente WHERE id_utente = 1";
$dichiarazione =FEntityManager::$db->prepare($query);
$dichiarazione->execute();
$countRighe = $dichiarazione->rowCount();
if($countRighe >0){
	$risultato = array();
	$dichiarazione->setFetchMode(PDO::FETCH_ASSOC);
	while ($righe = $dichiarazione->fetch()){
		$risultato[] = $righe;
	}
    return $risultato;
 }else{
    return array();
}
*/