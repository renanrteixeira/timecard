<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/headerdatepicker') ?>
<?php $this->load->view('template/headerselect2') ?>
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
	<?= form_open('employees/save')  ?>
		<div class="box-body">
			<div class="form-group">
				<label for="name">Nome</label>
				<input type="hidden" class="form-control" id="id" name="id" value="<?= set_value('id') ? : (isset($id) ? $id : '') ?>">
				<input type="text" class="form-control" id="name" name="name" placeholder="Employee name" value="<?= set_value('name') ? : (isset($name) ? $name : '') ?>" autofocus='true' required>
			</div>
			<div class="form-group">
				<label for="role">Função</label>
				<select class="form-control select2-single" id="role" name="role" style="width: 100%;" required>
					<?php foreach($roles->result() as $value) {?>
						<option value="<?= $value->id?>" <?php echo isset($role) ? ($role==$value->id) ? 'selected': '' : '';  ?>><?=$value->name?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>Admissão</label>
				<div class="input-group">
					<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
					</div>
					<input type="date" class="form-control" id="admission" name="admission" value="<?= set_value('admission') ? : (isset($admission) ? $admission : '') ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/aaaa" required>
				</div>
				<!-- /.input group -->
			</div>
			<div class="form-group">
				<label>Sexo</label>
				<select class="form-control select2-single" name="gender" id="gender" style="width: 100%; height: 34px" required>
					<option value="M" <?php echo isset($gender) ? ($gender=='M') ?'selected':'' : ''; ?>>Masculino</option>
					<option value="F" <?php echo isset($gender) ? ($gender=='F') ?'selected':'' : ''; ?>>Feminino</option>
				</select>
			</div>			
			<div class="form-group">
				<label>
					<input type="checkbox" id="status" name="status" value="<?= set_value('status') ? : (isset($status) ? $status : '0') ?>" <?php if(isset($status)) { if ($status == 1) { ?> checked <?php } } ?>> Ativo?
				</label>
			</div>
			<div class="box-footer">
			<button type="submit" class="btn btn-primary">Gravar</button>
		</div>
	<?= form_close(); ?>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/scriptdatepicker') ?>
<?php $this->load->view('template/scriptselect2') ?>
<?php $this->load->view('template/scripticheck') ?>
<?php $this->load->view('template/footer') ?>
