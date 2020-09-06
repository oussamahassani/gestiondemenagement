<?php
	$id_demande 			= $_POST['id_demande'];
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
			INSERT INTO RelanceDemande (id_Demande, date, heure, id_responsable, statut, commentaire)
			VALUES ('$id_demande', '$date_relance', '$heure_relance', '$responsable_relance', '$statut_relance', '$commentaire_relance')
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