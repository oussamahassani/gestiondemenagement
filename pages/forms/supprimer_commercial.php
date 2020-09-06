
 <?php
 session_start (); 
 // connection a la base de données
  require_once '../../connect.php';
 // recuperation de données de formulaire
	$commercial=$_GET['com'];
					    
	
	
	$req=mysql_query("DELETE FROM commercial where id_commercial='$commercial'");
	
	header('location: ../tables/liste_commerciaux.php');

?><script type="text/javascript">
document.location.href="../tables/liste_commerciaux.php";
</script>