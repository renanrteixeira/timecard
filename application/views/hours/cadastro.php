<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/headerselect2') ?>
<?php $this->load->view('template/headerdatepicker') ?>
<?php $this->load->view('template/link') ?>
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
	<?= form_open('hours/save')  ?>
		<div class="box-body">
			<div class="form-group">
				<input type="hidden" class="form-control" id="id" name="id" value="<?= set_value('id') ? : (isset($id) ? $id : '') ?>">
                <label for="employee">Funcionário</label>
                <select class="form-control select2-single" id="employee" name="employee" required autofocus>
				  <?php foreach($employees->result() as $value) {?>
                     <option value="<?= $value->id?>" <?php echo isset($employee) ? ($employee==$value->id) ? 'selected': '' : '';  ?>><?=$value->name?></option>
				  <?php }?>
				</select>
            </div>
			<div class="form-group">
				<label for="date">Data Lançamento</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="date" class="form-control" id="date" name="date" value="<?= set_value('date') ? : (isset($date) ? $date : '') ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/aaaa" required>
				</div>
				<!-- /.input group -->
			</div>
			<div class="form-group">
				<label for="hour1">Entrada Manhã</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour1" name="hour1" value="<?= set_value('hour1') ? : (isset($hour1) ? $hour1 : '') ?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="hour2">Saída Manhã</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour2" name="hour2" value="<?= set_value('hour2') ? : (isset($hour2) ? $hour2 : '') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="hour3">Entrada Tarde</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour3" name="hour3" value="<?= set_value('hour3') ? : (isset($hour3) ? $hour3 : '') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="hour4">Saída Tarde</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour4" name="hour4" value="<?= set_value('hour4') ? : (isset($hour4) ? $hour4 : '') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="hour5">Entrada Extra</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour5" name="hour5" value="<?= set_value('hour5') ? : (isset($hour5) ? $hour5 : '') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="hour6">Saída Extra</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
					<input type="time" class="form-control" id="hour6" name="hour6" value="<?= set_value('hour6') ? : (isset($hour6) ? $hour6 : '') ?>">
				</div>
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
<?php $this->load->view('template/footer') ?>
