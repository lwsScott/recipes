<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!--
  Lewis Scott
  5/17/20
  filename https://lscott.greenriverdev.com/328/recipes/views/recipes.php
  Recipes page
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recipes</title>
    <include href="includes/header.html"></include>
</head>
<body>
<include href="includes/navBar.html"></include>

<div class='container'>
    <h3>Recipe Summary</h3>

    <table id='recipes'>
        <thead>
        <tr>
            <th>Recipe name</th>
            <th>Submitted by</th>
            <th>Description</th>
        </tr>
        </thead>

        <repeat group="{{ @results }}" value="{{ @row }}">
            <tr>
                <td> <a href="recipes/{{ $row['recipeId'] }}"> {{ $row['recipeName'] }} </a></td>
                <td> {{ $row['firstName'] }} {{ $row['lastName'] }}</td>
                <td> {{ $row['description'] }}</td>
            </tr>
        </repeat>

    </table>

</div>
<!--
<a href='new-student.php?sid=$sid'-->
<include href="includes/footer.html"></include>

<!-- add data table scripts -->
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $('#recipes').DataTable();
</script>


</body>
</html>

