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

<div class="box box-warning collapsed-box">
	<div class="box-header">
		<h3 class="box-title">Filtros</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	<div class="box-body" style="display: none;">
		<?= form_open('payments/index')  ?>
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
					<button type="submit" class="btn btn-primary btn-custom"><span class="glyphicon glyphicon-filter img-circle btn-icon"></span> Filtrar</button>
				</div>
		<?= form_close(); ?>
	</div>
</div>


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
			<a href="<?php echo base_url('/payments/new')?>" class="btn btn-success btn-custom"><span class="glyphicon glyphicon-plus img-circle btn-icon"></span> Novo Pagamento</a>		
		</div>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Data Lançamento</th>
					<th>Funcionário</th>
					<th>Horas Pagas</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($hours->result() as $hour){ ?>
				<tr>
					<td><?= ucfirst(utf8_encode(strftime('%d/%m/%Y',strtotime($hour->date))))?></td>
					<td><?= $hour->name?></td>
					<td><?= $hour->hour1?></td>
					<td>
						<a href="<?php echo base_url('payments/edit/').$hour->id?>" data-toggle="tooltip" title="Editar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit img-circle btn-icon"></span></a>
						<a href="<?php echo base_url('payments/delete/').$hour->id?>" data-toggle="tooltip" title="Excluir" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash img-circle btn-icon"></span></a>
					</td>
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
