<?php

//$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === FALSE ? 'http' : 'https';
	$host     = $_SERVER['SERVER_NAME'];
	$port     = $_SERVER["SERVER_PORT"];
	$query    = $_SERVER['REQUEST_URI'];
	//echo $host."<br>";
	//echo $port."<br>";
	//echo $query."<br>";
	// $url="url: ".$protocol.'://'.$host.($port != 80 ? ':'.$port : '').$query;
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
$email="t.ttransport@orange.fr;";
$sujet="Fiche Déménagement";
//include(__DIR__."../connect.php");
include("../connect.php");

$id=$_GET['id_dem'] ; 
$req=mysql_query("select * ,tldep.valeur as type_Logement_dep,tlarr.valeur as type_Logement_arr from demande INNER JOIN client ON demande.id_client=client.id_client LEFT JOIN masterParametreValeur tldep ON tldep.id=typeLogement_dep LEFT JOIN masterParametreValeur tlarr ON tlarr.id=typeLogement_arr  where  demande.id_dem='$id' ");
while($result=mysql_fetch_array($req))
{
	if($result['assenceur_dep']=="1")
	{
	$accen_dep="oui";
	}else
	{
	$accen_dep="non";
	}
	if($result['assenseur_arr']=="1")
	{
	$accen_arr="oui";
	}else
	{
	$accen_arr="non";
	}

	
$date=$result['etablie_le'];
$a=substr($date,0,4);
$m=substr($date,5,2);
$j=substr($date,8,2);
$date=$j."/".$m."/".$a;

$datearr=$result['date_arr'];
$a=substr($datearr,0,4);
$m=substr($datearr,5,2);
$j=substr($datearr,8,2);
$datearr=$j."/".$m."/".$a;
$datedep=$result['date_dep'];
$a=substr($datedep,0,4);
$m=substr($datedep,5,2);
$j=substr($datedep,8,2);
$datedep=$j."/".$m."/".$a;
$civiliteclient=$result['civilite'];
$nomclient=$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['telMobile'];
$emailClient=$result['email'];
$adresse_dep=$result['adresse_dep'];
$code_postale_dep=$result['code_postale_dep'];
$ville_dep=$result['ville_dep'];
$habit_dep=$result['habit_dep'];
$portage_dep=$result['portage_dep'];
$superficie_dep=$result['superficie_dep'];
$adresse_arr=$result['adresse_arr'];
$code_postale_arr=$result['code_post_arr'];
$ville_arr=$result['ville_arr'];
$habit_arr=$result['habit_arr'];
$portage_arr=$result['portage_arr'];
$superficie_arr=$result['superficie_arr'];
$type_Logement_dep=$result['type_Logement_dep'];
$type_Logement_arr=$result['type_Logement_arr'];


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
<a href="http://www.fiches-demenagement.com"><img src="http://devis.superdemenagement.fr/cron/logo.png" alt="http://www.fiches-demenagement.com"  >
</a>
</td></tr>
</table>
</td>
</tr><tr>

<td>
<p style="position:absolute;white-space:nowrap" class="ft12"><b>INFORMATION&#160;DÉPART&#160;</b></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Adresse&#160;:&#160;</b>'.$adresse_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Code&#160;postal&#160;:&#160;</b>'.$code_postale_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Ville&#160;:&#160;</b>'.$ville_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Type&#160;de&#160;logement&#160;:&#160;</b>'.$type_Logement_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Étage&#160;:&#160;</b>'.$habit_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Ascenseur&#160;:&#160;</b>'.$accen_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Superficie&#160;:&#160;</b>'.$superficie_dep.'</p>
<p style="position:absolute;white-space:nowrap" class="ft16">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft15"><i><b>INFORMATION&#160;ARRIVÉE&#160;&#160;</b></i></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Adresse&#160;:&#160;</b>'.$adresse_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Code&#160;postal&#160;:&#160;</b>'.$code_postale_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Ville&#160;:&#160;</b>'.$ville_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Type&#160;de&#160;logement&#160;:&#160;</b>'.$type_Logement_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Étage&#160;:&#160;</b>'.$habit_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Ascenseur&#160;:&#160;</b>'.$accen_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Superficie&#160;:&#160;</b>'.$superficie_arr.'</p>
<p style="position:absolute;white-space:nowrap" class="ft16">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft15"><i><b>DATE&#160;ESTIMÉE&#160;DU&#160;DÉMÉNAGEMENT</b></i><b>&#160;</b></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>'.$datedep.'</b></p>
<p style="position:absolute;white-space:nowrap" class="ft113">&#160;<br/><i><b>INFORMATION&#160;CLIENT&#160;</b></i>&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Civilité&#160;:&#160;</b>'.$civiliteclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Nom&#160;:&#160;</b>'.$nomclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Prénom&#160;:&#160;</b>'.$prenomclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Téléphone&#160;:&#160;</b>'.$telclient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Email&#160;:&#160;</b>'.$emailClient.'</p>
<p style="position:absolute;white-space:nowrap" class="ft18"><b>&#160;</b></p>
<p style="position:absolute;white-space:nowrap" class="ft13">&#160;</p>
<p style="position:absolute;white-space:nowrap" class="ft19">&#160;&#160;</p>
</td></tr>
</table>
</div>
</body>
</html>';


 mail($email,$sujet,$html,$header);
							?>