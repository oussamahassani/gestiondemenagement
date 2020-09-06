

 <?php

 session_start (); 

 // connection a la base de données

  require_once '../../connect.php';

 // recuperation de données de formulaire

$id_cat=$_GET['id_cat'];
echo '<script>alert(\'la variable a suprimer est\+ '.$id_cat.')</script>';
$req=mysql_query("DELETE FROM categorie where id_catego='$id_cat'");
$req=mysql_query("DELETE FROM volume where id_catego='$id_cat'");
header('location: ../../racine/liste_categorie.php');
?>