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
            /*
            else if ($_SERVER['USER'] == 'username2')
            {
                require_once '/home/username2/config.php';
            }
            */

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

        //1. Define the query
        // remove the image for now TODO fix
        $sql = "INSERT INTO recipes (recipeName, ingredients, directions, description)
                VALUES (:recipeName, :ingredients, :directions,
                        :description)";
        //var_dump($sql);
        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //var_dump($statement);
        //echo $recipe->getDescription();
        //3. Bind the parameters
        $statement->bindParam(':recipeName', $recipe->getName(), PDO::PARAM_STR);
        $statement->bindParam(':ingredients', $recipe->getIngredients(), PDO::PARAM_STR);
        $statement->bindParam(':directions', $recipe->getDirections(), PDO::PARAM_STR);
        $statement->bindParam(':description', $recipe->getDescription(), PDO::PARAM_STR);
        //$statement->bindParam(':image', $recipe->getImage());

        //4. Execute the statement
        $result = $statement->execute();
        echo "Result: " . $result;

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
        //echo $id;
    }
}