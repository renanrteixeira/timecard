<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	<title>Signin</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/bower_components/Ionicons/css/ionicons.min.css') ?>">	
    <!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/plugins/iCheck/square/blue.css') ?>">
	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/dist/css/AdminLTE.min.css') ?>">
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url('/includes/login/login.css') ?>" rel="stylesheet">
</head>

<body class="hold-transition login-page text-center">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Controle</b>Ponto</a>
		</div>		
		<div class="login-box-body">
			<?php echo form_open('login/doLogin'); ?>
			<form>
				<img class="mb-4" src="<?php echo base_url('/assets/dist/img/logo.png')?>" alt="" width="72" height="72">
				<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
				<?php if (validation_errors()) { ?>
				<div class="callout callout-danger">
					<h4>Warning!</h4>
					<p><?php echo validation_errors(); ?></p>
				</div>
				<?php } ?>
				<?php if (!empty($this->input->get('msg')) && $this->input->get('msg') == 1) { ?>
				<div class="callout callout-danger">
					E-mail e/ou senha inválidos!
				</div>
				<?php } ?>
				<div class="form-group has-feedback">
					<input type="email" id="email" name="email" class="form-control" placeholder="E-mail address" value="<?php if(isset($_COOKIE["timecardlogin"])) { echo $_COOKIE["timecardlogin"]; } ?>" required autofocus>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>			
				<div class="form-group has-feedback">
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="checkbox mb-3">
					<label>
						<input type="checkbox" value="remember-me" <?php if(isset($_COOKIE["timecardlogin"])) { ?> checked <?php } ?>> Remember me
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" id="Login">Sign in</button>
				<p class="mt-5 mb-3 text-muted">&copy; 2019</p>
			</form>
			<?php echo form_close(); ?>
		</div>
	</div>
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('/assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('/assets/dist/js/adminlte.min.js') ?>"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('/assets/dist/js/demo.js') ?>"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url('/assets/plugins/iCheck/icheck.min.js') ?>"></script>
	<script>
	$(function () {
		$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' /* optional */
		});
	});
	</script>	
</body>

</html>
