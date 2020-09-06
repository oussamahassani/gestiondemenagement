<?php
try {
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
		require_once '../../connect.php';

		$con 						= mysql_connect($SERVER,$USERNAME,$PASSWORD);

		mysql_select_db($BASENAME, $con);

		// if (isset($_POST['comptRelance']) && ($_POST['comptRelance']) == 1) {
			// var_dump($_POST);
			$id_relance 					= $_POST['valueIdRelance'];
			$date_relance 					= $_POST['dateRelance'];
			$heure_relance 					= $_POST['heureRelance'];
			$statut_relance 				= $_POST['statutRelance'];
			$commentaire_relance 			= $_POST['commentaireRelance'];
			$responsable_relance 			= $_POST['responsableRelance'];

			$query_update_relance = "
				UPDATE relanceDevis
				SET 
					dateRelance 		= '$date_relance',
					heureRelance 		= '$heure_relance', 
					idStatutRelance 	= '$statut_relance', 
					commentaire 		= '$commentaire_relance',
					id_utilisateur 		= '$responsable_relance'
				WHERE id = $id_relance
			";
			// echo $query_update_relance;
			// exit;
			
			if (!mysql_query($query_update_relance,$con)) {
				die('Error: ' . mysql_error());
				mysql_close($con);
		  	} /*else 
				header('location: ../liste_relance.php');*/
		// } else 
		// 	header('location: ../../index.php');
	} else
		header('location: ../../login.php');
	mysql_close($con);
} catch (exception $e) {
	echo "Erreur : " . $e->getMessage() , "\n";
}
