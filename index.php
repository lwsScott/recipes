<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once 'vendor/autoload.php';
//require_once 'model/data-layer.php';
//require_once 'model/validation-functions.php';
// start session
session_start();

//echo "Here";

//Create an instance of the Base class
// instantiates the base class of the fat
// free framework
// :: invokes static method
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/home.html');

});



//Run fat free
// -> runs class method instance method
$f3->run();