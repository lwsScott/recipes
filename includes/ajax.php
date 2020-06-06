<?php

if ($_SERVER['USER'] == 'lscottgr')
{
    require_once '/home2/lscottgr/db.php';
}

else if ($_SERVER['USER'] == 'qzhanggr')
{
    require_once '/home2/qzhanggr/db.php';
}

if(isset($_POST['username'])){
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

    }
    echo $response;
    die;
}