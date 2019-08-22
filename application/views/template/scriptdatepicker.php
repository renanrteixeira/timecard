<!-- bootstrap datepicker -->
<script src="<?php echo base_url('/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('/assets/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
<script src="<?php echo base_url('/assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>

<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      mask: true,
      timepicker: false,
      changeMonth: true,
      changeYear: true      
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-MM-dd', { 'placeholder': 'yyyy-MM-dd' })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })    
</script>
