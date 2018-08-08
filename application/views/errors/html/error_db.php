<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>East Point | Error</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- SELECT 2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/bower_components/select2/dist/css/select2.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin-lte/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue">
	<div class="wrapper" style="height: auto; min-height: 100%;">
		<div class="content-wrapper" style="min-height: 1200px; margin:0px">
			<section class="content">
				<div class="error-page">
					<div class="error-content" style="margin:0px; padding:5% auto;">
					<h1>
						<i class="fa fa-warning text-red"></i> Oops! Something went wrong.
					</h1>
					<br>
					<p>
						We are sorry, an unexpected error occured in the system, Please contact your System Administrator right away

            <br><br>
            <?php echo $message; ?>

						<br><br>
						<a href="<?= base_url() ?>">Back to Dashboard</a>
					</p>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>