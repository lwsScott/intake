<?php
//Require the autoload file
//echo $_SERVER['DOCUMENT_ROOT'];
require_once('vendor/autoload.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Create an instance of the Base Class
$f3 = Base::instance();

// construct a new validator
//$validator = new Validate();

// create a new controller
$controller = new IntakeController($f3, $validator);

//default home
$f3->route('GET|POST /', function($f3) {
    $GLOBALS['controller']->home($f3);
});

//Run Fat-Free
$f3->run();

