	<?php	
	session_start (); 
	include("connect.php");	
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$login=$_POST['login'];	
	$password1=md5($_POST['password1']);
	
	$type="admin2";
	$req2=mysql_query("insert into admin(nom_admin,prenom_admin,type,login,password) values ('$nom','$prenom','$type','$login','$password1')");
	    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_admin.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_admin.php?a=1";
</script>
