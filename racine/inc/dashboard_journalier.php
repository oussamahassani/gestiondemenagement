<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_TIME, "fr_FR");

require_once "../../db.php";

$year_selected 			= $_POST['year_selected'];
$month_selected 		= $_POST['month_selected'];
$day_selected 			= $_POST['day_selected'];

$date_en_cours 			= $year_selected . '-' . $month_selected . '-' . $day_selected;

// $date_en_cours_systeme 	= date('d-m-Y');
$date_en_cours_systeme 	= $day_selected . '-' . $month_selected . '-' . $year_selected;

$m = $year_selected . '-' .$month_selected;

$date = new DateTime($m . '-01');
$date->modify('first day of this month');
$premier_jour_mois = $date->format('Y-m-d');

$premier_d = explode('-', $premier_jour_mois);
$premier_d = end($premier_d);

$date->modify('last day of this month');
$dernier_jour_mois = $date->format('Y-m-d');

$dernier_d = explode('-', $dernier_jour_mois);
$dernier_d = end($dernier_d);

$mois_hide = ($moins_en_cours = $m) ? '' : 'hide';
?>
<style>
a.active.show {
    cursor: pointer;
}
#chartdiv {
	width: 100%;
	height: 500px;
}
.hg-chart {
	height: 350px;
	width: 48%;
	float: left;
	display: inline-block;
	margin-top: -10px;
	/*margin-left: 15px;*/
	overflow: auto!important;
	margin-bottom: 20px;
}
table.width_espace {
	width: 50%!important;  
	text-align: center;
}
table.width_espace2 {
	width: 25%!important;     
	text-align: center;
}
.width_espace_td:first-child {
 	background: #333f50;
 	color: white;
 	width: 25%!important;
}
.width_espace_td2:first-child {
	background: #333f50;
	color: white;
	width: 50%!important;
}
.blocGraph {
    float: right;
    display: inline-block;
}
text.highcharts-credits {
    display: none;
}
.nav-justified>li {
    /* display: table-cell; */
    width: auto!important;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	cursor: pointer;
}
</style>
<div class="col-xs-12" style='margin-bottom: 10px;'>
    <div class="direction-type-client txt-center" style='text-align: center;'>
        <button id="dir_left" class='btn btn-primary'><i class="glyphicon glyphicon-chevron-left color-white"></i></button>
        <button id="dir_right" class='btn btn-primary'><i class="glyphicon glyphicon-chevron-right color-white"></i></button>
    </div>
</div>
<div class="table-responsive" id="dtlDay_dir">
	<?php
		// echo 'premier : '  . $premier_d . ', ' . $dernier_d;
		for ($j = 1; $j <= $dernier_d; $j++) {
			$d = $year_selected . '-' . $month_selected . '-' . $j;
			$d_syst = $j . '-' . $month_selected . '-' . $year_selected;
			$date_hide = (trim($date_en_cours_systeme) == $d_syst) ? '' : 'hide';
	?>
	<div class="bg-clr-desc-day <?php echo $date_hide; ?>" data-dir="<?php echo $j; ?>" data-currentmonth=''>
		<input type='hidden' id='day_<?php echo $d; ?>'>
		<div class="col-xl-12">
			<h3 style='text-align: center;'>Recap du jour - <?php echo $d_syst; ?></h3>
		</div>
	</div>
	<div id='retourNavigationJour_<?php echo $d; ?>' class='hide'></div>
	<?php
		}
	?>
	<!-- <div id='test'></div> -->
</div>