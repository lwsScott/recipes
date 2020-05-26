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
        $result = $GLOBALS['db']->getRecipes();
        foreach ($result as $row) {
            echo "<p>" . $row['recipeName'] . ", " . $row['ingredients'] . ", " .
                $row['directions'] . ", " . $row['description'] . ", " . $row['userId'] .
                ", " . $row['recipeId'] . "</p>";
        }

    }

    /**
     *
     */
    public function submitRecipe($f3)
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo '<h1>I made it here in the controller post method</h1>';

            // validate the data
            $valid = true;
            // validate name
            if (!validName($_POST['name'])) {
                $valid = false;
                $f3->set('errors["name"]', "Please provide a recipe name");
            } else {
                $f3->set('selectedName', $_POST['name']);
            }

            // validate ingredients
            if (!validIngredients($_POST['ingredients'])) {
                $valid = false;
                $f3->set('errors["ingredients"]', "Please provide the ingredients");
            } else {
                $f3->set('selectedIngredients', $_POST['ingredients']);
            }

            // validate directions
            if (!validDirections($_POST['directions'])) {
                $valid = false;
                $f3->set('errors["directions"]', "Please provide the directions");
            } else {
                $f3->set('selectedDirections', $_POST['directions']);
            }

            // validate description
            if (!validDescription($_POST['description'])) {
                $valid = false;
                $f3->set('errors["description"]', "Please provide the description");
            } else {
                $f3->set('selectedDescription', $_POST['description']);
            }
        }

        // if valid data
        if ($valid) {
            //echo '<h1>I made it here with valid data</h1>';

            $recipeName = $_POST['name'];
            $ingredients = $_POST['ingredients'];
            $directions = $_POST['directions'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $submitter = $_POST['submitter'];

            // construct a recipe object
            $recipe = new Recipe($recipeName, $ingredients, $directions, $description, $image, $submitter);
            //var_dump($recipe);
            // add the recipe to the database
            $GLOBALS['db']->addRecipe($recipe);
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