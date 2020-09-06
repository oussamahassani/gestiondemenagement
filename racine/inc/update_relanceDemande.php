<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
try {
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
		require_once '../../db.php';
		
		$id_relance 					= $_POST['valueIdRelance'];
		$date_relance 					= $_POST['dateRelance'];
		$heure_relance 					= $_POST['heureRelance'];
		$statut_relance 				= $_POST['statutRelance'];
		$commentaire_relance 			= $_POST['commentaireRelance'];
		$responsable_relance 			= $_POST['responsableRelance'];

		$query_update_relance = "
			UPDATE RelanceDemande
			SET 
				date 					= '$date_relance',
				heure 					= '$heure_relance', 
				statut 					= '$statut_relance', 
				commentaire 			= '$commentaire_relance',
				id_responsable 			= '$responsable_relance'
			WHERE id = $id_relance
		";
		// echo $query_update_relance;
		// exit;
		if (!$con) {
			die("Connexion échoué !: " . mysqli_connect_error());
		} else {
			if (mysqli_query($con, $query_update_relance)) {
				echo $query_update_relance;
			} else {
				die('Erreur: ' . mysqli_error($con));
			}
		}
	} else
		header('location: ../../login.php');
	mysqli_close($con);
} catch (exception $e) {
	echo "Erreur : " . $e->getMessage() , "\n";
}
