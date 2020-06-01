<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once 'vendor/autoload.php';
//require_once 'model/data-layer.php';
//require_once("model/validate.php");
// start session
session_start();

//echo "Here";

//Create an instance of the Base class
// instantiates the base class of the fat
// free framework
// :: invokes static method
$f3 = Base::instance();
$f3->set('DEBUG', 3);

// construct a new Database
// which creates a new PDO connection
$db = new Database();

// construct a new validator
$validator = new ValidateRecipes();

// create a new controller
$controller = new RecipeController($f3, $validator);

// Define a default route
$f3->route('GET /', function ($f3) {

    $GLOBALS['controller']->home();
});

// the recipes page route
// displays a list of all recipes using a datatable
$f3->route('GET|POST /recipes', function ($f3) {

    $GLOBALS['controller']->viewRecipes($f3);
});

// the recipe page route
// displays the details of the individual recipe
$f3->route('GET|POST /recipes/@recipeId', function ($f3, $params) {

    // access params in a route
    $recipeId = $f3->get('PARAMS.recipeId');

    $f3->set('recipeId', $recipeId);

    $GLOBALS['controller']->viewRecipe($f3);

});

// the submit recipe page
$f3->route('GET|POST /submitRecipe', function ($f3) {
    echo '<h1>I made it here</h1>';

    $GLOBALS['controller']->submitRecipe($f3);

    //$view = new Template();
    //echo $view->render
    //('views/submitRecipe.html');

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

//Define a route that displays student detail
$f3->route('GET|POST /viewUser', function(){

    $GLOBALS['controller']->viewUser();
});

// new user submit page route
$f3->route('GET|POST /newUser', function () use ($f3) {
    echo '<h1>I made it here</h1>';
    $GLOBALS['controller']->newUser();
//    $f3->set('firstName', $_POST['firstName']);
//    $f3->set('lastName', $_POST['lastName']);
//    $f3->set('phone', $_POST['phone']);
//    $f3->set('email', $_POST['email']);
//    $f3->set('username', $_POST['username']);
//    $f3->set('password', $_POST['password']);
//    $f3->set('userId', $_POST['userId']);
//    $f3->set('perId', $_POST['perId']);
    $view = new Template();
    echo $view->render
    ('views/newUser.html');

});


//Run fat free
// -> runs class method instance method
$f3->run();