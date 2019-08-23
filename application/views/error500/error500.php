<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!$_SESSION['name']) {
		redirect('Login/login');
	}
	
?>
<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/link') ?>
<?php $this->load->view('template/headerafterlink') ?>

    <section class="content-header">
      <h1>
        500 Database Error
      </h1>
	</section>
	<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Database Error.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php echo base_url()?>">return to dashboard</a> or try using the search form.
          </p>
          <h1><?php echo isset($heading) ? ($heading) : ''; ?></h1>
		      <p><?php echo isset($message) ? ($message) : ''; ?></p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>	

<?php $this->load->view('template/footerbeforescripts') ?>
<?php $this->load->view('template/scripts') ?>
<?php $this->load->view('template/footer') ?>		
