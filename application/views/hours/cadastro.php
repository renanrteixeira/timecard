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
		<?php if (!empty($_SESSION['retorno'])) { ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Sucesso!</h4>
						<!-- <?= $mensagem ?> -->
						<?= $_SESSION['retorno'] ?>
					</div>
		<?php } ?>

	<div class="box-header with-border">
		<h3 class="box-title"><?= $titulo?></h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= form_open('hours/save')  ?>
		<div class="box-body">
			<div class="box">
				<div class="box-body no-padding">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<input type="hidden" class="form-control" id="id" name="id" value="<?= set_value('id') ? : (isset($id) ? $id : '') ?>">
							</div>
							<div class="form-group">
								<label for="employee">Funcionário</label>
								<select class="form-control select2-single" id="employee" name="employee" required autofocus>
								<?php foreach($employees->result() as $value) {?>
									<option value="<?= $value->id?>" <?php echo isset($employee) ? ($employee==$value->id) ? 'selected': '' : '';  ?>><?=$value->name?></option>
								<?php }?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
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
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="typedate">Tipo de Data</label>
								<select class="form-control select2-single" id="typedate" name="typedate"  required>
								<?php foreach($typedates->result() as $value) {?>
									<option value="<?= $value->id?>" <?php echo isset($typedate) ? ($typedate==$value->id) ? 'selected': '' : '';  ?>><?=$value->name?></option>
								<?php }?>
								</select>
							</div>		
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-header with-border">
					<b>Manhã</b>
				</div>
				<div class="box-body bo-padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour1">Entrada</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour1" name="hour1" value="<?= set_value('hour1') ? : (isset($hour1) ? $hour1 : '') ?>" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour2">Saída</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour2" name="hour2" value="<?= set_value('hour2') ? : (isset($hour2) ? $hour2 : '') ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-header with-border">
					<b>Tarde</b>
				</div>
				<div class="box-body bo-padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour3">Entrada</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour3" name="hour3" value="<?= set_value('hour3') ? : (isset($hour3) ? $hour3 : '') ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour4">Saída</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour4" name="hour4" value="<?= set_value('hour4') ? : (isset($hour4) ? $hour4 : '') ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-header with-border">
					<b>Extra</b>
				</div>
				<div class="box-body bo-padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour5">Entrada</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour5" name="hour5" value="<?= set_value('hour5') ? : (isset($hour5) ? $hour5 : '') ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="hour6">Saída</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="time" class="form-control" id="hour6" name="hour6" value="<?= set_value('hour6') ? : (isset($hour6) ? $hour6 : '') ?>">
								</div>
							</div>
						</div>
					</div>
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
