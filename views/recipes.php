<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                <td> {{ $row['recipeName'] }} </td>
                <td> {{ $row['userId'] }} </td>
                <td> {{ $row['description'] }}</td>
            </tr>
        </repeat>

    </table>



</div>


<include href="includes/footer.html"></include>
</body>
</html><?php
