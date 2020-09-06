<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "inc/fct_all.php";

session_start ();
setlocale(LC_TIME, "fr_FR");

if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	// if (isset($_GET['date_vis']) && !empty($_GET['date_vis'])) {
	if (isset($_GET['date_vis']) && isset($_GET['id_statut_vis'])) {
		require_once "inc/header.php";
		require_once "inc/menu.php";
		require_once '../db.php';

		$date_en_cours = date("Ymd-His");

		$date_vis 		= $_GET['date_vis'];		
		$id_statut_vis 	= $_GET['id_statut_vis'];

		// Liste des demandes ayant champ source demande = source selectionnée
		$query_list_ca = "
			SELECT
				v.id_visite,
				v.date_vis,
				v.heure_vis,
				mpv.valeur,
				CONCAT(u.nom, ' ', u.prenom) 'raisonSocialeCommerciale',
				d.id_dem,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				d.date_dep,
				d.code_postale_dep,
				d.ville_dep,
				d.volume,
				mpv_prestation.valeur prestation
			FROM 
				demande d
			LEFT JOIN client c ON d.id_client = c.id_client
			LEFT JOIN visite v ON d.id_dem = v.id_dem_vis
			LEFT JOIN masterParametreValeur mpv ON mpv.id = v.id_statut_vis
			LEFT JOIN masterParametreValeur mpv_prestation ON mpv_prestation.id = d.prestation
			LEFT JOIN utilisateur u ON u.id_utilisateur = v.id_com
			WHERE
				v.id_statut_vis = $id_statut_vis
				AND v.date_vis 	= '$date_vis'
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
				<h4 class="mb-0">Liste des visites</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
					<li class="breadcrumb-item active">Liste des visites</li>
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
											<th>N° visite</th>
											<th>Date visite</th>
											<th>Heure visite</th>
											<th>Statut visite</th>
											<th>Nom du Commercial</th>
											<th>Demande</th>
											<th>Client</th>
											<th>Date d&eacute;part</th>
											<th>Code postal d&eacute;part</th>
											<th>Ville d&eacute;part</th>
											<th>Volume</th>
											<th>Prestation</th>
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
															<a href="modif_visite.php?id_visite=<?= $result['id_visite']; ?>" target='_blank'>
																<?= $result['id_visite']; ?>
															</a>
														</td>
														<!-- <td><?= $result['date_vis']; ?></td> -->
														<td><?= format_date_fr($result['date_vis']); ?></td>
														<td><?= $result['heure_vis']; ?></td>
														<td><?= $result['valeur']; ?></td>
														<td><?= $result['raisonSocialeCommerciale']; ?></td>
														<td><a href='consultation_demande.php?id_demande=<?= $result['id_dem']; ?>' target='_blank'><?= $result['id_dem']; ?></a></td>
														<td><?= $result['raisonSociale']; ?></td>
														<td><?= format_date_fr($result['date_dep']); ?></td>
														<td><?= $result['code_postale_dep']; ?></td>
														<td><?= $result['ville_dep']; ?></td>
														<td><?= $result['volume']; ?></td>
														<td><?= $result['prestation']; ?></td>
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