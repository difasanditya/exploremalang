<?php

session_start();
require 'connect.php';

$username=$_SESSION['user'];
date_default_timezone_set('Etc/UTC');
require 'phpmailer/PHPMailerAutoload.php';
$tbl_name="tb_user";
$sql="SELECT * FROM $tbl_name WHERE username='$username'";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);
$tbl_name2="tb_profile";
$sql2="SELECT * FROM $tbl_name2 WHERE username='$username'";
$result2=mysql_query($sql2);
$data2=mysql_fetch_array($result2);
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
$mail->addAddress($data['email'], $data2['name']);
$mail->Subject = 'Kode Verifikasi Explore Malang';
$mail->Body = "Halo ".$data2['name'].",\n\n";
$mail->Body .= "Anda baru saja meminta kode verifikasi untuk akun ".$username." di Explore Malang\n";
$mail->Body .= "Segera verifikasi email Anda dengan cara klik pada link berikut ini:\n\n";
$mail->Body .= "http://localhost/exploremalang/index.php?verification=".$data['verificationcode']."\n\n";
$mail->Body .= "Salam hangat,\n";
$mail->Body .= "Explore Malang";

if (!$mail->send()){
    $_SESSION['send-verification-error']=true;
    header("location:".$_SESSION['prev-location']);
}
else {
    $_SESSION['send-verification-success']=true;
    header("location:".$_SESSION['prev-location']);
}
?>