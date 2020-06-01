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

function validName($name)
{
    $name = str_replace(' ', '', $name);
    return !empty($name) && ctype_alpha($name);
}
function validPhone($age){
    if(is_numeric($age)){
        return true;
    }
    else{
        return false;
    }
}
function validAge($age){
    if ($age>18 && $age<118){
        return true;
    }
    else{
        return false;
    }
}
function validEmail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
        return false;
    }
}
function validInterest($interest){
    if(isset($interest)){
        return true;
    }
    else{
        return false;
    }
}

