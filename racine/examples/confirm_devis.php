 <?php
 // connection a la base de données
  require_once '../../connect.php';
 // recuperation de données de formulaire
	$id_devis=$_POST['iddev'];
					    
	
	
	
	$req=mysql_query("UPDATE devis SET confirm='1'
	where id_devis='$id_devis'");
	
	header('location: ../../liste_devis_conf.php');

?>