<?php 
    
    include "proses.php";
 
?>
 
 
<!doctype html>
<html>
<head>
<title>Cara Menggunakan Google reCaptcha</title>
    <!-- Bootstrap CSS Core --> 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container" style="margin-top: 50px;">
    <div class="col-xs-6 col-xs-offset-3">
        <div class="panel panel-default">
        <div class="panel-body">
 
 
            <?php if (isset($success)) {
                if ($success==true) { ?>
                <div class="alert alert-success"><?php echo "Terima Kasih, Akun Anda Berhasil Ditambahkan Silakan Login Di Menu Login"; ?></div>
            <? } else { ?>
            <div class="alert alert-danger"><?php echo "Gagal!, Mohon lengkapi form dan Captcha yang tersedia"; ?></div>
            <?php } } ?>
 
 
            <form action="?" method="post" name="form-komentar" >
                <div class="form-group">
                    <textarea name="komentar" placeholder="Tambahkan komentar anda" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Kirim Komentar" class="btn btn-danger">
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
 
    <!-- Memuat API Google reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>