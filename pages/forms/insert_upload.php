<?php
session_start();
$dossier = 'documents/';
$fichier = basename($_FILES['file']['name']);
//$taille_maxi = 100000;
$taille = filesize($_FILES['file']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf');
$extension = strrchr($_FILES['file']['name'], '.'); 
//Début des vérifications de sécurité...
/*if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}*/
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}
?>
<?php 

//recuperation des valeurs de champs

$file=$fichier;
$dem=$_POST['dem'];
$t=time(); // Affectera le temps ecoulé entre 1970 ET la date d'aujourd'hui
 require_once 'connect.php';
 if(isset($_SESSION['id']))
$login=$_SESSION['id'];
else
$login=$_SESSION['nom_com'];
$req="INSERT INTO upvisite(id_dem_v,nom_v)
 VALUES('$dem','$file')";
 $exe1=mysql_query($req);
 
 //verifier la requete 
    header('location: ../tables/liste_visite.php?a=1');
?>	<script type="text/javascript">
document.location.href="../tables/liste_visite.php?a=1";
</script>