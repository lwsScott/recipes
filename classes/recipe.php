<?php
/*
 * Recipe class for recipe website
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipe/classes/recipe.php
 * @author Lewis Scott
 * @version 1.0
 */

/*
 * Recipe class for recipe website
 * stores recipe information
 * 5/30/20
 * @author Lewis Scott
 * @version 1.0
 */
class Recipe
{
    //Declare instance variables
    private $_name;
    private $_ingredients;
    private $_directions;
    private $_description;
    private $_imageId;
    private $_userId;

    // constructor

    /**
     * Recipe constructor.
     * @param $name The recipe name
     * @param $ingredients list of ingredients in an array within a string
     * @param $directions list of directions in an array within a string
     * @param $description recipe description
     * @param $imageId image id if image associated
     * @param $userId user id
     * @param $firstName the firstname of the user
     * @param $lastName the lastname of the user
     */
    function __construct($name, $ingredients, $directions, $description, $imageId, $userId, $firstName, $lastName)
    {
        $this->_name = $name;
        $this->_ingredients = $ingredients;
        $this->_directions = $directions;
        $this->_description = $description;
        $this->_imageId = $imageId;
        $this->_userId = $userId;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;

    }

    /**
     * Set the image Id
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->_imageId = $imageId;
    }

    /**
     * get the user id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Get the firstname
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * get the last name
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * Get the recipe name
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * get the ingredients
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->_ingredients;
    }

    /**
     * get the directions
     * @return mixed
     */
    public function getDirections()
    {
        return $this->_directions;
    }

    /**
     * get the description
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * get the image Id
     * @return mixed
     */
    public function getImageId()
    {
        return $this->_imageId;
    }

    /**
     * String representation of the recipe
     * @return string
     */
    public function toString()
    {
        return "Recipe: " . $this->_name . "<br>" .
            "Description: <p>" . $this->_description . "</p>" .
            "Ingredients: <p>" . $this->__ingredients . "</p>" .
            "Directions: <p>" . $this->_directions . "</p>";
    }
}

