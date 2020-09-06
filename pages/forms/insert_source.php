	<?php	
	session_start (); 
	include("connect.php");	
	
	$id_admin=$_SESSION['id'];
	$couleur=$_POST['couleur'];
	$source=$_POST['nom_source'];
    $source=str_replace("'", "&acute;",$source);	
	$site=$_POST['site'];
	
	$req2=mysql_query("insert into source(couleur,nom_source,site,id_admin_source) values ('$couleur','$source','$site','$id_admin')");
	    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_source.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_source.php?a=1";
</script>
*/
?>