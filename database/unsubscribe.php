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
    $remove = "DELETE FROM $tbl_name WHERE email='$email'";
    $result=mysql_query($remove);
    if ($result == true) {
        $_SESSION["unsubscribe-success"] = true;
        header("location:".$ref);
    }
    else {
        $_SESSION["unsubscribe-error"] = true;
        $_SESSION["unsubscribe-email"] = $email;
        $_SESSION['error-info'] = "Terjadi Kesalahan Pada Database";
        header("location:".$ref);
    }
}
else{
    $_SESSION["unsubscribe-error"] = true;
    $_SESSION["unsubscribe-email"] = $email;
    $_SESSION['error-info'] = "Email Tersebut Tidak Terdaftar";
    header("location:".$ref);
}
?>