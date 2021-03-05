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


//form route
$f3->route('GET|POST /form', function($f3) {
    $GLOBALS['controller']->form($f3);
});

//form route
$f3->route('GET|POST /form#residency', function($f3) {
    $GLOBALS['controller']->form($f3);
});

//home route with index
$f3->route('GET|POST /index.php', function($f3) {
    $GLOBALS['controller']->home($f3);
});

//confirmation
$f3->route('GET|POST /confirmation', function($f3) {
    $GLOBALS['controller']->confirmation($f3);
});

//get involved route
$f3->route('GET|POST /getinvolved', function($f3) {
    $GLOBALS['controller']->getinvolved($f3);
});

//confirmation
$f3->route('GET|POST /resources', function($f3) {
    $GLOBALS['controller']->resources($f3);
});

//admin control route
$f3->route('GET|POST /control', function($f3) {
    $GLOBALS['controller']->admin($f3);
});

//logout route
$f3->route('GET|POST /logout', function($f3) {
    $GLOBALS['controller']->logout($f3);
});

//Run Fat-Free
$f3->run();

