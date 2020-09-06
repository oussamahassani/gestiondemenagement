	<?php	

	session_start (); 

	require_once '../../connect.php';
	$actif =$_POST['actif'];
	$id_type=$_POST['id_type'];
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$surnom=$_POST['surnom'];
	$poste=$_POST['poste'];
	$email=$_POST['email'];
	$tel=$_POST['tel'];
	$telMobile=$_POST['telMobile'];
	$login=$_POST['login'];	
	$password2=md5($_POST['password2']);


	$req2=mysql_query("INSERT INTO utilisateur (actif,id_type,civilite, nom,prenom,surnom,poste,tel,telMobile,email,login,password)
	 values ($actif,'$id_type','$civilite','$nom','$prenom','$surnom','$poste','$tel','$telMobile','$email','$login','$password2')");  
	if($req2)
    {echo "truee";}else
	{echo "false";}
	
?>
<script type="text/javascript">
document.location.href="../../racine/liste_utilisateur.php";
</script>


