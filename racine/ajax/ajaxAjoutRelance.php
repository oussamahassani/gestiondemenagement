<?php
	$id_devis 				= $_POST['id_devis'];
	$date_relance 			= $_POST['date_relance'];
	$heure_relance 			= $_POST['heure_relance'];
	$responsable_relance 	= $_POST['responsable_relance'];
	$statut_relance 		= $_POST['statut_relance'];
	$commentaire_relance 	= $_POST['commentaire_relance'];

	require_once '../../connect.php';
	$con 					= mysql_connect($SERVER,$USERNAME,$PASSWORD);
	mysql_select_db($BASENAME, $con);

	try {
		$req = "
			INSERT IGNORE INTO relanceDevis (idDevis, dateRelance, heureRelance, id_utilisateur, idStatutRelance, commentaire)
			VALUES ('$id_devis', '$date_relance', '$heure_relance', '$responsable_relance', '$statut_relance', '$commentaire_relance')
		";
		echo "insertion faite : " . $req;
		if (!mysql_query($req,$con)) {
			die('Error: ' . mysql_error());
	  	}
		mysql_close($con);
	} catch (exception $e) {
		echo $e->getMessage() , "\n";
	}
	
?>