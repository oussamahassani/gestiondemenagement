

<?php
session_start (); 
require_once '../../connect.php';

// recuperation de données de formulaire



$id=$_GET['id_devis'];
$req1=mysql_query("DELETE FROM devis where id_devis='$id'");

if (($_GET['confirm'] == 0) &&  ($_GET['annule'] == 1)) 
{header('location: ../liste_devis.php?annule=1');}
else if (($_GET['confirm']  == 1) &&  ($_GET['annule'] == 0)) 
{header('location: ../liste_devis.php?confirm=1');}
else 
{header('location: ../liste_devis.php');}


?>