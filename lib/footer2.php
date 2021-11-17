</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> v1
        </div>
        <strong>Copyright &copy; 2018 <a href="<?php echo $cfg_baseurl; ?>"><?php echo $cfg_webname; ?></a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $cfg_baseurl; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $cfg_baseurl; ?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $cfg_baseurl; ?>dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo $cfg_baseurl; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $cfg_baseurl; ?>plugins/chartjs/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#depomethod").change(function() {
                var method = $("#depomethod").val();
                $.ajax({
                    url: '<?php echo $cfg_baseurl; ?>inc/depo_rate.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/token_service.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/token_price.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/pulsa_type.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/pulsa_service.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/pulsa_price.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/order_service.php',
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
                    url: '<?php echo $cfg_baseurl; ?>inc/order_note.php',
                    data: 'service=' + service,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#note").html(msg);
                    }
                });
                $.ajax({
                    url: '<?php echo $cfg_baseurl; ?>inc/order_rate.php',
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
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
</body>

</html>
