<?php
/*
 * Database Class for recipe website
 * store and retrieve information to/from database
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/model/database.php
 * @author Lewis Scott
 * @version 1.0
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*
 * Class Database
 * constructs database object and connection
 * provides database storage and retrieval functions
 * 5/30/20
 * @author Lewis Scott
 * @version 1.0
 */
class Database
{
    //PDO object
    private $_dbh;

    /**
     * Database constructor.
     */
    function __construct()
    {
        try {
            if ($_SERVER['USER'] == 'lscottgr')
            {
                require_once '/home2/lscottgr/config.php';
            }

            else if ($_SERVER['USER'] == 'qzhanggr')
            {
                require_once '/home2/qzhanggr/config.php';
            }

            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns an array of recipes from the database
     * @return array the recipes
     */
    function getRecipes()
    {
        //1. Define the query
        $sql = "SELECT * FROM recipes";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    /**
     * Get the details of a selected recipe given a recipeId
     * @param $recipeId the recipeId of the recipe
     * @return mixed the recipe
     */
    function getDetails($recipeId)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM recipes
                WHERE recipeId = $recipeId";
        //echo $sql;
        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':recipeId', $recipeId);

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Inserts a recipe into the database
     * @param $recipe the recipe to add
     */
    function addRecipe($recipe)
    {
        //echo '<h1>I made it to database addRecipe with valid data</h1>';
        //var_dump($recipe);

        //var_dump($_SESSION);
        $userId = $_SESSION['userId'];
        //echo $userId;
        //1. Define the query
        $sql = "INSERT INTO recipes (recipeName, ingredients, directions, description, userId, firstName, lastName)
                VALUES (:recipeName, :ingredients, :directions,
                        :description, :userId, :firstName, :lastName)";
        //var_dump($sql);
        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        $name = $recipe->getName();
        $ing = $recipe->getIngredients();
        $dir = $recipe->getDirections();
        $desc = $recipe->getDescription();
        $first = $recipe->getFirstName();
        $last = $recipe->getLastName();

        //3. Bind the parameters
        $statement->bindParam(':recipeName',$name, PDO::PARAM_STR);
        $statement->bindParam(':ingredients', $ing, PDO::PARAM_STR);
        $statement->bindParam(':directions', $dir, PDO::PARAM_STR);
        $statement->bindParam(':description', $desc, PDO::PARAM_STR);
        $statement->bindParam(':userId', $userId, PDO::PARAM_STR);
        $statement->bindParam(':firstName', $first, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $last, PDO::PARAM_STR);


        //$statement->bindParam(':image', $recipe->getImage());

        //4. Execute the statement
        $result = $statement->execute();
        echo "Result: " . $result;

        //Get the key of the last inserted row
        $recipeId = $this->_dbh->lastInsertId();
        $_SESSION['recipeId'] = $recipeId;
        //echo $id;
    }

    /**
     * Associate an image with a recipe
     * @param $recipe the recipe
     */
    function addImage($recipe)
    {
        $userId = $recipe->getUserId();
        //1. Define the query
        $sql = "UPDATE recipes SET imageId = (:imageId) 
                WHERE recipeId = (:recipeId)";

        var_dump($sql);
        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //$image = $recipe->getImageId();
        $imageId = $recipe->getImageId();
        $recipeId = $_SESSION['recipeId'];

        //3. Bind the parameters
        $statement->bindParam(':imageId', $imageId);
        $statement->bindParam(':recipeId', $recipeId);

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;

        //Get the key of the last inserted row
        $recipeId = $this->_dbh->lastInsertId();
    }

    /*
     * The user's database
     */
    function getUser()
    {
        //1. Define the query
        $sql = "SELECT * FROM users";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Get the User ID given a username and password
     * @param $username the username
     * @param $password the password
     * @return mixed|string the userId if true, else an error message
     */
    function getUserId($username, $password)
    {
        //echo $username . "and" . $password. "<br>";

        //1. Define the query
        $sql = "SELECT userId FROM users
                WHERE username = '$username' && password = '$password'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchColumn();
        //var_dump($result);
        //foreach ($result as $row) {
        //    echo $row;
        //}
        if ($result) {
            return $result;
        } else {
            return "Incorrect login credentials provided";
        }
    }

    /**
     * Get the filename for an image
     * @param $imageId the id of the image
     * @return mixed|string the filename if successful, else error message
     */
    function getFileName($imageId)
    {
        //echo $username . "and" . $password. "<br>";

        //1. Define the query
        $sql = "SELECT filename FROM uploads
                WHERE file_id = '$imageId'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchColumn();
        //var_dump($result);
        //foreach ($result as $row) {
        //    echo $row;
        //}
        if ($result) {
            return $result;
        } else {
            return "Incorrect imageId provided";
        }
    }

    /**
     * Get a username given a userId
     * @param $userId the userId
     * @return mixed|string the username if successful, else error message
     */
    function getUserName($userId)
    {
        //1. Define the query
        $sql = "SELECT firstname, lastname FROM users
                WHERE userId = '$userId'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);
        //foreach ($result as $row) {
        //    echo $row;
        //}
        if ($result) {
            return $result;
        } else {
            return "Incorrect userId provided";
        }
    }

    /**
     * Get the permission of the user
     * @param $userId the userId
     * @return mixed|string the permission if successful, else error message
     */
    function getPermission($userId)
    {
        //echo $username . "and" . $password. "<br>";

        //1. Define the query
        $sql = "SELECT permission FROM users
                WHERE userId = '$userId'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchColumn();
        //var_dump($result);
        //foreach ($result as $row) {
        //    echo $row;
        //}
        if ($result) {
            return $result;
        } else {
            return "Incorrect userId provided";
        }
    }

    /**
     * Insert a new user into the database
     * @param $newUser the user to add
     */
    function writeUser($newUser)
    {
        echo '<h1>database php called</h1>';

        //1. Define the query
        $sql = "INSERT INTO users (firstname, lastname, email,
                phone, username, password, permission)
                VALUES (:firstname, :lastname, :email, :phone,
                        :username, :password, :permission)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //var_dump($statement);
        $first = $newUser->getFirstname();
        $last = $newUser->getLastname();
        $email = $newUser->getEmail();
        $phone = $newUser->getPhone();
        $userName = $newUser->getUsername();
        $password = $newUser->getPassword();
        if (get_class($newUser) == 'PremiumUser') {
            $permission = $newUser->getPermission();
        }

        //3. Bind the parameters
        // $statement->bindParam(':sid', $user->get());
        $statement->bindParam(':firstname', $first, PDO::PARAM_STR);
        $statement->bindParam(':lastname', $last, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':username', $userName, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':permission', $permission, PDO::PARAM_STR);


        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
    }

    /**
     * Get user details
     * @param $userId the user to get details
     * @return mixed the details
     */
    function getUserDetails($userId)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM users
                WHERE userId = $userId";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':userId', $userId);

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}