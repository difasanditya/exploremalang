<?php
    require 'template/template-upper.php';
    require 'database/connect.php';
?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="css/reservation.css">
<script>
    $(function() {
        $("#for").datepicker({minDate: 3});
    });
</script>
<script>
    function countPrice() {
        var price1 = document.forms["buy"]["price1"].value;
        var price2 = document.forms["buy"]["price2"].value;
        var adult = document.forms["buy"]["adult"].value;
        var kid = document.forms["buy"]["kid"].value;
        price1 = parseInt(price1);
        price2 = parseInt(price2);
        adult = parseInt(adult);
        kid = parseInt(kid);
        var total = (price1 * adult) + (price2 * kid)
        document.forms["buy"]["price"].value= total;
    }
    function countPrice2() {
        var price1 = document.forms["buy2"]["price1"].value;
        var price2 = document.forms["buy2"]["price2"].value;
        var adult = document.forms["buy2"]["adult"].value;
        var kid = document.forms["buy2"]["kid"].value;
        price1 = parseInt(price1);
        price2 = parseInt(price2);
        adult = parseInt(adult);
        kid = parseInt(kid);
        var total = (price1 * adult) + (price2 * kid)
        document.forms["buy2"]["price"].value= total;
    }
</script>
<div id="reservation-container">
    <h3>Pemesanan Tiket</h3>
    <?php
        if (isset($_GET['id'])==true){
            $tbl_name="tb_place";
            $idplace=$_GET['id'];
            $query="SELECT * FROM $tbl_name WHERE idplace='$idplace'";
            $result=mysql_query($query);
            $data=mysql_fetch_array($result);
            if ($data['priceadult']!=0){
                echo '<form method="post" action="database/purchase.php" name="buy">';
                echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
                echo '<table>';
                echo '<tr>';
                echo '<td>Tiket wisata</td>';
                echo '<td>:</td>';
                echo '<td>';
                echo '<input type="text" disabled name="place" value="';
                echo $data['name'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Untuk tanggal</td>';
                echo '<td>:</td>';
                echo '<td><input type="text" readonly name="date" id="for" value="';
                $plusthree = strtotime("+ 3 day");
                echo date("d-m-Y",$plusthree);
                echo '" required></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Harga Tiket Dewasa</td>';
                echo '<td>:</td>';
                echo '<td>';
                echo '<input type="text" disabled name="price1" value="';
                echo $data['priceadult'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Harga Tiket Anak-Anak</td>';
                echo '<td>:</td>';
                echo '<td>';
                echo '<input type="text" disabled name="price2" value="';
                echo $data['pricekid'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Sejumlah</td>';
                echo '<td>:</td>';
                echo '<td>';
                echo '<select name="adult" onchange="countPrice()">';
                echo '<option value="1">1</option>';
                echo '<option value="2">2</option>';
                echo '<option value="3">3</option>';
                echo '<option value="4">4</option>';
                echo '</select>';
                echo ' Dewasa ';
                echo '<select name="kid" onchange="countPrice()">';
                echo '<option value="0">0</option>';
                echo '<option value="1">1</option>';
                echo '<option value="2">2</option>';
                echo '<option value="3">3</option>';
                echo '<option value="4">4</option>';
                echo '</select>';
                echo ' Anak-Anak';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Total Harga</td>';
                echo '<td>:</td>';
                echo '<td>';
                echo '<input type="text" readonly name="price" value="';
                echo $data['priceadult'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="3">';
                echo '<input type="submit" value="Beli Tiket">';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</form>';
                
                
                echo '<form method="post" action="confirmation.php" name="buy2">';
                echo '<table>';
                echo '<tr>';
                echo '<td>Tiket wisata:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '<input type="text" disabled name="place" value="';
                echo $data['name'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Untuk tanggal:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><input type="text" readonly name="date" id="for" value="';
                $plusthree = strtotime("+ 3 day");
                echo date("d-m-Y",$plusthree);
                echo '" required></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Harga Tiket Dewasa:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '<input type="text" disabled name="price1" value="';
                echo $data['priceadult'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Harga Tiket Anak-Anak:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '<input type="text" disabled name="price2" value="';
                echo $data['pricekid'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Sejumlah:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '<select name="adult" onchange="countPrice()">';
                echo '<option value="1">1</option>';
                echo '<option value="2">2</option>';
                echo '<option value="3">3</option>';
                echo '<option value="4">4</option>';
                echo '</select>';
                echo ' Dewasa ';
                echo '<select name="kid" onchange="countPrice()">';
                echo '<option value="0">0</option>';
                echo '<option value="1">1</option>';
                echo '<option value="2">2</option>';
                echo '<option value="3">3</option>';
                echo '<option value="4">4</option>';
                echo '</select>';
                echo ' Anak-Anak';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Total Harga:</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo '<input type="text" disabled name="price" value="';
                echo $data['priceadult'];
                echo '">';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="text-align: center;">';
                echo '<input type="submit" value="Beli Tiket">';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</form>';
            }
            else {
                echo '<h3>Wisata ini tidak memerlukan pemesanan tiket</h3>';
            }
        }
        else {
            echo '<h3>Anda masuk dari link yang salah</h3>';
        }
    ?>
</div>

<?php
    require 'template/template-footer.php';
?>