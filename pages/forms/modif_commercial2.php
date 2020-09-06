	<?php	
	session_start (); 
	include("connect.php");	
	$id_admin=$_SESSION['id'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$adresse=$_POST['adresse'];	
	$adresse=str_replace("'", "&acute;",$adresse);
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$id=$_POST['id'];
	
	  $req2=mysql_query("
	UPDATE commercial SET nom_com='$nom',prenom_com='$prenom',adresse_com='$adresse',tel_com='$tel',email_com='$email',id_admin_com='$id_admin'
	
	where id_commercial='$id' ");    
	  
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_commerciaux.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_commerciaux.php?a=1";
</script>
