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
	<?= form_open('companies/save')  ?>
		<div class="box-body">
			<div class="form-group">
				<input type="hidden" class="form-control" id="id" name="id" value="<?= set_value('id') ? : (isset($id) ? $id : '') ?>">
			</div>
			<div class="form-group">
				<label for="name">Nome</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Company name" value="<?= set_value('name') ? : (isset($name) ? $name : '') ?>" autofocus='true' required>
			</div>
			<div class="form-group">
				<label for="name">Endereço</label>
				<input type="text" class="form-control" id="address" name="address" placeholder="Company address" value="<?= set_value('address') ? : (isset($address) ? $address : '') ?>" required>
			</div>
			<div class="form-group">
				<label for="name">Telefone</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-phone"></i>
					</div>
					<input type="text" class="form-control" id="telephone" name="telephone" placeholder="Company telephone" value="<?= set_value('telephone') ? : (isset($telephone) ? $telephone : '') ?>" data-inputmask='"mask": "(99) 9999-9999"' data-mask required>
				</div>
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
