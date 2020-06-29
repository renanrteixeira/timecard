</head>
<body class="hold-transition sidebar-mini skin-blue-light">
<div class="se-pre-con"></div>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>TO</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Controle</b>Ponto</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('/assets/dist/img/user9-160x160.jpg')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('/assets/dist/img/user9-160x160.jpg')?>" class="img-circle" alt="User Image">
                <p>
								  <?php echo $_SESSION['name']?>
                  <small><?php echo $_SESSION['email']?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                  </div>
                  <div class="col-xs-4 text-center">
                  </div>
                  <div class="col-xs-4 text-center">
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url("/users/edit/".$_SESSION['user_id'])?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('/login/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu de Navegação</li>
				<?php $this->load->view('menu/sidemenu') ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
			<h1>
				Controle Ponto
				<small>Versão 1.1</small>
			</h1>
			<?php echo create_breadcrumb('home', base_url()); ?>
    </section>

    <!-- Main content -->
    <section class="content">
