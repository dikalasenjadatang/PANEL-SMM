<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";
 
if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
    $data_user = mysqli_fetch_assoc($check_user);
    if (mysqli_num_rows($check_user) !== 0) {
        header("Location: ".$cfg_baseurl);
    }
}
    if (isset($_POST['daftar'])) {
        $post_username = mysqli_real_escape_string($db, trim($_POST['username']));
        $post_password = mysqli_real_escape_string($db, trim($_POST['password']));
        $post_repeat_password = mysqli_real_escape_string($db, trim($_POST['repassword']));
        $post_code = $_POST['code'];
        $post_api = random(20);
       
        $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
        $check_code = mysqli_query($db, "SELECT * FROM invitecode WHERE code = '$post_code'");
 
        if (empty($post_username) || empty($post_password) || empty($post_code) || empty($post_repeat_password)) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Lengkapi semua input. <script>swal('Oh Snap!', 'Lengkapi semua input.', 'error');</script>";
        } else if (mysqli_num_rows($check_user) > 0) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Username telah digunakan. <script>swal('Oh Snap!', 'Username telah digunakan.', 'error');</script>";
        } else if (mysqli_num_rows($check_email) > 0) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Email telah digunakan. <script>swal('Oh Snap!', 'Email telah digunakan.', 'error');</script>";
        } else if (mysqli_num_rows($check_code) == 0) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Kode undangan tidak ditemukan/sudah terpakai. <script>swal('Oh Snap!', 'Kode undangan tidak ditemukan/sudah terpakai.', 'error');</script>";
        } else if (strlen($post_username) > 15) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Username maksimal 15 karakter . <script>swal('Oh Snap!', 'Username maksimal 15 karakter.', 'error');</script>";
        } else if (strlen($post_password) > 15) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Password maksimal 15 karakter. <script>swal('Oh Snap!', 'Password maksimal 15 karakter.', 'error');</script>";
        } else if (strlen($post_username) < 5) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Username minimal 5 karakter. <script>swal('Oh Snap!', 'Username minimal 5 karakter.', 'error');</script>";
        } else if (strlen($post_password) < 5) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Password minimal 5 karakter. <script>swal('Oh Snap!', 'Password minimal 5 karakter.', 'error');</script>";
        } else if ($post_password <> $post_repeat_password) {
            $msg_type = "error";
            $msg_content = "<b>Gagal:</b> Konfirmasi password tidak sesuai. <script>swal('Oh Snap!', 'Konfirmasi password tidak sesuai.', 'error');</script>";
        } else {
                $insert_user = mysqli_query($db, "INSERT INTO users (username, password, balance, level, registered, status, api_key, uplink) VALUES ('$post_username', '$post_password', '0', 'Member', '$date', 'Active', '$post_api', 'free_register')");
               $insert_user = mysqli_query($db, "DELETE FROM code_verification WHERE code = '$post_code'");
                if ($insert_user == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Pendaftaran berhasil. Anda akan dialihkan ke halaman masuk.<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=index.php\"> <script>swal('Yeay!', 'Pendaftaran berhasil. Anda akan dialihkan ke halaman masuk.', 'success');</script>";
                } else {
                    $msg_type = "error";
                    $msg_content = "<script>swal('Error!', 'Error system (1).', 'error');</script>";
                }
            }
        }
include_once("lib/header.php");
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <center>
    <div class="col-lg-15">
								<div class="card">
									<div class="card-body">
                   <h3 class="panel-title"><i class="fa fa-user-plus"></i> Daftar </h3>
                </div>
                <div class="panel-body">
                                        <?php
                                        if ($msg_type == "success") {
                                        ?>
                                        <div class="alert alert-success">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <i class="fa fa-check-circle"></i>
                                            <?php echo $msg_content; ?>
                                        </div>
                                        <?php
                                        } else if ($msg_type == "error") {
                                        ?>
                                        <div class="alert alert-danger">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <i class="fa fa-times-circle"></i>
                                            <?php echo $msg_content; ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Password</label>
                                                <div class="col-md-10">
                                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Ulangi Password</label>
                                                <div class="col-md-10">
                                                    <input type="password" name="repassword" class="form-control" placeholder="Ulangi Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Kode Undangan</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="code" class="form-control" placeholder="Kode Undangan">
                                                </div>
                                            </div>
                                             
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" class="btn btn-primary" name="daftar"><i class="fa fa-send"></i> Submit </button>
                                                    <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi</button>                                                  
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                     <div class="col-md-15">
                    <div class="card">
                        <div class="card-body">
                          <i class="fa fa-question-circle"></i>
                           <h3 class="panel-title"><i class="fa fa-question-circle"></i> Mengapa Memilih Kami?</h3>
                       </div>
                       <div class="panel-body">
                                        <p><b><?php echo $cfg_webname; ?></b> <?php echo $cfg_about; ?></p>
                                    <ul>
                                        <li>Instant & Auto processing.</li>
                                        <li>Harga murah.</li>
                                        <li>Layanan lengkap.</li>
                                        <li>24 Jam support.</li>
                                        <li>Deposit via Bank & Pulsa.</li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
include("lib/footer.php");
?>