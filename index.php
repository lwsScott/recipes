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

// the recipe page route
$f3->route('GET|POST /recipes', function () {
    //echo '<h1>Initial home page check</h1>';
    //$view = new Template();
    //echo $view->render
    //('views/recipes.html');
    $GLOBALS['controller']->viewRecipes();

});

// the submit recipe page
$f3->route('GET|POST /submitRecipe', function ($f3) {
    //echo '<h1>Initial home page check</h1>';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // validate the data
        $valid = true;
        // validate name
        if (!validName($_POST['name'])) {
            $valid = false;
            $f3->set('errors["name"]', "Please provide a recipe name");
        } else {
            $f3->set('selectedName', $_POST['name']);

        }

        // validate ingredients
        if (!validIngredients($_POST['ingredients'])) {
            $valid = false;
            $f3->set('errors["ingredients"]', "Please provide the ingredients");
        } else {
            $f3->set('selectedIngredients', $_POST['ingredients']);
        }

        // validate directions
        if (!validDirections($_POST['directions'])) {
            $valid = false;
            $f3->set('errors["directions"]', "Please provide the directions");
        } else {
            $f3->set('selectedDirections', $_POST['directions']);
        }

        // validate description
        if (!validDescription($_POST['description'])) {
            $valid = false;
            $f3->set('errors["description"]', "Please provide the description");
        } else {
            $f3->set('selectedDescription', $_POST['description']);
        }
    }

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