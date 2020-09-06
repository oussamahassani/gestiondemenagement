<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$num_demande 					= $_POST['num_demande'];
	$client 						= $_POST['client'];
	$date_future_relance 			= $_POST['date_future_relance'];
	$statut_relance 				= $_POST['statut_relance'];
	$tel_client 					= $_POST['tel_client'];
	$date_chargement_relance 		= $_POST['date_chargement_relance'];
	// echo "statut_relance : " . $statut_relance;
	// exit;
	try {

		$num_demande 				= (!empty($num_demande)) ? " AND rdv.id_Demande = $num_demande" : "";
		$statut_relance 			= (!empty($statut_relance)) ? " AND mpvD.id = $statut_relance" : "";
		$tel_client 				= (!empty($tel_client)) ? " AND (c.tel LIKE '%$tel_client%' OR c.telMobile LIKE '%$tel_client%')" : "";
		$date_chargement_relance 	= (!empty($date_chargement_relance)) ? " AND d.date_dep = ' $date_chargement_relance '" : "";
		$date_future_relance 		= (!empty($date_future_relance)) ? " AND rdv.date = ' $date_future_relance '" : '';

		if (!empty($client)) {
			$client = " AND (c.nom LIKE '%$client%' OR c.prenom LIKE '%$client%' OR c.tel LIKE '%$client%' OR c.email LIKE '%$client%')";
		} else {
			$client = '';
		}


		require_once '../../db.php';
		$query_search = "

			SELECT
				DISTINCT rdv.id_Demande,
				MAX(rdv.id) id,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				(
			        CASE
			            WHEN c.tel <> '' THEN c.tel
			            WHEN c.tel = '' AND c.telMobile <> '' THEN c.telMobile
			        ELSE
			    		NULL
			    	END
			    ) tel,
				CONCAT(d.code_postale_dep, ' - ', d.date_dep) infoDemenagement,
				d.volume,
				mpvD.valeur statutRelance,
				rdv.date,
				rdv.heure
			FROM
				demande d
			INNER JOIN client c ON d.id_client = c.id_client
			INNER JOIN RelanceDemande rdv ON rdv.id_Demande = d.id_dem
			LEFT JOIN masterParametreValeur mpvD ON rdv.statut = mpvD.id
			INNER JOIN (
				SELECT
					MAX(id) AS id
				FROM
					RelanceDemande
				GROUP BY
					id_Demande
			) topRelance ON rdv.id = topRelance.id
			AND rdv.id = topRelance.id
			WHERE
				1 $num_demande $client $tel_client $date_future_relance $statut_relance $date_chargement_relance
			GROUP BY rdv.id_Demande
			ORDER BY rdv.date DESC
		";
		// echo $query_search;
		$req = mysqli_query($con, $query_search);
		if ($req) {
		?>
		<div id="resultatRecherche">
			<div class="row">
				<div class="col-xl-12 mb-30">
					<div class="card card-statistics h-100">
						<div class="card-body">
							<div class="table-responsive" id="resultatRecherche">
								<!-- <table id="datatable" class='table table-border table-striped p-0'> -->
								<table id="datatable" class="table table-striped table-bordered p-0">
									<thead>
										<tr>
											<th>N° demande</th>
											<th>Nom et Pr&eacute;nom du client</th>
											<th>T&eacute;l&eacute;phone</th>
											<th style='width: 230px;'>Info d&eacute;m&eacute;nagement</th>
											<th>Volume</th>
											<th>Date relance</th>
											<th>Heure relance</th>
											<th>Statut</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									while($result=mysqli_fetch_array($req)) {
									?>
										<tr>
											<form id='frm_list_relance_id' method='POST'>
												<td><?= $result['id_Demande']; ?></td>
												<td><?= $result['raisonSociale']; ?></td>
												<td><?= $result['tel']; ?></td>
												<td style='width: 230px;'><?= $result['infoDemenagement']; ?></td>
												<td><?= $result['volume']; ?></td>
												<td><?= $result['date']; ?></td>
												<td><?= $result['heure']; ?></td>
												<td><?= utf8_encode($result['statutRelance']); ?></td>
												<td><a href="enreg_relanceDemande.php?relance=<?= $result['id']; ?>"><button type='button' class='btn btn-danger' id='updateRelance_<?= $result['id']; ?>'><i class='fa fa-edit'></i></button></a></td>
											</form>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
		}
		mysqli_close($con);
	} catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
	
?>
	
		
	
	
