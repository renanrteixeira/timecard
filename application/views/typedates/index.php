<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$_SESSION['name']) {
	redirect('login/login');
}

?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/datatablesheader') ?>
<?php $this->load->view('template/headerafterlink') ?>


<div class="box box-primary">
		<?php if (!empty($_SESSION['mensagem'])) { ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Sucesso!</h4>
						<!-- <?= $mensagem ?> -->
						<?= $_SESSION['mensagem'] ?>
					</div>
		<?php } $_SESSION['mensagem'] = ''?>
		<?php if (!empty($_SESSION['erro'])) { ?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Erro!</h4>
						<!-- <?= $mensagem ?> -->
						<?= $_SESSION['erro'] ?>
					</div>
		<?php } $_SESSION['erro'] = ''?>
	<div class="box-header">
	    <div class="row col-md-12">
			<a href="<?php echo base_url('/typedates/new')?>" class="btn btn-success btn-custom"><span class="glyphicon glyphicon-plus img-circle btn-icon"></span> Novo Tipo de Data</a>		
		</div>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>Tempo</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($typedates->result() as $typedate){ ?>
				<tr>
					<td><?= $typedate->id ?></td>
					<td><?= $typedate->name?></td>
					<td><?= $typedate->time?></td>
					<td><a href="<?php echo base_url('typedates/edit/').$typedate->id?>" data-toggle="tooltip" title="Editar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit img-circle btn-icon"></td>
				</tr>
				<?php } ?>
			</tbody>			
		</table>
	</div>
</div>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/datatablesfooter') ?>
<?php $this->load->view('template/footer') ?>
