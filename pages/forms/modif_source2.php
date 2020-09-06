
		<?php	
		session_start (); 
	include("connect.php");	
	$id_admin=$_SESSION['id'];
	$id_source=$_POST['id_source'];
	$couleur=$_POST['couleur'];
	$source=$_POST['nom_source'];
    $source=str_replace("'", "&acute;",$source);	
	$site=$_POST['site'];
	
	
	$req2=mysql_query("
	UPDATE source SET couleur='$couleur',nom_source='$source',site='$site',id_admin_source='$id_admin'
	
	where id_source='$id_source' ");    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_source.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_source.php?a=1";
</script>
