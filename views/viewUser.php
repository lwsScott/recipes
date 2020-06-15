<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <include href="includes/header.html"></include>
</head>
<body>
<include href="includes/navBar.html"></include>

<div class='container'>
    <h3>View of All Users</h3>

    <table id='users'>
        <thead>
        <tr>
            <th>User id</th>
            <th>Username</th>

        </tr>
        </thead>

        <repeat group="{{ @users }}" value="{{ @row }}">
            <tr>

                <td><a href="users/{{$row['userId']}}"> {{ $row['userId'] }} </td>

                <td> {{ $row['username'] }} </td>

            </tr>
        </repeat>

    </table>

    <a href="newUser">Add new User</a>
</div>


<include href="includes/footer.html"></include>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $('#users').DataTable();
</script>
</body>
</html>