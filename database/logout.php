<?php
session_start();
$ref = $_SESSION['prev-location'];
session_destroy();
session_unset();
header("location:/exploremalang/index.php");
?>