<?php
include ("EImage.php");
include ("ECampo_Pallavolo.php");


$immagine = new EImage("prova"," 100"," jpeg"," 1900",'1','1');
$campopallavolo = new ECampo_Pallavolo('1',"fuori",'1'," gomma",$immagine);
print_r($campopallavolo);
 



























