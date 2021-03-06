<?php
/*
 * Index page for recipe website
 * provides routes to various views and runs fat free
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/index.php
 * @author Lewis Scott
 * @version 1.0
 */
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once 'vendor/autoload.php';
//require_once 'model/data-layer.php';
//require_once("model/validate.php");
// start session
session_start();


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

// construct a new controller
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

    // set the recipeId for use by the controller
    $f3->set('recipeId', $recipeId);

    $GLOBALS['controller']->viewRecipe($f3);
});

// the submit recipe page
$f3->route('GET|POST /submitRecipe', function () {
    //echo '<h1>I made it here</h1>';
    $GLOBALS['controller']->submitRecipe();
});

// the submit recipe page
$f3->route('GET|POST /recipeSubmit', function () {
    //echo '<h1>I made it here</h1>';
    $GLOBALS['controller']->recipe();
});

// the logout page
$f3->route('GET|POST /logout', function () {
    $GLOBALS['controller']->logout();
});

// the login page
$f3->route('GET|POST /login', function () {
    //echo '<h1>I made it to login</h1>';
    $GLOBALS['controller']->login();
});

// the upload image page
$f3->route('GET|POST /image', function () {
    //echo '<h1>I made it to login</h1>';
    $GLOBALS['controller']->image();
});

// the admin page
$f3->route('GET|POST /admin', function () {
    //echo '<h1>Initial home page check</h1>';
    $view = new Template();
    echo $view->render
    ('views/admin.html');
});

//Define a route that displays student detail
$f3->route('GET|POST /viewUsers', function(){

    $GLOBALS['controller']->viewUsers();
});

// new user submit page route
$f3->route('GET|POST /newUser', function () {
    //echo '<h1>I made it here</h1>';
    $GLOBALS['controller']->newUser();
});

// view detail users
$f3->route('GET|POST /users/@userId', function ($f3,$params) {
    // accept param
    $userId=$f3->get('PARAMS.userId');

    $f3->set('userId',$userId);

    $GLOBALS['controller']->userDetail($f3);
});

//Run fat free
// -> runs class method instance method
$f3->run();