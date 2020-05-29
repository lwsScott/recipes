<?php

/**
 * Class RecipeController
 */
class RecipeController
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
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
     * Process the view Recipes route
     */
    public function viewRecipes()
    {
        $result = $GLOBALS['db']->getRecipes();

        //var_dump($result);
        $this->_f3->set('results', $result);

        $view = new Template();
        echo $view->render('views/recipes.php');
        /*
        foreach ($result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row['recipeName'] . "</td>";
            echo "<td>" . $row['userId'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "</tr>";
        }
        */
        /*
        foreach ($result as $row) {
            echo "<p>" . $row['recipeName'] . ", " . $row['ingredients'] . ", " .
                $row['directions'] . ", " . $row['description'] . ", " . $row['userId'] .
                ", " . $row['recipeId'] . "</p>";
        }
        */
    }

    /**
     * Display the individual recipe
     */
    public function viewRecipe()
    {
        //echo "Here at view recipe" . $f3->get('recipeId');
        $result = $GLOBALS['db']->getDetails($this->_f3->get('recipeId'));

        var_dump($result);
        $this->_f3->set('results', $result);


        $view = new Template();
        echo $view->render('views/recipe.html');
    }

    /**
     *
     */
    public function submitRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1>I made it here in the controller post method</h1>';

            // validate the data
            $valid = true;
            echo $valid;
            // validate name
            if (!$this->_validator->validName($_POST['name'])) {
                $valid = false;
                $this->_f3->set('errors["name"]', "Please provide a recipe name");
            } else {
                $this->_f3->set('selectedName', $_POST['name']);
            }

            // validate ingredients
            if (!$this->_validator->validIngredients($_POST['ingredients'])) {
                $valid = false;
                $this->_f3->set('errors["ingredients"]', "Please provide the ingredients");
            } else {
                $this->_f3->set('selectedIngredients', $_POST['ingredients']);
            }

            // validate directions
            if (!$this->_validator->validDirections($_POST['directions'])) {
                $valid = false;
                $this->_f3->set('errors["directions"]', "Please provide the directions");
            } else {
                $this->_f3->set('selectedDirections', $_POST['directions']);
            }

            // validate description
            if (!$this->_validator->validDescription($_POST['description'])) {
                $valid = false;
                $this->_f3->set('errors["description"]', "Please provide the description");
            } else {
                $this->_f3->set('selectedDescription', $_POST['description']);
            }

            echo $valid;
            // if valid data
            if ($valid) {
                echo '<h1>I made it here with valid data</h1>';

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
            else {
                $view = new Template();
                echo $view->render
                ('views/submitRecipe.html');
            }
        } else {
            $view = new Template();
            echo $view->render
            ('views/submitRecipe.html');
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