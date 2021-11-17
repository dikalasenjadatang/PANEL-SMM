<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";
function create_random($pw){
    $a="ABCDEFGHIJKLMNOPRSTUVYZXabcdefghijklmnoprstuvyzx0123456789";
    $b="RP";
    for($i=0;$i<$pw;$i++){
        $b.=$a[rand(0,56)];
    }
    return $b;
}
 
if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
    $id = random_number(3).random_number(4);
    $data_user = mysqli_fetch_assoc($check_user);
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: ".$cfg_baseurl."account/logout");
    } else if ($data_user['status'] == "Suspended") {
        header("Location: ".$cfg_baseurl."account/logout");
    } else if ($data_user['level'] != "Developers") {
        header("Location: ".$cfg_baseurl);
    } else {
        if (isset($_POST['create_code'])) {
            $code = create_random(8);
 
            if (empty($code)) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
            } else {
                $insert_code = mysqli_query($db, "INSERT INTO invitecode (id, code, jumlah, status) VALUES ('$id', '$code', '1', 'Active')");
                if ($insert_code == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Kode undangan berhasil ditambahkan.<br /><b>Kode undangan:</b> $code<br />";
                } else {
                    $msg_type = "error";
                    $msg_content = "<b>Gagal:</b> Error system.";
                }
            }
        }
 
    include("../lib/header.php");
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                  <iv class="col-lg-15">
								<div class="card">
									<div class="card-body">
                           <h3 class="panel-title"><i class="fa fa-code"></i> Daftar Kode Undangan</h3>
                                </div>
                            <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST">
                                        <div class="col-md-12">
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
                                        <div class="col-md-6">
                                <button type="submit" class="pull-left btn btn-success btn-bordred waves-effect w-md waves-light m-b-5" name="create_code"><i class="fa fa-plus"></i> Buat Kode Undangan
                                </button>      
                                        </div>                                     
                                    <div class="col-md-6">
                                        </div>
                                        <div class="clearfix"></div>
                                        <br />
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-striped table-bordered table-hover m-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal Dibuat</th>
                                                        <th>Kode Undangan</th>
                                                        <th>Status Kode</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $check_deposit = mysqli_query($db, "SELECT * FROM invitecode ORDER BY id ASC");
                                                    $no = 1;
                                                    while ($data_deposit = mysqli_fetch_assoc($check_deposit)) {
                                                    if($data_deposit['status'] == "Active") {
                                                        $label = "success";
                                                    } else if($data_deposit['status'] == "Already Used") {
                                                        $label = "danger";
                                                    }  
                                                    ?>                                                 
                                                    <tr>
                                                        <td><?php echo $data_deposit['id']; ?></td>
                                                        <td><?php echo $data_deposit['date']; ?></td>
                                                        <td><?php echo $data_deposit['code']; ?></td>
                                                        <td><label class="label label-<?php echo $label; ?>"><?php echo $data_deposit['status']; ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>
<?php
    include("../lib/footer.php");
    }
} else {
    header("Location: ".$cfg_baseurl);
}
?>