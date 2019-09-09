<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/datatablesheader') ?>
<?php $this->load->view('template/headerselect2') ?>
<?php $this->load->view('template/headerafterlink') ?>

<div class="box box-warning collapsed-box">
	<div class="box-header">
		<h3 class="box-title">Filtros</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body" style="display: none;">
		<?= form_open('personalstatement/index')  ?>
				<div class="form-group">
					<label for="employee">Funcionário</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
						</div>
						<select class="form-control select2-single" id="employee" name="employee" style="width: 100%">
							<option value="">Informe um valor para filtrar</option>
							<?php foreach($employees->result() as $value) {?>
								<option value="<?= $value->id?>"><?=$value->name?></option>
							<?php }?>
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label for="mes" class="col-2 col-form-label">Mês/Ano</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input class="form-control" type="month" value="<?= date('Y-m')?>" id="mes" name="mes">
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary btn-custom"><span class="glyphicon glyphicon-filter img-circle btn-icon"></span> Filtrar</button>
				</div>
		<?= form_close(); ?>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">
		<h4>Funcionário: <?=  isset($employee) ? $employee->row()->employee : ''?></h4>
		<h4>Função: <?= isset($employee) ? $employee->row()->role : '' ?></h4>
		<h4>Período: <?= $periodo?></h4>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Data</th>
					<th>Entrada Manhã</th>
					<th>Saída Manhã</th>
					<th>Entrada Tarde</th>
					<th>Saída Tarde</th>
					<th>Entrada Extra</th>
					<th>Saída Extra</th>
					<th>Saldo Total</th>
				</tr>
			</thead>
			<tbody>
			<?php if (isset($extract)) { foreach($extract->result() as $value){ if ($value->name != 'TOTAL') {?>
				<tr>
    				<td><?= date('d/m/Y', strtotime($value->date))?></td>
					<td><?= $value->hour1?></td>
					<td><?= $value->hour2?></td>
					<td><?= $value->hour3?></td>
					<td><?= $value->hour4?></td>
					<td><?= $value->hour5?></td>
					<td><?= $value->hour6?></td>
					<td><?= $value->balance?></td>
				</tr>
				<?php } else {   ?>
					<tr>
						<td>TOTAL</td>
						<td></td>
						<td></td>
						<td></td>
						<td>Mês</td>
						<td><?= $value->hour6?></td>
						<td>Saldo</td>
						<td><?= $value->balance?></td>
					</tr>
					</tr>
				<?php } } }?>
			</tbody>			
		</table>
	</div>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/datatablesfooter') ?>
<?php $this->load->view('template/scriptselect2') ?>
<?php $this->load->view('template/footer') ?>
