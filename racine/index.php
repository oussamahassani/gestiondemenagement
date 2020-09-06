<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start ();

if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	require_once "inc/header.php"; 
	require_once "inc/menu.php";
	require_once "../db.php";
	// require "inc/dashboard.php";
?>
<!-- // Dashboard -->
<style type="text/css">
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	cursor: pointer;
}
/*.nav-tabs>li.active>a {
    cursor: pointer;
    background-color: brown !important;
    color: #fff !important;
}*/
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<div class="content-wrapper">
	<div class="page-title">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="mb-0">Dashboard</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
	    </div>
	</div>
	<div class="col-xs-12" style='margin-bottom: 10px;'>
	    <div class="direction-type-client txt-center" style='text-align: center;'>
	        <button id="services_left" class='btn btn-success'><i class="glyphicon glyphicon-chevron-left color-white"></i></button>
	        <button id="services_right" class='btn btn-success'><i class="glyphicon glyphicon-chevron-right color-white"></i></button>
	    </div>
	</div>
	<div id="resultatRecherche">
		<div class="row" id="dtlHtl_services">
			<div class="col-xl-12">
				<?php
					for ($i = 1; $i <= 12; $i++) {
						setlocale(LC_TIME, "fr_FR");
						$y = date('Y');
						$i_int = $i;
						$i = ($i < 10) ? ("0" . $i) : $i;
						$m = $y . '-' . $i;

						$mois_en_cours_char 	= strftime("%B", strtotime($m));
						$mois_en_cours = date('m');

						$date = new DateTime($m . '-01');
						$date = $date->format('Y-m-d');
						$date_en_cours 	= date('Y-m-d');
						$d_en_cours 	= date('d');

						$date_en_cours_systeme = $m . '-' . $d_en_cours;

						$month_hide = (trim($mois_en_cours) == $i) ? '' : 'hide';
				?>
				<div class="card card-statistics h-100 bg-clr-desc <?php echo $month_hide; ?>" data-services="<?php echo $i_int; ?>" data-currentmonth='<?php echo $i_int; ?>'>
					<div class="card-body">
						<ul class="nav nav-tabs">
							<!--<li class="active"><a data-toggle="tab" href="#home_<?php echo $i_int; ?>">Recap mensuel - <?php echo ucfirst(utf8_encode($mois_en_cours_char)); ?></a></li>-->
							<li class="active"><a data-toggle="tab" href="#home_<?php echo $i_int; ?>"><?php echo ucfirst(utf8_encode($mois_en_cours_char)) . ' ' . $y; ?></a></li>
							<!--<li><a data-toggle="tab" href="#menu_<?php echo $date_en_cours_systeme;?>">Recap du jour - <?php echo $date_en_cours_systeme; ?></a></li>-->
							<li><a data-toggle="tab" href="#menu_<?php echo $date_en_cours_systeme;?>">Recap Journalier</a></li>
						</ul>
						<div class="tab-content" id='retourNavigation_<?php echo $i_int; ?>'>
							<div id="home_<?php echo $i_int; ?>" class="tab-pane fade in active" data-mois='<?php echo $m; ?>'>
							</div>							
							<?php //include "inc/dashboard_mensuel.php" ;?>
							<div id="menu_<?php echo $date_en_cours_systeme;?>" class="tab-pane fade" data-jour='<?php echo $date_en_cours_systeme; ?>'>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>

				<input type='hidden' id='currentYear' value='<?php echo date('Y'); ?>'/>
				<input type='hidden' id='currentMonth' value='<?php echo date('m'); ?>'/>
				<input type='hidden' id='currentDay' value='<?php echo date('d'); ?>'/>
			</div>
		</div>
	</div>
<?php 
	require_once"inc/footer.php";
?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="js/navigation_dashboard.js?v=<?php echo date('Y-m-d H:i:s'); ?>"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
</div>
<?php
} else {
	header('location: ../login.php');
}
?>