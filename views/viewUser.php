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
            <th>first name</th>
            <th>lastName</th>
            <th>email</th>
            <th>Phone</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        </thead>

        <repeat group="{{ @users }}" value="{{ @row }}">
            <tr>

                <td> {{ $row['userId'] }} </td>
                <td> {{ $row['firstname'] }}</td>
                <td> {{ $row['lastname'] }} </td>
                <td> {{ $row['email'] }} </td>
                <td> {{ $row['phone'] }} </td>
                <td> {{ $row['username'] }} </td>
                <td> {{ $row['password'] }} </td>
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
