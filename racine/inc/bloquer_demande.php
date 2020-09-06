

 <?php

 session_start (); 

 // connection a la base de données

  require_once '../../connect.php';

 // recuperation de données de formulaire
 $id_source=$_GET['id_source'];
$id_demande=$_GET['id_demande'];
$bloquee=$_GET['bloquee'];

$req=mysql_query("UPDATE demande SET bloquee=".$bloquee." where id_dem='$id_demande'");
header('location: ../liste_demande_api.php?id_source='.$id_source);
?>
