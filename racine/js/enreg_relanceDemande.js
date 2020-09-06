$(document).ready(function() {
	$startDate = new Date(),
	$firstDate = new Date($startDate.getFullYear(), $startDate.getMonth() + 1, 0);

	id_demande = $("#valueIdDemande").val();

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
	$( function() {
		$(".datepicker").datepicker({
			minDate: $startDate,
			dateFormat: "yy-mm-dd"
		});
	});
	$("body").on("click", ".datepicker", function(){
        $(this).datepicker({
        	minDate: $startDate,
        	dateFormat: "yy-mm-dd"
        });
        $(this).datepicker("show");
    });
	$(function(){
		$("[id^='heure_relance_']").inputmask(
			"hh:mm", {
				placeholder: "HH:MM", 
				insertMode: false,
				showMaskOnHover: false,
				// hourFormat: 24
			}
		);
    });

	(function() {
		jQuery.creationTr = function(i) {
			$.ajax({type : "POST",
				url : "ajax/ajaxCreationTr.php",
				data : {
					i 				: i
				},
				dataType: "html",
				success : function(response) {
					$( ".datepicker" ).datepicker();
					$("#gestion_relance > tbody:last").append("<tr>" + $.trim(response) + "</tr>");
				},
				error: function(error) {
					console.error(error);
				}
			});
		}
	})(jQuery);

	(function() {
		jQuery.ajoutRelance = function(i) {
			$.ajax({type : "POST",
				url : "ajax/ajaxAjoutRelanceDemande.php",
				data : {
					id_demande 				: id_demande,
					date_relance 			: $('#date_relance_' + i).val(),
					heure_relance 			: $('#heure_relance_' + i).val(),
					responsable_relance 	: $('#responsable_relance_' + i).val(),
					statut_relance 			: $('#statut_relance_' + i).val(),
					commentaire_relance 	: $('#commentaire_relance_' + i).val()
				},
				dataType: "html",
				success : function(response) {
					console.log(response);
				},
				error: function(error) {
					console.error(error);
				}
			});
		}
	})(jQuery);

	(function() {
		jQuery.updateRelance = function(i) {
			var id_relance = $("#id_relance_" + i).val();
			$.ajax({type : "POST",
				url : "inc/update_relanceDemande.php",
				data : {
					valueIdRelance 		: id_relance,
					dateRelance 		: $('#date_relance_' + i).val(),
					heureRelance 		: $('#heure_relance_' + i).val(),
					responsableRelance 	: $('#responsable_relance_' + i).val(),
					statutRelance 		: $('#statut_relance_' + i).val(),
					commentaireRelance 	: $('#commentaire_relance_' + i).val()
				},
				dataType: "html",
				success : function(response) {
					console.log(response);
				},
				error: function(error) {
					console.error(error);
				}
			});
		}
	})(jQuery);
	var length_i = $("[id^='date_relance_']:visible").length;
	$.creationTr(length_i + 1);

	//Effet sur les placeholders
	$(document).on('focus', 'input, textarea', function() {
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

	// Affichage d'une nouvelle ligne dans le tableau des relances
	$i = 2;
	$(document).on('click',"[id^='date_relance_']",function(){
		var $spl = $(this).attr("id").split("_"),
			$indice = parseInt($("[id^='date_relance_']:visible:last").attr("id").split("_")[2]) + 1;
		console.log('$indice : ' + $indice);
		
		// $indice++;
		if ($spl[2] != 1) {
			$.creationTr($indice);	
		}
	});
	
	//Clique sur le bouton valider ou annuler
	$("[id^='saveRelance']").on('click', function(e) {
		var $this = $(this),
			subOK = true;
		e.preventDefault();
		/*isValidFormRelance = $("#frmRelanceDevis").validate({
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			} 
		}).form();*/

		// if (subOK && isValidFormRelance) {
		if (subOK) {
			$("#comptRelance").val(1);
			var i = 1;
			$("[id^='date_relance_']:visible").each(function(){
				if ($("#date_relance_" + i + ":visible") && ($("#date_relance_" + i).val() != '')) {
					if ($("#id_relance_" + i).val() == undefined) {
						if (($("#heure_relance_" + i).val() != undefined && $("#heure_relance_" + i).val() != '') || ($("#statut_relance_" + i).val() != undefined && $("#statut_relance_" + i).val() != '') || ($("#commentaire_relance_" + i).val() != undefined && $("#commentaire_relance_" + i).val() != '') || ($("#responsable_relance_" + i).val() != undefined && $("#responsable_relance_" + i).val() != '')) {
							$.ajoutRelance(i);
							console.log($("#responsable_relance_" + i).val()+ ", i : "+ i);
						}
						
					} else {
						if ((($("#date_relance_avant_" + i).val() != $("#date_relance_" + i).val()) || ($("#date_relance_" + i).val() != undefined)) || (($("#heure_relance_avant_" + i).val() != $("#heure_relance_" + i).val())|| ($("#heure_relance_" + i).val() != undefined)) || (($("#statut_relance_avant_" + i).val() != $("#statut_relance_" + i).val()) || ($("#statut_relance_" + i).val() != undefined)) || (($("#responsable_relance_avant_" + i).val() != $("#responsable_relance_" + i).val()) || ($("#responsable_relance_" + i).val() != undefined)) || (($("#commentaire_relance_avant_" + i).val() != $("#commentaire_relance_" + i).val()) || ($("#commentaire_relance_" + i).val() != undefined))) {
							$.updateRelance(i);
							console.log("i : " + i + $("#date_relance_" + i).val() + ' - ' + $("#heure_relance_" + i).val() + ' - ' + $("#statut_relance_" + i).val() + ' - ' + $("#responsable_relance_" + i).val() + ' - '+ ' - ' + $("#commentaire_relance_" + i).val() + ' - ' + $("#id_relance_" + i).val());
						}
					}
				}
				i++;
			});
			$("#frmRelanceDevis").submit();
		} else {
			var $obj = $('.form-control.error:first');
			$('body,html').animate({scrollTop:$obj.offset().top-20},1000);//+30
			return false;
		}
	});
	$(document).on("click", "#cancelRelance", function () {
		history.back();
	});
});