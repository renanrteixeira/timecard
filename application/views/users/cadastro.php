<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/linkicheck') ?>
<?php $this->load->view('template/headerafterlink') ?>

<div class="box box-primary">
		<?php if (validation_errors()) { ?>
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Atenção!</h4>
			<?php echo validation_errors(); ?>
			</div>
		<?php } ?>
		<?php if (!empty($mensagem)) { ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Atenção!</h4>
				<?= $mensagem ?>
			</div>
		<?php } ?>
	<div class="box-header with-border">
		<h3 class="box-title"><?= $titulo?></h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= form_open('users/save')  ?>
		<div class="box-body">
			<div class="form-group">
				<label for="name">Nome</label>
				<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= set_value('user_id') ? : (isset($user_id) ? $user_id : '') ?>">
				<input type="text" class="form-control" id="name" name="name" placeholder="Fist and middle name" value="<?= set_value('name') ? : (isset($name) ? $name : '') ?>" autofocus='true' / required>
			</div>
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail" value="<?= set_value('email') ? : (isset($email) ? $email : '') ?>" <?php echo isset($user_id) ? 'readonly' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password') ? : (isset($password) ? $password : '') ?>" required>
			</div>
			<div class="form-group">
				<label for="confirmpassword">Confirmação Password</label>
				<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" value="<?= set_value('confirmpassword') ? : (isset($confirmpassword) ? $confirmpassword : '') ?>" required>
			</div>
			<?php if ($_SESSION['admin'] == 'S') { ?>
				<div class="form-group">
					<label>Administrador?</label>
					<select class="form-control" name="admin" id="admin" required>
						<option value="S" <?php echo isset($admin) ? ($admin=='S') ?'selected':'' : ''; ?>>Sim</option>
						<option value="N" <?php echo isset($admin) ? ($admin=='N') ?'selected':'' : ''; ?>>Não</option>
					</select>
				</div>	
			<?php } ?>		
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="status" id="status" required>
					<option value="1" <?php echo isset($status) ? ($status==1) ?'selected':'' : ''; ?>>Ativo</option>
					<option value="0" <?php echo isset($status) ? ($status==0) ?'selected':'' : ''; ?>>Inativo</option>
				</select>
			</div>			
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Gravar</button>
		</div>
	<?= form_close(); ?>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/scripticheck') ?>
<?php $this->load->view('template/footer') ?>
