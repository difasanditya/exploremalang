<?php

session_start();
require 'connect.php';

$tbl_name="tb_user";
$ref=$_POST['from'];
$email=$_POST['email'];

$email = stripslashes($email);
$email = mysql_real_escape_string($email);

$sql="SELECT * FROM $tbl_name WHERE email='$email'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

if($count==1){
    $sql="SELECT * FROM $tbl_name WHERE email='$email' and username='admin'";
    $result=mysql_query($sql);
    $count=mysql_num_rows($result);
    if($count==1){
        $_SESSION["forgot-error"] = true;
        $_SESSION["forgot-email"] = $email;
        $_SESSION['error-info'] = "Email Tersebut Tidak Terdaftar";
        header("location:".$ref);
    }
    else{
        $edit="SELECT * FROM $tbl_name WHERE email='$email'";
        $hasil=mysql_query($edit);
        $data=mysql_fetch_array($hasil);
        $passwordreal = $data['password'];
        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $password = $randomString;
        $passwordencrypted = md5($randomString);
        $update = "UPDATE $tbl_name SET password='$passwordencrypted', reset='1' WHERE email='$email'";
        $hasil2= mysql_query($update);
        $hasil2;
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
        $mail->addAddress($email, $data['name']);
        $mail->Subject = 'Reset Password - Explore Malang';
        $mail->Body = "Halo ".$data['name'].",\n\n";
        $mail->Body .= "Anda telah meminta password baru untuk akun ".$data['username']." di Explore Malang.\n";
        $mail->Body .= "Password baru Anda adalah: ".$password."\n";
        $mail->Body .= "Atau klik link berikut untuk langsung mengganti password:\n\n";
        $mail->Body .= "http://localhost/exploremalang/index.php?reset=".$passwordencrypted."\n\n";
        $mail->Body .= "Salam hangat,\n";
        $mail->Body .= "Explore Malang";
        if (!$mail->send()) {
            $update = "UPDATE $tbl_name SET password='$passwordreal', reset='0' WHERE email='$email'";
            $hasil2= mysql_query($update);
            $hasil2;
            $_SESSION["forgot-error"] = true;
            $_SESSION["forgot-email"] = $email;
            $_SESSION['error-info'] = "Tidak Dapat Terhubung Ke Server";
            header("location:".$ref);
        } else {
            $_SESSION["forgot-success"] = true;
            header("location:".$ref);
        }
    }
}
else {
    $_SESSION["forgot-error"] = true;
    $_SESSION["forgot-email"] = $email;
    $_SESSION['error-info'] = "Email Tersebut Tidak Terdaftar";
    header("location:".$ref);
}
?>