<?php
    session_start();
    if (isset($_SESSION['prev-location'])==true){
        $prev=$_SESSION['prev-location'];
    }
    else {
        $prev="/exploremalang/index.php";
    }
    function url(){
        return sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME'],$_SERVER['REQUEST_URI']);
    }
    $_SESSION['prev-location'] = url();
?>
<html>
    <head>
        <title>EXPLORE MALANG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="shortcut icon" href="css/img/logo.ico">
        <script language="JavaScript" src="js/md5.js"></script>
        <script>
            function validateFormSignup() {
                var email = document.forms["signup"]["email"].value;
                var passwordlength = document.forms["signup"]["password"].value.length;
                var password1 = document.forms["signup"]["password"].value;
                var password2 = document.forms["signup"]["password2"].value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    document.getElementById('input-error-signup').innerHTML = "Email Tidak Valid";
                    return false;
                }
                if (passwordlength < 8) {
                    document.getElementById('input-error-signup').innerHTML = "Password Tidak Boleh Kurang Dari 8";
                    return false;
                }
                if (password1 != password2) {
                    document.getElementById('input-error-signup').innerHTML = "Kedua Password Tidak Sama";
                    return false;
                }
            }
        </script>
        <script>
            function validateFormForgot() {
                var email = document.forms["forgot"]["email"].value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    document.getElementById('input-error-forgot').innerHTML = "Email Tidak Valid";
                    return false;
                }
            }
        </script>
        <script>
            function validateFormSubscribe() {
                var email = document.forms["subscribe"]["email"].value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    document.getElementById('input-error-subscribe').innerHTML = "Email Tidak Valid";
                    return false;
                }
            }
        </script>
        <script>
            function validateFormUnsubscribe() {
                var email = document.forms["unsubscribe"]["email"].value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    document.getElementById('input-error-unsubscribe').innerHTML = "Email Tidak Valid";
                    return false;
                }
            }
        </script>
        <script>
            function validateFormReset() {
                var passwordlength = document.forms["reset"]["password"].value.length;
                var password1 = document.forms["reset"]["password"].value;
                var password2 = document.forms["reset"]["password2"].value;
                if (passwordlength < 8) {
                    document.getElementById('input-error-reset').innerHTML = "Password Tidak Boleh Kurang Dari 8";
                    return false;
                }
                if (password1 != password2) {
                    document.getElementById('input-error-reset').innerHTML = "Kedua Password Tidak Sama";
                    return false;
                }
            }
        </script>
        <script>
            function validateFormVerification() {
                var email = document.forms["verification"]["email"].value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    document.getElementById('input-error-verification').innerHTML = "Email Tidak Valid";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php
        $error = 0;
            if (isset($_SESSION['loggedin'])!=true) {
                if (isset($_SESSION['login-error'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="login-check" name="popup-radio" checked>';
                }
                else {
                    echo '<input type="radio" id="login-check" name="popup-radio">';
                }
                if (isset($_SESSION['signup-error'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="signup-check" name="popup-radio" checked>';
                }
                else {
                    echo '<input type="radio" id="signup-check" name="popup-radio">';
                }
                if (isset($_SESSION['forgot-error'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="forgot-check" name="popup-radio" checked>';
                }
                else {
                    echo '<input type="radio" id="forgot-check" name="popup-radio">';
                }
                if (isset($_SESSION['forgot-success'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="forgot-success-check" name="popup-radio" checked>';
                }
                if ((isset($_GET['reset'])==true)||(isset($_SESSION['reset-error'])==true)) {
                    $error = 1;
                    echo '<input type="radio" id="reset-check" name="popup-radio" checked>';
                }
                if (isset($_SESSION['reset-success'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="reset-success-check" name="popup-radio" checked>';
                }
            }
            else {
                if (isset($_SESSION['verification-success'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="verification-success-check" name="popup-radio" checked>';
                }
                if (isset($_SESSION['success-change-picture'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="picture-edit-success-check" name="popup-radio" checked>';
                    unset($_SESSION['success-change-picture']);
                }
                if (isset($_SESSION['success-change-profile'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="profile-edit-success-check" name="popup-radio" checked>';
                    unset($_SESSION['success-change-profile']);
                }
                if (isset($_SESSION["purchase-success"])==true) {
                    $error = 1;
                    echo '<input type="radio" id="purchase-success-check" name="popup-radio" checked>';
                    unset($_SESSION['purchase-success']);
                }
                if (isset($_SESSION["purchase-error"])==true) {
                    $error = 1;
                    echo '<input type="radio" id="purchase-error-check" name="popup-radio" checked>';
                    unset($_SESSION['purchase-error']);
                }
                if (isset($_SESSION['send-verification-error'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="send-verification-error-check" name="popup-radio" checked>';
                    unset($_SESSION['send-verification-error']);
                }
                if (isset($_SESSION['send-verification-success'])==true) {
                    $error = 1;
                    echo '<input type="radio" id="send-verification-success-check" name="popup-radio" checked>';
                    unset($_SESSION['send-verification-success']);
                }
            }
            if (isset($_SESSION['subscribe-success'])==true) {
                $error = 1;
                echo '<input type="radio" id="subscribe-success-check" name="popup-radio" checked>';
                unset($_SESSION['subscribe-success']);
            }
            if (isset($_SESSION['unsubscribe-error'])==true) {
                $error = 1;
                echo '<input type="radio" id="unsubscribe-check" name="popup-radio" checked>';
            }
            else {
                echo '<input type="radio" id="unsubscribe-check" name="popup-radio">';
            }
            if (isset($_SESSION['unsubscribe-success'])==true) {
                $error = 1;
                echo '<input type="radio" id="unsubscribe-success-check" name="popup-radio" checked>';
            }
            if (isset($_GET['verification'])==true) {
                $error = 1;
                echo '<input type="radio" id="verification-check" name="popup-radio" checked>';
            }
            if (isset($_SESSION['review-new-success'])==true) {
                $error = 1;
                echo '<input type="radio" id="review-new-success-check" name="popup-radio" checked>';
            }
            if (isset($_SESSION['review-edit-success'])==true) {
                $error = 1;
                echo '<input type="radio" id="review-edit-success-check" name="popup-radio" checked>';
            }
            if (isset($_SESSION['review-delete-success'])==true) {
                $error = 1;
                echo '<input type="radio" id="review-delete-success-check" name="popup-radio" checked>';
            }
            if ($error==1){
                echo '<input type="radio" id="none" name="popup-radio">';
            }
            else{
                echo '<input type="radio" id="none" name="popup-radio" checked>';
            }
        ?>
        <input type="radio" id="no-need-pay-check" name="popup-radio">
        <header style="height: 394px">
            <input type="checkbox" id="search">
            <input type="checkbox" id="verifications">
            <input type="checkbox" id="more-check">
            <div id="menu" class="unselectable">
                <div id="logo">
                    <a href="index.php">
                        <img src="css/img/logo.png">
                    </a>
                </div>
                <div id="link">
                    <ul>
                        <li>
                            <form method="get" action="explore.php">
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="%">
                                            <input type="text" name="search" placeholder="Cari di sini" required>
                                        </td>
                                        <td width="80px">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </li>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="explore.php">Jelajah</a></li>
                        <?php
                        
                            if (isset($_SESSION['loggedin'])==true) {
                                echo '<li><a href="profile.php">Profil</a></li>';
                                echo "<li><a href='database/logout.php'>Keluar</a></li>";
                            }
                            else {
                                echo '<li><a><label for="signup-check">Daftar</label></a></li>';
                                echo "<li><a><label for='login-check' onclick>Masuk</label></a></li>";
                            }
                        ?>
                        <li id="search-label">
                            <a>
                                <label for="search" onclick>Pencarian</label>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="menu-2" class="unselectable">
                <div id="logo">
                    <a href="index.php">
                        <img src="css/img/logo.png">
                    </a>
                </div>
                <div id="link">
                    <label id="more" for="more-check"><i class="fa fa-bars"></i></label>
                </div>
            </div>
            <?php
                if (isset($_SESSION['loggedin'])==true) {
                    if ($_SESSION["verification"]!=1){
                        echo '<div id="verification-bar">';
                        echo '<table id="verification-container" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td width="%">';
                        echo '<p>Anda belum memverifikasi email Anda, <a href="database/send-verification.php">klik di sini</a> untuk mengirim kode verifikasi ke email Anda.</p>';
                        echo '</td>';
                        echo '<td id="verification-close" width="24px">';
                        echo '<label for="verifications">';
                        echo 'X';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div>';
                    }
                }
            ?>
            <div id="search-bar">
                <form method="get" action="explore.php">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="%">
                                <input type="text" name="search" placeholder="Cari di sini" required>
                            </td>
                            <td width="80px">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="header">
                <div id="bg-head">
                    <figure>
                        <div id="image1"></div>
                        <div id="image2"></div>
                        <div id="image3"></div>
                        <div id="image4"></div>
                        <div id="image5"></div>
                    </figure>
                </div>
                <h1>EXPLORE MALANG</h1>
                <h2><sup><i class="fa fa-quote-left"></i></sup>Ayo mulai menjelajah!<sup><i class="fa fa-quote-right"></i></sup></h2>
            </div>
        </header>