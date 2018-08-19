  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add User</li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
         <div class="box-header with-border">
          <h3 class="box-title">Add User</h3>
        </div>
        <form class="form-horizontal" action="javascript:void(0);" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="f_name" class="col-sm-2 control-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="l_name" class="col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="c_password" class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="user_submit_btn" id="user_submit_btn" class="btn btn-primary pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
    </section>
  </div>