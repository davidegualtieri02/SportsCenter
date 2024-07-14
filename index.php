<?php
/*
require_once(__DIR__ . "vendor/autoload.php");

//require_once __DIR__ . "/vendor/autoload.php";
//require_once __DIR__. "/routes.php";
require_once(__DIR__ . "/smarty/libs/bootstrap.php");
require_once(__DIR__ . "config/config.php");
require_once(__DIR__ . "config/autoloader.php");

Installation::install();

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);


*/
require_once "config/config.php";
require_once 'config/autoloader.php';
//require_once "/install/Installation.php";
//Installation::install();

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);