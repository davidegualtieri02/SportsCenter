<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include("FUtente.php");
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