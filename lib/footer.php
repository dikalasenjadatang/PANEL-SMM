</div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018 <b>REDIR-PEDIA</b> Create By 1LxCoder. All Right Reserved
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/popper.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/detect.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/fastclick.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/waves.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/morris/morris.min.js"></script>
		<script src="<?php echo $cfg_baseurl; ?>lib/assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.core.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/assets/js/jquery.app.js"></script>

    </body>
     <?php
$db_host = "localhost";
$MySQLi_CON = new MySQLi ($db_host, $db_user, $db_password, $db_name);
        if($MySQLi_CON->connect_errno)
            {
                die ("KESALAHAN : ->".$MySQLi_CON->connect_errno);
            }
$seminggulalu = date('Y-m-d', strtotime('-7 days', strtotime(date("Y-m-d"))));

    function dbrows_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }

    function dbrowss_($tabel, $limit) {
        global $MySQLi_CON;
        $query = $MySQLi_CON->query("SELECT * FROM ".$tabel." WHERE ".$limit);
            
        $rows = $query->num_rows;
        return $rows;
        }
?>

<script>
    var tax_data = [<?php for ($i=1; $i<=7; $i++) {
    $tanggalpesanan = date('Y-m-d', strtotime('+'.$i.' days', strtotime($seminggulalu)));
    $like = $tanggalpesanan;
    $sosmed = dbrows_('orders', "date = '$tanggalpesanan' AND user = '$sess_username'");
    
    ?>
    {period: '<?php echo $tanggalpesanan; ?>', Sosmed: <?php echo $sosmed; ?>},
<?php } ?>
];
Morris.Line({
element: 'fatur',
data: tax_data,
xkey: 'period',
xLabels: "day",
ykeys: ['Sosmed'],
labels: ['Total Pesanan'],
lineColors: ['#3bafda'],
lineWidth: 1,
fillOpacity: ['0.1'],
pointFillColors: ['#ffffff'],
pointStrokeColors: ['#999999'],
behaveLikeLine: true,
gridLineColor: '#eef0f2',
hideHover: 'auto',
resize: true
});
</script>

<script>
    var tax_data = [<?php for ($i=1; $i<=7; $i++) {
    $tanggalpesanan = date('Y-m-d', strtotime('+'.$i.' days', strtotime($seminggulalu)));
    $like = $tanggalpesanan;
    $sosmed = dbrowss_('orders', "date = '$tanggalpesanan'");
    
    ?>
    {period: '<?php echo $tanggalpesanan; ?>', Sosmed: <?php echo $sosmed; ?>},
<?php } ?>
];
Morris.Line({
element: 'faturtampan',
data: tax_data,
xkey: 'period',
xLabels: "day",
ykeys: ['Sosmed'],
labels: ['Total Pesanan'],
lineColors: ['#3bafda'],
lineWidth: 1,
fillOpacity: ['0.1'],
pointFillColors: ['#ffffff'],
pointStrokeColors: ['#999999'],
behaveLikeLine: true,
gridLineColor: '#eef0f2',
hideHover: 'auto',
resize: true
});
</script>

   <script type="text/javascript">
        $(document).ready(function() {
            $("#depomethod").change(function() {
                var method = $("#depomethod").val();
                $.ajax({
                    url: 'inc/depo_rate.php',
                    data: 'method=' + method,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#rate").val(msg);
                    }
                });
            });

            $("#operator").change(function() {
                var operator = $("#operator").val();
                $.ajax({
                    url: 'inc/token_service.php',
                    data: 'operator=' + operator,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#token").html(msg);
                    }
                });
            });
            $("#token").change(function() {
                var token = $("#token").val();
                $.ajax({
                    url: 'inc/token_price.php',
                    data: 'token=' + token,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#total").val(msg);
                    }
                });
            });
            $("#type").change(function() {
                var type = $("#type").val();
                $.ajax({
                    url: 'inc/pulsa_type.php',
                    data: 'type=' + type,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#operator").html(msg);
                    }
                });
            });
            $("#operator").change(function() {
                var operator = $("#operator").val();
                $.ajax({
                    url: 'inc/pulsa_service.php',
                    data: 'operator=' + operator,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#pulsa").html(msg);
                    }
                });
            });
            $("#pulsa").change(function() {
                var pulsa = $("#pulsa").val();
                $.ajax({
                    url: 'inc/pulsa_price.php',
                    data: 'pulsa=' + pulsa,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#total").val(msg);
                    }
                });
            });
            $("#category").change(function() {
                var category = $("#category").val();
                $.ajax({
                    url: 'inc/order_service.php',
                    data: 'category=' + category,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#service").html(msg);
                    }
                });
            });
            $("#service").change(function() {
                var service = $("#service").val();
                $.ajax({
                    url: 'inc/order_note.php',
                    data: 'service=' + service,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#note").html(msg);
                    }
                });
                $.ajax({
                    url: 'inc/order_rate.php',
                    data: 'service=' + service,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#rate").val(msg);
                    }
                });
            });
        });

        function get_total(quantity) {
            var rate = $("#rate").val();
            var result = eval(quantity) * rate;
            $('#total').val(result);
        }
    </script> 
</body>

</html>