<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	require_once '../../connect.php';

	$con 						= mysql_connect($SERVER,$USERNAME,$PASSWORD);

	$que_user_logged 			= mysql_query($query_user_logged);
	$result_user_logged 		= mysql_fetch_array($que_user_logged);

	$que_get_status_parameter 	= mysql_query($query_get_status_parameter);
	$result_status_parameter 	= mysql_fetch_array($que_get_status_parameter);

	if (isset($_POST['comptRelance']) && ($_POST['comptRelance']) == 1) {
		// var_dump($_POST);
		$civilite_client 				= $_POST['civilite_client'];
		$nom_client 					= $_POST['nom_client'];
		$prenom_client 					= $_POST['prenom_client'];
		$num_mobile_client 				= $_POST['num_mobile_client'];
		$num_tel_client 				= $_POST['num_tel_client'];
		$mail_client 					= $_POST['mail_client'];
		$date_depart 					= $_POST['date_depart'];
		$cp_depart 						= $_POST['cp_depart'];
		$date_relance 					= $_POST['date_relance'];
		$heure_relance 					= $_POST['heure_relance'];
		$responsable_relance 			= $_POST['responsable_relance'];
		$statut_relance 				= $_POST['statut_relance'];
		$commentaire_relance 			= $_POST['commentaire_relance'];

		$req_client 					= mysql_query("
			INSERT IGNORE INTO client (civilite, nom, prenom, tel, telMobile, email)
			VALUES ('$civilite_client', '$nom_client', '$prenom_client', '$num_tel_client', '$num_mobile_client', '$mail_client')
		");
		$id_client 						= mysql_insert_id();

		$req_demande 					= mysql_query("
			INSERT IGNORE INTO demande (date_dep, code_postale_dep)
			VALUES ('$date_depart', '$cp_depart')
		");
		$id_demande 					= mysql_insert_id();

		$query_insert_relance 			= mysql_query("
			INSERT IGNORE INTO relanceDevis (idDevis, id_demande, id_client, dateRelance, heureRelance, id_utilisateur, commentaire)
			VALUES (0, $id_demande, $id_client, '$date_relance', '$heure_relance', $responsable_relance, '$commentaire_relance')
		");
		header('location: ../liste_relance.php');
	} else 
		header('location: ../index.php');
} else
	header('location: ../login.php');
?>