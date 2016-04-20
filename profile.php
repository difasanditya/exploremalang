<?php
    require 'template/template-upper.php';
    require 'database/connect.php';
    if (isset($_SESSION['prev-location'])==true){
        $prev=$_SESSION['prev-location'];
    }
    else {
        $prev="/exploremalang/index.php";
    }
    $_SESSION['prev-location'] = $_SERVER["PHP_SELF"];
    if (isset($_SESSION['loggedin'])!=true) {
        header("location:".$prev);
    }
?>
<link rel="stylesheet" type="text/css" href="css/profile.css">
<div id="profile-container">
    <div id="profile-header">
        <div id="picture-container">
            <?php
                $tbl_name3="tb_profile";
                $usernames=$_SESSION["user"];
                $sql3="SELECT * FROM $tbl_name3 WHERE username='$usernames'";
                $result3=mysql_query($sql3);
                $data3=mysql_fetch_array($result3);
                echo '<img src="'.$data3["picture"].'">';
            ?>
        </div>
        <div id="username-container">
            <h3>
                <?php
                    echo $_SESSION["user"];
                ?>
            </h3>
        </div>
        <div>
            <h4>
                <?php
                    $tbl_name="tb_review";
                    $usernames=$_SESSION["user"];
                    $sql="SELECT * FROM $tbl_name WHERE username='$usernames'";
                    $result=mysql_query($sql);
                    $count=mysql_num_rows($result);
                    echo $count.' Ulasan';
                ?>
            </h4>
        </div>
    </div>
    <?php
        if  ((isset($_SESSION['change-picture-error'])==true) || (isset($_GET['change-picture'])===true) || (isset($_GET['change-profile'])===true)) {
            echo '<input type="radio" name="profil-select" id="settings" checked>';
            echo '<input type="radio" name="profil-select" id="reviews">';
        }
        else {
            echo '<input type="radio" name="profil-select" id="settings">';
            echo '<input type="radio" name="profil-select" id="reviews" checked>';
        }
    ?>
    <input type="radio" name="profil-select" id="datas">
    <input type="radio" name="profil-select" id="purchases">
    <table cellpadding="0" cellspacing="0" id="edit">
        <tr>
            <td id="table-left">
                <div class="profile-menu2">
                    <label class="unselectable" for="reviews">
                        <i class="fa fa-commenting-o"></i>
                    </label>
                </div>
                <div class="profile-menu2">
                    <label class="unselectable" for="datas">
                        <i class="fa fa-user"></i>
                    </label>
                </div>
                <div class="profile-menu2">
                    <label class="unselectable" for="purchases">
                        <i class="fa fa-shopping-bag"></i>
                    </label>
                </div>
                <div class="profile-menu2" style="border-right: none;">
                    <label class="unselectable" for="settings">
                        <i class="fa fa-gear"></i>
                    </label>
                </div>
                <div class="profile-menu">
                    <label class="unselectable" for="reviews">
                        <i class="fa fa-pencil-square-o"></i>
                        <p>Ulasan</p>
                    </label>
                </div>
                <div class="profile-menu">
                    <label class="unselectable" for="datas">
                        <i class="fa fa-user"></i>
                        <p>Data Diri</p>
                    </label>
                </div>
                <div class="profile-menu">
                    <label class="unselectable" for="purchases">
                        <i class="fa fa-shopping-bag"></i>
                        <p>Riwayat Pembelian</p>
                    </label>
                </div>
                <div class="profile-menu">
                    <label class="unselectable" for="settings">
                        <i class="fa fa-gear"></i>
                        <p>Pengaturan</p>
                    </label>
                </div>
            </td>
            <td id="table-right">
                <div id="review-container" class="profile-data">
                    <?php
                        if ($count!=0){
                            while ($row = mysql_fetch_array($result)) {
                                echo '<div class="review-content">';
                                $idplace=$row['idplace'];
                                $tbl_name2="tb_place";
                                $sql2="SELECT * FROM $tbl_name2 WHERE idplace='$idplace'";
                                $result2=mysql_query($sql2);
                                $data2=mysql_fetch_array($result2);
                                echo '<table cellpadding="0" cellspacing="0">';
                                echo '<tr>';
                                echo '<td rowspan="3" class="review-picture">';
                                echo '<img src="'.$data2["picture"].'">';
                                echo '</td>';
                                echo '<td class="review-writer">';
                                echo '<p>';
                                echo $usernames.' pada ';
                                echo '<a>'.$data2["name"].'</a>:';
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td class="review-rating">';
                                echo '<p>';
                                for ($counting = 1; $counting<=$row["rating"]; $counting++){
                                    echo '<i class="fa fa-star"></i>';
                                }
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td rowspan="2">';
                                echo '<p>';
                                echo $row["review"];
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td class="review-tool">';
                                $idplace = $row["idplace"];
                                echo '<a href="database/review.php?edit=true&id=';
                                echo $idplace;
                                echo '">';
                                echo '<p>';
                                echo '<i class="fa fa-pencil"></i>';
                                echo ' Sunting';
                                echo '</p>';
                                echo '</a>';
                                echo '<p>';
                                echo '<a href="database/review.php?remove=true&id=';
                                echo $row['idreview'];
                                echo '">';
                                echo '<i class="fa fa-trash"></i>';
                                echo ' Hapus';
                                echo '</p>';
                                echo '</a>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</table>';
                                echo '</div>';
                            }
                        }
                        else {
                            echo '<h4>'.$usernames.' belum memberi ulasan</h4>';
                        }
                    ?>
                </div>
                <div id="data-container" class="profile-data">
                    <?php
                        $tbl_name3="tb_profile";
                        $usernames=$_SESSION["user"];
                        $sql3="SELECT * FROM $tbl_name3 WHERE username='$usernames'";
                        $result3=mysql_query($sql3);
                        $data3=mysql_fetch_array($result3);
                        echo '<table cellpadding="0" cellspacing="0">';
                        echo '<tr>';
                        echo '<td>';
                        echo 'Nama';
                        echo '</td>';
                        echo '<td>';
                        echo ':';
                        echo '</td>';
                        echo '<td>';
                        echo $data3["name"];
                        echo '</td>';
                        echo '</tr>';
                        if ($data3["sex"]!=''){
                            echo '<tr>';
                            echo '<td>';
                            echo 'Jenis Kelamin';
                            echo '<td>';
                            echo ':';
                            echo '</td>';
                            echo '</td>';
                            echo '<td>';
                            echo $data3["sex"];
                            echo '</td>';
                            echo '</tr>';
                        }
                        if ($data3["location"]!=''){
                            echo '<tr>';
                            echo '<td>';
                            echo 'Lokasi';
                            echo '<td>';
                            echo ':';
                            echo '</td>';
                            echo '</td>';
                            echo '<td>';
                            echo $data3["location"];
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '<tr>';
                        echo '<td>';
                        echo 'Bergabung Sejak';
                        echo '<td>';
                        echo ':';
                        echo '</td>';
                        echo '</td>';
                        echo '<td>';
                        $date=date_create($data3["joined"]);
                        echo date_format($date,"j F Y");
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                    ?>
                </div>
                <div id="purchase-container" class="profile-data">
                    <?php
                        $tbl_name4="tb_purchase";
                        $usernames=$_SESSION["user"];
                        $sql4="SELECT * FROM $tbl_name4 WHERE username='$usernames'";
                        $result4=mysql_query($sql4);
                        $count2=mysql_num_rows($result4);
                        if ($count2!=0) {
                            while ($data4=mysql_fetch_array($result4)) {
                                $tbl_name5="tb_place";
                                $usernames=$_SESSION["user"];
                                $idplaces=$data4["idplace"];
                                $sql5="SELECT * FROM $tbl_name5 WHERE idplace='$idplaces'";
                                $result5=mysql_query($sql5);
                                $data5=mysql_fetch_array($result5);
                                echo '<div class="purchase-content">';
                                echo '<table cellpadding="0" cellspacing="0">';
                                echo '<tr>';
                                echo '<td rowspan="5" class="purchase-picture">';
                                echo '<img src="'.$data5["picture"].'">';
                                echo '</td>';
                                echo '<td class="purchase-place">';
                                echo '<p>';
                                echo $data5["name"];
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td class="purchase-date">';
                                echo '<p>Dibeli pada: ';
                                $date=date_create($data4["purchased"]);
                                echo date_format($date,"j F Y");
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td class="purchase-for">';
                                echo '<p>Untuk: ';
                                $date=date_create($data4["for"]);
                                echo date_format($date,"j F Y");
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td class="purchase-price">';
                                echo '<p>Total: Rp ';
                                echo $data4["price"];
                                echo ' (';
                                echo ($data4["adult"]+$data4["kid"]);
                                echo ' tiket)';
                                echo '</p>';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td height="16px">';
                                echo '</td>';
                                echo '</tr>';
                                echo '</table>';
                                echo '</div>';
                            }
                        }
                        else {
                            echo '<h4>'.$usernames.' belum pernah melakukan pembelian</h4>';
                        }
                    ?>
                </div>
                <div id="setting-container" class="profile-data">
                    <h6>Pengaturan</h6>
                    <?php
                        $tbl_name5="tb_user";
                        $sql5="SELECT * FROM $tbl_name5 WHERE username='$usernames'";
                        $result5=mysql_query($sql5);
                        $data5=mysql_fetch_array($result5);
                        if ($data5['verification']==1){
                            if (isset($_GET['change-picture'])===true){
                                echo '<form method="post"  enctype="multipart/form-data" action="database/change-picture.php">';
                                echo '<input required type="file" name="picture" accept=".jpg,.png,.gif,.jpeg">';
                                if (isset($_SESSION['change-picture-error'])===true){
                                    echo '<p>';
                                    echo 'File yang didukung hanyalah .jpg, .jpeg, .png, dan .gif';
                                    echo '</p>';
                                    unset ($_SESSION['change-picture-error']);
                                }
                                echo '<br>';
                                echo '<input type="submit" value="Ganti Foto">';
                                echo '</form>';
                                echo '<a href="/exploremalang/profile.php#edit">';
                                echo 'Batal/Kembali';
                                echo '</a>';
                            }
                            else if (isset($_GET['change-profile'])===true) {
                                echo '<form method="post" action="database/change-profile.php">';
                                echo '<table id="form-edit" cellpadding="0" cellspacing="0">';
                                echo '<tr>';
                                echo '<td>';
                                echo 'Nama';
                                echo '</td>';
                                echo '<td>';
                                echo ':';
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="text" name="name" value="';
                                echo $data3["name"];
                                echo '" required maxlength="128">';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td>';
                                echo 'Jenis Kelamin';
                                echo '<td>';
                                echo ':';
                                echo '</td>';
                                echo '</td>';
                                echo '<td>';
                                if ($data3["sex"]=="L"){
                                    echo '<input type="radio" value="L" name="sex" required checked id="L">';
                                    echo '<label for="L">';
                                    echo 'L';
                                    echo '</label>';
                                    echo '<input type="radio" value="P" name="sex" required id="P">';
                                    echo '<label for="P">';
                                    echo 'P';
                                    echo '</label>';
                                }
                                else if ($data3["sex"]=="P"){
                                    echo '<input type="radio" value="L" name="sex" required id="L">';
                                    echo '<label for="L">';
                                    echo 'L';
                                    echo '</label>';
                                    echo '<input type="radio" value="P" name="sex" required checked id="P">';
                                    echo '<label for="P">';
                                    echo 'P';
                                    echo '</label>';
                                }
                                else {
                                    echo '<input type="radio" value="L" name="sex" required id="L">';
                                    echo '<label for="L">';
                                    echo 'L';
                                    echo '</label>';
                                    echo '<input type="radio" value="P" name="sex" required id="P">';
                                    echo '<label for="P">';
                                    echo 'P';
                                    echo '</label>';
                                }
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td>';
                                echo 'Lokasi';
                                echo '<td>';
                                echo ':';
                                echo '</td>';
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="text" name="location" value="';
                                echo $data3["location"];
                                echo '" required maxlength="255">';
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td colspan="3">';
                                echo '<input type="submit" value="Simpan">';
                                echo '</td>';
                                echo '</tr>';
                                if (isset($_SESSION['change-profile-error'])===true){
                                    echo '<tr>';
                                    echo '<td colspan="3">';
                                    echo '<p>';
                                    echo 'Terjadi kesalahan, mohon ulangi';
                                    echo '</p>';
                                    echo '</td>';
                                    unset ($_SESSION['change-profile-error']);
                                }
                                echo '<tr>';
                                echo '<td colspan="3" id="back">';
                                echo '<a href="/exploremalang/profile.php#edit">';
                                echo 'Batal/Kembali';
                                echo '</a>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</table>';
                                echo '</form>';
                            }
                            else {
                                echo '<table cellpadding="0" cellspacing="0">';
                                echo '<tr>';
                                echo '<td>';
                                echo '<a href="?change-picture=1#edit">';
                                echo '<i class="fa fa-photo"></i>';
                                echo '<br>';
                                echo 'Ubah foto';
                                echo '</a>';
                                echo '</td>';
                                echo '<td>';
                                echo '<a href="?change-profile=1#edit">';
                                echo '<i class="fa fa-file-text-o"></i>';
                                echo '<br>';
                                echo 'Ubah data';
                                echo '</a>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</table>';
                            }
                        }
                        else {
                            echo '<h6 id="must-verify">Anda harus melakukan verifikasi email terlebih dahulu agar dapat mengakses halaman ini.</h6>';
                        }
                    ?>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php
    require 'template/template-footer.php';
?>