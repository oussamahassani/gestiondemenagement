	<?php	

	session_start (); 

	require_once '../../connect.php';

	$id_vol=$_POST['id_vol'];
	$id_cat=$_POST['id_cat'];
	/*$nom_cat=$_POST['source'];*/
	$photo=$_POST['photo'];
	$calcvolum=$_POST['calc_vol'];
	$nomvolum=$_POST['Nom_vol'];

	


if(isset($photo)!= "" &&isset($calcvolum)!= "" && isset($nomvolum)!= "" )
{   $req4=mysql_query("UPDATE volume SET nom_vol='$nomvolum',image='$photo',calc_vol='$calcvolum' where id_vol='$id_vol'");
	echo '<p>valeur de requetteee 2 est'.$calcvolum .'</p>';
	}

?>

<script type="text/javascript">
document.location.href="../../racine/liste_volume.php";
</script>	
