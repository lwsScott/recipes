<?php
class Recipe
{
    //Declare instance variables
    private $_name;
    private $_ingredients;
    private $_directions;
    private $_description;
    private $_imageId;
    private $_submitter;

    // constructor
    function __construct($name, $ingredients, $directions, $description, $imageId, $submitter)
    {
        $this->_name = $name;
        $this->_ingredients = $ingredients;
        $this->_directions = $directions;
        $this->_description = $description;
        $this->_imageId = $imageId;
        $this->_submitter = $submitter;
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
    public function getSubmitter()
    {
        return $this->_submitter;
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

