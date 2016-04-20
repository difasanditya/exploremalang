<?php
    require 'template/template-upper.php';
    require 'database/connect.php';
    $tbl_name="tb_place";
?>
<link rel="stylesheet" type="text/css" href="css/explore.css">
<div id="explore-container">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td id="table-left">
                <div id="filter-header">
                    <div class="square"></div>
                    <p>Filter Wisata</p>
                </div>
                <div id="filter-container" class="unselectable">
                    <br>
                    <div class="filter-content">
                        <?php
                            echo '<a href="explore.php">';
                            if ( (isset($_GET['category'])==false) || ($_GET['category']!='nature') || ($_GET['category']!='sport') || ($_GET['category']!='park') || ($_GET['category']!='history') || ($_GET['category']!='recreation') ){
                                echo '<input id="all" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="all" type="radio" name="filter">';
                            }
                            $all="SELECT * FROM $tbl_name";
                            $result=mysql_query($all);
                            $count=mysql_num_rows($result);
                            echo '<p>Semua ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                    <div class="filter-content">
                        <?php
                            echo '<a href="?category=nature">';
                            if ( (isset($_GET['category'])==true) && ($_GET['category']=='nature')  ){
                                echo '<input id="nature" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="nature" type="radio" name="filter">';
                            }
                            $nature="SELECT * FROM $tbl_name WHERE category='nature'";
                            $result=mysql_query($nature);
                            $count=mysql_num_rows($result);
                            echo '<p>Alam ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                    <div class="filter-content">
                        <?php
                            echo '<a href="?category=sport">';
                            if ( (isset($_GET['category'])==true) && ($_GET['category']=='sport')  ){
                                echo '<input id="sport" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="sport" type="radio" name="filter">';
                            }
                            $sport="SELECT * FROM $tbl_name WHERE category='sport'";
                            $result=mysql_query($sport);
                            $count=mysql_num_rows($result);
                            echo '<p>Olahraga ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                    <div class="filter-content">
                        <?php
                            echo '<a href="?category=recreation">';
                            if ( (isset($_GET['category'])==true) && ($_GET['category']=='recreation')  ){
                                echo '<input id="recreation" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="recreation" type="radio" name="filter">';
                            }
                            $recreation="SELECT * FROM $tbl_name WHERE category='recreation'";
                            $result=mysql_query($recreation);
                            $count=mysql_num_rows($result);
                            echo '<p>Rekreasi ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                    <div class="filter-content">
                        <?php
                            echo '<a href="?category=history">';
                            if ( (isset($_GET['category'])==true) && ($_GET['category']=='history')  ){
                                echo '<input id="history" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="history" type="radio" name="filter">';
                            }
                            $history="SELECT * FROM $tbl_name WHERE category='history'";
                            $result=mysql_query($history);
                            $count=mysql_num_rows($result);
                            echo '<p>Sejarah ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                    <div class="filter-content">
                        <?php
                            echo '<a href="?category=park">';
                            if ( (isset($_GET['category'])==true) && ($_GET['category']=='park')  ){
                                echo '<input id="park" type="radio" name="filter" checked>';
                            }
                            else {
                                echo '<input id="park" type="radio" name="filter">';
                            }
                            $park="SELECT * FROM $tbl_name WHERE category='park'";
                            $result=mysql_query($park);
                            $count=mysql_num_rows($result);
                            echo '<p>Taman ('.$count.')</p>';
                            echo '</a>';
                        ?>
                    </div>
                </div>
            </td>
            <td id="table-right">
                <form>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <?php
                                    if (isset($_GET['search'])==true) {
                                        echo '<input type="text" name="search" placeholder="Cari di sini" required value="';
                                        echo $_GET['search'];
                                        echo '">';
                                    }
                                    else {
                                        echo '<input type="text" name="search" placeholder="Cari di sini" required>';
                                    }
                                ?>
                            </td>
                            <td width="%">
                                <button>
                                    <i class="fa fa-search"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if (isset($_GET['search'])==true) {
                        $search=$_GET['search'];
                        $querys="SELECT * FROM $tbl_name WHERE name LIKE '%$search%'";
                        $result=mysql_query($querys);
                        $counting =mysql_num_rows($result);
                        if ($counting>0){
                            echo '<h5>';
                            echo 'Menampilkan hasil pencarian untuk: ';
                            echo $_GET['search'];
                            echo '</h5>';
                        }
                        else {
                            echo '<h5>';
                            echo 'Tidak menemukan hasil untuk pencarian: ';
                            echo $_GET['search'];
                            echo '</h5>';
                        }
                    }
                    else if (isset($_GET['category'])==false) {
                        $querys="SELECT * FROM $tbl_name";
                    }
                    else if ( ($_GET['category']=='nature') || ($_GET['category']=='sport') || ($_GET['category']=='park') || ($_GET['category']=='history') || ($_GET['category']=='recreation') ){
                        $category = $_GET['category'];
                        $querys="SELECT * FROM $tbl_name WHERE category='$category'";
                        echo '<h5>';
                        echo 'Menampilkan hasil untuk kategori: ';
                        switch ($category) {
                        case "nature":
                            echo 'Alam';
                            break;
                        case "sport":
                            echo 'Olahraga';
                            break;
                        case "park":
                            echo 'Taman';
                            break;
                        case "history":
                            echo 'Sejarah';
                            break;
                        case "recreation":
                            echo 'Rekreasi';
                            break;
                        }
                        echo '</h5>';
                    }
                    else {
                        $querys="SELECT * FROM $tbl_name";
                    }
                    $result=mysql_query($querys);
                    $count = 1;
                    $counting =mysql_num_rows($result);
                    while ($row = mysql_fetch_array($result)){
                        if (isset($_GET['page'])==true) {
                            $limit = $_GET['page'] * 5;
                            $limit = $limit-5;
                            if ($count <= $limit){
                                $count++;
                                continue;
                            }
                        }
                        echo '<div class="place-content">';
                        echo '<table cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td class="picture-column" rowspan="6">';
                        echo '<img src="';
                        echo $row["picture"];
                        echo '">';
                        echo '</td>';
                        echo '<td class="name-column">';
                        echo '<h6>';
                        echo $row["name"];
                        echo '</h6>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="rating-column">';
                        $tbl_name2 = "tb_review";
                        $ids = $row["idplace"];
                        $rating="SELECT * FROM $tbl_name2 WHERE idplace=$ids";
                        $result2=mysql_query($rating);
                        $count2=mysql_num_rows($result2);
                        if ($count2==0){
                            echo '<p>Belum ada penilaian</p>';
                        }
                        else {
                            $ratingsum=0;
                            while ($row2 = mysql_fetch_array($result2)){
                                $ratingsum = $ratingsum + $row2["rating"];
                            }
                            $average = $ratingsum / $count2;
                            $counter=0;
                            for ($ups = 1; $ups <= $average; $ups++){
                                echo '<p><i class="fa fa-star"></i></p>';
                                $counter=$ups;
                            }
                            if ($counter!=$average){
                                echo '<p><i class="fa fa-star-half"></i></p>';
                            }
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="distance-column">';
                        echo '<p> ';
                        echo $row["distance"];
                        echo ' km dari pusat kota</p>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="price1-column">';
                        if ($row["pricekid"]==0){
                            echo '<p>Tiket anak-anak: Gratis';
                        }
                        else {
                            echo '<p>Tiket anak-anak: Rp ';
                            echo $row["pricekid"];
                            echo '</p>';   
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="price2-column">';
                        if ($row["priceadult"]==0){
                            echo '<p>Tiket dewasa: Gratis';
                        }
                        else {
                            echo '<p>Tiket dewasa: Rp ';
                            echo $row["priceadult"];
                            echo '</p>';   
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="button-column unselectable">';
                        echo '<a href="places.php?id=';
                        echo $row["idplace"];
                        echo '">';
                        echo '<p id="detail">Detail</p>';
                        echo '</a>';
                        if (($row["priceadult"]==0)&&($row["pricekid"]==0)){
                            echo '<label for="no-need-pay-check">';
                            echo '<a>';
                            echo '<p>';
                            echo 'Pesan';
                            echo '</p>';
                            echo '</a>';
                            echo '</label>';
                        }
                        else {
                            echo '<a href="reservation.php?id=';
                            echo $row["idplace"];
                            echo '">';
                            echo '<p>Pesan</p>';
                            echo '</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div>';
                        if (isset($_GET['page'])==true) {
                            $max = $limit + 5;
                            if ($count == $max){
                                break;
                            }
                            else{
                                $count++;
                            }
                        }
                        else {
                            if ($count==5){
                                break;
                            }
                            else{
                                $count++;
                            }
                        }
                    }
                    if ($counting>5){
                        echo '<table class="unselectable" id="paging" cellpadding="0">';
                        echo '<tr>';
                        if (isset($_GET['page'])==true){
                            if ($_GET['page']!=1) {
                                echo '<td width="20px">';
                                if (isset($_GET['category'])==true) {
                                    echo '<a href="?category=';
                                    echo $_GET['category'];
                                    echo '&page=';
                                    echo $_GET['page']-1;
                                    echo '">';
                                }
                                else if (isset($_GET['search'])==true) {
                                    echo '<a href="?search=';
                                    echo $_GET['search'];
                                    echo '&page=';
                                    echo $_GET['page']-1;
                                    echo '">';
                                }
                                else {
                                    echo '<a href="?page=';
                                    echo $_GET['page']-1;
                                    echo '">';
                                }
                                echo '<i class="fa fa-angle-left"></i>';
                                echo '</a>';
                                echo '</td>';
                            }
                        }
                        $divfive = $counting/5;
                        for ($x = 1; $x < $divfive; $x++){
                            echo '<td width="20px" class="number-container">';
                            if (isset($_GET['page'])==true){
                                if ($_GET['page']==$x) {
                                    echo '<a class="page-number page-now">';
                                }
                                else {
                                    if (isset($_GET['category'])==true) {
                                        echo '<a href="?category=';
                                        echo $_GET['category'];
                                        echo '&page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }
                                    else if (isset($_GET['search'])==true) {
                                        echo '<a href="?search=';
                                        echo $_GET['search'];
                                        echo '&page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }
                                    else {
                                        echo '<a href="?page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }   
                                }
                            }
                            else {
                                if ($x==1){
                                    echo '<a class="page-number page-now">';
                                }
                                else {
                                    if (isset($_GET['category'])==true) {
                                        echo '<a href="?category=';
                                        echo $_GET['category'];
                                        echo '&page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }
                                    else if (isset($_GET['search'])==true) {
                                        echo '<a href="?search=';
                                        echo $_GET['search'];
                                        echo '&page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }
                                    else {
                                        echo '<a href="?page=';
                                        echo $x;
                                        echo '" class="page-number">';
                                    }
                                }
                            }
                            echo '<p>';
                            echo $x;
                            echo '</p>';
                            echo '</a>';
                            echo '</td>';
                            $counter=$x;
                        }
                        if ($counter!=$divfive){
                            echo '<td width="20px" class="number-container">';
                            if (isset($_GET['page'])==true){
                                if ($_GET['page']==$counter+1) {
                                    echo '<a class="page-number page-now">';
                                }
                                else {
                                    if (isset($_GET['category'])==true) {
                                        echo '<a href="?category=';
                                        echo $_GET['category'];
                                        echo '&page=';
                                        echo $counter+1;
                                        echo '" class="page-number">';
                                    }
                                    else if (isset($_GET['search'])==true) {
                                        echo '<a href="?search=';
                                        echo $_GET['search'];
                                        echo '&page=';
                                        echo $counter+1;
                                        echo '" class="page-number">';
                                    }
                                    else {
                                        echo '<a href="?page=';
                                        echo $counter+1;
                                        echo '" class="page-number">';
                                    }   
                                }
                            }
                            else {
                                if (isset($_GET['category'])==true) {
                                    echo '<a href="?category=';
                                    echo $_GET['category'];
                                    echo '&page=';
                                    echo $counter+1;
                                    echo '" class="page-number">';
                                }
                                else if (isset($_GET['search'])==true) {
                                    echo '<a href="?search=';
                                    echo $_GET['search'];
                                    echo '&page=';
                                    echo $counter+1;
                                    echo '" class="page-number">';
                                }
                                else {
                                    echo '<a href="?page=';
                                    echo $counter+1;
                                    echo '" class="page-number">';
                                }   
                            }
                            echo '<p>';
                            echo $counter+1;
                            echo '</p>';
                            echo '</a>';
                            echo '</td>';
                        }
                        if (isset($_GET['page'])==true){
                            $limiting = $counting/5;
                            if (!($_GET['page']>=$limiting)) {
                                echo '<td width="20px">';
                                if (isset($_GET['category'])==true) {
                                    echo '<a href="?category=';
                                    echo $_GET['category'];
                                    echo '&page=';
                                    echo $_GET['page']+1;
                                    echo '">';
                                }
                                else if (isset($_GET['search'])==true) {
                                    echo '<a href="?search=';
                                    echo $_GET['search'];
                                    echo '&page=';
                                    echo $_GET['page']+1;
                                    echo '">';
                                }
                                else {
                                    echo '<a href="?page=';
                                    echo $_GET['page']+1;
                                    echo '">';
                                }
                                echo '<i class="fa fa-angle-right"></i>';
                                echo '</a>';
                            }
                        }
                        else {
                            if (isset($_GET['page'])!=true) {
                                echo '<td width="20px">';
                                if (isset($_GET['category'])==true) {
                                    echo '<a href="?category=';
                                    echo $_GET['category'];
                                    echo '&page=2">';
                                }
                                else if (isset($_GET['search'])==true) {
                                    echo '<a href="?search=';
                                    echo $_GET['search'];
                                    echo '&page=2">';
                                }
                                else {
                                    echo '<a href="?page=2">';
                                }
                                echo '<i class="fa fa-angle-right"></i>';
                                echo '</a>';
                                echo '</td>';
                            }
                        }
                        echo '</tr>';
                        echo '</table>';
                    }
                ?>
            </td>
        </tr>
    </table>
</div>
<?php
    require 'template/template-footer.php';
?>