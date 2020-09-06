

<?php
session_start (); 
require_once '../../connect.php';

// recuperation de données de formulaire


$id=$_GET['id_dem'];

$req=mysql_query("DELETE FROM demande where id_dem='$id'");

$req1=mysql_query("DELETE FROM devis where id_demande='$id'");

$req2=mysql_query("DELETE FROM visite where id_dem_vis='$id'");

$req3=mysql_query("DELETE FROM relance where id_demande_rel='$id'");

$req4=mysql_query("DELETE FROM facture where id_dem='$id'");



header('location: ../../racine/liste_demande.php');


?>