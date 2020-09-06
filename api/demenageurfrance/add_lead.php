<?php	
    session_start (); 

	include("../../connect.php");	

	$source=10;
	$idType=4;
	$yourname=$_POST['your-name'];	
	$lieudep=$_POST['lieua'];
	$lieuarr=$_POST['lieub'];
	$volume=$_POST['volume'];
    $dates=$_POST['dates'];
    $formule=$_POST['formule'];	
	$email=$_POST['your-email'];
	$telephone=$_POST['tel'];
	$volume1=$volume/2;
	
	
	
	$today = date("Y-m-d");  
	$date_etab=$today;

	$cp_dep=$_POST['cp_depart'];

	$ville_dep=$_POST['ville_depart'];

	$ville_dep=str_replace("'", "&acute;",$ville_dep);

	

	$remarque=str_replace("'", "&acute;",$remarque);
	$req2=mysql_query("insert into client(clientB2B,type_client,nom,tel,email) values (0,'1','$yourname','$telephone','$email')");
	
	
	$idclient=mysql_insert_id();	    
	$req3=mysql_query("insert into demande(id_type,type_facturation, id_source,id_client,etablie_le,adresse_dep,date_dep,date_dep,adresse_arr,volume,prestation) 
	                              values ('$idType','11','$source','$idclient','$date_etab','$lieudep','$dates','$lieuarr','$volume1','$formule')");
    $idDemande=mysql_insert_id();	
	
	if($req3)

	{echo "OK";}else

	{echo "KO";}
	
	echo  'Id demande : '.$idDemande ;
  /*
////Envoi de mail
$host     = $_SERVER['SERVER_NAME'];
$port     = $_SERVER["SERVER_PORT"];
$query    = $_SERVER['REQUEST_URI'];
$passage_ligne = "\r\n";
	$header = "From: <leads@fiches-demenagement.com>".$passage_ligne;
	$header.= "Reply-to: <leads@fiches-demenagement.com>".$passage_ligne;
	$header.= "CC: leads@fiches-demenagement.com;".$passage_ligne;
	$header.= "BCC: khedira.hela@gmail.com;sarrahafsia.91@gmail.com;".$passage_ligne;
	$header.= "MIME-version: 1.0\n"; 
	$header.= "Content-type: text/html; charset= UTF-8\n"; 

//TO :t.ttransport@orange.fr 
//
//CC : leads@fiches-demenagement.com 


$email=$result1['emailClientB2B'];
$idClientB2B=$result1['id_client'];

$sujet="Trouver mon déménageur - Fiche Déménagement";

$id=$idDemande; 
$req=mysql_query("select * ,tldep.valeur as type_Logement_dep from demande INNER JOIN client ON demande.id_client=client.id_client LEFT JOIN masterParametreValeur tldep ON tldep.id=typeLogement_dep where  demande.id_dem='$id' ");
while($result=mysql_fetch_array($req))
{

$date=$result['etablie_le'];
$a=substr($date,0,4);
$m=substr($date,5,2);
$j=substr($date,8,2);
$date=$j."/".$m."/".$a;


$nomclient=$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['tel'];
$emailClient=$result['email'];
$code_postale_dep=$result['code_postale_dep'];
$ville_dep=$result['ville_dep'];
$type_Logement_dep=$result['type_Logement_dep'];
$rqs=$result['rqs'];
}
$style='<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
<!--
p {margin: 0; padding: 0;}	.ft10{font-size:31px;font-family:Times;color:#17365d;}
.ft11{font-size:16px;font-family:Times;color:#000000;}
.ft12{font-size:16px;font-family:Times;color:#4aacc5;}
.ft13{font-size:16px;font-family:Times;color:#000000;}
.ft14{font-size:14px;font-family:Times;color:#30849b;}
.ft15{font-size:16px;font-family:Times;color:#4aacc5;}
.ft16{font-size:16px;font-family:Times;color:#30849b;}
.ft17{font-size:16px;font-family:Times;color:#4aacc5;}
.ft18{font-size:14px;font-family:Times;color:#17365d;}
.ft19{font-size:14px;font-family:Times;color:#000000;}
.ft110{font-size:16px;line-height:22px;font-family:Times;color:#000000;}
.ft111{font-size:14px;line-height:20px;font-family:Times;color:#30849b;}
.ft112{font-size:14px;line-height:19px;font-family:Times;color:#30849b;}
.ft113{font-size:16px;line-height:22px;font-family:Times;color:#4aacc5;}
-->
</style>
</head>
<body>';

$html =$style.'<body bgcolor="#A0A0A0" vlink="blue" link="blue">
<div id="page1-div" style="position:relative;width:892px;height:1262px;">
<table  style="width:892px;height:900px;" background="http://devis.superdemenagement.fr/cron/background.png" background-repeat="no-repeat">
<tr><td>
<table style="text-align: center" width="100%">
<tr>
<td>
<a href="http://trouver-mon-demenageur.com/">Trouver mon déménageur</a>
</td></tr>
</table>
</td>
</tr><tr>

<td>
<p style="position:absolute;white-space:nowrap" class="ft12"><b>INFORMATION&#160;DÉPART&#160;</b></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Code&#160;postal&#160;:&#160;</b>'.$code_postale_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Ville&#160;:&#160;</b>'.$ville_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Type&#160;de&#160;logement&#160;:&#160;</b>'.$type_Logement_dep.'</p>

<p style="position:absolute;white-space:nowrap" class="ft16">&#160;</p>

<p style="position:absolute;white-space:nowrap" class="ft113">&#160;<br/><i><b>INFORMATION&#160;CLIENT&#160;</b></i>&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>

<p style="position:absolute;white-space:nowrap" class="ft111"><b>Nom&#160;:&#160;</b>'.$nomclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Prénom&#160;:&#160;</b>'.$prenomclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Téléphone&#160;:&#160;</b>'.$telclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Email&#160;:&#160;</b>'.$emailClient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft16">&#160;</p>

<p style="position:absolute;white-space:nowrap" class="ft113">&#160;<br/><i><b>VOTRE PROJET</b></i>&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111">'.$rqs.'</p>
<p style="position:absolute;white-space:nowrap" class="ft18"><b>&#160;</b></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft19">&#160;&#160;</p>
</td></tr>
</table>
</div>
</body>
</html>';


mail($email,$sujet,$html,$header);
	*/	
?>


