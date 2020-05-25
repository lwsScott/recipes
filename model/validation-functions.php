<?php

/* Define functions to validate data */

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

