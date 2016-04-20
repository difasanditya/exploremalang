<?php

session_start();
require 'connect.php';

$tbl_name="tb_user";
$tbl_name2="tb_profile";
$ref=$_POST['from'];
$code=$_POST['code'];
$email=$_POST['email'];
$password=$_POST['password-en'];

$code = stripslashes($code);
$email = stripslashes($email);
$password = stripslashes($password);
$code = mysql_real_escape_string($code);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);

$edit="SELECT * FROM $tbl_name WHERE email='$email' and password='$password'";
$result=mysql_query($edit);
$count=mysql_num_rows($result);
$data=mysql_fetch_array($result);

if (($count==1)&&($data['username']!='admin')){
    if($data['verification']==0){
        if($data['verificationcode']==$code){
            $update = "UPDATE $tbl_name SET verification='1' WHERE email='$email'";
            $hasil2= mysql_query($update);
            $hasil2;
            $edit="SELECT * FROM $tbl_name WHERE email='$email' and password='$password'";
            $result=mysql_query($edit);
            $data=mysql_fetch_array($result);
            $user = $data['username'];
            $edit="SELECT * FROM $tbl_name2 WHERE username='$user'";
            $result=mysql_query($edit);
            $data2=mysql_fetch_array($result);
            $_SESSION["loggedin"] = true;
            $_SESSION["user"] = $user;
            $_SESSION["verification"] = $data['verification'];
            $_SESSION["level"] = $data['level'];
            $_SESSION["picture"] = $data2['picture'];
            $_SESSION["verification-success"] = true;
            header("location:/exploremalang/profile.php");
        }
        else{
            $_SESSION["verification-error"] = true;
            $_SESSION['verification-email'] = $email;
            $_SESSION['error-info'] = "Anda Mendapat Link Yang Salah";
            header("location:".$ref."?verification=".$code);
        }
    }
    else{
        $_SESSION["verification-error"] = true;
        $_SESSION['verification-email'] = $email;
        $_SESSION['error-info'] = "Email Sudah Terverifikasi";
        header("location:".$ref."?verification=".$code);
    }
}
else {
    $_SESSION["verification-error"] = true;
    $_SESSION['verification-email'] = $email;
    $_SESSION['error-info'] = "Email/Password Salah";
    header("location:".$ref."?verification=".$code);
}
?>