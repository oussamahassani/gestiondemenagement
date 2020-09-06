
 <?php
 session_start (); 
// connection a la base de données
require_once '../../connect.php';
// recuperation de données de formulaire

$id=$_GET['devis'];

$req1=mysql_query("DELETE FROM devis where id_devis='$id'");



if($_GET['retour']==0)
	{
  header('location: ../tables/liste_devis_conf.php');
?>	<script type="text/javascript">
document.location.href="../tables/liste_devis_conf.php";
</script>
<?php 
	}else
	{
	 header('location: ../tables/liste_devis.php');
?>	<script type="text/javascript">
document.location.href="../tables/liste_devis.php";
</script>	
<?php	}
?>