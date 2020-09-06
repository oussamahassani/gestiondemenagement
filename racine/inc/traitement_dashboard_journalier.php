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

// Chiffre d'affaire global
$query_ca2 = "
	SELECT
		date(`devis_etabli_le`) 'devis_etabli_le',
		ROUND(SUM(Prix_ht + Prix_ttc), 2) chiffre_affaire 
	FROM `devis`
	WHERE 
		id_statut = 46
		AND date(`devis_etabli_le`) = '$date_en_cours'
";

// Nb chantier
$nb_chantier_jour_en_cours = "
	SELECT
		dem.date_dep 'date_dep',
		COUNT(*) 'nb_chantier'
	FROM `devis` dev
	INNER JOIN demande dem ON dev.id_demande = dem.id_dem
	WHERE
		dev.id_statut = 46
	    AND dem.date_dep = '$date_en_cours'
";

// Source leads
$nb_source_jour_en_cours = "
	SELECT
		dem.`etablie_le`,
		s.nom_source,
		s.id_source,
		COUNT(*) nb_source,
	    (ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `demande` WHERE `etablie_le` = '$date_en_cours'), 2)) pourcentage_source
	FROM `demande` dem
	INNER JOIN `source` s ON s.id_source = dem.id_source
	WHERE
	   dem.`etablie_le` = '$date_en_cours'
	GROUP BY s.nom_source
";

// Devis
$nb_devis_jour_en_cours = "
	SELECT
		date(dev.`devis_etabli_le`) 'devis_etabli_le',
		mvp.valeur,
		dev.id_statut,
		COUNT(*) nb_devis,
	    (ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `devis` WHERE date(`devis_etabli_le`) = '$date_en_cours'), 2)) pourcentage_devis
	FROM `devis` dev
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = dev.id_statut
	WHERE
	   date(dev.`devis_etabli_le`) = '$date_en_cours'
	GROUP BY mvp.valeur
";
$get_nb_devis = "
	SELECT
		COUNT(*) nb_total_devis
	FROM `devis` dev
	WHERE
	   date(dev.`devis_etabli_le`) = '$date_en_cours'
";
// Visite
$nb_visite_jour_en_cours = "
	SELECT
		vis.date_vis,
		vis.id_statut_vis,
		COUNT(*) nb_visite,
		mvp.valeur,
		(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` = '$date_en_cours'), 2)) pourcentage_visite
	FROM `visite` vis
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
	WHERE
	   vis.`date_vis` = '$date_en_cours'
	GROUP BY mvp.valeur
";
$get_nb_total_visite = "
	SELECT
		COUNT(*) nb_total_visite
	FROM `visite` vis
	WHERE
	   vis.`date_vis` = '$date_en_cours'
";
// Activites commerciales
$query_active_com = "
	SELECT
		u.nom,
		mvp.valeur,
		vis.id_statut_vis,
		vis.date_vis,
		COUNT(*) nb_activite_commercial,
		(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` = '$date_en_cours'), 2)) pourcentage_commercial
	FROM `visite` vis
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
	INNER JOIN `utilisateur` u ON u.id_utilisateur = vis.id_com
	WHERE
	   vis.`date_vis` = '$date_en_cours'
	   AND u.id_type = 18
	GROUP BY mvp.valeur
";

$query_active_com2 = $query_active_com;

// Demande
$nb_demande_jour_en_cours = "
	SELECT
		(
			SELECT 
				COUNT(*) 
			FROM demande dem
			INNER JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem
			INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
			WHERE
				(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '') 
				AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '')
				AND dem.`etablie_le` = '$date_en_cours'
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
				AND dem.`etablie_le` = '$date_en_cours'
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
				AND dem.`etablie_le` = '$date_en_cours'
		) 'Traitée',
		(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `demande` WHERE `etablie_le` = '$date_en_cours'), 2)) pourcentage_demande
	FROM `demande` dem
	LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem
	LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
	WHERE
		dem.`etablie_le` = '$date_en_cours'
";

// Nb qualifiee
$nb_demande_qualifiee_jour_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_qualifiee_jour_en_cours
	FROM demande dem
	INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
	WHERE
		(r_dem.id_Demande IS NOT NULL OR r_dem.id_Demande != '' OR r_dem.id_Demande != 0)
		AND dem.`etablie_le` = '$date_en_cours'
";

// Pourcentage demande qualifiee
$perc_demande_qualifiee_jour_en_cours = "
	SELECT 
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` = '$date_en_cours'), 2) perc_demande_qualifiee_jour_en_cours
	FROM demande dem
	INNER JOIN RelanceDemande r_dem ON dem.id_dem = r_dem.id_Demande
	WHERE
		(r_dem.id_Demande IS NOT NULL OR r_dem.id_Demande != '' OR r_dem.id_Demande != 0)
		AND dem.`etablie_le` = '$date_en_cours'
";

// Nb demande traitee
$nb_demande_traitee_jour_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_traitee_jour_en_cours
	FROM demande dem 
	INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE
	    (
	        vis.id_dem_vis IS NOT NULL 
	        OR vis.id_dem_vis != '' 
	        OR vis.id_dem_vis != 0 
	    )
	    AND dem.`etablie_le` = '$date_en_cours'
";

// Perc nb demande traitee
$perc_demande_traitee_jour_en_cours = "
	SELECT 
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` = '$date_en_cours'), 2) perc_demande_traitee_jour_en_cours
	FROM demande dem 
	INNER JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem
	WHERE
	    (
	        vis.id_dem_vis IS NOT NULL 
	        OR vis.id_dem_vis != '' 
	        OR vis.id_dem_vis != 0 
	    )
	    AND dem.`etablie_le` = '$date_en_cours'
";

// Nb demande non pris en charge
$nb_demande_non_pris_jour_en_cours = "
	SELECT
		dem.`etablie_le` 'etablie_le',
		COUNT(*) nb_demande_non_pris_jour_en_cours
	FROM demande dem 
	LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem 
	LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE 
		(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '' OR vis.id_dem_vis = 0) 
		AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '' OR r_dem.id_Demande = 0) 
		AND dem.`etablie_le` = '$date_en_cours'
	GROUP BY dem.`etablie_le`
";

// Perc nb demande non pris en charge
$perc_demande_non_pris_jour_en_cours = "
	SELECT 
		ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM demande WHERE `etablie_le` = '$date_en_cours'), 2) perc_demande_non_pris_jour_en_cours
	FROM demande dem 
	LEFT JOIN `RelanceDemande` r_dem ON r_dem.id_Demande = dem.id_dem 
	LEFT JOIN `visite` vis ON vis.id_dem_vis = dem.id_dem 
	WHERE 
		(vis.id_dem_vis IS NULL OR vis.id_dem_vis = '' OR vis.id_dem_vis = 0) 
		AND (r_dem.id_Demande IS NULL OR r_dem.id_Demande = '' OR r_dem.id_Demande = 0)
		AND dem.`etablie_le` = '$date_en_cours'
";
?>
<!--<pre>
	<?php echo $query_active_com2; ?>
</pre>-->
<table class="table table-striped table-bordered p-0">
	<thead>
		<td>Chiffre d’affaire</td>								        
		<td>Nombre de chantiers</td>
	</thead>
	<tbody>									
		<tr>
			<td>
				<?php
					$query_ca2 = mysqli_query($con, $query_ca2);
					if ($query_ca2) {
						$result_ca2 = mysqli_fetch_array($query_ca2);
						$chiffre_ca = (!empty($result_ca2['chiffre_affaire'])) ? $result_ca2['chiffre_affaire'] : 0;
						$dev_etabli_le = $result_ca2['devis_etabli_le'];
						echo "<a href='list_ca_jour.php?devis=ca&dev_etabli_le=$dev_etabli_le' target='_blank'>" . $chiffre_ca . "</a>";
					} else echo mysqli_error($con);
				?>
			</td>
	        <td>
	        	<?php
	        		$nb_chantier_jour_en_cours = mysqli_query($con, $nb_chantier_jour_en_cours);
	        		if ($nb_chantier_jour_en_cours) {
	        			$result_nb_chantier_jour = mysqli_fetch_array($nb_chantier_jour_en_cours);
	        			$nb_chantier_jour = (!empty($result_nb_chantier_jour['nb_chantier'])) ? $result_nb_chantier_jour['nb_chantier'] : 0;
	        			// echo $nb_chantier_jour;
	        			$date_dep = $result_nb_chantier_jour['date_dep'];
	        			echo "<a href='list_ca_jour.php?devis=chantier&date_dep=$date_dep' target='_blank'>" . $nb_chantier_jour . "</a>";
	        		} else echo mysqli_error($con);
	        	?>
	        </td>
		</tr>
	</tbody>
</table>

<div id="sources_jour_<?php echo $date_en_cours; ?>" class='hg-chart'></div>
<div id="devis_jour_<?php echo $date_en_cours; ?>" class='hg-chart'></div>
<div id="visite_jour_<?php echo $date_en_cours; ?>" class='hg-chart'></div>
<div id="cam_act_comjour_<?php echo $date_en_cours; ?>" class='hg-chart'></div>
<div id="demande_jour_<?php echo $date_en_cours; ?>" class='hg-chart'></div>

<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> -->

<script type="text/javascript">
	var d 			= <?php echo $_POST['day_selected']; ?>;
		m 			= <?php echo $_POST['month_selected']; ?>,
		y 			= <?php echo $_POST['year_selected']; ?>,
		d_en_cours 	= y + '-' + m + '-' + d; 
	// console.log(', month: ' + d_en_cours);
	// Chart source_leads
    // Highcharts.chart('sources_jour', {
	Highcharts.chart('sources_jour_'+d_en_cours, {
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
			pointFormat: '{series.name} : <b>{point.y},     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name} : <b>{point.y},   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_demande_jour.php?id_source=' + this.options.key;
	                        window.open('list_demande_jour.php?id_source=' + this.options.key, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: 'pourcentage',
			data: [
				<?php
					$nb_source_jour_en_cours = mysqli_query($con, $nb_source_jour_en_cours);
					if ($nb_source_jour_en_cours) {
						$row_source = mysqli_num_rows($nb_source_jour_en_cours);
						if ($row_source > 0) {
							while ($results_source_leads_jour = mysqli_fetch_array($nb_source_jour_en_cours)) {
								$nom_source_jour 				= (!empty($results_source_leads_jour["nom_source"])) ? $results_source_leads_jour["nom_source"] : "Aucune";
								$pourcentage_source_jour 	= (!empty($results_source_leads_jour["pourcentage_source"]) ? $results_source_leads_jour["pourcentage_source"] : 0);
								$nb_source_jour 			= $results_source_leads_jour["nb_source"];
								$id_source 					= $results_source_leads_jour["id_source"];
								$etablie_le 				= $results_source_leads_jour["etablie_le"];
								$id_source 					= $id_source . '&etablie_le=' . $etablie_le;
								// echo "{y: " . $nb_source_jour . ", name: '" . html_entity_decode($nom_source_jour) . "', perc: " . $pourcentage_source_jour . "},";
								echo "{y: " . $nb_source_jour . ", name: '" . html_entity_decode($nom_source_jour) . "', key: '" . $id_source . "', perc: " . $pourcentage_source_jour . "},";
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
	// Highcharts.setOptions({lang: {noData: "Pas de devis"}});
    // Highcharts.chart('devis_jour', {
	<?php
		$get_nb_devis 					= mysqli_query($con, $get_nb_devis);
		$nb_total_devis_mois_en_cours 	= mysqli_fetch_array($get_nb_devis);
		$nb_total_devis 				= $nb_total_devis_mois_en_cours["nb_total_devis"];
		$nb_total_devis 				= 'Devis <br /> <h5>Total = ' . $nb_total_devis . '</h5>';
	?>
    Highcharts.chart('devis_jour_'+d_en_cours, {
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
			pointFormat: '{series.name} : <b>{point.y},     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name} : <b>{point.y},   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // location.href = 'list_devis_jour.php?statut_devis=' + this.options.key;
	                        window.open('list_devis_jour.php?statut_devis=' + this.options.key, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: 'pourcentage',
			data: [
				<?php
					$nb_devis_jour_en_cours = mysqli_query($con, $nb_devis_jour_en_cours);
					if ($nb_devis_jour_en_cours) {
						$row_devis = mysqli_num_rows($nb_devis_jour_en_cours);
						if ($row_devis > 0) {
							while ($results_devis_jour_en_cours = mysqli_fetch_array($nb_devis_jour_en_cours)) {
								$nom_valeur_devis_jour 				= (!empty($results_devis_jour_en_cours["valeur"])) ? $results_devis_jour_en_cours["valeur"] : "Aucune";
								$pourcentage_valeur_devis_jour 		= (!empty($results_devis_jour_en_cours["pourcentage_devis"])) ? $results_devis_jour_en_cours["pourcentage_devis"] : 0;
								$nb_devis_devis_jour 				= $results_devis_jour_en_cours["nb_devis"];

								$id_statut 							= $results_devis_jour_en_cours["id_statut"];
								$devis_etabli_le 					= $results_devis_jour_en_cours["devis_etabli_le"];

								$id_statut 							= $id_statut . '&devis_etabli_le=' . $devis_etabli_le;
								// echo "{y: " . $nb_devis_devis_jour . ", name: '" . html_entity_decode($nom_valeur_devis_jour) . "', perc: " . $pourcentage_valeur_devis_jour . "},";
								echo "{y: " . $nb_devis_devis_jour . ", name: '" . html_entity_decode($nom_valeur_devis_jour) . "', key: '" . $id_statut . "', perc: " . $pourcentage_valeur_devis_jour . "},";
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
    // Highcharts.chart('visite_jour', {
	<?php
		$get_nb_visite 					= mysqli_query($con, $get_nb_total_visite);
		$nb_total_visite_mois_en_cours 	= mysqli_fetch_array($get_nb_visite);
		$nb_total_visite 				= $nb_total_visite_mois_en_cours["nb_total_visite"];
		$nb_total_visite 				= 'Visite <br /> <h5>Total = ' . $nb_total_visite . '</h5>';
	?>
    Highcharts.chart('visite_jour_'+d_en_cours, {
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
			pointFormat: '{series.name} : <b>{point.y},     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name} : <b>{point.y},   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        // window.open('list_visite_jour.php?date_vis=' + this.options.date_vis, '_blank');
	                        window.open('list_visite_jour.php?' + this.options.date_vis, '_blank');
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: 'pourcentage',
			data: [
				<?php
					$nb_visite_jour_en_cours = mysqli_query($con, $nb_visite_jour_en_cours);
					if ($nb_visite_jour_en_cours) {
						$row_visite = mysqli_num_rows($nb_visite_jour_en_cours);
						if ($row_visite > 0) {
							while ($results_visite_jour = mysqli_fetch_array($nb_visite_jour_en_cours)) {
								$date_vis_jour 				= (!empty($results_visite_jour["date_vis"])) ? $results_visite_jour["date_vis"] : "Aucune";
								$pourcentage_visite_jour 	= (!empty($results_visite_jour["pourcentage_visite"])) ? $results_visite_jour["pourcentage_visite"] : 0;
								$nb_visite_jour 			= $results_visite_jour["nb_visite"];
								$id_statut_vis 				= $results_visite_jour["id_statut_vis"];

								$valeur_statut_vis 			= $results_visite_jour["valeur"];
								$g_vis 						= 'date_vis=' . $date_vis_jour . '&id_statut_vis=' . $id_statut_vis;
								// echo "{y: " . $nb_visite . ", name: '" . $date_vis . "', perc: " . $pourcentage_visite . "},";
								echo "{y: " . $nb_visite_jour . ", name: '" . html_entity_decode($valeur_statut_vis) . "', date_vis: '" . $g_vis . "', perc: " . $pourcentage_visite_jour . "},";

								// echo "{y: " . $nb_visite_jour . ", name: '" . $date_vis_jour . "', perc: " . $pourcentage_visite_jour . "},";
								// echo "{y: " . $nb_visite_jour . ", name: '" . $date_vis_jour . "', date_vis: '" . $date_vis_jour . "', perc: " . $pourcentage_visite_jour . "},";
							}
						} else {
							echo "['Aucune visite', 0]";
						}
					} else echo mysqli_error($con);
				?>
		    ]
	  	}]
	});
	
	// Highcharts.chart('cam_act_comjour', {
	Highcharts.chart('cam_act_comjour_'+d_en_cours, {
	    chart: {
	        type: 'bar'
	    },
	    title: {
	        text: 'Activités commerciales'
	    },
	    xAxis: {
	        categories: [
	        	<?php
	        		$query_active_com 	= mysqli_query($con, $query_active_com);
	        		$row_activite_jour_en_cours = mysqli_num_rows($query_active_com);
	        		if ($query_active_com) {
		        		if ($row_activite_jour_en_cours > 0) {
	        				while ($results_active_com = mysqli_fetch_array($query_active_com)) {
	        					$nom 						= $results_active_com["nom"];
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
                        location.href = 'list_act_com_jour.php?' + this.options.url;
                        window.open('list_act_com_jour.php?' + this.options.url, '_blank');
                    }
                }
	        }
	    },
	    series: [
	    	<?php
        		$query_active_com2 = mysqli_query($con, $query_active_com2);
        		if ($query_active_com2) {
        			$row_activite_jour_en_cours2 = mysqli_num_rows($query_active_com2);
        			if ($row_activite_jour_en_cours2 > 0) {
        				while ($results_active_com2 = mysqli_fetch_array($query_active_com2)) {
        					$pourcentage_commercial 	= $results_active_com2["pourcentage_commercial"];
        					$nb_activite_commercial 	= $results_active_com2["nb_activite_commercial"];
        					$valeur 					= $results_active_com2["valeur"];
        					$id_statut_vis 				= $results_active_com2["id_statut_vis"];
        					$date_vis 					= $results_active_com2["date_vis"];
        					$envoi_activite 			= 'id_statut_vis=' . $id_statut_vis . '&date_vis=' . $date_vis;
        					echo "{name: '" . html_entity_decode($valeur) . "', data:[". $pourcentage_commercial . "], url:'". $envoi_activite ."'}";
        				}
        			} else {
						echo "['Aucune activité', 0]";
					}
        		} else echo mysqli_error($con);
        	?>
    	]
	});

	// Chart Demandes
    // Highcharts.chart('demande_jour', {
    Highcharts.chart('demande_jour_'+d_en_cours, {
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
			text: 'Demandes'
		},
		tooltip: {
			pointFormat: '{series.name} : <b>{point.y},     </b> <b>{point.percentage:.2f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					// format: '{point.name}'
					format: '{point.name} : <b>{point.y},   </b> <b>{point.percentage:.2f}%</b>'
				}
			},
			series: {
	            cursor: 'pointer',
	            point: {
	                events: {
	                    click: function () {
	                        location.href = 'list_demande_par_statut_jour.php?statut_demande=' + this.options.statut_demande;
	                    }
	                }
	            }
	        }
		},
		series: [{
			type: 'pie',
			name: 'pourcentage',
			data: [
				<?php
					$nb_demande_qualifiee_jour_en_cours 		= mysqli_query($con, $nb_demande_qualifiee_jour_en_cours);
					$perc_demande_qualifiee_jour_en_cours 		= mysqli_query($con, $perc_demande_qualifiee_jour_en_cours);
					$nb_demande_traitee_jour_en_cours 			= mysqli_query($con, $nb_demande_traitee_jour_en_cours);
					$perc_demande_traitee_jour_en_cours 		= mysqli_query($con, $perc_demande_traitee_jour_en_cours);
					$nb_demande_non_pris_jour_en_cours 			= mysqli_query($con, $nb_demande_non_pris_jour_en_cours);
					$perc_demande_non_pris_jour_en_cours 		= mysqli_query($con, $perc_demande_non_pris_jour_en_cours);

					$nb_demande_qualifiee_jour_en_cours 		= mysqli_fetch_array($nb_demande_qualifiee_jour_en_cours);
					$perc_demande_qualifiee_jour_en_cours 		= mysqli_fetch_array($perc_demande_qualifiee_jour_en_cours);
					$nb_demande_traitee_jour_en_cours 			= mysqli_fetch_array($nb_demande_traitee_jour_en_cours);
					$perc_demande_traitee_jour_en_cours 		= mysqli_fetch_array($perc_demande_traitee_jour_en_cours);
					$nb_demande_non_pris_jour_en_cours 			= mysqli_fetch_array($nb_demande_non_pris_jour_en_cours);
					$perc_demande_non_pris_jour_en_cours 		= mysqli_fetch_array($perc_demande_non_pris_jour_en_cours);

					$perc_demande_qualifiee_jour_en_cours 		= (!empty($perc_demande_qualifiee_jour_en_cours['perc_demande_qualifiee_jour_en_cours'])) ? $perc_demande_qualifiee_jour_en_cours['perc_demande_qualifiee_jour_en_cours'] : 0;
					$perc_demande_traitee_jour_en_cours 		= (!empty($perc_demande_traitee_jour_en_cours['perc_demande_traitee_jour_en_cours'])) ? $perc_demande_traitee_jour_en_cours['perc_demande_traitee_jour_en_cours'] : 0;
					$perc_demande_non_pris_jour_en_cours 		= (!empty($perc_demande_non_pris_jour_en_cours['perc_demande_non_pris_jour_en_cours'])) ? $perc_demande_non_pris_jour_en_cours['perc_demande_non_pris_jour_en_cours'] : 0;

					$nb_demande_traitee_jour_en_cours 			= (!empty($nb_demande_traitee_jour_en_cours['nb_demande_traitee_jour_en_cours'])) ? $nb_demande_traitee_jour_en_cours['nb_demande_traitee_jour_en_cours'] : 0;
					$nb_demande_qualifiee_jour_en_cours 		= (!empty($nb_demande_qualifiee_jour_en_cours['nb_demande_qualifiee_jour_en_cours'])) ? $nb_demande_qualifiee_jour_en_cours['nb_demande_qualifiee_jour_en_cours'] : 0;
					$nb_demande_non_pris_jour_en_cours 			= (!empty($nb_demande_non_pris_jour_en_cours['nb_demande_non_pris_jour_en_cours'])) ? $nb_demande_non_pris_jour_en_cours['nb_demande_non_pris_jour_en_cours'] : 0;

					$etablie_le_qualifiee_jour_en_cours 		= (!empty($nb_demande_qualifiee_jour_en_cours['etablie_le'])) ? $nb_demande_qualifiee_jour_en_cours['etablie_le'] : '';
					$etablie_le_traitee_jour_en_cours 			= (!empty($nb_demande_traitee_jour_en_cours['etablie_le'])) ? $nb_demande_traitee_jour_en_cours['etablie_le'] : '';
					$etablie_le_non_pris_jour_en_cours 			= (!empty($nb_demande_non_pris_jour_en_cours['etablie_le'])) ? $nb_demande_non_pris_jour_en_cours['etablie_le'] : '';

					$statut_qualif 								= 'qualif&etablie_le=' . $etablie_le_qualifiee_jour_en_cours;
					$statut_traitee 							= 'trait&etablie_le=' . $etablie_le_traitee_jour_en_cours;
					$statut_non_pris 							= 'non_pris&etablie_le=' . $etablie_le_non_pris_jour_en_cours;
					/*if ($nb_demande_qualifiee_jour_en_cours) {
						echo "{y: " . $nb_demande_qualifiee_jour_en_cours . ", name: 'Qualifiée', perc: " . $perc_demande_qualifiee_jour_en_cours . "},";	
					} else {
						echo mysqli_error($con);
					}*/
					/*echo "{y: " . $nb_demande_qualifiee_jour_en_cours . ", name: 'Qualifiée', perc: " . $perc_demande_qualifiee_jour_en_cours . "},";	
					echo "{y: " . $nb_demande_traitee_jour_en_cours . ", name: 'Traitée', perc: " . $perc_demande_traitee_jour_en_cours . "},";
					echo "{y: " . $nb_demande_non_pris_jour_en_cours . ", name: 'Non pris en charge', perc: " . $perc_demande_non_pris_jour_en_cours . "},";*/
					echo "{y: " . $nb_demande_qualifiee_jour_en_cours . ", name: 'Qualifiée', statut_demande: '$statut_qualif', perc: " . $perc_demande_qualifiee_jour_en_cours . "},";
					echo "{y: " . $nb_demande_traitee_jour_en_cours . ", name: 'Traitée', statut_demande: '$statut_traitee', perc: " . $perc_demande_traitee_jour_en_cours . "},";
					echo "{y: " . $nb_demande_non_pris_jour_en_cours . ", name: 'Non pris en charge', statut_demande: '$statut_non_pris', perc: " . $perc_demande_non_pris_jour_en_cours . "},";
				?>
		    ]
	  	}]
	});
</script>