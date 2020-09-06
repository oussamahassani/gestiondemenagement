	<?php	

	session_start (); 
require_once "inc/header.php"; 
require_once '../connect.php';
require_once "inc/footer.php"; 
require_once"inc/menu.php";
	$targetDir = "images/calculateur/img/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
 $allowTypes = array('svg','pdf');
	$id_admin=$_SESSION['id'];
	$message="extention non valide , merci de choisire un type image  avec extension .svg";

	$source=$_POST['source'];	
	$Nom_vol=$_POST['Nom_vol'];	
	//$id_vol=$_POST['id_vol'];

	$calc_vol=$_POST['calc_vol'];
	$req1="SELECT * FROM categorie where id_catego = $source";
	$req2="SELECT id_vol FROM volume where id_catego  = $source ORDER BY id_vol DESC LIMIT 1";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$requete1 = mysql_query($req1) or die( mysql_error()) ;
	$row = mysql_fetch_assoc($requete1 );
    $a = $row['Nomcategorie'];
	$id_vol = mysql_fetch_assoc($requete2 );
$ab = $id_vol['id_vol'];
	
		echo '<p class="col-md-auto">valeur de requette est'.$a.'<p></br>';
if (!in_array($fileType, $allowTypes)) {
    echo '<div class="container">extension non valide !"';
		echo ' <br><br><br> <div style="margin-top:4rem;" class="alert alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>faute grave!</strong> merci de choisire un type image  avec extension .svg
        <a class="close" href="../racine/liste_volume.php">&times;</a>
           	</div>';
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else{
	move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath); 
   
		echo '<div ="table table-striped" style="margin-top:4rem; margin-left:2rem;" <p>valeur de id volume est  est'.$ab .'</p>';
		      echo "votre image:  ". basename( $_FILES["file"]["name"]). " a ete uploaded.</br></br>";
	 if ( $a == 'Salle de bain' ) {

	if (mysql_num_rows($requete2))
	
	{
	$ac=1;
	$ab=$ab+$ac;
	
     
echo '<p>valeur de id :'.$ab.'</p>';
	
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	 }}
	 
	else
	 {
		 $ab=20;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p>il na pas encore de volume pour cette categorie Salle de bain</p>';
			
			
	}
	 }
      else if ( $a == 'hall' ) {
	if (mysql_num_rows($requete2))
	{
	$ab=$ab+1;
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	
	  } }
	  else
	 {
		 $ab=50;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p>il na pas encore de volume pour cette categorie hall</p>';
			
	  }}
	  
 else if ( $a == 'cuisine' ) {
	echo '<p>categorie cuisine</p>';
	
	$ac=1;
	$ab=$ab+1;
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	
 } }
 else if ( $a == 'Bureau' ) {
	 if (mysql_num_rows($requete2))
	{
	echo '<p>categorie Bureau</p>';
	
	$ab=$ab+1;
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	
 }}
 else
	 {
		 $ab=80;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p>il na pas encore de volume pour cette categorie  Bureau<</p>';
		
	  }}
else if ( $a == 'Veranda' ) {
	if (mysql_num_rows($requete2))
	{
	echo '<p>categorie Veranda</p>';
	$ac=1;
	$ab=$ab+$ac;
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	
} 
} 
 else
	 {
		 $ab=100;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p class="col-md-auto" >il na pas encore de volume pour la  categorie Veranda </p>';
			
	  }}
else if ( $a == 'Salle à manger' )
	{
	if (mysql_num_rows($requete2))
	
{
	$ac=1;
	$ab=$ab+$ac;
    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{
	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
} 
}
else
	 {
		 $ab=120;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p>il na pas encore de volume pour cette categorie salle a manger</p>';
			
	  }}
	

else
{
	if (mysql_num_rows($requete2))
	{

	  
	$ac=1;
$ab=$ab+$ac;
echo '<p>valeur de id :'.$ab.'</p>';

    if (isset($_POST['source'])!= "" && isset($_POST['Nom_vol'])!= ""  && isset($_POST['Nom_vol'])!= ""  && isset($_POST['calc_vol'])!= ""  && isset($fileName)!= "" )
	{

	$req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
	}}
else
	 {
		 $ab=140;
		 $req2="insert into volume (id_vol,image, category, nom_vol, calc_vol, id_catego) values ('$ab','$targetFilePath','$a ','$Nom_vol','$calc_vol','$source')";
			echo '<p>il na pas encore de volume pour cette categorie </p>';
		

}}

echo '<p>snomcategorie:'.$a.'<p>';

  $requete = mysql_query($req2) or die( mysql_error() ) ;
if($requete)
  {
    echo("L'insertion a été correctement effectuée");
	
	echo ' <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
        <a class="close" href="../racine/liste_volume.php">&times;</a>
           	</div>';
			echo '</div>' ;
	 
  }
  else
  {
    echo("L'insertion à échouée") ;
  }

}

?>
<!--
<script type="text/javascript">
document.location.href="../racine/liste_volume.php";
</script>>

