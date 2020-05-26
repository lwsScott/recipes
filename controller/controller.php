<?php

/**
 * Class RecipeController
 */
class RecipeController
{
    private $_f3; //router
    //private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Display the default route
     */
    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Process the order route
     */
    public function viewRecipes()
    {
        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

        }
    }

    /**
     *
     */
    public function submitRecipe()
    {
        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

        }

    }

    /**
     *
     */
    public function summary()
    {
        //echo '<h1>Thank you for your order!</h1>';

        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}