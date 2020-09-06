	<?php	

function intdiv($a, $b){
    return ($a - $a % $b) / $b;
}

	session_start (); 

	include("../../connect.php");	

	$login=$_GET['login'];
	$password=$_GET['password'];
	if ($login=='DevisProx-SuperDem' &&  $password=='@DevisProx@')
	{
	$source=5;
	$idq=$_POST['idq'];	
	$qid=$_POST['qid'];	
	$idType=4;	

	$civilite=$_POST['civilite'];
	if ($civilite=='1')
	$civilite='Mr';
    if ($civilite=='3')
	$civilite='Mme';

	$typeClient=1;
	$nom=$_POST['nom'];

	$prenom=$_POST['prenom'];
	
	$telMobile=$_POST['tel_mobile'];
	$telephone=$_POST['tel_domicile'];
	
	
	$email=$_POST['email'];

	$type_facturation=$_POST['type_facturation'];
	if ($type_facturation=='1')
	$type_facturation='11';
    if ($type_facturation=='2')
	$type_facturation='12';
	if ($type_facturation=='X')
	$type_facturation='13';



	
	$typeLogement_dep=$_POST['actuel_type'];
	if ($typeLogement_dep=='1')
	$typeLogement_dep='9';
    if ($typeLogement_dep=='2')
	$typeLogement_dep='10';

	$typeLogement_arr=$_POST['futur_type'];
	if ($typeLogement_arr=='1')
	$typeLogement_arr='9';
    if ($typeLogement_arr=='2')
	$typeLogement_arr='10';
	$today = date("Y-m-d");  
	$date_etab=$today;

	

	$date_val=$_POST['date_val'];

	$a=substr($date_val,6,4);

	$m=substr($date_val,3,2);

	$j=substr($date_val,0,2);

	$date_val=$a."-".$m."-".$j;

	

	$adresse_dep=$_POST['adresse_depart'];

	$adresse_dep=str_replace("'", "&acute;",$adresse_dep);

	$cp_dep=$_POST['cp_depart'];

	$ville_dep=$_POST['ville_depart'];

	$ville_dep=str_replace("'", "&acute;",$ville_dep);

	$habit_dep=$_POST['actuel_etage'];

	

	if ($_POST['actuel_ascenseur']== '1')

	{

	$assen_dep=1;

	}else

	{

	$assen_dep=0;

	}

	

	if (isset($_POST['stat_dep']))

	{

	$stat_dep=1;

	}else

	{

	$stat_dep=0;

	}

	

	if (isset($_POST['monte_dep']))

	{

	$monte_dep=1;

	}else

	{

	$monte_dep=0;

	}
	if (isset($_POST['passageFenetre_dep']))

	{

	$passageFenetre_dep=1;

	}else

	{

	$passageFenetre_dep=0;

	}

	if (isset($_POST['accesVehicule_dep']))

	{

	$accesVehicule_dep=1;

	}else

	{

	$accesVehicule_dep=0;

	}

	if (isset($_POST['garde_meuble_dep']))
    {
    $garde_meuble_dep=1;
    }else
    {
    $garde_meuble_dep=0;
	}

	if (isset($_POST['cave_dep']))
    {
    $cave_dep=1;
    }else
    {
    $cave_dep=0;
    }
	
	

	$portage_dep=$_POST['portage_dep'];

	$portage_dep=str_replace("'", "&acute;",$portage_dep);

	$date_dep=$_POST['date_demenagement'];


	

	$periode_dep=$_POST['periode_dep'];

	$adresse_arr=$_POST['adresse_arrivee'];

	$adresse_arr=str_replace("'", "&acute;",$adresse_arr);

	$cp_arr=$_POST['cp_arrivee'];

	$ville_arr=$_POST['ville_arrivee'];

	$ville_arr=str_replace("'", "&acute;",$ville_arr);

	$habit_arr=$_POST['futur_etage'];

	$superficie_dep=$_POST['actuel_superficie'];
    $superficie_arr=$_POST['futur_superficie'];
	$volume = intdiv($superficie_dep, 2);

	if ($_POST['futur_ascenseur']=='1')
	{

	$assen_arr=1;

	}else

	{

	$assen_arr=0;

	}

	

	if (isset($_POST['stat_arr']))

	{

	$stat_arr=1;

	}else

	{

	$stat_arr=0;

	}

	

	if (isset($_POST['monte_arr']))

	{

	$monte_arr=1;

	}else

	{

	$monte_arr=0;

	}
	if (isset($_POST['passageFenetre_arr']))

	{

	$passageFenetre_arr=1;

	}else

	{

	$passageFenetre_arr=0;

	}
	
	if (isset($_POST['accesVehicule_arr']))

	{

	$accesVehicule_arr=1;

	}else

	{

	$accesVehicule_arr=0;

	}

	if (isset($_POST['garde_meuble_arr']))
    {
    $garde_meuble_arr=1;
    }else
    {
    $garde_meuble_arr=0;
    }
	
	if (isset($_POST['cave_arr']))
    {
    $cave_arr=1;
    }else
    {
    $cave_arr=0;
    }
	
	$portage_arr=$_POST['portage_arr'];

	$portage_arr=str_replace("'", "&acute;",$portage_arr);

	$date_arr=$_POST['date_demenagement'];
   
	$periode_arr=$_POST['periode_arr'];
	
	$distance=$_POST['distance'];

	$prestation=$_POST['prestation'];

	$remarque=$_POST['remarque'];	

	$remarque=str_replace("'", "&acute;",$remarque);
	 
	
	if ($qid  != '' )
	{

	$req2=mysql_query("insert into client(clientB2B,type_client,civilite,nom,prenom,tel,telMobile,email) values (0,'$typeClient','$civilite','$nom','$prenom','$telephone','$telMobile','$email')");
	
	
	$idclient=mysql_insert_id();	    

	
     

	$req3=mysql_query("insert into demande(ref_externe,id_type,type_facturation, id_source,id_client,etablie_le,valable_le,adresse_dep,code_postale_dep,ville_dep,habit_dep,assenceur_dep,stationnement_dep,monte_meuble_dep,portage_dep,date_dep,periode_dep,adresse_arr,code_post_arr,ville_arr,habit_arr,assenseur_arr,stationnement_arr,monte_meuble_arr,portage_arr,date_arr,periode_arr,volume,distance,prestation,rqs,id_admin_mod,passageFenetre_dep,passageFenetre_arr,cave_dep,cave_arr,garde_meuble_dep,garde_meuble_arr,accesVehicule_dep,accesVehicule_arr,typeLogement_dep,typeLogement_arr,superficie_dep,superficie_arr) values ('$qid','$idType','$type_facturation','$source','$idclient','$date_etab','$date_val','$adresse_dep','$cp_dep','$ville_dep','$habit_dep','$assen_dep','$stat_dep','$monte_dep','$portage_dep','$date_dep','$periode_dep','$adresse_arr','$cp_arr','$ville_arr','$habit_arr','$assen_arr','$stat_arr','$monte_arr','$portage_arr ','$date_arr','$periode_arr','$volume','$distance','$prestation','$remarque','$id_admin','$passageFenetre_dep','$passageFenetre_arr','$cave_dep','$cave_arr','$garde_meuble_dep','$garde_meuble_arr','$accesVehicule_dep','$accesVehicule_arr','$typeLogement_dep','$typeLogement_arr','$superficie_dep','$superficie_arr')");
    $idDemande=mysql_insert_id();	
	
	if($req3)

	{echo "OK";}else

	{echo "KO";}
	//echo("insert into client(type_client,civilite,nom,prenom,tel,email) values ('$typeClient','$civilite','$nom','$prenom','$telephone','$email')");
	//echo ("insert into demande(ref_externe,id_type, id_source,id_client,etablie_le,valable_le,adresse_dep,code_postale_dep,ville_dep,habit_dep,assenceur_dep,stationnement_dep,monte_meuble_dep,portage_dep,date_dep,periode_dep,adresse_arr,code_post_arr,ville_arr,habit_arr,assenseur_arr,stationnement_arr,monte_meuble_arr,portage_arr,date_arr,periode_arr,volume,distance,prestation,rqs,id_admin_mod,passageFenetre_dep,passageFenetre_arr,cave_dep,cave_arr,garde_meuble_dep,garde_meuble_arr,accesVehicule_dep,accesVehicule_arr,typeLogement_dep,typeLogement_arr,superficie_dep,superficie_arr) values ('$idq','$idType','$source','$idclient','$date_etab','$date_val','$adresse_dep','$cp_dep','$ville_dep','$habit_dep','$assen_dep','$stat_dep','$monte_dep','$portage_dep','$date_dep','$periode_dep','$adresse_arr','$cp_arr','$ville_arr','$habit_arr','$assen_arr','$stat_arr','$monte_arr','$portage_arr ','$date_arr','$periode_arr','$volume','$distance','$prestation','$remarque','$id_admin','$passageFenetre_dep','$passageFenetre_arr','$cave_dep','$cave_arr','$garde_meuble_dep','$garde_meuble_arr','$accesVehicule_dep','$accesVehicule_arr','$typeLogement_dep','$typeLogement_arr','$superficie_dep','$superficie_arr'");
	
	echo  'Id demande : '.$idDemande ;
   }
   else
   
	{echo "KO";}
   
}
else
{
	echo "Incorrect login/password"	;
}



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


$nbMaxEnvoiLead=0;
$req3=mysql_query("SELECT nbMaxEnvoiLead FROM associationTypeService WHERE id_objet=5 and code_objet='Source' and id_service=15 and id_type='$type_facturation'");
while($result3=mysql_fetch_array($req3))
		{
			$nbMaxEnvoiLead=$result3['nbMaxEnvoiLead'];
		}
		
$req1=mysql_query("SELECT client.id_client as  id_client,emailClientB2B FROM client 
               LEFT JOIN logService l on DATE(NOW()) = DATE(l.date_creation) AND l.id_client=client.id_client
			   WHERE clientb2b=1 and cronactif=1 and actif=1
			   GROUP BY  id_client,nbMaxEnvoiLead,emailClientB2B
			   HAVING count(l.id_client)<client.nbMaxEnvoiLead 
			   ORDER BY count(l.id_client) ASC  
			   LIMIT $nbMaxEnvoiLead
");
while($result1=mysql_fetch_array($req1))
		{ 
$email=$result1['emailClientB2B'];
$idClientB2B=$result1['id_client'];

$sujet="Fiche Déménagement";

$id=$idDemande; 
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
$telclientMobile=$result['telMobile'];
$telclient=$result['tel'];
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
<p style="position:absolute;white-space:nowrap" class="ft111"><b>Mobile&#160;:&#160;</b>'.$telclientMobile.'</p>
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
$req2=mysql_query("insert into logService(id_client,id_demande,id_service) values ('$idClientB2B','$id','15')");
	
}
		
?>
<!--<script type="text/javascript">
	document.location.href="../../cron/send_lead_immediat.php?id_dem=<?php echo $idDemande;?>";
	
	</script>!-->



