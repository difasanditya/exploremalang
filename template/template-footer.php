        <footer>
            <div id="footer">
                <div id="footer-left">
                    <div class="footer-head">
                        <p>Lebih Dekat Dengan Kami</p>
                    </div>
                    <div class="footer-content">
                        <div class="social" id="facebook">
                            <p><i class="fa fa-facebook"></i></p>
                        </div>
                        <div class="social" id="google-plus">
                            <p><i class="fa fa-google-plus"></i></p>
                        </div>
                        <div class="social" id="foursquare">
                            <p><i class="fa fa-foursquare"></i></p>
                        </div>
                        <div class="social" id="instagram">
                            <p><i class="fa fa-instagram"></i></p>
                        </div>
                        <div class="social" id="pinterest">
                            <p><i class="fa fa-pinterest-p"></i></p>
                        </div>
                        <div class="social" id="tumblr">
                            <p><i class="fa fa-tumblr"></i></p>
                        </div>
                        <div class="social" id="twitter">
                            <p><i class="fa fa-twitter"></i></p>
                        </div>
                        <div class="social" id="youtube">
                            <p><i class="fa fa-youtube"></i></p>
                        </div>
                    </div>
                </div>
                <div id="footer-right">
                    <div class="footer-head">
                        <p>Berlangganan</p>
                    </div>
                    <div class="footer-content">
                        <form name="subscribe" method="post" action="database/subscribe.php" onsubmit="return validateFormSubscribe()">
                            <input type="hidden" name="from" value="<?php echo $_SESSION['prev-location'];?>">
                            <input type="text" placeholder="Masukkan Email Anda" name="email" maxlength="128" required>
                            <button type="submit"><i class="fa fa-envelope-o"></i></button>
                        </form>
                        <div id="input-error">
                            <?php
                                if (isset($_SESSION['subscribe-error'])==true) {
                                    echo "<p id='input-error-subscribe'>";
                                    echo $_SESSION['error-info'];
                                    echo "</p>";
                                    unset($_SESSION['subscribe-error']);
                                    unset($_SESSION['error-info']);
                                }
                                else{
                                    echo "<p id='input-error-subscribe'></p>";
                                }
                            ?>
                        </div>
                        <p id="stop-newsletter">Ingin berhenti berlangganan?
                            <label for="unsubscribe-check">Klik di sini</label>
                        </p>
                    </div>
                </div>
                <div id="footer-bottom">
                    <p>
                        <i class="fa fa-copyright"></i>
                        <?php
                            echo ' '.date("Y").' ';
                        ?>
                        Explore Malang</p>
                </div>
            </div>
        </footer>
        <?php
            if (isset($_SESSION['loggedin'])!=true) {
                //Login Popup
                echo '<div id="login" class="overlay">';
                echo '<div class="popup">';
                echo '<h4>Masuk</h4>';
                echo '<label for="none">X</label>';
                echo '<form name="login" method="post" action="database/login.php">';
                echo '<input type="hidden" name="from" value="'.$_SESSION['prev-location'].'">';
                echo '<input type="hidden" name="password-en" id="pass-en">';
                echo '<div class="login-row">';
                echo '<div class="login-content login-content-left">';
                echo '<p>Username:</p>';
                echo '</div>';
                echo '<div class="login-content login-content-right">';
                if (isset($_SESSION['login-error'])==true) {
                    echo '<input type="text" name="username" placeholder="Username" maxlength="30" required value="'.$_SESSION["login-user"].'">';
                    unset($_SESSION['login-user']);
                }
                else{
                    echo '<input type="text" name="username" placeholder="Username" maxlength="30" required>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="login-row">';
                echo '<div class="login-content login-content-left">';
                echo '<p>Password:</p>';
                echo '</div>';
                echo '<div class="login-content login-content-right">';
                echo '<input type="password" name="password" placeholder="Password" id="pass" onchange="';
                echo "document.getElementById('pass-en').value = calcMD5(document.getElementById('pass').value)";
                echo '" maxlength="128" required>';
                echo '</div>';
                echo '</div>';
                echo '<div id="input-error">';
                if (isset($_SESSION['login-error'])==true) {
                    echo "<p id='input-error-login'>";
                    echo $_SESSION['error-info'];
                    echo "</p>";
                    unset($_SESSION['login-error']);
                    unset($_SESSION['error-info']);
                }
                else{
                    echo "<p id='input-error-login'></p>";
                }
                echo '</div>';
                echo '<input type="submit" value="Masuk">';
                echo '</form>';
                echo '<div id="login-helper">';
                echo '<label for="signup-check">';
                echo '<p id="dont-have">Belum punya akun?</p>';
                echo '</label>';
                echo '<label for="forgot-check">';
                echo '<p id="forgot-pass">Lupa password?</p>';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                //Sign-up Popup
                echo '<div id="signup" class="overlay">';
                echo '<div class="popup">';
                echo '<h4>Daftar</h4>';
                echo '<label for="none">X</label>';
                echo '<form name="signup" method="post" action="database/signup.php" onsubmit="return validateFormSignup()">';
                echo '<input type="hidden" name="from" value="'.$_SESSION["prev-location"].'">';
                echo '<input type="hidden" name="password-en" id="pass-en-signup">';
                echo '<div class="signup-row">';
                echo '<div class="signup-content signup-content-left">';
                echo '<p>Nama:</p>';
                echo '</div>';
                echo '<div class="signup-content signup-content-right">';
                if (isset($_SESSION['signup-error'])==true) {
                    echo '<input type="text" name="name" placeholder="Nama" required value="'.$_SESSION["signup-name"].'">';
                    unset($_SESSION['signup-name']);
                }
                else{
                    echo '<input type="text" name="name" placeholder="Nama" required>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="signup-row">';
                echo '<div class="signup-content signup-content-left">';
                echo '<p>Email:</p>';
                echo '</div>';
                echo '<div class="signup-content signup-content-right">';
                if (isset($_SESSION['signup-error'])==true) {
                    echo '<input type="text" name="email" placeholder="Email" maxlength="128" required value="'.$_SESSION["signup-email"].'">';
                    unset($_SESSION['signup-email']);
                }
                else{
                    echo '<input type="text" name="email" placeholder="Email" maxlength="128" required>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="signup-row">';
                echo '<div class="signup-content signup-content-left">';
                echo '<p>Username:</p>';
                echo '</div>';
                echo '<div class="signup-content signup-content-right">';
                if (isset($_SESSION['signup-error'])==true) {
                    echo '<input type="text" name="username" placeholder="Username" maxlength="30" required value="'.$_SESSION["signup-username"].'">';
                    unset($_SESSION['signup-username']);
                }
                else{
                    echo '<input type="text" name="username" placeholder="Username" maxlength="30" required>';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="signup-row">';
                echo '<div class="signup-content signup-content-left">';
                echo '<p>Password:</p>';
                echo '</div>';
                echo '<div class="signup-content signup-content-right">';
                echo '<input type="password" name="password" placeholder="Password" id="pass-signup" onchange="';
                echo "document.getElementById('pass-en-signup').value = calcMD5(document.getElementById('pass-signup').value)";
                echo '" maxlength="128" required>';
                echo '</div>';
                echo '</div>';
                echo '<div class="signup-row">';
                echo '<div class="signup-content signup-content-left">';
                echo '<p>Password:</p>';
                echo '</div>';
                echo '<div class="signup-content signup-content-right">';
                echo '<input type="password" name="password2" placeholder="Ulangi Password" id="pass2" maxlength="128" required>';
                echo '</div>';
                echo '</div>';
                echo '<div id="input-error">';
                if (isset($_SESSION['signup-error'])==true) {
                    echo "<p id='input-error-signup'>";
                    echo $_SESSION['error-info'];
                    echo "</p>";
                    unset($_SESSION['signup-error']);
                    unset($_SESSION['error-info']);
                }
                else{
                    echo "<p id='input-error-signup'></p>";
                }
                echo '</div>';
                echo '<input type="submit" value="Daftar">';
                echo '</form>';
                echo '<div id="signup-helper">';
                echo '<label for="login-check">';
                echo '<p id="dont-have">Sudah punya akun?</p>';
                echo '</label>';
                echo '<label for="forgot-check">';
                echo '<p id="forgot-pass">Lupa password?</p>';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                //Forgot Popup
                echo '<div id="forgot" class="overlay">';
                echo '<div class="popup">';
                echo '<h4>Lupa Password</h4>';
                echo '<label for="none">X</label>';
                echo '<form name="forgot" method="post" action="database/forgot.php" onsubmit="return validateFormForgot()">';
                echo '<input type="hidden" name="from" value="'.$_SESSION['prev-location'].'">';
                echo '<div class="forgot-row2">';
                echo '<p>Jika Anda lupa dengan password Anda, maka masukkan email Anda pada kolom di bawah ini sehingga kami dapat mereset password Anda dan mengirimkan password baru ke email Anda.</p>';
                echo '</div>';
                echo '<div class="forgot-row">';
                if (isset($_SESSION['forgot-error'])==true) {
                    echo '<input type="text" name="email" placeholder="Email" maxlength="128" required value="'.$_SESSION["forgot-email"].'">';
                    unset($_SESSION['forgot-email']);
                }
                else{
                    echo '<input type="text" name="email" placeholder="Email" maxlength="128" required>';
                }
                echo '</div>';
                echo '<div id="input-error">';
                if (isset($_SESSION['forgot-error'])==true) {
                    echo "<p id='input-error-forgot'>";
                    echo $_SESSION['error-info'];
                    echo "</p>";
                    unset($_SESSION['forgot-error']);
                    unset($_SESSION['error-info']);
                }
                else{
                    echo "<p id='input-error-forgot'></p>";
                }
                echo '</div>';
                echo '<input type="submit" value="Ganti Password">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                //Forgot Success Popup
                if (isset($_SESSION['forgot-success'])==true) {
                    echo '<div id="forgot-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="forgot-success-row">';
                    echo '<p>Password Anda telah berhasil direset, silahkan cek email Anda.</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['forgot-success']);
                }
                //Reset Popup
                if (isset($_GET['reset'])==true){
                    echo '<div id="reset" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Ganti Password</h4>';
                    echo '<label for="none">X</label>';
                    echo '<form name="reset" method="post" action="database/reset.php" onsubmit="return validateFormReset()">';
                    echo '<input type="hidden" name="from" value="'.$_SESSION['prev-location'].'">';
                    echo '<input type="hidden" name="code" value="'.$_GET['reset'].'">';
                    echo '<input type="hidden" name="password-en" id="pass-en-reset">';
                    echo '<div class="reset-row">';
                    echo '<div class="reset-content reset-content-left">';
                    echo '<p>Password:</p>';
                    echo '</div>';
                    echo '<div class="reset-content reset-content-right">';
                    echo '<input type="password" name="password" placeholder="Password Baru" id="pass-reset" onchange="';
                    echo "document.getElementById('pass-en-reset').value = calcMD5(document.getElementById('pass-reset').value)";
                    echo '" maxlength="128" required>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="reset-row">';
                    echo '<div class="reset-content reset-content-left">';
                    echo '<p>Password:</p>';
                    echo '</div>';
                    echo '<div class="reset-content reset-content-right">';
                    echo '<input type="password" name="password2" placeholder="Ulangi Password Baru" id="pass2" maxlength="128" required>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div id="input-error">';
                    if (isset($_SESSION['reset-error'])==true) {
                        echo "<p id='input-error-reset'>";
                        echo $_SESSION['error-info'];
                        echo "</p>";
                        unset($_SESSION['reset-error']);
                        unset($_SESSION['error-info']);
                    }
                    else{
                        echo "<p id='input-error-reset'></p>";
                    }
                    echo '</div>';
                    echo '<input type="submit" value="Ganti">';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
                //Reset Success Popup
                if (isset($_SESSION['reset-success'])==true) {
                    echo '<div id="reset-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="reset-success-row">';
                    echo '<p>Password telah berhasil diganti.</p>';
                    echo '<label for="login-check">Klik di sini untuk masuk.</label>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['reset-success']);
                }
                //Verification Popup
                if (isset($_GET['verification'])==true){
                    echo '<div id="verification" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Verifikasi Email</h4>';
                    echo '<label for="none">X</label>';
                    echo '<form name="verification" method="post" action="database/verification.php" onsubmit="return validateFormVerification()">';
                    echo '<input type="hidden" name="from" value="'.$_SESSION['prev-location'].'">';
                    echo '<input type="hidden" name="code" value="'.$_GET['verification'].'">';
                    echo '<input type="hidden" name="password-en" id="pass-en-verification">';
                    echo '<div class="verification-row">';
                    echo '<div class="verification-content verification-content-left">';
                    echo '<p>Email:</p>';
                    echo '</div>';
                    echo '<div class="verification-content verification-content-right">';
                    if (isset($_SESSION['verification-error'])==true) {
                        echo '<input type="text" name="email" placeholder="Email" maxlength="128" required value="'.$_SESSION["verification-email"].'">';
                        unset($_SESSION['verification-email']);
                    }
                    else{
                        echo '<input type="text" name="email" placeholder="Email" maxlength="128" required>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="verification-row">';
                    echo '<div class="verification-content verification-content-left">';
                    echo '<p>Password:</p>';
                    echo '</div>';
                    echo '<div class="verification-content verification-content-right">';
                    echo '<input type="password" name="password" placeholder="Password" id="pass-verification" onchange="';
                    echo "document.getElementById('pass-en-verification').value = calcMD5(document.getElementById('pass-verification').value)";
                    echo '" maxlength="128" required>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div id="input-error">';
                    if (isset($_SESSION['verification-error'])==true) {
                        echo "<p id='input-error-verification'>";
                        echo $_SESSION['error-info'];
                        echo "</p>";
                        unset($_SESSION['verification-error']);
                        unset($_SESSION['error-info']);
                    }
                    else{
                        echo "<p id='input-error-verification'></p>";
                    }
                    echo '</div>';
                    echo '<input type="submit" value="Verifikasi">';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            else {
                //Verification Popup
                if (isset($_GET['verification'])==true){
                    echo '<div id="verification" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Verifikasi Email</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="verification-error-row">';
                    echo '<p>Anda harus keluar terlebih dahulu agar dapat memverifikasi email.';
                    echo '<br>';
                    echo '<a href="database/logout.php">Klik disini untuk keluar</a>';
                    echo '</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                //Verification Success Popup
                if (isset($_SESSION['verification-success'])==true) {
                    echo '<div id="verification-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="verification-success-row">';
                    echo '<p>Email Anda telah berhasil diverifikasi.</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['verification-success']);
                }
                //Create Review Success Popup
                if (isset($_SESSION['review-new-success'])==true) {
                    echo '<div id="review-new-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="verification-success-row">';
                    echo '<p>Ulasan berhasil dibuat.</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['review-new-success']);
                }
                //Edit Review Success Popup
                if (isset($_SESSION['review-edit-success'])==true) {
                    echo '<div id="review-edit-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="verification-success-row">';
                    echo '<p>Sukses menyunting ulasan.</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['review-edit-success']);
                }
                //Delete Review Success Popup
                if (isset($_SESSION['review-delete-success'])==true) {
                    echo '<div id="review-delete-success" class="overlay">';
                    echo '<div class="popup">';
                    echo '<h4>Sukses</h4>';
                    echo '<label for="none">X</label>';
                    echo '<div class="verification-success-row">';
                    echo '<p>Ulasan telah dihapus.</p>';
                    echo '<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['review-delete-success']);
                }
            }
        ?>
        <div id="unsubscribe" class="overlay">
            <div class="popup">
                <h4>Berhenti Berlangganan</h4>
                <label for="none">X</label>
                <form name="unsubscribe" method="post" action="database/unsubscribe.php" onsubmit="return validateFormUnsubscribe()">
                    <input type="hidden" name="from" value="<?php echo $_SESSION['prev-location'];?>">
                    <div class="unsubscribe-row2">
                        <p>Masukkan email Anda pada kolom di bawah ini untuk berhenti berlangganan.</p>
                    </div>
                    <div class="unsubscribe-row">
                        <?php
                            if (isset($_SESSION['unsubscribe-error'])==true) {
                                echo '<input type="text" name="email" placeholder="Email" maxlength="128" required value="'.$_SESSION["unsubscribe-email"].'">';
                                unset($_SESSION['unsubscribe-email']);
                            }
                            else{
                                echo '<input type="text" name="email" placeholder="Email" maxlength="128" required>';
                            }
                        ?>
                    </div>
                    <div id="input-error">
                        <?php
                            if (isset($_SESSION['unsubscribe-error'])==true) {
                                echo "<p id='input-error-unsubscribe'>";
                                echo $_SESSION['error-info'];
                                echo "</p>";
                                unset($_SESSION['unsubscribe-error']);
                                unset($_SESSION['error-info']);
                            }
                            else{
                                echo "<p id='input-error-unsubscribe'></p>";
                            }
                        ?>
                    </div>
                    <input type="submit" value="Berhenti Berlangganan">
                </form>
            </div>
        </div>
        <div id="subscribe-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p>Terima kasih telah berlangganan berita dengan kami. Anda akan menerima berita terbaru melalui email.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="unsubscribe-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p>Anda tidak akan menerima berita dari kami melalui email.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="no-need-pay" class="overlay">
            <div class="popup">
                <h4>Pemesanan</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Anda tidak perlu memesan tiket untuk wisata ini.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="picture-edit-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Foto berhasil diubah.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="profile-edit-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Data berhasil diubah.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="purchase-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Pembelian tiket telah berhasil.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="purchase-error" class="overlay">
            <div class="popup">
                <h4>Gagal</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Pembelian tiket gagal, silahkan ulangi lagi.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="send-verification-error" class="overlay">
            <div class="popup">
                <h4>Gagal</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Kode gagal dikirim, silahkan ulangi lagi.</p>
                    <br>
                </div>
            </div>
        </div>
        <div id="send-verification-success" class="overlay">
            <div class="popup">
                <h4>Sukses</h4>
                <label for="none">X</label>
                <div class="subscribe-success-row">
                    <p style="padding-left: 8px; padding-right: 8px; margin-bottom: 0px;">Kode berhasil dikirim, silahkan cek email.</p>
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>