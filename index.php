<?php
    require 'template/template-upper.php';
?>
<link rel="stylesheet" type="text/css" href="css/home.css">
<div id="home-content">
    <h3>Cari Destinasi Wisatamu!</h3>
    <form method="get" action="explore.php">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td id="td-search" width="%">
                    <input id="search-bars" type="text" name="search" placeholder="Cari di sini" required>
                </td>
                <td id="td-submit">
                    <button id="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <div id="head-content">
        <div class="square"></div>
        <div id="head-content-text">
            <p>Wisata Favorit</p>
        </div>
    </div>
    <div id="container-item">
        <div class="item">
            <div class="item-container">
                <div class="item-img" id="item-img1"></div>
                <div class="item-header">
                    <h4>Gunung Semeru</h4>
                </div>
                <div class="item-button">
                    <a href="places.php?id=25">
                        <button>Lebih Detail</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-container">
                <div class="item-img" id="item-img2"></div>
                <div class="item-header">
                    <h4>Air Terjun Coban Talun</h4>
                </div>
                <div class="item-button">
                    <a href="places.php?id=5">
                        <button>Lebih Detail</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-container">
                <div class="item-img" id="item-img3"></div>
                <div class="item-header">
                    <h4>Omah Kayu</h4>
                </div>
                <div class="item-button">
                    <a href="places.php?id=45">
                        <button>Lebih Detail</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="item-container">
                <div class="item-img" id="item-img4"></div>
                <div class="item-header">
                    <h4>Gunung Bromo</h4>
                </div>
                <div class="item-button">
                    <a href="places.php?id=22">
                        <button>Lebih Detail</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <a href="explore.php">
        <button>Lihat Semua Destinasi Wisata</button>
    </a>
</div>
<?php
    require 'template/template-footer.php';
?>