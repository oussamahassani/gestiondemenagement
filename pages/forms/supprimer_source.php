
 <?php
 session_start (); 
 // connection a la base de données
  require_once '../../connect.php';
 // recuperation de données de formulaire
	$source=$_GET['source'];
					    
	
	
	$req=mysql_query("DELETE FROM source where id_source='$source'");
	
	header('location: ../tables/liste_source.php');

?><script type="text/javascript">
document.location.href="../tables/liste_source.php";
</script>