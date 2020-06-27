<?php

defined('BASEPATH') or exit('No direct script access allowed');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


if (!$_SESSION['name']) {
	redirect('login/login');
}

  $today = strtotime('first day of this month');
  
?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/datatablesheader') ?>
<?php $this->load->view('template/headerselect2') ?>
<?php $this->load->view('template/headerafterlink') ?>

<div class="box box-warning collapsed-box">
	<div class="box-header">
		<h3 class="box-title">Exportar por Período</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body" id="box">
		<?= form_open('hoursextract/exportPeriod')  ?>
				<div class="form-group">
					<label for="date">Data Inicial</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" class="form-control" id="datebegin" name="datebegin">
					</div>
					<label for="date">Data Final</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" class="form-control" id="datefinish" name="datefinish">
					</div>					<!-- /.input group -->
				</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-success btn-custom"><span class="fa fa-file-excel-o"></span> Exportar Excel</button>
				</div>
		<?= form_close(); ?>
	</div>
</div>

<div class="box box-primary table-responsive-xl">
	<div class="box-header">
		<?= form_open('hoursextract/export') ?>
			<button type="submit" class="btn btn-success btn-custom"><span class="fa fa-file-excel-o"></span> Exportar Excel</button>
		<?= form_close(); ?>
	</div>

	<div class="box-body table-responsive-xl">
		<table id="table" class="table table-striped table-bordered table-sm">
			<thead>
				<tr>
					<th style="width:400px"></th>
					<th></th>
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-12 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-11 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-10 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-9 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-8 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-7 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-6 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-5 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-4 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-3 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-2 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-1 months', $today))))?></th> 
					<th class="text-center" colspan="2"><?= ucfirst(utf8_encode(strftime('%b/%g', $today)))?></th>
				</tr>
				<tr>
					<th style="width:400px">Funcionário</th>
					<th class="text-center">Saldo Anterior</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
					<th class="text-center">Total</th>
					<th class="text-center">Saldo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($extract->result() as $value){ ?>
					<tr>
						<td style="width:400px"><?= $value->name?></td>
						<td><?= $value->MES_12_SALDO?></td>
						<td><?= $value->MES_12?></td>
						<td><?= $value->MES_11_SALDO?></td>
						<td><?= $value->MES_11?></td>
						<td><?= $value->MES_10_SALDO?></td>
						<td><?= $value->MES_10?></td>
						<td><?= $value->MES_9_SALDO?></td>
						<td><?= $value->MES_9?></td>
						<td><?= $value->MES_8_SALDO?></td>
						<td><?= $value->MES_8?></td>
						<td><?= $value->MES_7_SALDO?></td>
						<td><?= $value->MES_7?></td>
						<td><?= $value->MES_6_SALDO?></td>
						<td><?= $value->MES_6?></td>
						<td><?= $value->MES_5_SALDO?></td>
						<td><?= $value->MES_5?></td>
						<td><?= $value->MES_4_SALDO?></td>
						<td><?= $value->MES_4?></td>
						<td><?= $value->MES_3_SALDO?></td>
						<td><?= $value->MES_3?></td>
						<td><?= $value->MES_2_SALDO?></td>
						<td><?= $value->MES_2?></td>
						<td><?= $value->MES_1_SALDO?></td>
						<td><?= $value->MES_1?></td>
						<td><?= $value->MES_ATUAL_SALDO?></td>
						<td><?= $value->MES_ATUAL?></td>
						<td><?= $value->SALDO?></td>
					</tr>
				<?php } ?>
			</tbody>			
		</table>
	</div>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/datatablesfooter') ?>
<?php $this->load->view('template/scriptselect2') ?>
<?php $this->load->view('template/footer') ?>
