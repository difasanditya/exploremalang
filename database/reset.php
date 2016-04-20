<?php

session_start();
require 'connect.php';

$tbl_name="tb_user";
$ref=$_POST['from'];
$code=$_POST['code'];
$password=$_POST['password-en'];

$code = stripslashes($code);
$password = stripslashes($password);
$code = mysql_real_escape_string($code);
$password = mysql_real_escape_string($password);

$edit="SELECT * FROM $tbl_name WHERE password='$code'";
$result=mysql_query($edit);
$count=mysql_num_rows($result);

if($count==1){
    $hasil=mysql_query($edit);
    $data=mysql_fetch_array($hasil);
    if($data['reset']==1){
        $email = $data['email'];
        $update = "UPDATE $tbl_name SET password='$password', reset='0' WHERE email='$email'";
        $hasil2= mysql_query($update);
        $hasil2;
        $_SESSION["reset-success"] = true;
        header("location:".$ref);
    }
    else{
        $_SESSION["reset-error"] = true;
        $_SESSION['error-info'] = "Anda Tidak Pernah Melakukan Reset Password";
        header("location:".$ref."?reset=".$code);
    }
}
else {
    $_SESSION["reset-error"] = true;
    $_SESSION['error-info'] = "Anda Mendapat Link Yang Salah";
    header("location:".$ref."?reset=".$code);
}
?>