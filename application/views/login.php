<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php echo $title; ?></title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/logo_copy.png'); ?>">
		<link rel="icon" href="<?php echo base_url('assets/img/logo.png'); ?>" type="image/x-icon">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		
		<link href="<?php echo base_url(); ?>assets/plugin/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper  pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="<?php echo base_url('login'); ?>">
						
						<img class="brand-img" src="<?php echo base_url('assets/images/logo_copy.png'); ?>" alt="brand" width="30px" height="30px" /><span class="brand-text"><?php echo app_name; ?></span>
					</a>
				</div>				
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 aut-page error-bg-img">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign in to <?php echo app_name; ?></h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<?php echo form_open_multipart('user/login', array('id'=>'bb_ajax_form', 'class'=>'form-horizontal')); ?>
												<div id="bb_ajax_msg"></div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
													<input type="email" class="form-control" required="" name="email" id="email" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<div class="clearfix"></div>
													<input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter pwd">
												</div>
												
												<div class="form-group text-center">
													<button type="submit" class="btn btn-warning btn-anim btn-rounded"><i class="icon-rocket"></i><span class="btn-text">sign in</span></button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/plugin/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo base_url(); ?>assets/plugin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugin/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?php echo base_url(); ?>assets/js/init.js"></script>

		<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
	</body>
</html>
