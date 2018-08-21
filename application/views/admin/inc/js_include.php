<!-- jQuery 3 -->
<script src="<?php echo admin_pluginsUrl('jquery/dist/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo admin_pluginsUrl('jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo admin_pluginsUrl('bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo admin_pluginsUrl('moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo admin_pluginsUrl('bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo admin_pluginsUrl('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo admin_pluginsUrl('datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo admin_pluginsUrl('datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo admin_pluginsUrl('jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo admin_pluginsUrl('fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo admin_jsUrl('adminlte.min.js'); ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo admin_jsUrl('custom_function.js'); ?>"></script>
<script type="text/javascript">
	 $('#admin_table').DataTable();
</script>