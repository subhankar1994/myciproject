  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Users
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <a href="<?php echo base_url('admin/add_user'); ?>" class="btn btn-primary">Add User</a>
          </h3>
        </div>
        <div class="box-body">
          <table id="admin_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Active</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $key => $user){ ?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $user->uname; ?></td>
                  <td><?php echo $user->f_name.' '.$user->l_name; ?></td>
                  <td><?php echo $user->email; ?></td>
                  <td><?php echo $user->phone; ?></td>
                  <td><span class="label label-success">Active</span></td>
                  <td>
                    <a href="#" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
               
                </tbody>
              </table>
        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>