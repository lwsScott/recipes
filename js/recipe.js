/*12-2-2018
Final Project
This page uses JQuery to
create an array of ingredients and display them in a list
create an array of directions and display them in a list
Puts the ingredients, directions and recipe name into
a file to POST to .php on server which stores in a DB for
later retrieval
Then have a retrieval function to query the database
based on search name.

url:  http://lscott.greenriverdev.com/207/final-project/js/recipe.js
*/

	
	// create an array of ingredients and display them in a list
	var ingredients = [];
	var JSONingredients;
	$("#btnIng").on('click', function() {
	    var add = $("#ingredient").val();
	    if(ingredients.indexOf(add) == -1 )
	    {
		   ingredients.push(add);
		   ingredients.sort();
	    }

	    $('#ingList').html("");
	    for (var i=0; i<ingredients.length; i++)
	    {
		   $("#ingList").append("<li>" + ingredients[i] + "</li>" + "<br>");
	    }
	    $("#ingredient").val("");
	    
	    	// convert that array into a JSON string - puts quotes around the array
	    	JSONingredients = JSON.stringify(ingredients);
		//console.log(JSONingredients);
        });
	
	// create an array of directions and display them in a list
	var directions = [];
	var JSONdirections;
	$("#btnDir").on('click', function() {
	    var add = $("#direction").val();
	    if(directions.indexOf(add) == -1 )
	    {
		   directions.push(add);
		   directions.sort();
	    }

	    $('#dirList').html("");
	    for (var i=0; i<directions.length; i++)
	    {
		   $("#dirList").append("<li>" + directions[i] + "</li>" + "<br>");
	    }
	    $("#direction").val("");
	    
	    // convert that array into a JSON string - puts quotes around the array
	    	JSONdirections = JSON.stringify(directions);
		//console.log(JSONingredients);
        });
	
	
	// we now have two strings JSONingredients = "[''ing1, "ing2"]"
	// and JSONdirections "[''dir1, "dir2"]"
	// combine into one array [JSONingredients, JSONdirections, name]
	// name will come from the input id=recipeName
	// then stringify that array "[JSONingredients, JSONdirections, name]"
	// then we can post that to PHP which will store it in a DB table
	


	// post the data to the .php file	
	$("#btnSubmit").on('click', function() {
		// add the name to the array
		var myArr = [JSONingredients, JSONdirections, $('#recipeName').val()];
		var postString = JSON.stringify(myArr);
		$.ajax({
			url: 'js/recipe.php',
			type: "POST",
			dataType: 'text',
			data: {recipe: postString},
			success: function(result) {
				catcher=result;
				console.log(result);
				console.log(catcher);
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
	});
	
	// now search the database for a recipe name
	// and return the ingredients, directions, name
	// parse and display the data.
	var catcher = [];
	var object;
	$("#btnSearch").on('click', function() {
		//$('#output').html("<p>button is working</p>");
		//console.log($('#recipeNameSearch').val());
		$.ajax({
			url: 'js/recipe-search.php',
			type: "POST",
			dataType: 'text',
			data: {searchName: $('#recipeNameSearch').val()},
			success: function(result) {
				catcher=result;
				console.log(result);
				console.log(catcher);
				//console.log($('#searchName').val());
				object = JSON.parse(result);
				console.log(object);
				$('#outputIng').html("");
				$('#outputDir').html("");
				$('#output').html("<p>" + object.name);
				for (var i=0; i<JSON.parse(object.ingredients).length; i++)
				{
					$('#outputIng').append("<li>" + JSON.parse(object.ingredients)[i] + "</li>");
				}
				for (i=0; i<JSON.parse(object.directions).length; i++)
				{
					$('#outputDir').append("<li>" + JSON.parse(object.directions)[i] + "</li>");
				}
			},
			error: function(xhr, resp, text) {
				console.log(xhr, resp, text);
			}
		});
	});
	
	
	