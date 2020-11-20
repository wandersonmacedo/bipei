$(document).ready(function(){

	$dia_selecionado = $('h5 .dia_sel').text();
    $('.select_dia>option').each(function(index){
    	if($dia_selecionado == $(this).text()){
    		$(this).attr('selected', true);
    	}
	});

	$mes_selecionado = $('h5 .mes_sel').text();
    $('.select_mes>option').each(function(index){
    	if($mes_selecionado == $(this).text()){
    		$(this).attr('selected', true);
    	}
	});

	var modalId = $('#modalId');
	var btnConfirmation = $('.modal .btn-confirmation');
	var rastreioInfo = $('.rastreio-info');

	// MODAL BOTÃO REMOVER
	$('.btn-remove').click(function(e){
		e.preventDefault();
		var $codeRastreio = $(this).attr("data-rastreio");
		var $codeId = $(this).attr("data-target");
		var $codeIdDel = $codeId.substring(9);
		$codeId = $codeId.substring(1);
		rastreioInfo.text($codeRastreio);
		modalId.attr('id', $codeId);
		btnConfirmation.attr('href', 'remove/' + $codeIdDel);
	});

	// TABELA PAINEL
	$('.codigosTable.painel').DataTable({
		  "initComplete": function(settings, json) {
		    $('.box-table').removeClass("load");
		  },
		"scrollCollapse": false,
		"paging":         true,
		"language": {
		  "sProcessing": "A processar...",
		  "sLengthMenu": "Mostrar _MENU_ rastreios",
		  "sZeroRecords": "Não foram encontrados resultados",
		  "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ rastreios",
		  "sInfoEmpty": "Mostrando de 0 até 0 de 0 rastreios",
		  "sInfoFiltered": "(filtrado de _MAX_ rastreios no total)",
		  "sInfoPostFix": "",
		  "sSearch": "Buscar:",
		  "sUrl": "",
		  "oPaginate": {
		    "sFirst": "Primeiro",
		    "sPrevious": "Anterior",
		    "sNext": "Próximo",
		    "sLast": "Último"
		  }
		}
	});

	// TABELAS PÁGINAS EXPORTAR
	$('.codigosTable.export').DataTable({
		"initComplete": function(settings, json) {
			$('.box-table').removeClass("load");
		},
		"bFilter": false,
		"scrollCollapse": true,
		"paging":         true,
		"language": {
		  "sProcessing": "A processar...",
		  "sLengthMenu": "Mostrar _MENU_ rastreios",
		  "sZeroRecords": "Não foram encontrados resultados",
		  "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ rastreios",
		  "sInfoEmpty": "Mostrando de 0 até 0 de 0 rastreios",
		  "sInfoFiltered": "(filtrado de _MAX_ rastreios no total)",
		  "sInfoPostFix": "",
		  "sSearch": "Buscar:",
		  "sUrl": "",
		  "oPaginate": {
		    "sFirst": "Primeiro",
		    "sPrevious": "Anterior",
		    "sNext": "Próximo",
		    "sLast": "Último"
		  }
		},
		dom: 'Bfrtip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
});
