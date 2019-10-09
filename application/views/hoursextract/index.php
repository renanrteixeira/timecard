<?php

defined('BASEPATH') or exit('No direct script access allowed');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/datatablesheader') ?>
<?php $this->load->view('template/headerselect2') ?>
<?php $this->load->view('template/headerafterlink') ?>

<div class="box box-primary">
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Funcionário</th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-9month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-8month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-7month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-6month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-5month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-4month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-3month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-2month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('-1month'))))?></th>
					<th><?= ucfirst(utf8_encode(strftime('%b/%g', strtotime('today'))))?></th>
					<th>Saldo Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($extract->result() as $value){ ?>
					<tr>
						<td><?= $value->name?></td>
						<td><?= $value->MES_1?></td>
						<td><?= $value->MES_2?></td>
						<td><?= $value->MES_3?></td>
						<td><?= $value->MES_4?></td>
						<td><?= $value->MES_5?></td>
						<td><?= $value->MES_5?></td>
						<td><?= $value->MES_6?></td>
						<td><?= $value->MES_7?></td>
						<td><?= $value->MES_9?></td>
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
