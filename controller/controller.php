<?php

/**
 * Class RecipeController
 */
class RecipeController
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Display the default route
     */
    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Process the view Recipes route
     */
    public function viewRecipes()
    {
        // get the recipes
        $result = $GLOBALS['db']->getRecipes();

        //var_dump($result);
        // store the recipes in the hive as 'results'
        $this->_f3->set('results', $result);

        // display the recipes page
        $view = new Template();
        echo $view->render('views/recipes.php');
    }

    /**
     * Display the individual recipe
     */
    public function viewRecipe()
    {
        //echo "Here at view recipe" . $f3->get('recipeId');
        // get the details of the recipe from the database
        $result = $GLOBALS['db']->getDetails($this->_f3->get('recipeId'));

        var_dump($result);
        // set the hive variable to the recipe results
        $this->_f3->set('results', $result);

        // display the individual recipe page
        $view = new Template();
        echo $view->render('views/recipe.html');
    }

    /**
     *  Provides a user form to submit a recipe
     */
    public function submitRecipe()
    {
        // check if the user is logged in
        // redirect to login page if not
        // user will be redirected back after logging in
        if (!isset($_SESSION['userId'])) {
            $_SESSION["page"] = $_SERVER["SCRIPT_URI"];
            $this->_f3->reroute('login');
        }
        $userId = $_SESSION['userId'];
        //echo $userId;

        //var_dump( $_SESSION["page"]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //echo '<h1>I made it here in the controller post method</h1>';

        // validate the data and set hive variables
        $valid = true;
        //var_dump($_POST);
        // validate name
        if (!$this->_validator->validName($_POST['name'])) {
            $valid = false;
            $this->_f3->set('errors["name"]', "Please provide a recipe name");
        } else {
            $this->_f3->set('selectedName', $_POST['name']);
        }

        // validate ingredients
        if (!$this->_validator->validIngredients($_POST['ingredients'])) {
            $valid = false;
            $this->_f3->set('errors["ingredients"]', "Please provide the ingredients");
        } else {
            $this->_f3->set('selectedIngredients', $_POST['ingredients']);
        }

        // validate directions
        if (!$this->_validator->validDirections($_POST['directions'])) {
            $valid = false;
            $this->_f3->set('errors["directions"]', "Please provide the directions");
        } else {
            $this->_f3->set('selectedDirections', $_POST['directions']);
        }

        // validate description
        if (!$this->_validator->validDescription($_POST['description'])) {
            $valid = false;
            $this->_f3->set('errors["description"]', "Please provide the description");
        } else {
            $this->_f3->set('selectedDescription', $_POST['description']);
        }

        //echo $valid;
        // if valid data
        if ($valid) {
            //echo '<h1>I made it here with valid data</h1>';

            $recipeName = $_POST['name'];
            $ingredients = $_POST['ingredients'];
            $directions = $_POST['directions'];
            $description = $_POST['description'];
            $userId = $_SESSION['userId'];
            //$image = $_POST['image'];
            $image = "";
            //$submitter = $_POST['submitter'];
            $submitter = "";
            // construct a recipe object
            $recipe = new Recipe($recipeName, $ingredients, $directions, $description, $image, $userId);
            var_dump($recipe);
            // add the recipe to the database
            $GLOBALS['db']->addRecipe($recipe);
            $this->_f3->reroute('recipes');

        }
        else {
            $view = new Template();
            echo $view->render
            ('views/submitRecipe.html');
        }
    } else {
        $view = new Template();
        echo $view->render
        ('views/submitRecipe.html');
    }
    }

    /**
     *  Provides a check for login
     */
    public function checkLogin()
    {
        echo "made it here to the check login page";

    }

    /**
     *  Provides a login form and validates
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // initialize variables
            $username = "";
            $err = false;
            //echo "made it to the post method on login<br>";

            // if the form has been submitted
            if (!empty($_POST)) {
                // Get the username and password
                $username = $_POST['username'];
                $password = $_POST['password'];
                $_SESSION['username'] = $username;

                // get the userId of the user from the database
                // and set the session variable
                $userId = $GLOBALS['db']->getUserId($username, $password);

                // TODO edit this to draw username and password from database
                // get the userId from the database
                //$user = 'myuser';
                //$pass = 'password';
                if (!empty($userId) && $userId > 0) {
                    // store userId in the session array
                    $_SESSION['userId'] = $userId;

                    // redirect user to either the page they came from or index.php
                    $page = isset($_SESSION['page']) ? $_SESSION['page'] : "index.php";
                    header("location: " . $page);
                } else {
                    // set error flag to true
                    $_SESSION['err'] = true;
                    $err = true;
                }
            }

        }

        $view = new Template();
        echo $view->render
        ('views/login.php');
    }

    /**
     *  Provides a logout form
     */
    public function logout()
    {
        $view = new Template();
        echo $view->render
        ('views/logout.php');
    }


    /**
     *  Display a summary of results submitted
     * TODO figure out how we want to confirm data
     * between users and recipes
     */
    public function summary()
    {
        //echo '<h1>Thank you for your order!</h1>';

        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }

    /*
     * view user and submit the user detail
     */

    /**
     *
     */
    public function viewUsers()
    {
        $users = $GLOBALS['db']->getUser();
        $this->_f3->set('users', $users);
        $template = new Template();
        echo $template->render('views/viewUser.php');
    }

    public function newUser()
    {
        $valid = true;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$this->_validator->validName($_POST['firstName'])) {

                //Set an error variable in the F3 hive
                $valid = false;
                $this->_f3->set('errors["firstName"]', "cant be empty");
                echo "firstname no done";

            }

            if (!$this->_validator->validName($_POST['lastName'])) {

                //Set an error variable in the F3 hive
                $valid = false;
                $this->_f3->set('errors["lastName"]', "cant be empty");
                //echo "last name not done";

            }
            if (!$this->_validator->validPhone($_POST['phone'])) {
                $valid = false;
                $this->_f3->set('errors["phone"]', "must be a number");
                //echo "phone not done";

            }
            if (!$this->_validator->validEmail($_POST['email'])) {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["email"]', "must be a correct format");
                //echo "email false";
            }

            if ($_POST['username'] == "") {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["username"]', "cant be empty");
                //echo "username false";
            }
            if ($_POST['password'] == "") {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["password"]', "cant be empty");
                //echo "password false";
            }

            // check if premium user selected
            if (isset($_POST['membership'])) {
                $this->_f3->set('membership', $_POST['membership']);
            }

            if ($valid) {
                //echo "start store datebase";
                $firstName = $_POST['firstName'];

                //echo $firstName;
                $lastName = $_POST['lastName'];
                //echo $lastName;
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                // create the user object
                // premium user if selected, standard user if not selected
                if (isset($_POST['membership'])) {
                    $newUser = new PremiumUser($firstName, $lastName, $email, $phone,
                        $username, $password);
                }
                else {
                    $newUser = new User($firstName, $lastName, $email, $phone,
                        $username, $password);
                }

                // add into it

                //var_dump($newUser);
                $GLOBALS['db']->writeUser($newUser);
                $this->_f3->reroute('viewUsers');

            }
        }
        else {
            $view = new Template();
            echo $view->render
            ('views/newUser.html');
        }
    }
}