	<?php	

	session_start (); 

	require_once '../../connect.php';

	$id_admin=$_SESSION['id'];
	$actif =$_POST['actif'];
	$id_type=$_POST['id_type'];
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$surnom=$_POST['surnom'];
	$poste=$_POST['poste'];
	$email=$_POST['email'];
	$tel=$_POST['telephone'];
	$telMobile=$_POST['telMobile'];
	$login=$_POST['login'];	

	$password2=md5($_POST['password2']);

	$id=$_POST['id_utilisateur'];

	$req2=mysql_query("UPDATE utilisateur SET actif=$actif, id_type='$id_type',civilite='$civilite',nom='$nom',prenom='$prenom',surnom='$surnom',poste='$poste',tel='$tel',telMobile='$telMobile',email='$email',login='$login',password='$password2' where id_utilisateur='$id' ");    
	if($req2)

	{echo "truee";}else
	{echo "false";}
	
?>
<script type="text/javascript">
document.location.href="../../racine/liste_utilisateur.php";
</script>
