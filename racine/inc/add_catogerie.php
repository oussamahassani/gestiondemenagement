	<?php	

	session_start (); 

	require_once '../../connect.php';
	$nom_cat=$_POST['nom_cat'];
	$chain1="Veranda";
	$chain2="cuisine";
    $chain3="Salle à manger";
	$chain4="salon";
	$chain5="Bureau";
	$chain6="Salle de bain";
	
	
	
    if (isset($_POST['nom_cat'])!= "" && ($nom_cat ===$chain1 )) {
$id='1';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo "<script>console.log('Debug Objects: " . $nom_cat . "' );</script>";

}
else  if ((isset($_POST['nom_cat'])!= "") && ($nom_cat ===$chain2) ) {
$id='2';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo     '<p>target salon : '.$nom_cat.'</p>\n';

}
 else if (isset($_POST['nom_cat'])!= "" && ($nom_cat==$chain3)) {
$id='3';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo "<script>console.log('Debug Objects: " . $nom_cat . "' );</script>";

}
 else if (isset($_POST['nom_cat'])!= "" && ($nom_cat==$chain4)) {
$id='4';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo "<script>console.log('Debug Objects: " . $nom_cat . "' );</script>";

}
 else if (isset($_POST['nom_cat'])!= "" && ($nom_cat==$chain5)) {
$id='5';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo "<script>console.log('Debug Objects: " . $nom_cat . "' );</script>";

}
 else if (isset($_POST['nom_cat'])!= "" && ($nom_cat==$chain6)) {
$id='6';
	$req1="insert into categorie(id_catego,Nomcategorie) values ($id,'$nom_cat')";

echo "<script>console.log('Debug Objects: " . $nom_cat . "' );</script>";

}
else
{
	$req1="insert into categorie(id_catego,Nomcategorie) values ('','$nom_cat')";
}

 $requete = mysql_query($req1) or die( mysql_error() ) ;
if($requete)
  {
    echo("L'insertion a été correctement effectuée") ;
  }
  else
  {
    echo("L'insertion à échouée") ;
  }
?>

<script type="text/javascript">
	document.location.href="../liste_categorie.php";

</script>

