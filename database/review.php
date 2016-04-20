<?php

session_start();
require 'connect.php';
$tbl_name = "tb_review";

if (isset($_GET['edit'])==true){
    $_SESSION["review-edit"] = true;
    header("location:/exploremalang/places.php?id=".$_GET['id']."#review-tab");
}

else if (isset($_GET['remove'])==true){
    $idre = $_GET['id'];
    $insertinto = "DELETE FROM $tbl_name WHERE idreview='$idre'";
    $resultinsert=mysql_query($insertinto);
    if ($resultinsert === TRUE) {
        $_SESSION["review-delete-success"] = true;
        header("location:".$_SESSION['prev-location']);
    }
    else {
        $_SESSION["review-error"] = true;
        header("location:".$ref);
    }
}

else {
    $ref = $_POST['ref'];
    $action = $_POST['todo'];
    $username = $_SESSION['user'];
    if ($action=='new'){
        $idplace = $_POST['idplace'];
        if (isset($_POST['rate'])==true){
            $rate = $_POST['rate'];
        }
        else {
            $rate = $_POST['rate2'];
        }
        $review = $_POST['review'];
        $rate = stripslashes($rate);
        $review = stripslashes($review);
        $insertinto = "INSERT INTO $tbl_name (username, idplace, review, rating) VALUES ('$username','$idplace','$review','$rate')";
        $resultinsert=mysql_query($insertinto);
        if ($resultinsert === TRUE) {
            $_SESSION["review-new-success"] = true;
            header("location:".$ref);
        }
        else {
            $_SESSION["review-error"] = true;
            header("location:".$ref);
        }
    }
    else if ($action=='edit'){
        $idreview = $_POST['idreview'];
        if (isset($_POST['rate'])==true){
            $rate = $_POST['rate'];
        }
        else {
            $rate = $_POST['rate2'];
        }
        $review = $_POST['review'];
        $rate = stripslashes($rate);
        $review = stripslashes($review);
        $insertinto = "UPDATE $tbl_name SET review='$review', rating='$rate' WHERE idreview='$idreview'";
        $resultinsert=mysql_query($insertinto);
        if ($resultinsert === TRUE) {
            $_SESSION["review-edit-success"] = true;
            header("location:".$ref);
        }
        else {
            $_SESSION["review-error"] = true;
            $_SESSION["review-edit"] = true;
            header("location:/exploremalang/places.php?id=".$_GET['id']."#review-tab");
        }
    }
}

?>