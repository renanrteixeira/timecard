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
		<?php } $_SESSION['erro'] = '' ?>
	<div class="box-header">
	    <div class="row col-md-12">
			<a href="<?php echo base_url('/users/new')?>" class="btn btn-success btn-custom"><span class="glyphicon glyphicon-plus img-circle btn-icon"></span> Novo usuário</a>		
		</div>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Status</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users->result() as $user){ ?>
				<tr>
					<td><?= $user->user_id ?></td>
					<td><?= $user->name?></td>
					<td><?= $user->email ?></td>
					<?php if ($user->status == 0) { ?>
					  <td>Inativo</td>
					<?php } else { ?>
						<td>Ativo</td>
					<?php } ?>
					<?php if ( (($_SESSION['user_id'] == $user->user_id)) || ($_SESSION['admin'] == 'S') ){?>
						<td><?= anchor("users/edit/$user->user_id", "Editar")?></td>
					<?php } else { ?>
						<td></td>
					<?php } ?>
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
