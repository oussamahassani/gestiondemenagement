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
$query_ca2 = "
	SELECT 
		ROUND(SUM(Prix_ht + Prix_ttc), 2) chiffre_affaire 
	FROM `devis`
	WHERE 
		id_statut = 46
		AND date(`devis_etabli_le`) = '$date_en_cours'
";

// Nb chantier
$nb_chantier_jour_en_cours = "
	SELECT COUNT(*) 'nb_chantier'
	FROM `devis` dev
	INNER JOIN demande dem ON dev.id_demande = dem.id_dem
	WHERE
		dev.id_statut = 46
	    AND dem.date_dep = '$date_en_cours'
";

// Source leads
$nb_source_jour_en_cours = "
	SELECT
		s.nom_source,
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
			mvp.valeur,
			COUNT(*) nb_devis,
		    (ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `devis` WHERE date(`devis_etabli_le`) = '$date_en_cours'), 2)) pourcentage_devis
	FROM `devis` dev
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = dev.id_statut
	WHERE
	   date(dev.`devis_etabli_le`) = '$date_en_cours'
	GROUP BY mvp.valeur
";

// Visite

$nb_visite_jour_en_cours = "
	SELECT
		vis.date_vis,
		COUNT(*) nb_visite,
		(ROUND((COUNT(*) * 100) / (SELECT COUNT(*) FROM `visite` WHERE `date_vis` = '$date_en_cours'), 2)) pourcentage_visite
	FROM `visite` vis
	INNER JOIN `masterParametreValeur` mvp ON mvp.id = vis.id_statut_vis
	WHERE
	   vis.`date_vis` = '$date_en_cours'
	GROUP BY mvp.valeur, vis.date_vis
";

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