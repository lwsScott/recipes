<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
/**
 * Class Validate
 * Contains the validation methods for my app
 * @author Lewis Scott
 * @version 1.0
 */
class ValidateRecipes
{
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

    function validName($name)
    {
        $name = str_replace(' ', '', $name);
        return !empty($name);
    }

    // validate phone number either 10 digits or 3-3-4 digits
    function validPhone($phoneNum)
    {
        //echo $phoneNum;
        return (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNum) ||
            preg_match("/^[0-9]{10}$/", $phoneNum));
    }

    function validEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }
}



