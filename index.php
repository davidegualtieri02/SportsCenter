<?php
//require 'vendor/autoload.php';

//require_once __DIR__ . "/vendor/autoload.php";
//require_once __DIR__. "/routes.php";
require_once __DIR__. "/smarty/libs/bootstrap.php";
//require_once "config/config.php";
//require_once 'autoloader.php';
 
Installation::install();

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);
