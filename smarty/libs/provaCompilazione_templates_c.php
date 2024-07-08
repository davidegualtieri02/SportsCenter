
<?php


// ATTENZIONE!!!!!!
// Non è necessario runnare questo file quando vengono
// modificati dei file template oppure all'aggiunta di
// nuovi file template, è un processo che dovrebbe, e
// sottolineo dovrebbe, svolgere smarty automaticamente.

include'Smarty.class.php';
$smarty = new Smarty;
// forza la compilazione dei file di template
// il primo parametro indica l'estensione dei file da considerare
// quando il secondo parametro è FALSE => SOLO FILES MODIFICATI
// quando il secondo parametro è TRUE => TUTTI I FILES
$smarty->compileAllTemplates('.tpl', true);

