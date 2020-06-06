
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <!-- Header  -->
    <include href="includes/header.html"></include>
</head>
<body>
<!-- Navbar -->
<include href="includes/navBar.html"></include>
<div class="container card rounded">

    <h1>Login Page</h1>

    <form action="#" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<check if='{{ isset(@SESSION.username) }}'>{{ @SESSION.username }}</check>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" >
        </div>
        <check if="{{ isset(@SESSION.err) }}">
            <span class="err">Incorrect login</span><br>
        </check>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>
<include href="includes/footer.html"></include>


</body>
</html>