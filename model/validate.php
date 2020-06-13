<?php
/*
 * validation Class for recipe website
 * validates data
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/model/validate.php
 * @author Lewis Scott
 * @version 1.0
 */
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
    /**
     * validate ingredients
     * @param $ing
     * @return bool
     */
    function validIngredients($ing)
    {
        return !empty($ing);
    }

    /**
     * validate directions
     * @param $dir
     * @return bool
     */
    function validDirections($dir)
    {
        return !empty($dir);
    }

    /**
     * validate the description
     * @param $desc
     * @return bool
     */
    function validDescription($desc)
    {
        return !empty($desc);
    }

    /**
     * validate the recipe name
     * @param $name
     * @return bool
     */
    function validName($name)
    {
        $name = str_replace(' ', '', $name);
        return !empty($name);
    }

    // validate phone number either 10 digits or 3-3-4 digits

    /**
     * validate the phone number
     * @param $phoneNum
     * @return bool
     */
    function validPhone($phoneNum)
    {
        //echo $phoneNum;
        return (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNum) ||
            preg_match("/^[0-9]{10}$/", $phoneNum));
    }

    /**
     * validate the email
     * @param $email
     * @return bool
     */
    function validEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }
}



