<?php

session_start();
require 'connect.php';

$tbl_name="tb_user";
$tbl_name2="tb_profile";
$ref=$_POST['from'];
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password-en'];

$name = stripslashes($name);
$email = stripslashes($email);
$username = stripslashes($username);
$password = stripslashes($password);
$name = mysql_real_escape_string($name);
$email = mysql_real_escape_string($email);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$checkemail="SELECT * FROM $tbl_name WHERE email='$email'";
$checkusername="SELECT * FROM $tbl_name WHERE username='$username'";

$resultemail=mysql_query($checkemail);
$resultusername=mysql_query($checkusername);

$countemail=mysql_num_rows($resultemail);
$countusername=mysql_num_rows($resultusername);

if($countemail!=0){
    $_SESSION["signup-error"] = true;
    $_SESSION["signup-name"] = $name;
    $_SESSION["signup-email"] = $email;
    $_SESSION["signup-username"] = $username;
    $_SESSION['error-info'] = "Email Telah Terpakai";
    header("location:".$ref);
}
else if($countusername!=0){
    $_SESSION["signup-error"] = true;
    $_SESSION["signup-name"] = $name;
    $_SESSION["signup-email"] = $email;
    $_SESSION["signup-username"] = $username;
    $_SESSION['error-info'] = "Username Telah Terpakai";
    header("location:".$ref);
}
else{
    $length = 32;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $verification = $randomString;
    $insertinto = "INSERT INTO $tbl_name (username, email, password, verificationcode) VALUES ('$username','$email','$password','$verification')";
    $resultinsert=mysql_query($insertinto);
    if ($resultinsert === TRUE) {
        $now = date("Y-m-d");
        $insertinto = "INSERT INTO $tbl_name2 (username, name, joined) VALUES ('$username','$name','$now')";
        $resultinsert2=mysql_query($insertinto);
        $resultinsert2;
        date_default_timezone_set('Etc/UTC');
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "explore.malang.22@gmail.com";
        $mail->Password = "3xpl0r3ng4l4m";
        $mail->setFrom('admin@exploremalang.id', 'Explore Malang');
        $mail->addAddress($email, $name);
        $mail->Subject = 'Selamat Datang di Explore Malang';
        $mail->Body = "Halo ".$name.",\n\n";
        $mail->Body .= "Anda baru saja mendaftar di Explore Malang dengan username: ".$username."\n";
        $mail->Body .= "Segera verifikasi email Anda dengan cara klik pada link berikut ini:\n\n";
        $mail->Body .= "http://localhost/exploremalang/index.php?verification=".$verification."\n\n";
        $mail->Body .= "Salam hangat,\n";
        $mail->Body .= "Explore Malang";
        if (!$mail->send()) {
            $_SESSION["signup-error"] = true;
            $_SESSION["signup-name"] = $name;
            $_SESSION["signup-email"] = $email;
            $_SESSION["signup-username"] = $username;
            $_SESSION['error-info'] = "Tidak Dapat Terhubung Ke Server";
            $deletefrom = "DELETE FROM $tbl_name WHERE username='$username'";
            $resultdelete=mysql_query($deletefrom);
            $resultdelete;
            $deletefrom2 = "DELETE FROM $tbl_name2 WHERE username='$username'";
            $resultdelete2=mysql_query($deletefrom2);
            $resultdelete2;
            header("location:".$ref);
        }
        else {
            $sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
            $result=mysql_query($sql);
            $data=mysql_fetch_array($result);
            $sql2="SELECT * FROM tb_profile WHERE username='$username'";
            $result2=mysql_query($sql2);
            $data2=mysql_fetch_array($result2);
            $_SESSION["loggedin"] = true;
            $_SESSION["user"] = $username;
            $_SESSION["verification"] = $data['verification'];
            $_SESSION["picture"] = $data2['picture'];
            header("location:".$ref);
        }
    }
    else {
        $_SESSION["signup-error"] = true;
        $_SESSION["signup-name"] = $name;
        $_SESSION["signup-email"] = $email;
        $_SESSION["signup-username"] = $username;
        $_SESSION['error-info'] = "Terjadi kesalahan pada database";
        header("location:".$ref);
    }
}
?>