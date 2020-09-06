<?php
/*******************************************************
* Déclaration de la fonction
*******************************************************/
/**
* La fonction force le téléchargement d'un fichier
*
* @author : Hugo HAMON
* @param : string $nom nom du fichier
* @param : string $situtation emplacement sur le serveur web
* @param : integer $poids poids du fichier en octets
* @return : void
**/
function forcerTelechargement($nom, $situation)
{
header('Content-Type: application/octet-stream');

header('Content-disposition: attachment; filename='. $nom);
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($situation);
exit();
}
/*******************************************************
* Appel de la fonction
*******************************************************/
$fichier=$_GET['nom'];
$situation="documents/".$fichier;
forcerTelechargement($fichier,$situation);
?>