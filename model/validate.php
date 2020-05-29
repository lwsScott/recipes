<?php
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