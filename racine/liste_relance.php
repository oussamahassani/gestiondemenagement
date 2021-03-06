<?php
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	require_once "inc/header.php";
	require_once "inc/menu.php";
	require_once '../connect.php';
	include "inc/mod_statutParametre.php";
	include "inc/mod_utilisateur.php";

	$date_en_cours = date("Ymd-His");

	$query_status_parameter = "
		SELECT id, valeur 
		FROM `masterParametreValeur` mpv
		WHERE idMasterParametre = 11
	";
	$que_get_status_parameter     = mysql_query($query_status_parameter);

?>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/default.css?v=1' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<!-- <link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css' /> -->
<style type="text/css">
	.page-item.active .page-link {
		background-color: #84ba3f !important;
	    border-color: #84ba3f !important;
	}
	/*.col-md-3 {
	    -webkit-box-flex: 0;
	    -ms-flex: 0 0 25%;
	    flex: 0 0 24%;
	}*/
	.datepicker {
		width: 100% !important;
	}
	.card-body {
		font-size: 0.87rem !important;
		padding: 0;
	}
	.table th {
	    vertical-align: middle;
	}
	.table th, .table td {
	    vertical-align: middle;
	    padding: .30rem;
	}
	thead th {
	    background-color: #FFA500;
	}
	.table {
		border-collapse: separate !important;
	}
	.table tbody tr:nth-child(even) {
		background-color: #7CFC00;
	}
	.table tbody tr:nth-child(odd) {
		background-color: #B0E0E6;
	} 
	
</style>
<div class="content-wrapper overfl-auto">

    <!-- <div class="row">
		<div class="col-md-12">
			<form id='enreg_relance' method='POST' action='enreg_relance.php'>
				<button type='submit' class='btn btn-primary fl-left'>
					<i class='fa fa-plus'></i>
					Ajouter une relance
				</button>
			</form>
		</div>
	</div> -->
	<div class="row">
		<div class="col-md-12 mrg-35">
			<div class="">
				<form>
					<div class="row">
						<div class="col-md-3">
							<label for='num_devis'>N&deg; devis</label>
							<input type='text' id='num_devis' name='num_devis' class='form-control'>
						</div>
						<div class="col-md-3">
							<label for='client'>Client</label>
							<input type='text' id='client' name='client' class='form-control'>
						</div>
						<div class="col-md-3">
							<label for='date_future_relance'>Date future relance</label>
							<input type='text' id='date_future_relance' name='date_future_relance' class='form-control datepicker'>
						</div>
						<div class="col-md-3">
							<label for='statut_relance'>Statut relance</label>
							<select name='statut_relance' id='statut_relance' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
								<?php
									while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
										echo "<option value=" . $result_status_parameter['id'] . ">". utf8_encode($result_status_parameter['valeur']) . "</option>";
									}
								?>
							</select>
						</div>
					</div>					
					<button type='button' class='btn btn-success btn-fl-left' id='rechercher_relance' style='margin-top: 10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
				</form>
			</div>
		</div>
	</div>
	<div id='liste_relance'></div>
<?php
	require_once"inc/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->
<script type="text/javascript" src='js/bootstrap-datatables/jquery.dataTables.min.js'></script>
<script src="js/gestion_relance.js?v=<?php echo $date_en_cours; ?>"></script>
</div>
<?php
} else {
	header('location: ../login.php');
}
?>