<?php
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
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->_imageId = $imageId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->_ingredients;
    }

    /**
     * @return mixed
     */
    public function getDirections()
    {
        return $this->_directions;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->_imageId;
    }

    public function toString()
    {
        return "Recipe: " . $this->_name . "<br>" .
            "Description: <p>" . $this->_description . "</p>" .
            "Ingredients: <p>" . $this->__ingredients . "</p>" .
            "Directions: <p>" . $this->_directions . "</p>";

    }


}

