<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!$_SESSION['name']) {
		redirect('login/login');
	}
	
?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/headerafterlink') ?>

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/footer') ?>
