<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | <?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <?php $this->load->view('admin/inc/css_include'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('admin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php $this->load->view('admin/left_nav'); ?>

  <!-- Content Wrapper. Contains page content -->
<?php $this->load->view($main_content); ?>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/footer'); ?>

</div>
<!-- ./wrapper -->

<?php $this->load->view('admin/inc/js_include'); ?>
</body>
</html>
