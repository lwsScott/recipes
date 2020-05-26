<?php

require_once ("config-recipe.php");

class Database
{
    //PDO object
    private $_dbh;

    function __construct()
    {
        try {
            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
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
                WHERE recipeId = :$recipeId";

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
        var_dump($recipe);

        //1. Define the query
        $sql = "INSERT INTO recipe (recipeName, ingredients, directions, description, image)
                VALUES (:recipeName, :ingredients, :directions,
                        :description, :image)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':recipeName', $recipe->getName());
        $statement->bindParam(':ingredients', $recipe->getIngredients());
        $statement->bindParam(':directions', $recipe->getDirections());
        $statement->bindParam(':description', $recipe->getDescription());
        $statement->bindParam(':image', $recipe->getImage());

        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
    }
}