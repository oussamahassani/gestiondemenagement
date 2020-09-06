$(document).ready(function() {
	$startDate = new Date(),
	$firstDate = new Date($startDate.getFullYear(), $startDate.getMonth() + 1, 0);

	$.datepicker.regional['fr'] = {
	    closeText: '',
	    prevText: '',
	    nextText: '',
	    currentText: '',
	    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	    monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
	    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	    dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
	    dayNamesMin: ['D','L','M','M','J','V','S'],
	    weekHeader: 'Sem.',
	    format: "dd-mm-yyyy",
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	};
	/*$('#datatable').DataTable({
        "order": [[0, 'desc']]
    });*/
	$(function() {
		$(".datepicker").datepicker({
		/*	minDate: $startDate,*/
			dateFormat: "dd-mm-yy"
		});
	});
	$.datepicker.setDefaults($.datepicker.regional["fr"]);
	