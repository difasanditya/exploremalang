<?php

session_start();
require 'connect.php';

$tbl_name="tb_profile";
$name=$_POST['name'];
$sex=$_POST['sex'];
$location=$_POST['location'];

$name = stripslashes($name);
$sex = stripslashes($sex);
$location = stripslashes($location);
$name = mysql_real_escape_string($name);
$sex = mysql_real_escape_string($sex);
$location = mysql_real_escape_string($location);

$username = $_SESSION['user'];

$update = "UPDATE $tbl_name SET name='$name', sex='$sex', location='$location' WHERE username='$username'";
$hasil= mysql_query($update);

if ($hasil==true){
    $_SESSION['success-change-profile']=true;
    header("location:/exploremalang/profile.php");
}
else {
    $_SESSION['change-profile-error']=true;
    header("location:".$_SESSION['prev-location']."#edit");
}
?>