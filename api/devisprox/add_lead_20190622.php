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

?>
<script type="text/javascript">
	document.location.href="../../cron/send_lead_immediat.php?id_dem=<?php echo $idDemande;?>";
	
	</script>



