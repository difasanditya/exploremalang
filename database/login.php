<?php

session_start();
require 'connect.php';

$tbl_name="tb_user";
$tbl_name2="tb_profile";
$ref=$_POST['from'];
$username=$_POST['username'];
$password=$_POST['password-en'];

$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);

if($count==1){
    $data=mysql_fetch_array($result);
    $sql="SELECT * FROM $tbl_name2 WHERE username='$username'";
    $result=mysql_query($sql);
    $data2=mysql_fetch_array($result);
    $_SESSION["loggedin"] = true;
    $_SESSION["user"] = $username;
    $_SESSION["verification"] = $data['verification'];
    $_SESSION["picture"] = $data2['picture'];
    header("location:".$ref);
}
else {
    $_SESSION["login-error"] = true;
    $_SESSION["login-user"] = $username;
    $_SESSION['error-info'] = "Username/Password Salah";
    header("location:".$ref);
}
?>