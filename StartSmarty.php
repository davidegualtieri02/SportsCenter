<?php

require_once ('./smarty/libs/Smarty.class.php');

class StartSmarty
{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->setTemplateDir('./smarty/libs//templates');
        $smarty->setCompileDir('./smarty/libs/templates_c');
        $smarty->setCacheDir('./smarty/libs/cache');
        $smarty->setConfigDir('./smarty/libs/configs');
        //$smarty->testInstall();
        return $smarty;
    }
}