<?php
session_start (); 
// connection a la base de données
require_once '../../connect.php';
// recuperation de données de formulaire

$id_source=$_GET['id_source'];
$id_client=$_GET['id_client'];
$id_demande=$_GET['id_demande'];
echo $id_client;
echo $id_demande;
$req1=mysql_query("insert into demande(id_client_B2B,ref_externe,id_type,type_facturation, id_source,id_client,etablie_le,valable_le,adresse_dep,code_postale_dep,ville_dep,habit_dep,assenceur_dep,stationnement_dep,monte_meuble_dep,portage_dep,date_dep,periode_dep,adresse_arr,code_post_arr,ville_arr,habit_arr,assenseur_arr,stationnement_arr,monte_meuble_arr,portage_arr,date_arr,periode_arr,volume,distance,prestation,rqs,id_admin_mod,passageFenetre_dep,passageFenetre_arr,cave_dep,cave_arr,garde_meuble_dep,garde_meuble_arr,accesVehicule_dep,accesVehicule_arr,typeLogement_dep,typeLogement_arr,superficie_dep,superficie_arr,id_demande_source)
    SELECT $id_client,ref_externe,id_type,type_facturation, id_source,id_client,etablie_le,valable_le,adresse_dep,code_postale_dep,ville_dep,habit_dep,assenceur_dep,stationnement_dep,monte_meuble_dep,portage_dep,date_dep,periode_dep,adresse_arr,code_post_arr,ville_arr,habit_arr,assenseur_arr,stationnement_arr,monte_meuble_arr,portage_arr,date_arr,periode_arr,volume,distance,prestation,rqs,id_admin_mod,passageFenetre_dep,passageFenetre_arr,cave_dep,cave_arr,garde_meuble_dep,garde_meuble_arr,accesVehicule_dep,accesVehicule_arr,typeLogement_dep,typeLogement_arr,superficie_dep,superficie_arr,'$id_demande'
   FROM demande WHERE id_dem='$id_demande'");
    $id_demande_superdem=mysql_insert_id();	

$req2=mysql_query("insert into logService(id_client,id_demande,id_service) values ('$id_client','$id_demande','15')");
	
if ( $id_client == 247 ) /*SUPER DEMENAGEMENT*/
{
   $req3=mysql_query("UPDATE demande SET id_demande_superdem=".$id_demande_superdem." where id_dem='$id_demande'");
}
elseif ($id_client == 141 ) /*Paris Eco*/
{
$req3=mysql_query("UPDATE demande SET id_demande_pariseco=".$id_demande_pariseco." where id_dem='$id_demande'");
}

header('location: ../liste_demande_api.php?id_source='.$id_source);
?>
