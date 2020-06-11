  /*
 * Lewis Scott
 * 5/20/20
 * filename https://lscott.greenriverdev.com/328/recipes/recipe.js
 *
 */

  // create an array of ingredients and display them in a list
  let ingredients = [];
  let JSONingredients;

  $("#btnIng").on('click', function() {
	  var add = $("#ingredient").val();

	  if(ingredients.indexOf(add) == -1) {

		  ingredients.push(add);
		  //ingredients.sort();
	  }

	  $('#ingList').html("");
	  for (var i=0; i<ingredients.length; i++)
	  {
		  $("#ingList").append("<li>" + ingredients[i] + "</li>" + "<br>");
	  }
	  $("#ingredient").val("");

	  // convert that array into a JSON string - puts quotes around the array
	  JSONingredients = JSON.stringify(ingredients);

	  // set the value of the form to carry the array within a string
	  document.getElementById('ingredients').value = JSONingredients;
	  //console.log(JSONingredients);
  });

  // create an array of directions and display them in a list
  let directions = [];
  let JSONdirections;
  $("#btnDir").on('click', function() {
	  var add = $("#direction").val();
	  if(directions.indexOf(add) == -1 ) {
		  directions.push(add);
		  //directions.sort();
	  }

	  $('#dirList').html("");
	  for (var i=0; i<directions.length; i++)
	  {
		  $("#dirList").append("<li>" + directions[i] + "</li>" + "<br>");
	  }
	  $("#direction").val("");

	  // convert that array into a JSON string - puts quotes around the array
	  JSONdirections = JSON.stringify(directions);

	  // set the value of the form to carry the array within a string
	  document.getElementById('directions').value = JSONdirections;

	  //console.log(JSONingredients);
  });

  // we now have two strings JSONingredients = "[''ing1, "ing2"]"
  // and JSONdirections "[''dir1, "dir2"]"

  // combine into one array [JSONingredients, JSONdirections, name]
  // name will come from the input id=recipeName
  // then stringify that array "[JSONingredients, JSONdirections, name]"
  // then we can post that to PHP which will store it in a DB table

  // name="recipeName"
  // name="ingredients"
  // name="directions"
  // name="description"

  // this is what a post array looks like
  // array(7) { ["firstName"]=> string(1) "l" ["lastName"]=> string(1) "s"
  // ["email"]=> string(11) "me@mail.com" ["phone"]=> string(10) "1234567891"
  // ["username"]=> string(3) "lew" ["password"]=> string(4) "pswd"
  // ["confirm"]=> string(4) "pswd" }
 // $products = array('eggs' => 2.19, 'bacon' => 4.35, 'bagels' => 1.89);
/*
  // post the data to the .php file
  $("#btnSubmit").on('click', function() {
	  // add the name to the array
	  let myArr = [JSONingredients, JSONdirections, $('#recipeName').val(), $('#description').val()];
	  // the post array is an associative array
	  // create our own associative array

	  let postString = JSON.stringify(myArr);
	  $.ajax({
		  url: 'submitRecipe.html',
		  type: "POST",
		  dataType: 'text',
		  data: {recipe: postString}/*,
		  success: function(result) {
		  	return result;
			  //catcher=result;
			  //console.log(result);
			  //console.log(catcher);
			  //console.log($('#searchName').val());
			  //var object = JSON.parse(result);
			  //console.log(object);
			  //$('#output').html("<p>" + object.name + ", " + object.email +
			  //					", " + object.phone + "</p>");
		  },
		  error: function(xhr, resp, text) {
			  console.log(xhr, resp, text);
		  }
	  });


	  //$.post('submitRecipe', {recipe: postString});
	  //var xhr = new XMLHttpRequest();
	  //xhr.open("POST", 'submitRecipe');
	  //xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  //xhr.send((({recipe: postString})
	  //));
  // listen for form submit
//document.getElementById("ingForm").addEventListener("click", addIngredient, false);
*/