<?php
/*
 * ajax page for recipe website
 * queries username to determine if available
 * sets the session nameAvail variable
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/controller/controller.php
 * @author Lewis Scott
 * @version 1.0
 */
session_start();

// check which database to use depending on site
if ($_SERVER['USER'] == 'lscottgr') {
    require_once '/home2/lscottgr/db.php';
}
else if ($_SERVER['USER'] == 'qzhanggr') {
    require_once '/home2/qzhanggr/db.php';
}
// check the username for availability
// query the database and count usernames
if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $query = "select count(*) as cntUser from users where username='".$username."'";

    $result = mysqli_query($cnxn ,$query);
    $response = "<span style='color: green;'>Available.</span>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $response = "<span style='color: red;'>Not Available.</span>";
            $_SESSION['nameAvail'] = "Username is not available";
        }
        else {
            $_SESSION['nameAvail'] = "available";
        }
    }
    echo $response;
    die;
}