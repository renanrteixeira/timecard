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
	<link rel="stylesheet" href="<?php echo base_url('/includes/bootstrap/css/bootstrap.min.css') ?>">
	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('/assets/dist/css/AdminLTE.min.css') ?>">
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url('/includes/login/login.css') ?>" rel="stylesheet">
</head>

<body class="text-center hold-transition login-page">
	<div class="login-box">
		<?php echo form_open('Users/doLogin'); ?>
		<form>
			<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
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
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
				<input type="email" id="email" name="email" class="form-control" placeholder="E-mail address" required autofocus>
			</div>
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			</div>
			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit" id="Login">Sign in</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2019</p>
		</form>
		<?php echo form_close(); ?>
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

</body>

</html>
