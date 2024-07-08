
<?php
include'Smarty.class.php';
$smarty = new Smarty;
// forza la compilazione di tutti i file di template
$smarty->compileAllTemplates('.tpl', true);

