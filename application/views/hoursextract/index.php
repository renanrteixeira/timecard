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

<div class="box box-primary">
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Funcionário</th>
					<th><?= date('M/y',strtotime('-6month'))?></th>
					<th><?= date('M/y',strtotime('-5month'))?></th>
					<th><?= date('M/y',strtotime('-4month'))?></th>
					<th><?= date('M/y',strtotime('-3month'))?></th>
					<th><?= date('M/y',strtotime('-2month'))?></th>
					<th><?= date('M/y',strtotime('-1month'))?></th>
					<th><?= date('M/y')?></th>
					<th>Saldo Total</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($extract->result() as $value){ ?>
				<tr>
					<td><?= $value->name?></td>
					<td><?= $value->MES_0?></td>
					<td><?= $value->MES_1?></td>
					<td><?= $value->MES_2?></td>
					<td><?= $value->MES_3?></td>
					<td><?= $value->MES_4?></td>
					<td><?= $value->MES_5?></td>
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
