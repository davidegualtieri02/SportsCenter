<?php

require_once(__DIR__ .'/../smarty/libs/Smarty.class.php');

class StartSmarty{
    static function configuration(){
        $smarty = new Smarty();
        $smarty->template_dir = __DIR__ . '/../smarty/libs/templates';
        $smarty->compile_dir = __DIR__ .'/../smarty/libs/templates_c';
        $smarty->config_dir = __DIR__.'/../smarty/libs/configs';
        $smarty->cache_dir = __DIR__.'/../smarty/libs/cache';
        return $smarty;
    }
}