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

<div class="box box-primary table-responsive-xl">
<div class="box-header">
		<h3 class="box-title">Extrato de Lançamentos de Horas</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body" id="box">
		<?= form_open('hoursexport/export')  ?>
				<div class="form-group">
					<label for="date">Data Inicial</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" class="form-control" id="datebegin" name="datebegin" required>
					</div>
					<label for="date">Data Final</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" class="form-control" id="datefinish" name="datefinish" required>
					</div>					<!-- /.input group -->
				</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-success btn-custom"><span class="fa fa-file-excel-o"></span> Exportar Excel</button>
				</div>
		<?= form_close(); ?>
	</div>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/datatablesfooter') ?>
<?php $this->load->view('template/scriptselect2') ?>
<?php $this->load->view('template/footer') ?>
