
 <?php
 session_start (); 
 // connection a la base de données
  require_once '../../connect.php';
 // recuperation de données de formulaire
	$admin=$_GET['admin'];
					    
	
	
	$req=mysql_query("DELETE FROM admin where id_admin='$admin'");
	
	header('location: ../tables/liste_admin.php');

?><script type="text/javascript">
document.location.href="../tables/liste_admin.php";
</script>