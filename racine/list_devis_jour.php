<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "inc/fct_all.php";

session_start ();
setlocale(LC_TIME, "fr_FR");

$devis_etabli_le = $_GET['devis_etabli_le'];

$mois_params = (isset($devis_etabli_le)) ? $devis_etabli_le : '';

if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	if (isset($_GET['statut_devis']) && !empty($_GET['statut_devis'])) {
		require_once "inc/header.php";
		require_once "inc/menu.php";
		require_once '../db.php';

		$date_en_cours = date("Ymd-His");

		$id_statut_devis = $_GET['statut_devis'];

		// Liste des demandes ayant champ source demande = source selectionnée
		$query_list_ca = "
			SELECT
				dev.id_devis,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				d.date_dep,
				d.code_postale_dep,
				d.code_post_arr,
				d.volume,
				dev.Prix_ht,
				mpv.valeur prestation,
				date(dev.devis_etabli_le) 'devis_etabli_le'				
			FROM 
				demande d
			INNER JOIN client c ON d.id_client = c.id_client
			INNER JOIN masterParametreValeur mpv ON mpv.id = d.prestation
			INNER JOIN devis dev ON dev.id_demande = d.id_dem
			WHERE
				dev.id_statut = $id_statut_devis
				AND date(dev.devis_etabli_le) = '$devis_etabli_le'
		";
		// echo '<pre>' . $query_list_ca . '</pre>';
		$query_list_ca = mysqli_query($con, $query_list_ca);	
?>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/default.css?v=1' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<style type="text/css">
	/*.page-item.active .page-link {
		background-color: #84ba3f !important;
	    border-color: #84ba3f !important;
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
	/*thead th {
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
	}*/
	div.dataTables_wrapper div.dataTables_filter {
	    display: none;
	}
</style>
<div class="content-wrapper overfl-auto">
	<div class="page-title">
      	<div class="row">
			<div class="col-sm-6">
				<h4 class="mb-0">Liste des Sources Leads du <?php echo format_date_fr($devis_etabli_le); ?></h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
					<li class="breadcrumb-item active">Liste des Sources Leads</li>
				</ol>
			</div>
        </div>
    </div>
	<div id='liste_relance'>
		<div id="resultatRecherche">
			<div class="row">
				<div class="col-xl-12 mb-30">
					<div class="card card-statistics h-100">
						<div class="card-body">
							<div class="table-responsive" id="resultatRecherche">
								<table id="datatable" class="table table-striped table-bordered p-0">
									<thead>
										<tr>
											<th>N° demande</th>
											<th style='width: 230px;'>Client</th>
											<th>Date de d&eacute;part</th>
											<th>Code postal d&eacute;part</th>
											<th>Code postal arriv&eacute;e</th>
											<th>Prestation</th>
											<th>Volume</th>
											<th>Tarif HT</th>
											<th>Date cr&eacute;ation devis</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if ($query_list_ca) {
										$row_list_ca = mysqli_num_rows($query_list_ca);
										if ($row_list_ca > 0) {
											while($result=mysqli_fetch_array($query_list_ca)) {
											?>
												<tr>
													<form id='frm_list_relance_id' method='POST'>
														<td>
															<a href="details_devis_c.php?dev=<?= $result['id_devis']; ?>" target='_blank'>
																<?= $result['id_devis']; ?>
															</a>
														</td>
														<td style='width: 180px;'><?= $result['raisonSociale']; ?></td>
														<!-- <td><?= $result['date_dep']; ?></td> -->
														<td><?= format_date_fr($result['date_dep']); ?></td>
														<td><?= $result['code_postale_dep']; ?></td>
														<td><?= $result['code_post_arr']; ?></td>
														<td><?= utf8_encode($result['prestation']); ?></td>		
														<td><?= $result['volume']; ?></td>
														<td><?= $result['Prix_ht']; ?></td>
														<!-- <td><?= $result['devis_etabli_le']; ?></td> -->
														<td><?= format_date_fr($result['devis_etabli_le']); ?></td>
													</form>
												</tr>
											<?php
											}
										}
									} else echo mysqli_error($con);
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	require_once"inc/footer.php";
?>
</div>
<?php
	} else {
		header('location: ../index.php');
	}
} else {
	header('location: ../login.php');
}
?>