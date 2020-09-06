	<?php	
	session_start (); 
	include("connect.php");	
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$login=$_POST['login'];	
	$password2=md5($_POST['password2']);
	$id=$_POST['id'];
	  $req2=mysql_query("UPDATE admin SET nom_admin='$nom',prenom_admin='$prenom',login='$login',password='$password2' where id_admin='$id' ");    
	  
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
  header('location: ../tables/liste_admin.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_admin.php?a=1";
</script>
