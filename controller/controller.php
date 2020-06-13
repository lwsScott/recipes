<?php
/*
 * Controller page for recipe website
 * provides routes to various views and runs fat free
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/controller/controller.php
 * @author Lewis Scott
 * @version 1.0
 */
/**
 * Class RecipeController
 * routes and validates data
 * interacts with the database object
 * creates User, Premium User and recipe objects
 * to carry information and display it
 * 5/30/20
 * @author Lewis Scott
 * @version 1.0
 */
class RecipeController
{
    /**
     * @var
     */
    private $_f3; //router
    /**
     * @var
     */
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
        // get the details of the recipe ONE from the database
        $recipeOne = $GLOBALS['db']->getDetails('43');

        // set the hive variable to the recipe ONE results
        $this->_f3->set('recipeOne', $recipeOne);

        // get the filename for image from the recipe and set it
        $fileName = $GLOBALS['db']->getFileName($recipeOne['imageId']);
        $this->_f3->set('filenameOne', $fileName);

        // get the details of the recipe TWO from the database
        $recipeTwo = $GLOBALS['db']->getDetails('44');

        // set the hive variable to the recipe TWO results
        $this->_f3->set('recipeTwo', $recipeTwo);

        // get the filename for image from the recipe and set it
        $fileName = $GLOBALS['db']->getFileName($recipeTwo['imageId']);
        $this->_f3->set('filenameTwo', $fileName);

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
        $results = $GLOBALS['db']->getDetails($this->_f3->get('recipeId'));

        //var_dump($results);
        //echo "<br>";
        // set the hive variable to the recipe results
        $this->_f3->set('results', $results);

        //var_dump($results['ingredients']);
        //echo "<br>";
        $ingArray = json_decode($results['ingredients']);
        $this->_f3->set('ingArray', $ingArray);

        //echo "<br>";
        $dirArray = json_decode($results['directions']);
        $this->_f3->set('dirArray', $dirArray);

        $fileName = $GLOBALS['db']->getFileName($results['imageId']);
        //var_dump($result);
        //$fileName = $result['filename'];
        //echo $firstname;
        $this->_f3->set('filename', $fileName);

        //$lastname = $result['lastName'];;
        //$this->_f3->set('lastname', $lastname);

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
        //var_dump($_SERVER['REQUEST_METHOD']);
        //var_dump($_SESSION);
        //var_dump( $_SESSION["page"]);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //echo '<h1>I made it here in the controller post method</h1>';
        //var_dump($_POST);
        //$recipe = $_POST["recipe"];

        //$tempArr = json_decode($recipe);
        //$arr = array_values($tempArr);
        //echo $arr[0]; echo $arr[1]; echo $arr[2];  //sends this back ["1","2"]["a","b"]test
        //echo json_encode($arr[0]);  // returns this "[\"1\",\"2\"]"

        // so we can now declare variable
       // and break down our post variables
        //$_POST['ingredients'] = $arr[0];
        //$_POST['directions'] = $arr[1];
        //$_POST['name'] = $arr[2];
        //$_POST['description'] = $arr[3];
        //echo $ing;
        //echo $dir;
        //echo $name;

        // validate the data and set hive variables
        $valid = true;
        var_dump($_POST);
        // validate recipe name
        if (!$this->_validator->validName($_POST['recipeName'])) {
            $valid = false;
            $this->_f3->set('errors["name"]', "Please provide a recipe name");
        } else {
            $this->_f3->set('selectedName', $_POST['recipeName']);
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

            $recipeName = $_POST['recipeName'];
            $ingredients = $_POST['ingredients'];
            $directions = $_POST['directions'];
            $description = $_POST['description'];
            $userId = $_SESSION['userId'];

            $result = $GLOBALS['db']->getUserName($userId);
            //var_dump($result);
            $firstname = $result['firstname'];
            //echo $firstname;
            $this->_f3->set('firstname', $firstname);

            $lastname = $result['lastname'];;
            $this->_f3->set('lastname', $lastname);

            //$image = $_POST['image'];
            $imageId = "";
            //$submitter = $_POST['submitter'];
            $submitter = "";
            // construct a recipe object
            $recipe = new Recipe($recipeName, $ingredients, $directions, $description, $imageId, $userId, $firstname, $lastname);
            //var_dump($recipe);
            $_SESSION['recipe'] = $recipe;
            // add the recipe to the database
            $GLOBALS['db']->addRecipe($recipe);
                //Redirect to the interests route if premium member
            if (($_SESSION['permission']) == "upload") {
                $this->_f3->reroute("image");
            }
            else {
                //redirect to summary page
                $this->_f3->reroute('recipes');
            }

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
     * Display the recipe image route
     * establish database connection and store image
     * to a folder and its filename to a database if chosen
     * route to recipes when complete
     */
    public function image()
    {
        try {
            //Create a new PDO connection
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //echo "here in the controller image";
        $dirName = '../uploader/uploads/';
        // store the directory name in the session
        $_SESSION['dirName'] = $dirName;
        //$target_file = $dirName . basename($_FILES["fileToUpload"]["name"]);
        //$uploadOk = 1;
        //echo realpath("test.txt");
        //echo $dirName;
        //var_dump($_FILES['fileToUpload']);

        //If file has been submitted
        if (isset($_FILES['fileToUpload'])) {

            $file = $_FILES['fileToUpload'];
            //$_SESSION['member']->setImageId($file['name']);

            //echo $file['name'].'<br>';
            //echo $file['type'].'<br>';
            //echo $file['tmp_name'].'<br>';
            //echo $file['error'].'<br>';
            //echo $file['size'].'<br>';

            // 264.JPG
            // image/jpeg
            // /tmp/phpCSZfKz
            // 0
            // 2632637

            //Define valid file types
            $validTypes = array('image/jpeg', 'image/jpg', 'image/png');

            //Check file size - 3 MB maximum
            if ($_SERVER['CONTENT_LENGTH'] > 3000000) {
                echo "<p class='error'>File is too large. Maximum file size is 3 MB.</p>";
            } //Check file type
            else if (in_array($file['type'], $validTypes)) {

                if ($file['error'] > 0)
                    echo "<p class='error'>Return Code: {$file['error']}</p>";

                //Check for duplicate file
                if (file_exists($dirName . $file['name'])) {
                    echo "<p class='error'>Error uploading: ";
                    echo $file['name'] . " already exists.</p>";
                } else {
                    //Move file to upload directory
                    move_uploaded_file($file['tmp_name'], $dirName . $file['name']);
                    echo "<p class='success'>Uploaded {$file['name']} successfully!</p> ";

                    // store the file name in the database
                    $sql = "INSERT INTO uploads(filename) VALUES ('{$file['name']}')";
                    $dbh->exec($sql);

                    // establish the $id number of the last insert
                    $id = $dbh->lastInsertId();
                    $_SESSION['imageId'] = $id;
                    $_SESSION['recipe']->setImageId($id);

                    // now write the imageId to the recipe database
                    $GLOBALS['db']->addImage($_SESSION['recipe']);
                    //redirect to image page
                    $this->_f3->reroute('recipes');

                }
            }
            //Invalid file type
            else {
                echo "<p class='error'>Invalid file type. Allowed types: gif, jpg, png</p>";
            }
        }

        $view = new Template();
        //var_dump($view);
        echo $view->render('views/imageUpload.php');
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

                // get the userId from the database
                //$user = 'myuser';
                //$pass = 'password';
                if (!empty($userId) && $userId > 0) {
                    // store userId in the session array
                    $_SESSION['userId'] = $userId;

                    // get the user permission
                    $permission = $GLOBALS['db']->getPermission($userId);
                    $_SESSION['permission'] = $permission;

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
        // display login
        $view = new Template();
        echo $view->render
        ('views/login.php');
    }

    /**
     *  Logout function
     */
    public function logout()
    {
        // logout
        $view = new Template();
        echo $view->render
        ('views/logout.php');
    }


    /**
     * TODO delete?
     * Display a summary of results submitted
     * between users and recipes
     */
    public function summary()
    {
        //echo '<h1>Thank you for your order!</h1>';

        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }


    /**
     * view users
     */
    public function viewUsers()
    {
        $users = $GLOBALS['db']->getUser();
        $this->_f3->set('users', $users);
        $template = new Template();
        echo $template->render('views/viewUser.php');
    }

    /**
     * insert a new User
     */
    public function newUser()
    {
        $valid = true;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);
            if (!$this->_validator->validName($_POST['firstName'])) {

                //Set an error variable in the F3 hive
                $valid = false;
                $this->_f3->set('errors["firstName"]', "cant be empty");
                //echo "firstname no done";
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

            if (!$this->_validator->validName($_POST['username'])) {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["username"]', "cant be empty");
                //echo "username false";
            }
            //echo $_SESSION['nameAvail'];
            if (($_SESSION['nameAvail'] != 'available')) {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["username"]', "Username not available");
                //echo "username false";
            }

            if (!$this->_validator->validName($_POST['password'])) {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["password"]', "Required");
                //echo "password false";
            }

            if ($_POST['password'] != $_POST['confirm']) {
                $valid = false;
                //Set an error variable in the F3 hive
                $this->_f3->set('errors["confirm"]', "need the same as password");
                //echo "confirm password false";
            }

            // check if premium user selected
            if (isset($_POST['membership'])) {
                $this->_f3->set('membership', $_POST['membership']);
                $permission = 'upload';
            }
            //echo "I made it here";
            //var_dump($valid);

            // make the form stick
            $this->_f3->set('firstName', $_POST['firstName']);
            $this->_f3->set('lastName', $_POST['lastName']);
            $this->_f3->set('phone', $_POST['phone']);
            $this->_f3->set('email', $_POST['email']);
            $this->_f3->set('username', $_POST['username']);
            $this->_f3->set('password', $_POST['password']);
            $this->_f3->set('confirm', $_POST['confirm']);

            if ($valid) {
                //echo "I made it here valid";

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
                        $username, $password, $permission);
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
        $view = new Template();
        echo $view->render
        ('views/newUser.html');
    }

    /*
     *  display individual user
     */
    /**
     *
     */
    public function userDetail()
    {
        //echo $this->_f3->get('userId');

        $result = $GLOBALS['db']->getUserDetails($this->_f3->get('userId'));

        //var_dump($result);
        $this->_f3->set('results', $result);

        $view = new Template();
        echo $view->render('views/user.html');
    }
}