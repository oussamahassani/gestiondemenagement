	<?php	
	session_start (); 
	include("connect.php");	
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$adresse=$_POST['adresse'];	
	$adresse=str_replace("'", "&acute;",$adresse);
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$id_admin=$_SESSION['id'];
	$req2=mysql_query("insert into commercial(nom_com,prenom_com,adresse_com,tel_com,email_com,id_admin_com) values ('$nom','$prenom','$adresse','$tel','$email','$id_admin')");
	    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_commerciaux.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_commerciaux.php?a=1";
</script>
