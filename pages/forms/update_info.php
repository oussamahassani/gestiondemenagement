	<?php	
	session_start (); 
	include("connect.php");	
	$id_admin=$_SESSION['id'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
    $id=$_SESSION['id'];
	
	  $req=mysql_query("UPDATE admin SET nom_admin='$nom',prenom_admin='$prenom'
	
	where id_admin='$id'");  
	
if($req)
	{echo "truee";}else
	{echo "false";}
   header('location: info.php?a=1');
?>	<script type="text/javascript">
document.location.href="info.php?a=1";
</script>
