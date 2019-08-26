<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!$_SESSION['name']) {
		redirect('Login/login');
	}
	
?>

<li class="treeview">
	<a href="#">
		<i class="fa fa-edit"></i>
		<span>Cadastros</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url('/roles/index')?>"><i class="fa fa-circle-o"></i> Funções</a></li>
		<li><a href="<?php echo base_url('/employees/index')?>"><i class="fa fa-circle-o"></i> Funcionários</a></li>
		<li><a href="<?php echo base_url('/typedates/index')?>"><i class="fa fa-circle-o"></i> Tipos de Data</a></li>
		<li><a href="<?php echo base_url('/hours/index')?>"><i class="fa fa-circle-o"></i> Lançamento Horas</a></li>
		<li><a href="<?php echo base_url('/users/index')?>"><i class="fa fa-circle-o"></i> Usuários</a></li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
	    <i class="fa fa-print"></i>
		<span>Relatórios</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url('/hoursextract/index')?>"><i class="fa fa-circle-o"></i> Extrato de Horas</a></li>
		<li><a href="<?php echo base_url('/personalstatement/index')?>"><i class="fa fa-circle-o"></i> Extrato Pessoal</a></li>
	</ul>
</li>
