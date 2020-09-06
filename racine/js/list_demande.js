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
	$.datepicker.setDefaults($.datepicker.regional["fr"]);
	$(function() {
		$(".datepicker").datepicker({
			minDate: $startDate,
			dateFormat: "yy-mm-dd"
		});
		$('#heure_relance').inputmask(
			"hh:mm", {
			placeholder: "HH:MM", 
			insertMode: false, 
			showMaskOnHover: false,
			// hourFormat: 24
		});
	});
	$("[id^='relance_']").on('click', function(e) {
		$this = $(this).attr("id").split("_");
		$("#valueIdDemande").val($this[1]);
		$('#modalRelance').modal({backdrop: 'static', keyboard: false},'show');
	});
	//Effet sur les placeholders
	$('input, textarea').on('focus',function() {
		var $this = $(this);
		var place_val = $this.attr('placeholder');
		if(place_val != '') {
			$this.data('placeholder',place_val).removeAttr('placeholder');
		}
	}).on('blur',function() {
		var $this = $(this);
		var place_val = $this.data('placeholder');
		if (place_val != '') {
			$this.attr('placeholder',place_val);
		}
	});
	//Affichage du modal
	
	//Clique sur le bouton valider ou annuler
	$("[id^='validRelance']").on('click', function(e) {
		var $this = $(this),
			subOK = true;
		e.preventDefault();
		isValidFormRelance = $("#frmRelanceDevis").validate({
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			}
		}).form();

		if (subOK && isValidFormRelance) {
			// console.log("ok");
			var date_relance 			= $("#date_relance").val(),
				heure_relance 			= $("#heure_relance").val(),
				responsable_relance 	= $("#responsable_relance").val(),
				statut_relance 			= $("#statut_relance").val(),
				commentaire_relance 	= $("#commentaire_relance").val(),
				id_demande 				= $("#valueIdDemande").val();

			$.ajax({
				type : "POST",
				url : "ajax/ajaxAjoutRelanceDemande.php",
				data : {
					id_demande 				: id_demande,
					date_relance 			: date_relance,
					heure_relance 			: heure_relance,
					responsable_relance 	: responsable_relance,
					statut_relance 			: statut_relance,
					commentaire_relance 	: commentaire_relance
				},
				dataType: "html",
				/*beforeSend : function() {
					$this.html('<img src="images/page-load.gif" alt="" border="0" style="margin-top:0;margin-right:0">');
				},*/
				success : function(response) {
					// $("#liste_relance").html(response);
					console.log(response);
					// $("#frmRelanceDevis").submit();
					document.location.href="../../racine/liste_demande.php";
				},
				error: function(error) {
					console.error(error);
				}
			});

			/*$("#comptRelance").val(1);
			$("#frm_relance").submit();*/
		} else {
			var $obj = $('.form-control.error:first');
			$('body,html').animate({scrollTop:$obj.offset().top-20},1000);//+30
			return false;
		}
	});
});