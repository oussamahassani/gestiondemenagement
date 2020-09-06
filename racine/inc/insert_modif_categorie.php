<?php
session_start (); 	
require_once '../../connect.php';
    
	$nom=$_POST['nom_cat'];
	$id=$_POST['id_cat'];

		

	
	if($_POST['nom_cat']!="")
	{
	$req2=mysql_query("UPDATE categorie SET Nomcategorie='$nom' where id_catego='$id' ");
	}    
	
	
?>	
<script type="text/javascript">
	document.location.href="../liste_categorie.php";

</script>

