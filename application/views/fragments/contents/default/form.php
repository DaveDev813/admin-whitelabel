  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
    <h1><?= ucfirst(($CORE->action == "add") ? $MODULE->add_page_title : $MODULE->edit_page_title) ?></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-user-circle-o"></i> Customer</a></li>
      <li class="active">New Customer</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box box-solid box-primary">
          
          <!--  BOX HEADER -->
          <div class="box-header with-border">
            <h3 class="box-title"><?= ucfirst(str_replace('_', ' ', $CORE->module)) ?> information</h3>
          </div>

          <!--  BOX BODY -->
          <div class="box-body">
            <form role="form" method="POST" class="col-md-12" enctype="multipart/form-data">

              <?php if($CORE->method == "POST" && isset($ERROR)){ ?> 
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Failed to complete request</h4>
                  <?= $ERROR["msg"]; ?>
                </div>
              <?php } ?>

              <div class="col-md-12" style="padding-left : 0px; padding-top: 5px">
                <?php foreach ($CORE->fields as $id => $field){ ?>
                  <?= $field["html"]; ?>
                <?php } ?>
              </div>

              <div class="col-md-12">                 
                <button type="submit" name="submit" value="submit" class="btn btn-md btn-success pull-right">
                  <span class="fa fa-save"></span>&nbsp; Save
                </button>
                <a href="<?= base_url() . "/" . $CORE->module . "/list?q=1" ?>" class="btn btn-md btn-warning pull-right" style="margin-right: 10px;">
                  <span class="fa fa-arrow-circle-left"></span>&nbsp; Cancel
                </a>
              </div>
            </form>
          </div>

          <!--  BOX FOOTER -->
          <div class="box-footer">
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
