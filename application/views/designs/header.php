<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo app_meta_desc; ?>" />
	<meta name="keywords" content="" />
	<meta name="author" content=""/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico">

	<link href="<?php echo base_url(); ?>assets/plugin/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper  theme-1-active pimary-color-blue">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="<?php echo base_url('dashboard'); ?>">
							<img class="brand-img" src="<?php echo base_url(); ?>assets/images/logo_copy.png" alt="brand" width="30px" height="30px" />
							<span class="brand-text"><?php echo app_name; ?></span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
				
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					
					<li class="dropdown auth-drp">
						<?php 
							if (empty($pic)) {
								$image = 'assets/avatar.png';
							} else{
								$image = $pic;
							}
							

						?>

						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url($image); ?>" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="<?php echo base_url('logout'); ?>"><i class="icon-logout"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<?php if (!empty($user)) {?>
					<li>
						<a class="<?php if($page_active == 'dashboard'){echo 'active-page';} ?>" href="<?php echo base_url('dashboard'); ?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">dashboard</span></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?php if($page_active == 'artist'){echo 'active-page';} ?>" href="<?php echo base_url('artist'); ?>"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">manage artists</span></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?php if($page_active == 'album'){echo 'active-page';} ?>" href="<?php echo base_url('album'); ?>"><div class="pull-left"><i class="ti-image mr-20"></i><span class="right-nav-text">manage albums</span></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?php if($page_active == 'genre'){echo 'active-page';} ?>" href="<?php echo base_url('genre'); ?>"><div class="pull-left"><i class="ti-map mr-20"></i><span class="right-nav-text">manage genres</span></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?php if($page_active == 'new_tracks'){echo 'active-page';} ?>" href="<?php echo base_url('new_tracks'); ?>"><div class="pull-left"><i class="ti-music mr-20"></i><span class="right-nav-text">new tracks</span></div><div class="clearfix"></div></a>
					</li>
					<li>
						<a class="<?php if($page_active == 'tracks'){echo 'active-page';} ?>" href="<?php echo base_url('tracks'); ?>"><div class="pull-left"><i class="ti-music-alt  mr-20"></i><span class="right-nav-text">manage tracks</span></div><div class="clearfix"></div></a>
					</li>
				<?php } ?>
				
				<li>
					<a class="<?php if($page_active == 'music'){echo 'active-page';} ?>" href="<?php echo base_url('music'); ?>"><div class="pull-left"><i class="ti-headphone mr-20"></i><span class="right-nav-text">Music</span></div><div class="clearfix"></div></a>
				</li>
				<?php if (empty($user)) { ?>
					<li>
						<a href="<?php echo base_url('login'); ?>"><div class="pull-left"><i class="icon-login mr-20"></i><span class="right-nav-text">Login</span></div><div class="clearfix"></div></a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
		<!-- Right Sidebar Backdrop -->
		<div class="right-sidebar-backdrop"></div>
		<!-- /Right Sidebar Backdrop -->

        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-30">