  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Customer Information</h3>
            </div>

            <div class="box-body">
              <form role="form" method="POST" class="col-md-12">
                  <?php if($action_success){ ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> New Record Added!</h4>
                      A new record has been added to your system, <a href="#">click</a> here to view details.
                    </div>
                  <?php } ?>

                  <?php if($has_error){ ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Failed to add new customer!</h4>
                      We're sorry an unexpected error occured, please contact your system administrator.
                    </div>
                  <?php } ?>
                  <div class="col-md-12" style="padding-left : 0px; padding-top: 5px">

                      <!-- Input -->
                      <?= $this->formcomponents->set("input", "input_tag", "A Sample Input", array(), array(
                        "class"       => "form-control",
                        "placeholder" => "First Name"
                      )); ?>

                      <!-- SELECT TAG -->
                      <?= $this->formcomponents->set("select", "select_tag", "A Sample Select", array(
                          "Male" => "M",
                          "Female" => "F",
                          "Others" => "O"
                        )); ?>

                      <?= $this->formcomponents->set("checkbox", "checkbox_tag", "A Sample Checkboxes", array(
                        "Option 1" => 1, "Option 2" => 2, "Option 3" => 3), 
                        array()); 
                      ?>

                      <?= $this->formcomponents->set("radio", "radio", "A Sample Radio", array(
                        "Radio 1" => 1, "Radio 2" => 2, "Radio 3" => 3), 
                        array()); 
                      ?>

                      <?= $this->formcomponents->set("datepicker", "datepicker_tag", "A Sample DatePicker", array("05/11/2018"), array()); ?>

                      <?= $this->formcomponents->set("daterangepicker", "daterangepicker_tag", "A Sample DateRangePicker", array("05/11/2018 - 06/10/2018"), array()); ?>

                      <?= $this->formcomponents->set("timepicker", "timepicker_tag", "A Sample Time Picker", array(date("H:i A")), array()); ?>

                      <?= $this->formcomponents->set("inputphonemasked", "phone_input", "A Sample Masked Phone Input", array(), array("class" => "form-control")); ?>

                      <?= $this->formcomponents->set("inputdatemasked", "date_input", "A Sample Masked Date Input", array(), array("class" => "form-control")); ?>

                      <?= $this->formcomponents->set("textarea", "textarea_tag", "A Sample Textarea", array(), array(
                        "class"       => "form-control",
                        "placeholder" => "Write your comment",
                        "rows"        => 5
                      )); ?>


   <!-- SELECT TAG -->
                      <?= $this->formcomponents->set("multiple", "multiple_tag", "A Sample multiple select", array(
                          "Male" => "M",
                          "Female" => "F",
                          "Others" => "O"
                        ), 
                        array(
                          "class"       => "form-control",
                          "placeholder" => "First Name",
                          "selected"    => array("O","M")
                      )); ?>

                  </div>
                  <div class="col-md-12">                 
                    <button type="submit" name="submit" value="submit" class="btn btn-success pull-right">
                      <span class="fa fa-save"></span>&nbsp; <?= $submit_label ?>
                    </button>
                    <button type="submit" name="submit" value="submit" class="btn btn-warning pull-right" style="margin-right: 10px;">
                      <span class="fa fa-arrow-circle-left"></span>&nbsp; Cancel
                    </button>
                  </div>
              </form>
            </div>
            <div class="box-footer">
            </div>

          <!-- /.box-header -->
          <!-- form start -->

        <!-- /.box -->
      </div>


    </div>
    <!-- /.row -->
  </section>
</div>
