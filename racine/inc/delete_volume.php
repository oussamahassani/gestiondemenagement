

 <?php

 session_start (); 

 // connection a la base de données

  require_once '../../connect.php';

 // recuperation de données de formulaire

$id=$_GET['id_dem'];
echo "<script>alert(\"la variable a suprimer est\+ ".$id.")</script>";
$req=mysql_query("DELETE FROM volume where id_vol='$id'");
header('location: ../../racine/liste_volume.php');
?>