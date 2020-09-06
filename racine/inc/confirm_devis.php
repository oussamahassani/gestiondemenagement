 <?php

 session_start (); 

 // connection a la base de données

  require_once '../../connect.php';

 // recuperation de données de formulaire

	$id=$_GET['id_devis'];
    $id_admin=$_SESSION['id'];
    $req=mysql_query("UPDATE devis SET confirm=1,id_statut=46,id_ad_dev='$id_admin'
	where id_devis='$id'");
	
	header('location: ../liste_devis.php?confirm=1');


?>