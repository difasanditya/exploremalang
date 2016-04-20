<?php

session_start();
require 'connect.php';

$tbl_name="tb_purchase";

$idplace = $_POST['id'];
$date = $_POST['date'];
$adult = $_POST['adult'];
$kid = $_POST['kid'];
$price = $_POST['price'];

$idplace = stripslashes($idplace);
$adult = stripslashes($adult);
$kid = stripslashes($kid);
$price = stripslashes($price);

$idplace = mysql_real_escape_string($idplace);
$adult = mysql_real_escape_string($adult);
$kid = mysql_real_escape_string($kid);
$price = mysql_real_escape_string($price);

$username = $_SESSION['user'];

$now = date("Y-m-d");
$date2 = date_create($date);
$date2 = date_format($date2,"Y-m-d");

$insert = "INSERT INTO $tbl_name VALUES (NULL,'$username','$idplace','$price','$adult','$kid','$now','$date2')";
$hasil= mysql_query($insert);
if ($hasil==true){
    header("location:/exploremalang/profile.php");
    date_default_timezone_set('Etc/UTC');
    require 'phpmailer/PHPMailerAutoload.php';
    $tbl_name2="tb_user";
    $sql="SELECT * FROM $tbl_name2 WHERE username='$username'";
    $result=mysql_query($sql);
    $data=mysql_fetch_array($result);
    $tbl_name3="tb_user";
    $sql2="SELECT * FROM $tbl_name3 WHERE username='$username'";
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
    $mail->Subject = 'Pembelian Tiket Explore Malang';
    $mail->Body = "Halo ".$data2['name'].",\n\n";
    $mail->Body .= "Anda baru saja membeli tiket di Explore Malang dengan rincian sebagai berikut:\n";
    $tbl_name4="tb_place";
    $sql3="SELECT * FROM $tbl_name4 WHERE idplace='$idplace'";
    $result3=mysql_query($sql3);
    $data3=mysql_fetch_array($result3);
    $mail->Body .= "Nama wisata: ".$data3['name']."\n";
    $mail->Body .= "Untuk tanggal: ".$date."\n";
    $mail->Body .= "Tiket dewasa: ".$adult."\n";
    $mail->Body .= "Tiket anal-anak: ".$kid."\n";
    $mail->Body .= "Senilai: ".$price."\n";
    $mail->Body .= "Salam hangat,\n";
    $mail->Body .= "Explore Malang";
    if (!$mail->send()) {
        $_SESSION["purchase-error"] = true;
        header("location:".$_SESSION['prev-location']);
    }
    else {
        $_SESSION["purchase-success"] = true;
        header("location:/exploremalang/profile.php");
    }
}
else {
    $_SESSION["purchase-error"] = true;
    header("location:".$_SESSION['prev-location']);
}
?>