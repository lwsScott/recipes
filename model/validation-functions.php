<?php

/**
 * Class Validate
 * Contains the validation methods for my app
 * @author Lewis Scott
 * @version 1.0
 */
class Validate
{
    function validName($name)
    {
        return !empty($name);
    }

    function validIngredients($ing)
    {
        return !empty($ing);
    }

    function validDirections($dir)
    {
        return !empty($dir);
    }

    function validDescription($desc)
    {
        return !empty($desc);
    }
}

