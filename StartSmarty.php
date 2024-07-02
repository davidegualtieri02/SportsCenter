<?php

require_once ('./smarty/libs/Smarty.class.php');

class StartSmarty
{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->template_dir= './smarty/libs/templates';
        $smarty->compile_dir= './smarty/libs/templates_c';
        $smarty->config_dir= './smarty/libs/configs';
        $smarty->cache_dir= './smarty/libs/cache';
        //$smarty->testInstall();
        return $smarty;
    }
}