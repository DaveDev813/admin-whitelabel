  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
  <section class="content-header">
    <h1>New Customer</h1>
  </section>

  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">

          <!-- /.box-header -->
          <!-- form start -->

          <form role="form" method="POST" class="col-md-12" style="padding-left : 0px">

            <div class="box-body">

              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Failed to add new customer!</h4>
                We're sorry an unexpected error occured, please contact your system administrator.
              </div>

              <div class="col-md-7" style="padding-left : 0px; padding-top: 10px">
                <div class="form-group">
                  <label for="exampleInputEmail1">Customer No.</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Employee No.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="First Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name <small>(Optional)</small></label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Middle Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Date of Birth</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Email Address">
                </div>              
                <div class="form-group has-error">
                  <label for="exampleInputPassword1">Contact No.</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact No.">
                  <span class="help-block">Help block with error</span>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="button" class="btn btn-warning">Back To List</button>
              <button type="submit" name="submit" value="submit" class="btn btn-success">Create New Customer</button>              
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
</div>
