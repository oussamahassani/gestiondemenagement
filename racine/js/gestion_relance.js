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
	    format: "Y-m-d",
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
			minDate: $startDate,
			dateFormat: "yy-mm-dd"
		});
	});
	$.datepicker.setDefaults($.datepicker.regional["fr"]);
	(function() {
		jQuery.tableauRechercheRelance = function() {
			$.ajax({type : "POST",
				url : "ajax/ajaxRechercheRelance.php",
				data : {
					num_devis 				: $('#num_devis').val(),
					client 					: $('#client').val(),
					date_future_relance 	: $('#date_future_relance').val(),
					date_derniere_relance 	: $('#date_derniere_relance').val(),
					statut_relance			: $('#statut_relance').val()
				},
				dataType: "html",
				beforeSend : function() {
					// $("#rechercher_relance").html('<img src="images/page-load.gif" alt="" border="0" style="margin-top:0;margin-right:0">');
				},
				success : function(response) {
					$("#liste_relance").html(response);
				},
				error: function(error) {
					console.error(error);
				}
			});
		}
	})(jQuery);


	/*$("[id^='relance_']").on('click', function(e) {
		$('#modalRelance').modal({backdrop: 'static', keyboard: false},'show');
	});*/
	//Affichage du modal
	
	//Clique sur le bouton valider ou annuler
	$("[id^='btnrelance_']").on('click', function(e) {
		var $this = $(this),
			subOK = true,
			btnRelance = $(this).attr('id').split('_');
		isValidFormRelance = $("form[id^='frm_relance']").validate({
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			} 
		}).form();
		if (btnRelance[1] == 'valid') {
			if (subOK && isValidFormReglement) {
				$.ajax({type : "POST",
					url : "ajax/ajaxAjoutRelance.php",
					data : {
						id_devis 				: $('#id_devis').val(),
						date_relance 			: $('#date_relance').val(),
						heure_relance 			: $('#heure_relance').val(),
						responsable_relance 	: $('#responsable_relance').text(),
						statut_relance 			: $('#commentLgt').val(),
						commentaire_relance 	: $('#commentaire_relance').val()
					},
					dataType: "html",
					beforeSend : function() {
						$('#frm_relance').find('input:visible,textarea:visible').prop('disabled',true);
						$("#fermer_relance").html('<img src="images/page-load.gif" alt="" border="0" style="margin-top:0;margin-right:0">');
					},
					success : function(response) {
						// $("#formDevis").submit();
						console.log(response);
					},
					error: function(error) {
						console.error(error);
					}
				});
			} else {
				var $obj = $('.form-control.error:first');
				$('body,html').animate({scrollTop:$obj.offset().top-20},1000);
				return false;
			}
		}
	});

	//Liste des relances existantes
	$.tableauRechercheRelance();
	$("#rechercher_relance").on('click', function(e) {
		var $this = $(this);
		$.tableauRechercheRelance();
	});
});