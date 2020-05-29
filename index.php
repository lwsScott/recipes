<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once 'vendor/autoload.php';
//require_once 'model/data-layer.php';
require_once 'model/validation-functions.php';
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

// create a new controller
$controller = new RecipeController($f3);

// Define a default route
$f3->route('GET /', function ($f3) {
    //echo '<h1>Initial home page check</h1>';
    //$view = new Template();
    //echo $view->render
    //('views/home.html');
    $GLOBALS['controller']->home();

});

// the recipes page route
// displays a list of all recipes using a datatable
$f3->route('GET|POST /recipes', function ($f3) {
    //echo '<h1>Initial home page check</h1>';
    //$view = new Template();
    //echo $view->render
    //('views/recipes.html');
    $GLOBALS['controller']->viewRecipes($f3);

});

// the recipe page route
// displays the details of the individual recipe
$f3->route('GET|POST /recipes/@recipeId', function ($f3, $params) {
    //echo '<h1>Initial home page check</h1>';
    //$view = new Template();
    //echo $view->render
    //('views/recipes.html');
    //echo "Here at getting individual recipe";
    // access params in a route
    $recipeId = $f3->get('PARAMS.recipeId');
    //echo $recipeId;
    $f3->set('recipeId', $recipeId);

    $GLOBALS['controller']->viewRecipe($f3);

});

// the submit recipe page
$f3->route('GET|POST /submitRecipe', function ($f3) {
    //echo '<h1>I made it here</h1>';

        $GLOBALS['controller']->submitRecipe($f3);

        /*
        // data is valid
        if($valid) {
            // store the data in the session array
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['questions'] = $_POST['questions'];

            // redirect to summary page
            $f3->reroute('summary');
            //session_destroy();
        }
    }
         */
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