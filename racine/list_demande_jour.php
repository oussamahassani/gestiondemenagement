<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "inc/fct_all.php";

session_start ();
setlocale(LC_TIME, "fr_FR");

$etablie_le = $_GET['etablie_le'];

$mois_params = (isset($etablie_le)) ? $etablie_le : '';

// echo '<pre>params : ' . $premier_jour_mois, $dernier_jour_mois . '</pre>';
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	if (isset($_GET['id_source']) && !empty($_GET['id_source'])) {
		require_once "inc/header.php";
		require_once "inc/menu.php";
		require_once '../db.php';

		$date_en_cours = date("Ymd-His");

		$id_source = $_GET['id_source'];

		// Liste des demandes ayant champ source demande = source selectionnée
		$query_list_ca = "
			SELECT
				d.id_dem,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				CONCAT(c.tel, ' - ', c.telMobile) telClient,
				d.date_dep,
				d.code_postale_dep,
				d.code_post_arr,
				d.volume,
				mpv.valeur prestation,
				date(d.date_creation) 'date_reception_demande',
				v.id_visite,
				(
					CASE
						WHEN v.id_visite IS NOT NULL THEN v.date_vis
						ELSE ''
					END
				) 'date_visite',
				(
					CASE
						WHEN v.id_visite IS NOT NULL THEN CONCAT(u.nom, ' ', u.prenom)
						ELSE ''
					END
				) 'raisonSocialeCommerciale',
				(
					CASE
						WHEN dev.id_statut = 46 AND dev.id_devis IS NOT NULL THEN dev.id_devis
						ELSE ''
					END
				) 'devis',
				(
					SELECT mpv.valeur
					FROM `masterParametreValeur` mpv WHERE id = dev.id_statut
				) 'statut_devis'				
			FROM 
				demande d
			INNER JOIN client c ON d.id_client = c.id_client
			INNER JOIN masterParametreValeur mpv ON mpv.id = d.prestation
			INNER JOIN visite v ON d.id_dem = v.id_dem_vis
			INNER JOIN source s ON s.id_source = d.id_source
			INNER JOIN utilisateur u ON u.id_utilisateur = v.id_com
			INNER JOIN devis dev ON dev.id_demande = d.id_dem
			WHERE
				s.id_source = $id_source
				AND date(d.date_creation) = '$etablie_le'
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
				<h4 class="mb-0">Liste des Sources Leads du <?php echo format_date_fr($etablie_le); ?></h4>
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
											<th>T&eacute;l&eacute;phone</th>
											<th>Date de d&eacute;part</th>
											<th>Code postal d&eacute;part</th>
											<th>Code postal arriv&eacute;e</th>
											<!-- <th>Distance</th> -->
											<th>Volume</th>
											<th>Prestation</th>
											<th>Date r&eacute;ception demande</th>
											<th>Visite</th>
											<th>Date visite</th>
											<th>Commercial</th>
											<th>Devis</th>
											<th>Statut devis</th>
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
														<td><a href='consultation_demande.php?id_demande=<?= $result['id_dem']; ?>' target='_blank'><?= $result['id_dem']; ?></a></td>
														<td style='width: 230px;'><?= $result['raisonSociale']; ?></td>
														<td><?= $result['telClient']; ?></td>
														<!-- <td><?= $result['date_dep']; ?></td> -->
														<td><?= format_date_fr($result['date_dep']); ?></td>
														<td><?= $result['code_postale_dep']; ?></td>
														<td><?= $result['code_post_arr']; ?></td>
														<td><?= $result['volume']; ?></td>
														<td><?= utf8_encode($result['prestation']); ?></td>														
														<!-- <td><?= $result['date_reception_demande']; ?></td> -->
														<td><?= format_date_fr($result['date_reception_demande']); ?></td>
														<td>
															<?php 
																if (!empty($result['id_visite'])) echo 'Oui';
																else echo 'Non';
															?>
														</td>
														<!-- <td><?= $result['date_visite']; ?></td> -->
														<td><?= format_date_fr($result['date_visite']); ?></td>
														<td><?= $result['raisonSocialeCommerciale']; ?></td>
														<td>
															<a href="details_devis_c.php?dev=<?= $result['devis']; ?>" target='_blank'>
																<?= $result['devis']; ?>
															</a>
														</td>
														<td><?= $result['statut_devis']; ?></td>
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