$(document).ready(function() {
	(function(){
		jQuery.loadNavigation = function(y, m, d){
			$.ajax({
				type: "POST", 
				url: "inc/dashboard_mensuel.php",
				data: {
					year_selected: y,
					month_selected: m,
					day_selected: d
				},
				dataType: "html",
				cache: false,
				success : function(ct){
					$('#home_'+m).html(ct);
				},
				error : function(error){
					console.log(error);
				},
			});
		}
	})(jQuery);

	(function(){
		jQuery.loadNavigationJour = function(y, m, d){
			m = (m > 0 && m <= 9) ? ('0'+m) : m;
			var date_jour = y + '-' + m + '-' + d;
			$.ajax({
				type: "POST", 
				url: "inc/dashboard_journalier.php",
				data: {
					year_selected: y,
					month_selected: m,
					day_selected: d
				},
				dataType: "html",
				cache: false,
				success : function(ct){
					$('#menu_'+date_jour).html(ct);
				},
				error : function(error){
					console.log(error);
				},
			});
		}
	})(jQuery);

	(function(){
		jQuery.loadTraitementNavigationJour = function(y, m, d){
			m = (m > 0 && m <= 9) ? ('0'+m) : m;
			var date_jour = y + '-' + m + '-' + d;
			$.ajax({
				type: "POST", 
				url: "inc/traitement_dashboard_journalier.php",
				data: {
					year_selected: y,
					month_selected: m,
					day_selected: d
				},
				dataType: "html",
				cache: false,
				success : function(ct){
					/*if ($('#menu_'+date_jour).find('#test')) {
						console.log('date_jour : ' + date_jour);
						$('#menu_'+date_jour).find('#test').html(ct);
					} else console.log('ko');*/
					if ($('#retourNavigationJour_'+date_jour).hasClass('hide')) $('#retourNavigationJour_'+date_jour).removeClass('hide');
					else $('#retourNavigationJour_'+date_jour).addClass('hide');

					$('#retourNavigationJour_'+date_jour).html(ct);
					// console.log('date_jour : ' + $('#retourNavigationJour_'+date_jour).attr("id").split('_')[1]);
				},
				error : function(error){
					console.log(error);
				},
			});
		}
	})(jQuery);

	var year_selected 	= Number($("#currentYear").val()),
		month_selected 	= Number($("#currentMonth").val()),
		day_selected 	= Number($("#currentDay").val()),
		date_completed 	= year_selected + '-' + month_selected + '-' + day_selected;
	$.loadNavigation(year_selected, month_selected, day_selected);
	$.loadNavigationJour(year_selected, month_selected, day_selected);
	$.loadTraitementNavigationJour(year_selected, month_selected, day_selected);

	$(document).on('click', '[id^=services_]', function (e) {
	    var $this = $(this),
	        _hid = true,
	        $tabDesc = $('[id^="dtlHtl_"]').attr('id').split('_')[1],
	        $sp1 = $this.attr('id').split('_')[1];
	    if ($('.bg-clr-desc').length > 0) {
	        var _curPhts = $('.bg-clr-desc:visible:last').data($tabDesc),
	            _lstPhts = $('#dtlHtl_'+$tabDesc).find('.bg-clr-desc:last').data($tabDesc),
	            _frstCh = $('#dtlHtl_'+$tabDesc).find('.bg-clr-desc:first').data($tabDesc),
	            _nxPhts = Number(_curPhts)+1,
	            _prPhts = Number(_curPhts)-1;
            // if ($('.bg-clr-desc:visible:last').data($tabDesc) > 0 && $('.bg-clr-desc:visible:last').data($tabDesc) <= 12) {
            if ($('.bg-clr-desc:visible:last').data($tabDesc) > 0) {
        	    if ($sp1 == 'left') {
        	        if(Number(_curPhts) == 1) {
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_lstPhts+']').removeClass('hide');
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	            // $.loadNavigation(_lstPhts);
        	        } else if(Number(_curPhts) > 1) {
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_prPhts+']').removeClass('hide');
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	        } else _hid = true
        	        $.loadNavigation(year_selected, _prPhts, day_selected);
        	        $.loadNavigationJour(year_selected, _prPhts, day_selected);
        	        $.loadTraitementNavigationJour(year_selected, _prPhts, day_selected);
        	    } else {
        	        if ($('.bg-clr-desc[data-'+$tabDesc+'='+_nxPhts+']:hidden').length > 0) {
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_nxPhts+']').removeClass('hide');
        	        } else if(Number(_curPhts) == _lstPhts) {
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_frstCh+']:first-child').removeClass('hide');
        	            $('.bg-clr-desc[data-'+$tabDesc+'='+_lstPhts+']').addClass('hide');
        	            console.log('visible : ' + _frstCh + ', ' + _lstPhts);
        	        } else _hid = true;
        	        $.loadNavigation(year_selected, _nxPhts, day_selected);
        	        $.loadNavigationJour(year_selected, _nxPhts, day_selected);
        	        $.loadTraitementNavigationJour(year_selected, _nxPhts, day_selected);
        	    }
            }	        
	    } else _hid = true;
	});

	$(document).on('click', '[id^=dir_]', function (e) {
	    var $this = $(this),
	        _hid = true,
	        $tabDesc = $('[id^="dtlDay_"]').attr('id').split('_')[1],
	        $sp1 = $this.attr('id').split('_')[1];
	    if ($('.bg-clr-desc-day').length > 0) {
	        var _curPhts = $('.bg-clr-desc-day:visible:last').data($tabDesc),
	            _lstPhts = $('#dtlDay_'+$tabDesc).find('.bg-clr-desc-day:last').data($tabDesc),
	            _frstCh = $('#dtlDay_'+$tabDesc).find('.bg-clr-desc-day:first').data($tabDesc),
	            _nxPhts = Number(_curPhts)+1,
	            _prPhts = Number(_curPhts)-1;
            if ($('.bg-clr-desc-day:visible:last').data($tabDesc) > 0) {
        	    if ($sp1 == 'left') {
        	        if(Number(_curPhts) == 1) {
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_lstPhts+']').removeClass('hide');
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	            // $.loadNavigation(_lstPhts);
        	        } else if(Number(_curPhts) > 1) {
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_prPhts+']').removeClass('hide');
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	        } else _hid = true
        	        // $.loadTraitementNavigationJour(year_selected, _prPhts, day_selected);
        	        var d_jour 			= year_selected + '-' + month_selected + '-' + _prPhts,
        	        	current_jour 	= year_selected + '-' + month_selected + '-' + _curPhts;
        	        /*if ($('#retourNavigationJour_'+d_jour).hasClass('hide')) $('#retourNavigationJour_'+d_jour).removeClass('hide');
					else $('#retourNavigationJour_'+d_jour).addClass('hide');*/
					/*$('#retourNavigationJour_'+d_jour).removeClass('hide');
					$('#retourNavigationJour_'+d_jour).removeClass('hide');*/
					console.log('LEFT : last : ' + _lstPhts + ', current : ' + _curPhts + ', prev : ' + _prPhts);
					$('#retourNavigationJour_'+current_jour).addClass('hide');
        	        $.loadTraitementNavigationJour(year_selected, month_selected, _prPhts);
        	        
        	    } else {
        	        if ($('.bg-clr-desc-day[data-'+$tabDesc+'='+_nxPhts+']:hidden').length > 0) {
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_curPhts+']').addClass('hide');
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_nxPhts+']').removeClass('hide');
        	            // $.loadNavigation(_nxPhts);
        	        } else if(Number(_curPhts) == _lstPhts) {
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_frstCh+']:first-child').removeClass('hide');
        	            $('.bg-clr-desc-day[data-'+$tabDesc+'='+_lstPhts+']').addClass('hide');
        	        } else _hid = true;
        	        console.log('RIGHT : last : ' + _lstPhts + ', _curPhts : ' + _curPhts + ', _nxPhts : ' + _nxPhts + ', _frstCh : ' + _frstCh);

        	        var d_jour 			= year_selected + '-' + month_selected + '-' + _nxPhts,
        	        	current_jour 	= year_selected + '-' + month_selected + '-' + _curPhts;
    	        	$('#retourNavigationJour_'+current_jour).addClass('hide');
        	        /*if ($('#retourNavigationJour_'+d_jour).hasClass('hide')) $('#retourNavigationJour_'+d_jour).removeClass('hide');
					else $('#retourNavigationJour_'+d_jour).addClass('hide');*/
        	        $.loadTraitementNavigationJour(year_selected, month_selected, _nxPhts);
        	    }
            }
	    } else {
	    	_hid = true;
	    }
	});
});