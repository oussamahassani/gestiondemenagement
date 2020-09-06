<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "inc/fct_all.php";

session_start ();
setlocale(LC_TIME, "fr_FR");

$mois_params = (isset($_GET['etablie_le'])) ? $_GET['etablie_le'] : '';
$mois_params = substr($mois_params, 0, 7);
$date = new DateTime($mois_params . '-01');
$date->modify('first day of this month');
$premier_jour_mois = $date->format('Y-m-d');

$date->modify('last day of this month');
$dernier_jour_mois = $date->format('Y-m-d');

if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	if (isset($_GET['statut_demande']) && !empty($_GET['statut_demande'])) {
		require_once "inc/header.php";
		require_once "inc/menu.php";
		require_once '../db.php';

		$date_en_cours = date("Ymd-His");
		$champs_demande = "
			SELECT
				dem.id_dem,
				dem.`etablie_le`,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				dem.date_dep,
				dem.code_postale_dep,
				dem.code_post_arr,
				dem.ville_dep,
				dem.volume,
				mpv.valeur prestation,
				dem.code_post_arr,
				vis.id_visite,
				vis.date_vis,
				CONCAT(u.nom, ' ', u.prenom) 'commercial',
				mpv_statut_vis.valeur statut_visite,
				dev.id_devis,
				date(dev.devis_etabli_le) devis_etabli_le,
				mpv_statut_dev.valeur statut_devis,
				mpv_statut_vis.valeur 'valeur_statut_visite',
				date(dem.date_creation) 'date_reception_demande',
				vis.date_vis
			FROM demande dem
		";

		$statut_demande = $_GET['statut_demande'];
		$nb_demande_mois_en_cours = '';
		switch ($statut_demande) {
			case 'qualif':
				$nb_demande_mois_en_cours = "
					INNER JOIN client c ON dem.id_client = c.id_client
					INNER JOIN devis dev ON dev.id_demande = dem.id_dem
					INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
					INNER JOIN visite vis ON vis.id_dem_vis = dem.id_dem
					INNER JOIN utilisateur u ON u.id_utilisateur = vis.id_com
					INNER JOIN masterParametreValeur mpv ON mpv.id = dem.prestation
					INNER JOIN masterParametreValeur mpv_statut_vis ON mpv_statut_vis.id = vis.id_statut_vis
					INNER JOIN masterParametreValeur mpv_statut_dev ON mpv_statut_dev.id = dev.id_statut
					WHERE
						(r_dem.id_Demande IS NOT NULL OR r_dem.id_Demande != '' OR r_dem.id_Demande != 0)
						AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
				";
			break;
			case 'trait':
				$nb_demande_mois_en_cours = "
					INNER JOIN client c ON dem.id_client = c.id_client
					INNER JOIN devis dev ON dev.id_demande = dem.id_dem
					INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
					INNER JOIN visite vis ON vis.id_dem_vis = dem.id_dem
					INNER JOIN utilisateur u ON u.id_utilisateur = vis.id_com
					INNER JOIN masterParametreValeur mpv ON mpv.id = dem.prestation
					INNER JOIN masterParametreValeur mpv_statut_vis ON mpv_statut_vis.id = vis.id_statut_vis
					INNER JOIN masterParametreValeur mpv_statut_dev ON mpv_statut_dev.id = dev.id_statut
					WHERE
				    (
				        vis.id_dem_vis IS NOT NULL 
				        OR vis.id_dem_vis != '' 
				        OR vis.id_dem_vis != 0 
				    )
				    AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
				";
			break;
			case 'non_pris':
				$nb_demande_mois_en_cours = "
					INNER JOIN client c ON dem.id_client = c.id_client
					INNER JOIN devis dev ON dev.id_demande = dem.id_dem
					LEFT JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
					LEFT JOIN visite vis ON vis.id_dem_vis = dem.id_dem
					INNER JOIN utilisateur u ON u.id_utilisateur = vis.id_com
					INNER JOIN masterParametreValeur mpv ON mpv.id = dem.prestation
					INNER JOIN masterParametreValeur mpv_statut_vis ON mpv_statut_vis.id = vis.id_statut_vis
					INNER JOIN masterParametreValeur mpv_statut_dev ON mpv_statut_dev.id = dev.id_statut
					WHERE 
						(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '' OR vis.id_dem_vis = 0) 
						AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '' OR r_dem.id_Demande = 0) 
						AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
				";
			break;
		}
		$query_demande = $champs_demande . $nb_demande_mois_en_cours;
		// echo $query_demande;
		$query_demande = mysqli_query($con, $query_demande);	
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
				<h4 class="mb-0">Liste des demandes</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
					<li class="breadcrumb-item active">Liste des demandes</li>
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
											<!-- <th>Date r&eacute;ception demande</th> -->
											<th>Date demande</th>
											<th style='width: 230px;'>Client</th>
											<!-- <th>Date de d&eacute;part</th> -->
											<th>Date d&eacute;part</th>
											<!-- <th>Code postal d&eacute;part</th> -->
											<th>CP d&eacute;part</th>
											<th>ville d&eacute;part</th>
											<th>Volume</th>
											<th>Prestation</th>
											<!-- <th>Code postal arriv&eacute;e</th> -->
											<th>CP arriv&eacute;e</th>
											<th>Visite</th>
											<th>Date visite</th>
											<th>Commercial</th>
											<th>Statut visite</th>
											<th>Devis</th>
											<th>Date devis</th>
											<th>Statut devis</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if ($query_demande) {
										$row_list_ca = mysqli_num_rows($query_demande);
										if ($row_list_ca > 0) {
											while($result=mysqli_fetch_array($query_demande)) {
											?>
												<tr>
													<form id='frm_list_relance_id' method='POST'>
														<td>
															<!-- <?= $result['id_dem']; ?> -->
															<a href='consultation_demande.php?id_demande=<?= $result['id_dem']; ?>' target='_blank'><?= $result['id_dem']; ?></a>
														</td>
														<!-- <td><?= $result['date_reception_demande']; ?></td> -->
														<td><?= format_date_fr($result['date_reception_demande']); ?></td>
														<td style='width: 230px;'><?= $result['raisonSociale']; ?></td>
														<!-- <td><?= $result['date_dep']; ?></td> -->
														<td><?= format_date_fr($result['date_dep']); ?></td>
														<td><?= $result['code_postale_dep']; ?></td>
														<td><?= $result['ville_dep']; ?></td>
														<td><?= $result['volume']; ?></td>
														<td><?= utf8_encode($result['prestation']); ?></td>
														<td><?= $result['code_post_arr']; ?></td>
														<td>
															<!-- <?= $result['id_visite']; ?> -->
															<a href="modif_visite.php?id_visite=<?= $result['id_visite']; ?>" target='_blank'>
																<?= $result['id_visite']; ?>
															</a>
														</td>
														<!-- <td><?= $result['date_vis']; ?></td> -->
														<td><?= format_date_fr($result['date_vis']); ?></td>
														<td><?= $result['commercial']; ?></td>
														<td><?= $result['valeur_statut_visite']; ?></td>
														<td>
															<!--<?= $result['id_devis']; ?>-->
															<a href="details_devis_c.php?dev=<?= $result['id_devis']; ?>" target='_blank'>
																<?= $result['id_devis']; ?>
															</a>
														</td>
														<!-- <td><?= $result['devis_etabli_le']; ?></td> -->
														<td><?= format_date_fr($result['devis_etabli_le']); ?></td>
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