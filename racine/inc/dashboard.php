<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
setlocale(LC_TIME, "fr_FR");
$mois_en_cours_char 	= strftime("%B");
$dernier_jour_mois 		= date('Y-m-d', strtotime('last day of this month', time()));
$premier_jour_mois 		= date('Y-m-01');
$date_en_cours 			= date('Y-m-d');
$date_en_cours_systeme 	= date('d-m-Y');	 

// Chiffre d'affaire global
$query_ca = "
	SELECT 
		ROUND(SUM(Prix_ht + Prix_ttc), 2) chiffre_affaire 
	FROM `devis`
	WHERE 
		id_statut = 46
		AND date(`devis_etabli_le`) BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'
";

// Nb chaniter
function fct_nb_chantier($cond_ca) {
	$nb_chantier = "
		SELECT COUNT(*) 'nb_chantier'
		FROM `devis` dev
		INNER JOIN demande dem ON dev.id_demande = dem.id_dem
		WHERE
			dev.id_statut = 46
		    AND dem.date_dep " . $cond_ca;

	return $nb_chantier;
}
$nb_chantier_mois_en_cours = fct_nb_chantier("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
// $nb_chantier_jour_en_cours = fct_nb_chantier("= '$dernier_jour_mois'");

// Source leads
function fct_source_leads($cond_source_leads) {
	$source_leads = "
		SELECT
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
// $nb_source_jour_en_cours = fct_source_leads("= '$dernier_jour_mois'");

// Devis
function fct_devis($cond_devis) {
	$devis = "
		SELECT
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
	// echo $devis;
	return $devis;
}
$nb_devis_mois_en_cours = fct_devis("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
// $nb_devis_jour_en_cours = fct_devis("= '$dernier_jour_mois'");

// Visite
function fct_visite($cond_visite) {
	$visite = "
		SELECT
			vis.date_vis,
			vis.id_statut_vis,
			COUNT(*) nb_visite,
			CONCAT(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` " . $cond_visite . "), 2)) pourcentage_visite
		FROM `visite` vis
		INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
		WHERE
		   vis.`date_vis` " . $cond_visite . "
		GROUP BY mvp.valeur, vis.date_vis
	";

	return $visite;
}
$nb_visite_mois_en_cours = fct_visite("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");
// $nb_visite_jour_en_cours = fct_visite("= '$dernier_jour_mois'");

// Activite commerciale
function fct_activite_com($cond_active_com) {
	$query_active_com = "
		SELECT
			u.nom,
			mvp.valeur,
			vis.id_statut_vis,
			COUNT(*) nb_activite_commercial,
			(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` " . $cond_active_com . "), 2)) pourcentage_commercial
		FROM `visite` vis
		INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
		INNER JOIN `utilisateur` u ON u.id_utilisateur = vis.id_com
		WHERE
		   vis.`date_vis` " . $cond_active_com . "
		   AND vis.id_statut_vis = 18
		GROUP BY mvp.valeur
	";

	return $query_active_com;
}
$nb_activite_mois_en_cours 		= fct_activite_com("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

$nb_activite_mois_en_cours2 		= fct_activite_com("BETWEEN '$premier_jour_mois' AND '$dernier_jour_mois'");

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
// $nb_demande_jour_en_cours = fct_demande("= '$dernier_jour_mois'");

// Nb qualifiee
$nb_demande_qualifiee_mois_en_cours = "
	SELECT
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