<!-- DataTables -->
<script src="<?php echo base_url('/assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('#table').DataTable({ "language": {
				"decimal": ",",
				"emptyTable": "Não exitem dados para exibição",
				"info": "Exibindo _START_ até _END_ de _TOTAL_ Registro(s)",
				"infoEmpty": "Exibindo 0 até 0 de 0 Registro(s)",
				"infoFiltered": "(Filtrado de _MAX_ total de Registros)",
				"infoPostFix": "",
				"thousands": ".",
				"lengthMenu": "Exibindo _MENU_ Registros",
				"loadingRecords": "Carregando...",
				"processing": "Processando...",
				"search": "Pesquisar:",
				"zeroRecords": "Nenhum Registro encontrado",
				"paginate": {
					"first": "Primeiro",
					"last": "Último",
					"next": "Próximo",
					"previous": "Anterior"
				},
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				}
			},
			responsive: true,
			"scrollX": true
		});
	});
</script>
