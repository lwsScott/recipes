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

// the recipe page route
$f3->route('GET|POST /recipe', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/recipe.html');
});

// the submit recipe page
$f3->route('GET|POST /submitRecipe', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/submitRecipe.html');
});

// the admin page
$f3->route('GET|POST /admin', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/admin.html');
});

// summary page
$f3->route('GET|POST /summary', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/summary.html');
});

// new user submit page route
$f3->route('GET|POST /newUser', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/newUser.html');
});

//Run fat free
// -> runs class method instance method
$f3->run();