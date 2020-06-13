/*
* Lewis Scott
* 6/4/20
* filename https://lscott.greenriverdev.com/328/recipes/js/clientSideValidation.js
* validates data before submitting
*/
// if not validate prevent default and do not post data
let checkForm = function(e) {
    //let form = e.target;
    if (!validate())
    {
        // prevent form from submitting and "refreshing" page
        e.preventDefault();
    }
};
// on submit checkForm
document.getElementById("recipe").addEventListener("submit", checkForm, false);

    // validate the data
    function validate()
    {
        //alert("Validating");

        // Create a flag variable
        let valid = true;

        // Make all errors hidden
        let errors = document.getElementsByClassName("err");
        for (let i=0; i<errors.length; i++)
        {
            errors[i].style.visibility = "hidden";
        }

        // Check recipe name
        let recipeName = document.getElementById("recipeName").value;
        if (recipeName == "")
        {
            let errName = document.getElementById("errName");
            errName.style.visibility = "visible";
            errName.innerHTML = "Recipe Name required";
            valid = false;
        }

        // Check recipe description
        let description = document.getElementById("description").value;
        if (description == "")
        {
            let errDesc = document.getElementById("errDesc");
            errDesc.innerHTML = "Description required";
            errDesc.style.visibility = "visible";
            valid = false;
        }

        // Check recipe ingredients
        let ingredients = document.getElementById("ingredients").value;
        if (ingredients == "")
        {
            let errDesc = document.getElementById("errIng");
            errIng.innerHTML = "Ingredients required";
            errIng.style.visibility = "visible";
            valid = false;
        }

        // Check recipe directions
        let directions = document.getElementById("directions").value;
        if (directions == "")
        {
            let errDesc = document.getElementById("errDir");
            errDir.innerHTML = "Directions required";
            errDir.style.visibility = "visible";
            valid = false;
        }
        return valid;
    }

