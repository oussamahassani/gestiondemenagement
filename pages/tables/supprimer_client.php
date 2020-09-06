

 <?php

 session_start (); 

 // connection a la base de données

  require_once '../../connect.php';

 // recuperation de données de formulaire

	$id_client=$_GET['id_client'];
$req=mysql_query("DELETE FROM client where id_client='$id_client'");
header('location: ../tables/liste_client.php');
?><script type="text/javascript">

document.location.href="../tables/liste_client.php";

</script>