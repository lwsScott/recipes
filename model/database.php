<?php

//require_once ("config-recipe.php");

class Database
{
    //PDO object
    private $_dbh;

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
        return $result;
    }


    function getDetails($recipeId)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM recipes
                WHERE recipeId = $recipeId";

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

    function addRecipe($recipe)
    {
        echo '<h1>I made it to database addRecipe with valid data</h1>';
        //var_dump($recipe);

        var_dump($_SESSION);
        $userId = $_SESSION['userId'];
        //echo $userId;
        //1. Define the query
        // remove the image for now TODO fix
        $sql = "INSERT INTO recipes (recipeName, ingredients, directions, description, userId)
                VALUES (:recipeName, :ingredients, :directions,
                        :description, :userId)";
        //var_dump($sql);
        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        $name = $recipe->getName();
        $ing = $recipe->getIngredients();
        $dir = $recipe->getDirections();
        $desc = $recipe->getDescription();
        //3. Bind the parameters
        $statement->bindParam(':recipeName',$name, PDO::PARAM_STR);
        $statement->bindParam(':ingredients', $ing, PDO::PARAM_STR);
        $statement->bindParam(':directions', $dir, PDO::PARAM_STR);
        $statement->bindParam(':description', $desc, PDO::PARAM_STR);
        $statement->bindParam(':userId', $userId, PDO::PARAM_STR);

        //$statement->bindParam(':image', $recipe->getImage());

        //4. Execute the statement
        $result = $statement->execute();
        echo "Result: " . $result;

        //Get the key of the last inserted row
        $recipeId = $this->_dbh->lastInsertId();
        $_SESSION['recipeId'] = $recipeId;
        //echo $id;
    }

    function addImage($recipe)
    {
        $userId = $recipe->getSubmitter();
        //1. Define the query
        // remove the image for now TODO fix
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
        echo "Result: " . $result;

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

    /*
     * Get the User ID given a username and password
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

    /*
 * Get the User ID given a username and password
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
}