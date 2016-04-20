<?php

session_start();
require 'connect.php';

$tbl_name="tb_profile";
$username=$_SESSION['user'];
$picture=$_FILES['picture']['name'];
$name = explode(".",$picture);

for ($int = 0; $int<=strlen($picture);$int++){
    if (isset($name[$int])==false){
        $extention = $name[$int-1];
        $filename = $username.".".$extention;
        break;
    }
}

if ( ($extention=='jpg') || ($extention=='jepg') || ($extention=='png') ||  ($extention=='gif') ) {
    $sql="SELECT * FROM $tbl_name WHERE username='$username'";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);

    if ($row['picture']!="css/img/profile/unset.png"){
        unlink("../".$row['picture']);
    }

    if (file_exists("../css/img/profile/".$filename) ){
        unlink("../css/img/profile/".$filename);
        move_uploaded_file($_FILES['picture']['tmp_name'], "../css/img/profile/".$filename);
        mysql_query("UPDATE $tbl_name SET picture='css/img/profile/$filename' WHERE username='$username'");
        $_SESSION["picture"]= 'css/img/profile/'.$filename;
        $_SESSION['success-change-picture']=true;
        header("location:/exploremalang/profile.php");
    }

    else{
        move_uploaded_file($_FILES['picture']['tmp_name'], "../css/img/profile/".$filename);
	   mysql_query("UPDATE $tbl_name SET picture='css/img/profile/$filename' WHERE username='$username'");
        $_SESSION["picture"]= 'css/img/profile/'.$filename;
        $_SESSION['success-change-picture']=true;
        header("location:/exploremalang/profile.php");
    }
}

else {
    $_SESSION['change-picture-error']=true;
    header("location:".$_SESSION['prev-location']."#edit");
}

?>