<?php
//queste due righe si lasciano per ogni prova, perché ti indicano quale è l'errore (in caso ci sia)
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*

//include("ECampo.php");
include("ECampo_Calcio.php");
//include("EImage.php");

$i = new EImage("nomeprova", 100, "tipi", "imagedata", 10, 20);

$c = new ECampo_Calcio("coperturaprova", "titl", 100, $i);

print_r($c);

//print_r($i);

*/
 /*
include("ECartadiPagamento.php");

$carta = new ECartadiPagamento("nomtit", "cogntit", 1111222233334444, new DateTime("2025-12"), 980);

print_r($carta); 
*/

include("EAttrezzatura_Basket.php");

$attr = new EAttrezzatura_Basket(5, 6);

print_r($attr);