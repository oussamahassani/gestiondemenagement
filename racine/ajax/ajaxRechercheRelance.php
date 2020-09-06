<?php
	$num_devis 				= $_POST['num_devis'];
	$client 				= $_POST['client'];
	$date_future_relance 	= $_POST['date_future_relance'];
	$statut_relance 		= $_POST['statut_relance'];	
	// echo "statut_relance : " . $statut_relance;
	// exit;
	try {

		$num_devis 					= (!empty($num_devis)) ? " AND rdv.idDevis = $num_devis" : "";
		$statut_relance 			= (!empty($statut_relance)) ? " AND mpvD.id = $statut_relance" : "";

		if (!empty($client)) {
			$client = " AND (c.nom LIKE '%$client%' OR c.prenom LIKE '%$client%' OR c.tel LIKE '%$client%' OR c.email LIKE '%$client%')";
		} else {
			$client = '';
		}

		$date_future_relance 		= (!empty($date_future_relance)) ? " AND rdv.dateRelance = ' $date_future_relance '" : '';

		require_once '../../connect.php';
		$query_search = "

			SELECT
				DISTINCT rdv.idDevis,
				MAX(rdv.id) id,
				CONCAT(c.civilite, ' ', CONCAT(c.nom, ' ', c.prenom)) raisonSociale,
				c.tel,
				CONCAT(d.code_postale_dep, ' - ', d.date_dep) infoDemenagement,
				d.volume,
				mpv.valeur prestation,
				dev.Prix_ttc,
				dev.Prix_ht,
				mpvD.valeur statutRelance,
				rdv.dateRelance,
				rdv.heureRelance
			FROM 
				demande d
			INNER JOIN client c ON d.id_client = c.id_client
			INNER JOIN devis dev ON dev.id_demande = d.id_dem
			INNER JOIN relanceDevis rdv ON rdv.idDevis = dev.id_devis
			LEFT JOIN masterParametreValeur mpvD ON rdv.idStatutRelance = mpvD.id
			INNER JOIN masterParametreValeur mpv ON mpv.id = d.prestation
			INNER JOIN (
				SELECT
					MAX(id) AS id
				FROM
					relanceDevis
				GROUP BY
					idDevis
			) topRelance ON rdv.id = topRelance.id
			AND rdv.id = topRelance.id
			WHERE
				1 $num_devis $client $date_future_relance $statut_relance
				/*AND rdv.idStatutRelance != 2*/
			GROUP BY rdv.idDevis
			ORDER BY rdv.dateRelance DESC
		";
		// echo $query_search;
		$req = mysql_query($query_search);

		?>
		<div id="resultatRecherche">
    <div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
			 <table id="datatable" class="table table-striped table-bordered p-0">
              
									<thead>
										<tr>
											<th>N° devis</th>
											<th>Nom et Pr&eacute;nom du client</th>
											<th>T&eacute;l&eacute;phone</th>
											<th style='width: 230px;'>Info d&eacute;m&eacute;nagement</th>
											<th>Volume</th>
											<th>Prestation</th>
											<th>Prix TTC</th>
											<th>Prix HT</th>
											<th>Date future relance</th>
											<th>Heure future relance</th>
											<th>Statut</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									while($result=mysql_fetch_array($req)) {
									?>
										<tr>
											<form id='frm_list_relance_id' method='POST'>
												<td><?= $result['idDevis']; ?></td>
												<td><?= $result['raisonSociale']; ?></td>
												<td><?= $result['tel']; ?></td>
												<td style='width: 230px;'><?= $result['infoDemenagement']; ?></td>
												<td><?= $result['volume']; ?></td>
												<td><?= $result['prestation']; ?></td>
												<td><?= $result['Prix_ttc']; ?></td>
												<td><?= $result['Prix_ht']; ?></td>
												<td><?= $result['dateRelance']; ?></td>
												<td><?= $result['heureRelance']; ?></td>
												<td><?= utf8_encode($result['statutRelance']); ?></td>
												<td><a href="enreg_relance2.php?relance=<?= $result['id']; ?>"><button type='button' class='btn btn-danger' id='updateRelance_<?= $result['id']; ?>'><i class='fa fa-edit'></i></button></a></td>
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
		mysqli_close($conn);
	} catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
	
?>
	
		
	
	
