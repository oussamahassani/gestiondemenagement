	<?php	

	session_start (); 

	include("connect.php");	

	$id_admin=$_SESSION['id'];

	$couleur=$_POST['couleur'];

	$source=$_POST['source'];	

	$civilite=$_POST['civilite'];

	$nom=$_POST['nom'];

	$prenom=$_POST['prenom'];

	$telephone=$_POST['telephone'];

	$email=$_POST['email'];

	$date_etab=$_POST['date_etab'];

	$a=substr($date_etab,6,4);

	$m=substr($date_etab,3,2);

	$j=substr($date_etab,0,2);

	$date_etab=$a."-".$m."-".$j;

	

	$date_val=$_POST['date_val'];

	$a=substr($date_val,6,4);

	$m=substr($date_val,3,2);

	$j=substr($date_val,0,2);

	$date_val=$a."-".$m."-".$j;

	

	$adresse_dep=$_POST['adresse_dep'];

	$adresse_dep=str_replace("'", "&acute;",$adresse_dep);

	$cp_dep=$_POST['cp_dep'];

	$ville_dep=$_POST['ville_dep'];

	$ville_dep=str_replace("'", "&acute;",$ville_dep);

	$habit_dep=$_POST['habit_dep'];

	

	if (isset($_POST['assen_dep']))

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
	

	$portage_dep=$_POST['portage_dep'];

	$portage_dep=str_replace("'", "&acute;",$portage_dep);

	$date_dep=$_POST['date_dep'];

	$a=substr($date_dep,6,4);

	$m=substr($date_dep,3,2);

	$j=substr($date_dep,0,2);

	$date_dep=$a."-".$m."-".$j;

	

	$periode_dep=$_POST['periode_dep'];

	$date2=substr($periode_dep,0,10);	

	$a=substr($date2,6,4);

	$m=substr($date2,3,2);

	$j=substr($date2,0,2);

	$date2=$a."-".$m."-".$j;

    $date3=substr($periode_dep,13,10);

	$a=substr($date3,6,4);

	$m=substr($date3,3,2);

	$j=substr($date3,0,2);

	$date3=$a."-".$m."-".$j;

	

	

	$adresse_arr=$_POST['adresse_arr'];

	$adresse_arr=str_replace("'", "&acute;",$adresse_arr);

	$cp_arr=$_POST['cp_arr'];

	$ville_arr=$_POST['ville_arr'];

	$ville_arr=str_replace("'", "&acute;",$ville_arr);

	$habit_arr=$_POST['habit_arr'];

	

	if (isset($_POST['assen_arr']))

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

	

	$portage_arr=$_POST['portage_arr'];

	$portage_arr=str_replace("'", "&acute;",$portage_arr);

	$date_arr=$_POST['date_arr'];

	$a=substr($date_arr,6,4);

	echo"<br>".$a;

	$m=substr($date_arr,3,2);

	echo"<br>".$m;

	$j=substr($date_arr,0,2);

	echo"<br>".$j;

	$date_arr=$a."-".$m."-".$j;

	

	$periode_arr=$_POST['periode_arr'];

	$date4=substr($periode_arr,0,10);	

	$a=substr($date4,6,4);

	$m=substr($date4,3,2);

	$j=substr($date4,0,2);

	$date4=$a."-".$m."-".$j;

    $date5=substr($periode_arr,13,10);

	$a=substr($date5,6,4);

	$m=substr($date5,3,2);

	$j=substr($date5,0,2);

	$date5=$a."-".$m."-".$j;

	

	$volume=$_POST['volume'];

	$distance=$_POST['distance'];

	$prestation=$_POST['prestation'];

	$remarque=$_POST['remarque'];	

	$remarque=str_replace("'", "&acute;",$remarque);

	

	$req2=mysql_query("insert into client(civilite,nom,prenom,tel,email) values ('$civilite','$nom','$prenom','$telephone','$email')");

	$idclient=mysql_insert_id();	    

	

	$req3=mysql_query("insert into demande(couleur,id_source,id_client,etablie_le,valable_le,adresse_dep,code_postale_dep,ville_dep,habit_dep,assenceur_dep,stationnement_dep,monte_meuble_dep,portage_dep,date_dep,periode1_dep,periode2_dep,adresse_arr,code_post_arr,ville_arr,habit_arr,assenseur_arr,stationnement_arr,monte_meuble_arr,portage_arr,date_arr,periode_arr1,periode_arr2,volume,distance,prestation,rqs,id_admin_mod,passageFenetre_dep,passageFenetre_arr) values ('$couleur','$source','$idclient','$date_etab','$date_val','$adresse_dep','$cp_dep','$ville_dep','$habit_dep','$assen_dep','$stat_dep','$monte_dep','$portage_dep','$date_dep','$date2','$date3','$adresse_arr','$cp_arr','$ville_arr','$habit_arr','$assen_arr','$stat_arr','$monte_arr','$portage_arr ','$date_arr','$date4','$date5','$volume','$distance','$prestation','$remarque','$id_admin','$passageFenetre_dep','$passageFenetre_arr')");

	

	if($req3)

	{echo "truee";}else

	{echo "false";}

    header('location: ../tables/liste_demande.php');

?>	<script type="text/javascript">

document.location.href="../tables/liste_demande.php";

</script>



