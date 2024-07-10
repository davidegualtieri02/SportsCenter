<?php
//require 'vendor/autoload.php';
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__. "/routes.php";
require_once __DIR__. "/smarty/libs/bootstrap.php";
 


$requestUri= $_SERVER['REQUEST_URI'];
route($requestUri);
