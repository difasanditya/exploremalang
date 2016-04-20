<?php
    if (isset($_GET['id'])==true){
        $idplace = $_GET['id'];
    }
    require 'template/template-upper.php';
    require 'database/connect.php';
    $tbl_name="tb_place";
?>
<link rel="stylesheet" type="text/css" href="css/places.css">
<div id="place-container">
    <?php
        if (isset($_GET['id'])==true){
            echo '<table cellpadding="0" cellspacing="0">';
            echo '<tr>';
            echo '<td id="table-left" width="%">';
            $query="SELECT * FROM $tbl_name WHERE idplace='$idplace'";
            $result=mysql_query($query);
            $count=mysql_num_rows($result);
            if ($count==1){
                $row = mysql_fetch_array($result);
                echo '<table id="detail-container" cellpadding="0" cellspacing="0">';
                echo '<tr>';
                echo '<td id="detail-picture" rowspan="5">';
                echo '<img src="';
                echo $row["picture"];
                echo '">';
                echo '</td>';
                echo '<td id="detail-name">';
                echo '<h6>';
                echo $row["name"];
                echo '</h6>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td id="detail-rating">';
                $tbl_name2 = "tb_review";
                $rating="SELECT * FROM $tbl_name2 WHERE idplace=$idplace";
                $result2=mysql_query($rating);
                $count2=mysql_num_rows($result2);
                if ($count2==0){
                    echo '<p id="first-star" style="padding-left: 17px;">Belum ada penilaian</p>';
                }
                else {
                    $ratingsum=0;
                    while ($row2 = mysql_fetch_array($result2)){
                        $ratingsum = $ratingsum + $row2["rating"];
                    }
                    $average = $ratingsum / $count2;
                    $counter=0;
                    echo '<p>';
                    for ($ups = 1; $ups <= $average; $ups++){
                        if ($ups==1) {
                            echo '<i id="first-star" class="fa fa-star"></i>';
                        }
                        else {
                            echo '<i class="fa fa-star"></i>';
                        }
                        $counter=$ups;
                    }
                    if ($counter!=$average){
                        echo '<i class="fa fa-star-half"></i>';
                    }
                    echo '</p>';
                }
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td id="detail-distance">';
                echo '<p>';
                echo $row["distance"];
                echo ' km dari pusat kota</p>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td id="detail-price1">';
                echo '<p>Tiket Anak-Anak: ';
                if ($row["pricekid"]==0){
                    echo 'Gratis';
                }
                else {
                    echo ' Rp'.$row["pricekid"];
                }
                echo '</p>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td id="detail-price2">';
                echo '<p>Tiket Dewasa: ';
                if ($row["priceadult"]==0){
                    echo 'Gratis';
                }
                else {
                    echo ' Rp'.$row["priceadult"];
                }
                echo '</p>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '<table id="place-desc" cellpadding="0" cellspacing="0">';
                echo '<tr>';
                echo '<td id="desc">';
                echo 'Deskripsi:';
                echo '</td>';
                echo '<td>';
                echo $row["description"];
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td id="detail-reserve" colspan="2">';
                if (($row["priceadult"]==0)&&($row["pricekid"]==0)){
                    echo '<label for="no-need-pay-check">';
                    echo '<p>';
                    echo 'Pesan Sekarang';
                    echo '</p>';
                    echo '</label>';
                }
                else {
                    echo '<a href="reservation.php?id=';
                    echo $row["idplace"];
                    echo '">';
                    echo '<button>Pesan Sekarang</button>';
                    echo '</a>';
                }
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                if (isset($_SESSION['review-edit'])==true) {
                    echo '<input type="radio" name="tabs" id="tab1">';
                    echo '<input type="radio" name="tabs" id="tab2" checked>';
                }
                else {
                    echo '<input type="radio" name="tabs" id="tab1" checked>';
                    echo '<input type="radio" name="tabs" id="tab2">';
                }
                echo '<div id="review-tab">';
                echo '<div id="tab-1" class="tabs unselectable">';
                $tbl_name2 = "tb_review";
                $rating="SELECT * FROM $tbl_name2 WHERE idplace=$idplace";
                $result2=mysql_query($rating);
                $count2=mysql_num_rows($result2);
                echo '<label for="tab1">';
                echo 'Ulasan';
                if ($count2>0){
                    echo ' ('.$count2.')';
                }
                echo '</label>';
                echo '</div>';
                echo '<div id="tab-2" class="tabs unselectable">';
                echo '<label for="tab2">';
                echo 'Beri Ulasan';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '<div id="review-tab2">';
                echo '<div class="tabs unselectable">';
                echo '<label for="tab1">';
                echo '<i class="fa fa-commenting-o"></i>';
                echo '</label>';
                echo '</div>';
                echo '<div class="tabs unselectable">';
                echo '<label for="tab2">';
                echo '<i class="fa fa-pencil-square-o"></i>';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '<div id="review-container">';
                echo '<br>';
                echo '<div id="tabs-1">';
                $tbl_name2 = "tb_review";
                $rating="SELECT * FROM $tbl_name2 WHERE idplace=$idplace";
                $result2=mysql_query($rating);
                $count2=mysql_num_rows($result2);
                if ($count2>=1){
                    while ($row2=mysql_fetch_array($result2)){
                        echo '<table class="table-review" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td class="review-img" rowspan="3">';
                        echo '<img src="';
                        $tbl_name3 = "tb_profile"; 
                        $username3=$row2['username'];
                        $query3 = "SELECT * FROM $tbl_name3 WHERE username='$username3'";
                        $result3 = mysql_query($query3);
                        $row3 = mysql_fetch_array($result3);
                        echo $row3['picture'];
                        echo '">';
                        echo '</td>';
                        echo '<td class="review-username">';
                        echo '<p>';
                        echo $row2['username'];
                        echo '</p>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="review-star">';
                        echo '<p>';
                        for ($counting = 1; $counting<=$row2["rating"]; $counting++){
                            echo '<i class="fa fa-star"></i>';
                        }
                        echo '</p>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="review-content">';
                        echo '<p>';
                        echo $review = nl2br($row2['review']);
                        echo '</p>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '<div class="strips">';
                        echo '</div>';
                    }
                }
                else {
                    echo '<h5>';
                    echo 'Masih belum ada ulasan.';
                    echo '</h5>';
                }
                echo '</div>';
                echo '<div id="tabs-2">';
                if (isset($_SESSION['loggedin'])==true) {
                    $usern=$_SESSION['user'];
                    $tbl_name7='tb_review';
                    $query="SELECT * FROM $tbl_name7 WHERE idplace='$idplace' AND username='$usern'";
                    $result=mysql_query($query);
                    $count=mysql_num_rows($result);
                    if ($count==0){
                        echo '<form method="post" action="database/review.php">';
                        echo '<input type="hidden" name="ref" value="'.$_SESSION['prev-location'].'">';
                        echo '<input type="hidden" name="idplace" value="'.$idplace.'">';
                        echo '<input type="hidden" name="todo" value="new">';
                        echo '<h6>';
                        echo 'Beri Ulasan';
                        echo '</h6>';
                        echo '<table id="form-review" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian';
                        echo '</td>';
                        echo '<td id="form-review-middle">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        echo '<input type="radio" name="rate" value="1" id="one" checked>';
                        echo '<input type="radio" name="rate" value="2" id="two">';
                        echo '<input type="radio" name="rate" value="3" id="three">';
                        echo '<input type="radio" name="rate" value="4" id="four">';
                        echo '<input type="radio" name="rate" value="5" id="five">';
                        echo '<label for="one">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="two">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="three">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="four">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="five">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan';
                        echo '</td>';
                        echo '<td id="form-review-middle" class="padding-6">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        echo '<textarea name="review" required placeholder="Masukkan ulasan di sini" maxlength="255"></textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo '<input type="submit" value="Beri Ulasan">';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</form>';
                        
                        echo '<form method="post" action="database/review.php">';
                        echo '<input type="hidden" name="ref" value="'.$_SESSION['prev-location'].'">';
                        echo '<input type="hidden" name="idplace" value="'.$idplace.'">';
                        echo '<input type="hidden" name="todo" value="new">';
                        echo '<table id="form-review2" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        echo '<input type="radio" name="rate2" value="1" id="ones" checked>';
                        echo '<input type="radio" name="rate2" value="2" id="twos">';
                        echo '<input type="radio" name="rate2" value="3" id="threes">';
                        echo '<input type="radio" name="rate2" value="4" id="fours">';
                        echo '<input type="radio" name="rate2" value="5" id="fives">';
                        echo '<label for="ones">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="twos">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="threes">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="fours">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="fives">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        echo '<textarea name="review" required placeholder="Masukkan ulasan di sini">';
                        echo'</textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td style="text-align: center;">';
                        echo '<input type="submit" value="Beri Ulasan">';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</form>';
                    }
                    else if (isset($_SESSION['review-edit'])==true) {
                        unset($_SESSION['review-edit']);
                        echo '<form method="post" action="database/review.php">';
                        $row = mysql_fetch_array($result);
                        echo '<input type="hidden" name="ref" value="'.$_SESSION['prev-location'].'">';
                        echo '<input type="hidden" name="idreview" value="';
                        echo $row['idreview'];
                        echo '">';
                        echo '<input type="hidden" name="todo" value="edit">';
                        echo '<h6>';
                        echo 'Sunting Ulasan';
                        echo '</h6>';
                        echo '<table id="form-review" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian';
                        echo '</td>';
                        echo '<td id="form-review-middle">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        if ($row['rating']==1){
                            echo '<input type="radio" name="rate" value="1" id="one" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate" value="1" id="one">';
                        }
                        if ($row['rating']==2){
                            echo '<input type="radio" name="rate" value="2" id="two" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate" value="2" id="two">';
                        }
                        if ($row['rating']==3){
                            echo '<input type="radio" name="rate" value="3" id="three" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate" value="3" id="three">';
                        }
                        if ($row['rating']==4){
                            echo '<input type="radio" name="rate" value="4" id="four" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate" value="4" id="four">';
                        }
                        if ($row['rating']==5){
                            echo '<input type="radio" name="rate" value="5" id="five" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate" value="5" id="five">';
                        }
                        echo '<label for="one">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="two">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="three">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="four">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="five">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan';
                        echo '</td>';
                        echo '<td id="form-review-middle" class="padding-6">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        echo '<textarea name="review" required placeholder="Masukkan ulasan di sini">';
                        echo $row['review'];
                        echo'</textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo '<input type="submit" value="Simpan Perubahan">';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</form>';
                        
                        echo '<form method="post" action="database/review.php">';
                        echo '<input type="hidden" name="ref" value="'.$_SESSION['prev-location'].'">';
                        echo '<input type="hidden" name="idreview" value="';
                        echo $row['idreview'];
                        echo '">';
                        echo '<input type="hidden" name="todo" value="edit">';
                        echo '<table id="form-review2" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        if ($row['rating']==1){
                            echo '<input type="radio" name="rate2" value="1" id="ones" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate2" value="1" id="ones">';
                        }
                        if ($row['rating']==2){
                            echo '<input type="radio" name="rate2" value="2" id="twos" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate2" value="2" id="twos">';
                        }
                        if ($row['rating']==3){
                            echo '<input type="radio" name="rate2" value="3" id="threes" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate2" value="3" id="threes">';
                        }
                        if ($row['rating']==4){
                            echo '<input type="radio" name="rate2" value="4" id="fours" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate2" value="4" id="fours">';
                        }
                        if ($row['rating']==5){
                            echo '<input type="radio" name="rate2" value="5" id="fives" checked>';
                        }
                        else {
                            echo '<input type="radio" name="rate2" value="5" id="fives">';
                        }
                        echo '<label for="ones">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="twos">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="threes">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="fours">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="fives">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        echo '<textarea name="review" required placeholder="Masukkan ulasan di sini">';
                        echo $row['review'];
                        echo'</textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td style="text-align: center;">';
                        echo '<input type="submit" value="Simpan Perubahan">';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</form>';
                    }
                    else {
                        $row = mysql_fetch_array($result);
                        echo '<h6>';
                        echo 'Anda sudah memberi ulasan sebelumnya, berikut ulasan Anda:';
                        echo '</h6>';
                        echo '<table id="form-review" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian';
                        echo '</td>';
                        echo '<td id="form-review-middle">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        if ($row['rating']==1){
                            echo '<input disabled type="radio" name="rate" value="1" id="one" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate" value="1" id="one">';
                        }
                        if ($row['rating']==2){
                            echo '<input disabled type="radio" name="rate" value="2" id="two" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate" value="2" id="two">';
                        }
                        if ($row['rating']==3){
                            echo '<input disabled type="radio" name="rate" value="3" id="three" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate" value="3" id="three">';
                        }
                        if ($row['rating']==4){
                            echo '<input disabled type="radio" name="rate" value="4" id="four" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate" value="4" id="four">';
                        }
                        if ($row['rating']==5){
                            echo '<input disabled type="radio" name="rate" value="5" id="five" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate" value="5" id="five">';
                        }
                        echo '<label for="one">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="two">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="three">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="four">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="five">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan';
                        echo '</td>';
                        echo '<td id="form-review-middle" class="padding-6">';
                        echo ':';
                        echo '</td>';
                        echo '<td id="form-review-right">';
                        echo '<textarea disabled name="review" required placeholder="Masukkan ulasan di sini">';
                        echo $row['review'];
                        echo'</textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo '<a href="database/review.php?edit=true&id=';
                        echo $idplace;
                        echo '" style="margin-right: 24px;">';
                        echo '<button>Sunting</button>';
                        echo '</a>';
                        echo '<a href="database/review.php?remove=true&id=';
                        echo $row['idreview'];
                        echo '">';
                        echo '<button>Hapus</button>';
                        echo '</a>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        
                        echo '<table id="form-review2" cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td id="form-review-left">';
                        echo 'Penilaian:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        if ($row['rating']==1){
                            echo '<input disabled type="radio" name="rate2" value="1" id="one" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate2" value="1" id="one">';
                        }
                        if ($row['rating']==2){
                            echo '<input disabled type="radio" name="rate2" value="2" id="two" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate2" value="2" id="two">';
                        }
                        if ($row['rating']==3){
                            echo '<input disabled type="radio" name="rate2" value="3" id="three" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate2" value="3" id="three">';
                        }
                        if ($row['rating']==4){
                            echo '<input disabled type="radio" name="rate2" value="4" id="four" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate2" value="4" id="four">';
                        }
                        if ($row['rating']==5){
                            echo '<input disabled type="radio" name="rate2" value="5" id="five" checked>';
                        }
                        else {
                            echo '<input disabled type="radio" name="rate2" value="5" id="five">';
                        }
                        echo '<label for="one">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="two">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="three">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="four">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '<label for="five">';
                        echo '<i class="fa fa-star"></i>';
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-left" class="padding-6">';
                        echo 'Ulasan:';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td id="form-review-right">';
                        echo '<textarea disabled name="review" required placeholder="Masukkan ulasan di sini">';
                        echo $row['review'];
                        echo'</textarea>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td style="text-align: center;">';
                        echo '<a href="database/review.php?edit=true&id=';
                        echo $idplace;
                        echo '" style="margin-right: 24px;">';
                        echo '<button>Sunting</button>';
                        echo '</a>';
                        echo '<a href="database/review.php?remove=true&id=';
                        echo $row['idreview'];
                        echo '">';
                        echo '<button>Hapus</button>';
                        echo '</a>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                    }
                }
                else {
                    echo '<h5>';
                    echo 'Anda harus masuk terlebih dahulu agar dapat memberikan ulasan. ';
                    echo '<label for="login-check">Klik di sini</label>';
                    echo ' untuk masuk.';
                    echo '</h5>';
                }
                echo '</div>';
                echo '</div>';
            }
            else {
                echo '<h5>';
                echo 'Anda masuk dari link yang salah, ';
                echo '<a href="';
                echo $prev;
                echo '">klik di sini</a>';
                echo ' untuk kembali';
                echo '</h5>';
            }
            echo '</td>';
            echo '<td id="table-right">';
            echo '<div id="place-header">';
            echo '<div class="square"></div>';
            echo '<p>Tempat Lainnya</p>';
            echo '</div>';
            echo '<div id="place-other">';
            echo '<br>';
            for ($x=1;$x<=5;$x++){
                switch ($x) {
                    case 1:
                        $showed='Alam';
                        $name='nature';
                        break;
                    case 2:
                        $showed='Olahraga';
                        $name='sport';
                        break;
                    case 3:
                        $showed='Rekreasi';
                        $name='recreation';
                        break;
                    case 4:
                        $showed='Sejarah';
                        $name='history';
                        break;
                    case 5:
                        $showed='Taman';
                        $name='park';
                        break;
                }
                $query="SELECT * FROM $tbl_name WHERE category='$name'";
                $result=mysql_query($query);
                $count=mysql_num_rows($result);
                echo '<div id="category-';
                echo $x;
                echo '" class="category">';
                echo '<input name="other-link" type="checkbox" id="cat-';
                echo $x;
                echo '-more">';
                echo '<label class="unselectable" for="cat-';
                echo $x;
                echo '-more">';
                echo $showed;
                echo ' ('.$count.')</label>';
                echo '<ul id="cat-';
                echo $x;
                echo '" class="unselectable">';
                while ($row = mysql_fetch_array($result)){
                    echo '<li>';
                    echo '<a href="?id=';
                    echo $row['idplace'];
                    echo '">';
                    echo $row['name'];
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            echo '</div>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
        else {
            echo '<div id="place-header">';
            echo '<div class="square"></div>';
            echo '<p>Daftar Wisata</p>';
            echo '</div>';
            echo '<div id="place-other">';
            echo '<br>';
            for ($x=1;$x<=5;$x++){
                switch ($x) {
                    case 1:
                        $showed='Alam';
                        $name='nature';
                        break;
                    case 2:
                        $showed='Olahraga';
                        $name='sport';
                        break;
                    case 3:
                        $showed='Rekreasi';
                        $name='recreation';
                        break;
                    case 4:
                        $showed='Sejarah';
                        $name='history';
                        break;
                    case 5:
                        $showed='Taman';
                        $name='park';
                        break;
                }
                $query="SELECT * FROM $tbl_name WHERE category='$name'";
                $result=mysql_query($query);
                $count=mysql_num_rows($result);
                echo '<div id="category-';
                echo $x;
                echo '" class="category">';
                echo '<input name="other-link" type="checkbox" id="cat-';
                echo $x;
                echo '-more">';
                echo '<label class="unselectable" for="cat-';
                echo $x;
                echo '-more">';
                echo $showed;
                echo ' ('.$count.')</label>';
                echo '<ul id="cat-';
                echo $x;
                echo '" class="unselectable">';
                while ($row = mysql_fetch_array($result)){
                    echo '<li>';
                    echo '<a href="?id=';
                    echo $row['idplace'];
                    echo '">';
                    echo $row['name'];
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            echo '</div>';
        }
    ?>
</div>
<?php
    require 'template/template-footer.php';
?>