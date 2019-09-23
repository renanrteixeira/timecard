	<!-- ./wrapper -->
	
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('/assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('/assets/dist/js/adminlte.min.js')?>"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url('/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
	<!-- jvectormap  -->
	<script src="<?php echo base_url('/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
	<script src="<?php echo base_url('/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url('/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('/assets/bower_components/chart.js/Chart.js')?>"></script>
	<!-- InputMask -->
	<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
	<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
	<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>
    <script>
		$(document).ready(function() {
			// show the alert
			setTimeout(function() {
				$(".alert").alert('close');
			}, 2000);
		});
		$('[data-mask]').inputmask();
	</script>

