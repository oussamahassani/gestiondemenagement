<?php
session_start (); 
// connection a la base de données
require_once '../../connect.php';
// recuperation de données de formulaire
$id_source=$_GET['id_source'];
$id_client=$_GET['id_client'];
$id_demande=$_GET['id_demande'];
$req=mysql_query("delete from devis WHERE id_demande in (select id_dem from demande where id_client_B2B ='$id_client' and id_demande_source='$id_demande')");
ECHO "delete from devis WHERE id_demande in (select id_dem from demande where id_client_B2B ='$id_client' and id_demande_source='$id_demande')";
$req1=mysql_query("delete from visite WHERE id_dem_vis in (select id_dem from demande where id_client_B2B ='$id_client' and id_demande_source='$id_demande')");
echo "delete from visite WHERE id_dem_vis in (select id_dem from demande where id_client_B2B ='$id_client' and id_demande_source='$id_demande')";
$req2=mysql_query("delete from demande WHERE id_client_B2B ='$id_client' and id_demande_source='$id_demande'");
echo "delete from demande WHERE id_client_B2B ='$id_client' and id_demande_source='$id_demande'";

$req4=mysql_query("delete from logService WHERE id_client ='$id_client' and id_demande='$id_demande'");
if ( $id_client == 247 ) /*SUPER DEMENAGEMENT*/
{
   $req3=mysql_query("UPDATE demande SET id_demande_superdem=NULL where id_dem='$id_demande'");
}
elseif ($id_client == 141 ) /*Paris Eco*/
{
$req3=mysql_query("UPDATE demande SET id_demande_pariseco=NULL where id_dem='$id_demande'");
}

header('location: ../liste_demande_api.php?id_source='.$id_source);
?>
