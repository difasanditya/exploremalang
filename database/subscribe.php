<?php

session_start();
require 'connect.php';

$tbl_name="tb_subscriber";
$ref=$_POST['from'];
$email=$_POST['email'];

$email = stripslashes($email);
$email = mysql_real_escape_string($email);

$checkemail="SELECT * FROM $tbl_name WHERE email='$email'";

$result=mysql_query($checkemail);

$countemail=mysql_num_rows($result);

if($countemail!=0){
    $_SESSION["subscribe-error"] = true;
    $_SESSION['error-info'] = "Email Tersebut Sudah Terdaftar";
    header("location:".$ref."#footer");
}
else{
    $insertinto = "INSERT INTO $tbl_name VALUES ('$email')";
    $resultinsert=mysql_query($insertinto);
    if ($resultinsert === TRUE) {
        $_SESSION["subscribe-success"] = true;
        header("location:".$ref);
    }
    else {
        $_SESSION["subscribe-error"] = true;
        $_SESSION['error-info'] = "Terjadi Kesalahan Pada Database";
        header("location:".$ref);
    }
}
?>