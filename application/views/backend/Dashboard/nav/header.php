<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, admin wrap admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, material design, material dashboard bootstrap 4 dashboard template"
    />
    <meta
      name="description"
      content="Admin Wrap is powerful and clean admin dashboard template, inpired from Google's Material Design"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Admin Wrap Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap/" />
    
    <link rel="icon" type="image/png" sizes="16x16"
      href=<?php echo base_url()."assets/dashboard/assets/images/favicon.png" ?>
    />
    
    <link href=<?php echo base_url()."assets/dashboard/css/bootstrap.min.css"?> rel="stylesheet"/>
    <link href=<?php echo base_url()."assets/dashboard/css/perfect-scrollbar.min.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/morris.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/c3.min.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/jquery.toast.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/style.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/dashboard1.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/default.css"?> id="theme" rel="stylesheet" />
    <link rel="stylesheet" href=<?php echo base_url()."assets/dashboard/css/simple-line-icons.min.css"?> rel="stylesheet" />
    <link rel="stylesheet" href=<?php echo base_url()."assets/dashboard/css/iconmind.css"?> rel="stylesheet"/>
    <link rel="stylesheet" href=<?php echo base_url()."assets/dashboard/css/themify-icons.css"?> rel="stylesheet"/>
    <link rel="stylesheet" href=<?php echo base_url()."assets/dashboard/css/weather-icons.min.css"?> rel="stylesheet"/>
    <link rel="stylesheet" href=<?php echo base_url()."assets/dashboard/css/fontawesome-all.css"?> rel="stylesheet" />
	<link href=<?php echo base_url()."assets/dashboard/css/bootstrap-select.min.css"?> rel="stylesheet"/>
	<link href=<?php echo base_url()."assets/dashboard/css/footable.bootstrap.min.css"?> rel="stylesheet"/>
	<link href=<?php echo base_url()."assets/dashboard/css/contact-app-page.css"?> rel="stylesheet"/>
    <link href=<?php echo base_url()."assets/dashboard/css/footable-page.css"?> rel="stylesheet"/>

	<link href=<?php echo base_url()."assets/dashboard/css/bootstrap-datepicker.min.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/select2.min.css"?> rel="stylesheet"/>
    <link href=<?php echo base_url()."assets/dashboard/css/switchery.min.css"?> rel="stylesheet" />
    
    <link href=<?php echo base_url()."assets/dashboard/css/bootstrap-tagsinput.css"?> rel="stylesheet" />
    <link href=<?php echo base_url()."assets/dashboard/css/jquery.bootstrap-touchspin.min.css"?> rel="stylesheet"/>
    <link href=<?php echo base_url()."assets/dashboard/css/multi-select.css"?>rel="stylesheet"/>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src=<?php echo base_url()."assets/dashboard/js/jquery.min.js"?> ></script>
	
  </head>

<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
	<div class="loader">
		<div class="loader__figure"></div>
		<p class="loader__label">Admin Wrap</p>
	</div>
</div>
<div id="main-wrapper">
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">

        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <b>
                    <img
                        src=<?php echo base_url()."assets/dashboard/assets/images/logo-icon.png"?>
                        alt="homepage"
                        class="dark-logo"/>
                    <img
                        src=<?php echo base_url()."assets/dashboard/assets/images/logo-light-icon.png" ?>
                        alt="homepage"
                        class="light-logo"/>
                </b>
                <span>
                    <img
                        src=<?php echo base_url()."assets/dashboard/assets/images/logo-text.png" ?>
                        alt="homepage"
                        class="dark-logo"/>
                    <img
                        src=<?php echo base_url()."assets/dashboard/assets/images/logo-light-text.png" ?>
                        class="light-logo"
                        alt="homepage"/></span>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a
                        class=" nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                        href="javascript:void(0)">
                        <i class="sl-icon-menu"></i >
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class=" nav-link sidebartoggler hidden-sm-down waves-effect waves-dark"
                        href="javascript:void(0)">
                        <i class="sl-icon-menu"></i >
                    </a>
                </li>
                <li class="nav-item hidden-xs-down search-box">
                    <a
                        class="nav-link hidden-sm-down waves-effect waves-dark"
                        href="javascript:void(0)">
                        <i class="icon-Magnifi-Glass2"></i >
                    </a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"/>
                        <a class="srh-btn">
                            <i class="ti-close"></i>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">

                <li class="nav-item dropdown u-pro">
                    <a
                        class=" nav-link dropdown-toggle waves-effect waves-dark profile-pic"
                        href=""
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"><img
                        src=<?php echo base_url()."assets/dashboard/assets/images/users/1.jpg" ?>
                        alt="user"
                        class=""/>
                        <span class="hidden-md-down">Mark Sanders &nbsp;<i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                        <img
                                            src=<?php echo base_url()."assets/dashboard/assets/images/users/1.jpg" ?>
                                            alt="user"/>
                                    </div>
                                    <div class="u-text">
                                        <h4>Steave Jobs</h4>
                                        <p class="text-muted">varun@gmail.com</p>
                                    </div>
                                </div>
                            </li>

                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="ti-settings"></i>
                                    Pengaturan Admin</a >
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-power-off"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php require_once "sidebar.php"; ?>
