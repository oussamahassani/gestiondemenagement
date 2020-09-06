<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "../../db.php";
setlocale(LC_TIME, "fr_FR");

$dernier_jour_mois 		= date('Y-m-d', strtotime('last day of this month', time()));
$premier_jour_mois 		= date('Y-m-01');
$date_en_cours 			= date('Y-m-d');
$date_en_cours_systeme 	= date('d-m-Y');

$y = $_POST['year_selected'];
$m = $_POST['month_selected'];
$d = $_POST['day_selected'];
// $y = date('Y');
$moins_en_cours = $y . '-' . $m;
$date_longue = $moins_en_cours . '-' . $d;

$date = new DateTime($moins_en_cours . '-01');
$date->modify('first day of this month');
$premier_jour_mois = $date->format('Y-m-d');

$date->modify('last day of this month');
$dernier_jour_mois = $date->format('Y-m-d');

// Chiffre d'affaire global
$query_ca = "
	SELECT
		date(`devis_etabli_le`) 'devis_etabli_le',
		ROUND(SUM(Prix_ht), 2) Prix_ht, 
		ROUND(SUM(Prix_ttc), 2) Prix_ttc
	FROM `devis`
	WHERE 
		id_statut = 46
		AND date(`devis_etabli_le`) BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Nb chaniter
function fct_nb_chantier($cond_ca) {
	$nb_chantier = "
		SELECT
			dem.date_dep 'date_dep',
			COUNT(*) 'nb_chantier'
		FROM `devis` dev
		INNER JOIN demande dem ON dev.id_demande = dem.id_dem
		WHERE
			dev.id_statut = 46
		    AND dem.date_dep " . $cond_ca;

	return $nb_chantier;
}
$nb_chantier_mois_en_cours = fct_nb_chantier("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

// Source leads
function fct_source_leads($cond_source_leads) {
	$source_leads = "
		SELECT
			dem.`etablie_le`,
			s.nom_source,
			s.id_source,
			COUNT(*) nb_source,
		    (ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `demande` WHERE `etablie_le` " . $cond_source_leads . "), 2)) pourcentage_source
		FROM `demande` dem
		INNER JOIN `source` s ON s.id_source = dem.id_source
		WHERE
		   dem.`etablie_le` " . $cond_source_leads . "
		GROUP BY s.nom_source
	";

	return $source_leads;
}
$nb_source_mois_en_cours = fct_source_leads("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

// Devis
function fct_devis($cond_devis) {
	$devis = "
		SELECT
			date(dev.`devis_etabli_le`) 'devis_etabli_le',
			mvp.valeur,
			dev.id_statut,
			COUNT(*) nb_devis,
		    (ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `devis` WHERE date(`devis_etabli_le`) " . $cond_devis . "), 2)) pourcentage_devis
		FROM `devis` dev
		INNER JOIN `masterParametreValeur` mvp ON mvp.id = dev.id_statut
		WHERE
		   date(dev.`devis_etabli_le`) " . $cond_devis . "
		GROUP BY mvp.valeur
	";
	return $devis;
}
$nb_devis_mois_en_cours = fct_devis("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
$get_nb_devis = "
	SELECT
		COUNT(*) nb_total_devis
	FROM `devis` dev
	WHERE
	   date(dev.`devis_etabli_le`) BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Visite
function fct_visite($cond_visite) {
	$visite = "
		SELECT
			vis.date_vis,
			vis.id_statut_vis,
			COUNT(*) nb_visite,
			mvp.valeur,
			CONCAT(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` " . $cond_visite . "), 2)) pourcentage_visite
		FROM `visite` vis
		INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
		WHERE
		   vis.`date_vis` " . $cond_visite . "
		GROUP BY mvp.valeur
	";

	return $visite;
}
$nb_visite_mois_en_cours = fct_visite("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
$get_nb_total_visite = "
	SELECT
		COUNT(*) nb_total_visite
	FROM `visite` vis
	WHERE
	   vis.`date_vis` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Activite commerciale
function fct_activite_com($cond_active_com) {
	/*
	SELECT 
		-- COUNT(*) nb_activite,
	    vis.id_visite,
	    vis.remarque_visite, 
	    vis.date_vis,
	    CONCAT(u.nom, ' - ', u.prenom),
	    u.id_type,
	    mpv.valeur
	FROM `visite` vis
	INNER JOIN utilisateur u ON u.id_utilisateur = vis.id_com
	INNER JOIN masterParametreValeur mpv ON mpv.id = vis.id_statut_vis
	WHERE
		vis.date_vis BETWEEN '2019-11-01' AND '2019-11-30'
		AND id_type = 18
	GROUP BY mpv.id
	*/
	$query_active_com = "
		SELECT
			u.nom,
			mvp.valeur,
			vis.id_statut_vis,
			vis.date_vis,
			COUNT(*) nb_activite_commercial,
			(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` " . $cond_active_com . "), 2)) pourcentage_commercial
		FROM `visite` vis
		LEFT JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
		LEFT JOIN `utilisateur` u ON u.id_utilisateur = vis.id_com
		WHERE
		   vis.`date_vis` " . $cond_active_com . "
		   AND u.id_type = 18
		GROUP BY vis.id_statut_vis, vis.id_com
	";

	return $query_active_com;
}

$nb_activite_mois_en_cours 			= fct_activite_com("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

$nb_activite_mois_en_cours2 		= fct_activite_com("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
$nb_activite_mois_en_cours4 		= "
	SELECT
		u.nom
	FROM `visite` vis
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
	INNER JOIN `utilisateur` u ON u.id_utilisateur = vis.id_com
	WHERE
	   vis.`date_vis` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
	   AND u.id_type = 18
	GROUP BY u.id_utilisateur
";

// Demande
function fct_demande($cond_demande) {
	$demande = "
		SELECT
			id_dem,
			(
				SELECT 
					COUNT(*)
				FROM demande dem
				INNER JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem
				INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
				WHERE
					(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '') 
					AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '')
					AND dem.`etablie_le` " . $cond_demande . "
			) 'Non pris en charge',
			(
				SELECT 
					COUNT(*) 
				FROM demande dem
				INNER JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem
				WHERE
					r_dem.id_Demande IS NOT NULL 
					OR r_dem.id_Demande != '' 
					OR r_dem.id_Demande > 0
					AND dem.`etablie_le` " . $cond_demande . "
			) 'Qualifiée',
			(
				SELECT 
					COUNT(*)
				FROM demande dem
				INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
				WHERE 
					vis.id_dem_vis IS NOT NULL 
					OR vis.id_dem_vis != '' 
					OR vis.id_dem_vis > 0
					AND dem.`etablie_le` " . $cond_demande . "
			) 'Traitée',
			(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `demande` WHERE `etablie_le` " . $cond_demande . "), 2)) pourcentage_demande
		FROM `demande` dem
		LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem
		LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
		WHERE
			dem.`etablie_le` " . $cond_demande;
	return $demande;
}
$nb_demande_mois_en_cours = fct_demande("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

// Nb total demande du mois en cours
$nb_total_demande_mois_en_cours = "
	SELECT
		COUNT(*) nb_total_demande_mois_en_cours
	FROM demande dem
	WHERE
		dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";
// Nb qualifiee
$nb_demande_qualifiee_mois_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_qualifiee_mois_en_cours
	FROM demande dem
	INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
	WHERE
		(r_dem.id_Demande IS NOT NULL OR r_dem.id_Demande != '' OR r_dem.id_Demande != 0)
		AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Pourcentage demande qualifiee
$perc_demande_qualifiee_mois_en_cours = "
	SELECT 
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'), 2) perc_demande_qualifiee_mois_en_cours
	FROM demande dem
	INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
	WHERE
		(r_dem.id_Demande IS NOT NULL OR r_dem.id_Demande != '' OR r_dem.id_Demande != 0)
		AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Nb demande traitee
$nb_demande_traitee_mois_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_traitee_mois_en_cours
	FROM demande dem 
	INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE
	    (
	        vis.id_dem_vis IS NOT NULL 
	        OR vis.id_dem_vis != '' 
	        OR vis.id_dem_vis != 0 
	    )
	    AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Perc nb demande traitee
$perc_demande_traitee_mois_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'), 2) perc_demande_traitee_mois_en_cours
	FROM demande dem 
	INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
	WHERE
	    (
	        vis.id_dem_vis IS NOT NULL 
	        OR vis.id_dem_vis != '' 
	        OR vis.id_dem_vis != 0 
	    )
	    AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Nb demande non pris en charge
$nb_demande_non_pris_mois_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_non_pris_mois_en_cours
	FROM demande dem 
	LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem 
	LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE 
		(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '' OR vis.id_dem_vis = 0) 
		AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '' OR r_dem.id_Demande = 0) 
		AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
	GROUP BY dem.`etablie_le`
";

// Perc nb demande non pris en charge
$perc_demande_non_pris_mois_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'), 2) perc_demande_non_pris_mois_en_cours
	FROM demande dem 
	LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem 
	LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE 
		(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '' OR vis.id_dem_vis = 0) 
		AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '' OR r_dem.id_Demande = 0) 
		AND dem.`etablie_le` BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";
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
/*.width_espace_td:first-child {
 	background: #333f50;
 	color: white;
 	width: 25%!important;
}
.width_espace_td2:first-child {
	background: #333f50;
	color: white;
	width: 50%!important;
}*/
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
g.highcharts-button.highcharts-contextbutton.highcharts-button-normal {
    display: none;
}
</style>
<?php //require_once "inc_dashboard_journalier.php" ;?>
<div class="table-responsive" id="resultatRecherche">
	<table class="table table-striped table-bordered p-0">
		<thead>
			<td>Chiffre d’affaire</td>								        
			<td>Nombre de chantiers</td>
		</thead>
		<tbody>									
			<tr>
				<td>
					<?php
						/*echo "<pre>";
						echo $query_ca;
						echo "</pre>";*/
						$query_ca = mysqli_query($con, $query_ca);
						if ($query_ca) {
							$result_ca 	= mysqli_fetch_array($query_ca);
							$prix_ht 	= (!empty($result_ca['Prix_ht'])) ? $result_ca['Prix_ht'] : 0;
							$prix_ttc 	= (!empty($result_ca['Prix_ttc'])) ? $result_ca['Prix_ttc'] : 0;
							// var_dump($result_ca['chiffre_affaire']);
							$dev_etabli_le = $result_ca['devis_etabli_le'];
							echo "<a href='list_ca_c.php?devis=ca&dev_etabli_le=$dev_etabli_le'  target='_blank'>" . $prix_ht . "</a> HT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='list_ca_c.php?devis=ca&dev_etabli_le=$dev_etabli_le'  target='_blank'>". $prix_ttc ."</a> TTC";
						} else echo mysqli_error($con);
					?>
				</td>
		        <td>
		        	<?php
		        		/*echo "<pre>";
						echo $nb_chantier_mois_en_cours;
						echo "</pre>";*/
		        		$nb_chantier_mois_en_cours = mysqli_query($con, $nb_chantier_mois_en_cours);
		        		if ($nb_chantier_mois_en_cours) {
		        			$result_nb_chantier = mysqli_fetch_array($nb_chantier_mois_en_cours);
		        			$nb_chantier = (!empty($result_nb_chantier['nb_chantier'])) ? $result_nb_chantier['nb_chantier'] : 0;
		        			$date_dep = $result_nb_chantier['date_dep'];
		        			echo "<a href='list_ca_c.php?devis=chantier&date_dep=$date_dep'  target='_blank'>" . $nb_chantier . "</a>";
		        		} else echo mysqli_error($con);
		        	?>
		        </td>
			</tr>
		</tbody>
	</table>
	<div id="sources_leads_<?php echo $m; ?>" class='hg-chart' data-test='sources_leads_<?php echo $m; ?>'></div>
	<div id="cam_devis_<?php echo $m; ?>" class='hg-chart' data-test='cam_devis'></div>
	<div id="cam_visite_<?php echo $m; ?>" class='hg-chart' data-test='cam_visite'></div>
	<div id="cam_act_com_<?php echo $m; ?>" class='hg-chart' data-test='cam_act_com'></div>
	<div id="cam_demande_<?php echo $m; ?>" class='hg-chart' data-test='cam_demande'></div>
	<input type='hidden' id='month' value='<?php echo $m; ?>'>
</div>
<script type="text/javascript">
	var s_leads 		= $('[id^="sources_leads_"]').attr("id").split('_'),
		cam_devis 		= $('[id^="cam_devis_"]').attr("id").split('_'),
		cam_visite 		= $('[id^="cam_visite_"]').attr("id").split('_'),
		cam_act_com 	= $('[id^="cam_act_com_"]').attr("id").split('_'),
		cam_demande 	= $('[id^="cam_demande_"]').attr("id").split('_'),
		month 			= <?php echo $_POST['month_selected']; ?>;

	var source_leads = 'sources_leads_'+month;
	// console.log('source_leads : ' + source_leads + ', month: ' + month);

	// Chart source_leads
    Highcharts.chart('sources_leads_'+month, {
        exporting: { enabled: false },
        credits: {
	    	enabled: false
		},
	  	chart: {
		    type: 'pie',
		    options3d: {
				enabled: true,
				alpha: 55,
				beta: 0
		    }
		  },
		title: {
			text: 'Sources Leads'
		},
		tooltip: {
			// pointFormat: '{series.name} : <b>{point.percentage:.2f}%</b>,'
			pointFormat: '{series.name}, <b>{point.y} -     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name}, <b>{point.y} -   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_demande_s.php?id_source=' + this.options.key;
	                        window.open('list_demande_s.php?id_source=' + this.options.key, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: '',
			data: [
				<?php
					$nb_source_mois_en_cours = mysqli_query($con, $nb_source_mois_en_cours);
					if ($nb_source_mois_en_cours) {
						$row_source_mois = mysqli_num_rows($nb_source_mois_en_cours);
						if ($row_source_mois > 0) {
							while ($results_source_leads = mysqli_fetch_array($nb_source_mois_en_cours)) {
								$nom_source 		= $results_source_leads["nom_source"];
								$id_source 			= $results_source_leads["id_source"];
								$pourcentage_source = $results_source_leads["pourcentage_source"];
								$nb_source 			= $results_source_leads["nb_source"];
								$etablie_le 		= $results_source_leads["etablie_le"];

								$id_source = $id_source . '&etablie_le=' . $etablie_le;

								echo "{y: " . $nb_source . ", name: '" . html_entity_decode($nom_source) . "', key: '" . $id_source . "', perc: " . $pourcentage_source . "},";
							}
						} else {
							echo "['Aucune source', 0]";
						}
					} else echo mysqli_error($con);
				?>
		    ]
	  	}]
	});

	// Chart devis
    // Highcharts.chart('cam_devis', {
	<?php
		$get_nb_devis 					= mysqli_query($con, $get_nb_devis);
		$nb_total_devis_mois_en_cours 	= mysqli_fetch_array($get_nb_devis);
		$nb_total_devis 				= $nb_total_devis_mois_en_cours["nb_total_devis"];
		$nb_total_devis 				= 'Devis <br /> <h5>Total = ' . $nb_total_devis . '</h5>';
	?>
    Highcharts.chart('cam_devis_'+month, {
        exporting: { enabled: false },
        credits: {
	    	enabled: false
		},
	  	chart: {
		    type: 'pie',
		    options3d: {
				enabled: true,
				alpha: 55,
				beta: 0
		    }
		  },
		title: {
			text: '<?php echo $nb_total_devis; ?>'
		},
		tooltip: {
			pointFormat: '{series.name}, <b>{point.y} -     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name}, <b>{point.y} -   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_devis_s.php?statut_devis=' + this.options.key;
	                        window.open('list_devis_s.php?statut_devis=' + this.options.key, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: '',
			data: [
				<?php
					$nb_devis_mois_en_cours = mysqli_query($con, $nb_devis_mois_en_cours);
					if ($nb_devis_mois_en_cours) {
						$row_devis_mois = mysqli_num_rows($nb_devis_mois_en_cours);

						if ($row_devis_mois > 0) {
							while ($results_devis_mois_en_cours = mysqli_fetch_array($nb_devis_mois_en_cours)) {
								$nom_valeur 		= $results_devis_mois_en_cours["valeur"];
								$pourcentage_valeur = $results_devis_mois_en_cours["pourcentage_devis"];
								$nb_devis 			= $results_devis_mois_en_cours["nb_devis"];
								$id_statut 			= $results_devis_mois_en_cours["id_statut"];
								$devis_etabli_le 	= $results_devis_mois_en_cours["devis_etabli_le"];

								$id_statut 			= $id_statut . '&devis_etabli_le=' . $devis_etabli_le;
								// 
								// echo "{y: " . $nb_devis . ", name: '" . html_entity_decode($nom_valeur) . "', perc: " . $pourcentage_valeur . "},";
								echo "{y: " . $nb_devis . ", name: '" . html_entity_decode($nom_valeur) . "', key: '" . $id_statut . "', perc: " . $pourcentage_valeur . "},";
							}
						} else {
							echo "['Aucun devis', 0]";
						}
					} else echo mysqli_error($con);
				?>
		    ]
	  	}]
	});

	// Chart Visite
    // Highcharts.chart('cam_visite', {
	<?php
		$get_nb_visite 					= mysqli_query($con, $get_nb_total_visite);
		$nb_total_visite_mois_en_cours 	= mysqli_fetch_array($get_nb_visite);
		$nb_total_visite 				= $nb_total_visite_mois_en_cours["nb_total_visite"];
		$nb_total_visite 				= 'Visite <br /> <h5>Total = ' . $nb_total_visite . '</h5>';
	?>
    Highcharts.chart('cam_visite_'+month, {
        exporting: { enabled: false },
        credits: {
	    	enabled: false
		},
	  	chart: {
		    type: 'pie',
		    options3d: {
				enabled: true,
				alpha: 55,
				beta: 0
		    }
		  },
		title: {
			text: '<?php echo $nb_total_visite; ?>'
		},
		tooltip: {
			pointFormat: '{series.name}, <b>{point.y} -     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name}, <b>{point.y} -   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_visite_s.php?date_vis=' + this.options.date_vis;
	                        window.open('list_visite_s.php?' + this.options.date_vis, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: '',
			data: [
				<?php
					$nb_visite_mois_en_cours = mysqli_query($con, $nb_visite_mois_en_cours);
					if ($nb_visite_mois_en_cours) {
						$row_visite_mois_en_cours = mysqli_num_rows($nb_visite_mois_en_cours);

						if ($row_visite_mois_en_cours > 0) {
							while ($results_visite = mysqli_fetch_array($nb_visite_mois_en_cours)) {
								$date_vis 			= $results_visite["date_vis"];
								$pourcentage_visite = $results_visite["pourcentage_visite"];
								$nb_visite 			= $results_visite["nb_visite"];
								$id_statut_vis 		= $results_visite["id_statut_vis"];
								$valeur_statut_vis 	= $results_visite["valeur"];
								$g_vis 				= 'date_vis=' . $date_vis . '&id_statut_vis=' . $id_statut_vis;
								// echo "{y: " . $nb_visite . ", name: '" . $date_vis . "', perc: " . $pourcentage_visite . "},";
								echo "{y: " . $nb_visite . ", name: '" . html_entity_decode($valeur_statut_vis) . "', date_vis: '" . $g_vis . "', perc: " . $pourcentage_visite . "},";
							}
						} else {
							echo "['Aucune visite', 0]";
						}
					} else echo mysqli_error($con);
				?>
		    ]
	  	}]
	});
	// Highcharts.chart('cam_act_com', {
	Highcharts.chart('cam_act_com_'+month, {
	    chart: {
	        type: 'bar'
	    },
	    title: {
	        text: 'Activités commerciales'
	    },
	    xAxis: {
	    	// categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
	        categories: [
	        	<?php
	        		$nb_activite_mois_en_cours4 	= mysqli_query($con, $nb_activite_mois_en_cours4);
		    		$row_activite_mois_en_cours4 	= mysqli_num_rows($nb_activite_mois_en_cours4);
		    		if ($nb_activite_mois_en_cours4) {
		        		if ($row_activite_mois_en_cours4 > 0) {
		    				while ($results_active_com4 = mysqli_fetch_array($nb_activite_mois_en_cours4)) {
		    					$nom 				= $results_active_com4["nom"];
		    					echo "'" . $nom . "', ";
		    				}
		        		} else {
							echo "'Aucune activité'";
						}
		    		} else echo mysqli_error($con);
	        	?>
	        ]
	    },
	    yAxis: {
	        min: 0,
	        max: 100,
	        title: {
	            text: ''
	        }
	    },
	    legend: {
	        reversed: true
	    },
	    plotOptions: {
	        series: {
	            stacking: 'normal',
	            cursor: 'pointer',
	            events: {
                    click: function () {
                        // location.href = 'list_act_com_s.php?' + this.options.url;
                        window.open('list_act_com_s.php?' + this.options.url, '_blank');
                    }
                }
	        }
	    },
	    series: [
	    	<?php
        		$nb_activite_mois_en_cours2 = mysqli_query($con, $nb_activite_mois_en_cours2);
        		if ($nb_activite_mois_en_cours2) {
        			$row_activite_mois_en_cours2 = mysqli_num_rows($nb_activite_mois_en_cours2);
        			if ($row_activite_mois_en_cours2 > 0) {
        				while ($results_active_com2 = mysqli_fetch_array($nb_activite_mois_en_cours2)) {
        					$pourcentage_commercial 	= $results_active_com2["pourcentage_commercial"];
        					$nb_activite_commercial 	= $results_active_com2["nb_activite_commercial"];
        					$valeur 					= $results_active_com2["valeur"];
        					$id_statut_vis 				= $results_active_com2["id_statut_vis"];
        					$date_vis 					= $results_active_com2["date_vis"];
        					$envoi_activite 			= 'id_statut_vis=' . $id_statut_vis . '&date_vis=' . $date_vis;
        					echo "{name: '" . html_entity_decode(ucfirst($valeur)) . "', data:[". $pourcentage_commercial . "], url:'". $envoi_activite ."'}, ";
        				}
        			} else {
						echo "['Aucune activité', 0]";
					}
        		} else echo mysqli_error($con);
        	?>
    	]
	});

	// Chart Demandes
    // Highcharts.chart('cam_demande', {
	<?php
		$nb_total_demande_mois_en_cours = mysqli_query($con, $nb_total_demande_mois_en_cours);
		$total_demande_mois_en_cours 	= mysqli_fetch_array($nb_total_demande_mois_en_cours);
		$nb_total_demande 				= $total_demande_mois_en_cours["nb_total_demande_mois_en_cours"];
		$nb_total_demande 				= 'Demande <br /> <h5>Total = ' . $nb_total_demande . '</h5>';
	?>
    Highcharts.chart('cam_demande_'+month, {
        exporting: { enabled: false },
        credits: {
	    	enabled: false
		},
	  	chart: {
		    type: 'pie',
		    options3d: {
				enabled: true,
				alpha: 55,
				beta: 0
		    }
		  },
		title: {
			// text: '<?php echo $nb_total_demande; ?>'
			text: 'Demande'
		},
		tooltip: {
			pointFormat: '{series.name}, <b>{point.y} -     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name}, <b>{point.y} -   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_demande_par_statut.php?statut_demande=' + this.options.statut_demande;
	                        window.open('list_demande_par_statut.php?statut_demande=' + this.options.statut_demande, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: '',
			data: [
				<?php
					$nb_demande_qualifiee_mois_en_cours 		= mysqli_query($con, $nb_demande_qualifiee_mois_en_cours);
					$perc_demande_qualifiee_mois_en_cours 		= mysqli_query($con, $perc_demande_qualifiee_mois_en_cours);
					$nb_demande_traitee_mois_en_cours 			= mysqli_query($con, $nb_demande_traitee_mois_en_cours);
					$perc_demande_traitee_mois_en_cours 		= mysqli_query($con, $perc_demande_traitee_mois_en_cours);
					$nb_demande_non_pris_mois_en_cours 			= mysqli_query($con, $nb_demande_non_pris_mois_en_cours);
					$perc_demande_non_pris_mois_en_cours 		= mysqli_query($con, $perc_demande_non_pris_mois_en_cours);

					$nb_demande_qualifiee_mois_en_cours 		= mysqli_fetch_array($nb_demande_qualifiee_mois_en_cours);
					$perc_demande_qualifiee_mois_en_cours 		= mysqli_fetch_array($perc_demande_qualifiee_mois_en_cours);
					$nb_demande_traitee_mois_en_cours 			= mysqli_fetch_array($nb_demande_traitee_mois_en_cours);
					$perc_demande_traitee_mois_en_cours 		= mysqli_fetch_array($perc_demande_traitee_mois_en_cours);
					$nb_demande_non_pris_mois_en_cours 			= mysqli_fetch_array($nb_demande_non_pris_mois_en_cours);
					$perc_demande_non_pris_mois_en_cours 		= mysqli_fetch_array($perc_demande_non_pris_mois_en_cours);
					
					$etablie_le_qualifiee_mois_en_cours 		= $nb_demande_qualifiee_mois_en_cours['etablie_le'];
					$nb_demande_qualifiee_mois_en_cours 		= (!empty($nb_demande_qualifiee_mois_en_cours['nb_demande_qualifiee_mois_en_cours'])) ? $nb_demande_qualifiee_mois_en_cours['nb_demande_qualifiee_mois_en_cours'] : 0;
					$perc_demande_qualifiee_mois_en_cours 		= (!empty($perc_demande_qualifiee_mois_en_cours['perc_demande_qualifiee_mois_en_cours'])) ? $perc_demande_qualifiee_mois_en_cours['perc_demande_qualifiee_mois_en_cours'] : 0;
					
					$etablie_le_traitee_mois_en_cours 			= $nb_demande_traitee_mois_en_cours['etablie_le'];
					$nb_demande_traitee_mois_en_cours 			= (!empty($nb_demande_traitee_mois_en_cours['nb_demande_traitee_mois_en_cours'])) ? $nb_demande_traitee_mois_en_cours['nb_demande_traitee_mois_en_cours'] : 0;
					$perc_demande_traitee_mois_en_cours 		= (!empty($perc_demande_traitee_mois_en_cours['perc_demande_traitee_mois_en_cours'])) ? $perc_demande_traitee_mois_en_cours['perc_demande_traitee_mois_en_cours'] : 0;

					$etablie_le_non_pris_mois_en_cours 			= $nb_demande_non_pris_mois_en_cours['etablie_le'];
					$nb_demande_non_pris_mois_en_cours 			= (!empty($nb_demande_non_pris_mois_en_cours['nb_demande_non_pris_mois_en_cours'])) ? $nb_demande_non_pris_mois_en_cours['nb_demande_non_pris_mois_en_cours'] : 0;
					$perc_demande_non_pris_mois_en_cours 		= (!empty($perc_demande_non_pris_mois_en_cours['perc_demande_non_pris_mois_en_cours'])) ? $perc_demande_non_pris_mois_en_cours['perc_demande_non_pris_mois_en_cours'] : 0;

					$statut_qualif 								= 'qualif&etablie_le=' . $etablie_le_qualifiee_mois_en_cours;
					$statut_traitee 							= 'trait&etablie_le=' . $etablie_le_traitee_mois_en_cours;
					$statut_non_pris 							= 'non_pris&etablie_le=' . $etablie_le_non_pris_mois_en_cours;


					echo "{y: " . $nb_demande_qualifiee_mois_en_cours . ", name: 'Qualifiée', statut_demande: '$statut_qualif', perc: " . $perc_demande_qualifiee_mois_en_cours . "},";
					echo "{y: " . $nb_demande_traitee_mois_en_cours . ", name: 'Traitée', statut_demande: '$statut_traitee', perc: " . $perc_demande_traitee_mois_en_cours . "},";
					echo "{y: " . $nb_demande_non_pris_mois_en_cours . ", name: 'Non pris en charge', statut_demande: '$statut_non_pris', perc: " . $perc_demande_non_pris_mois_en_cours . "},";
				?>
		    ]
	  	}]
	});
</script>
<input type='hidden' value='hide' />