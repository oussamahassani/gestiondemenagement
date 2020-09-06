<?php

session_start (); 	

	include("connect.php");	

	$id_admin=$_SESSION['id'];

	$id_d=$_POST['id_client'];

	$id=$_POST['id_c'];

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

	

	$date_arr=$_POST['date_arr'];

	$a=substr($date_arr,6,4);

	$m=substr($date_arr,3,2);

	$j=substr($date_arr,0,2);

	$date_arr=$a."-".$m."-".$j;

	

		

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

	

		

	$volume=$_POST['volume'];

	$distance=$_POST['distance'];

	$prestation=$_POST['prestation'];

	$remarque=$_POST['remarque'];

	$remarque=str_replace("'", "&acute;",$remarque);

	

		

	

	$req2=mysql_query("

	UPDATE client SET civilite='$civilite',nom='$nom',prenom='$prenom',tel='$telephone',email='$email'

	

	where id_client='$id' ");

		

	$req3=mysql_query("UPDATE demande SET etablie_le='$date_etab',valable_le='$date_val',adresse_dep='$adresse_dep',code_postale_dep='$cp_dep',ville_dep='$ville_dep',habit_dep='$habit_dep',assenceur_dep='$assen_dep',stationnement_dep='$stat_dep',monte_meuble_dep='$monte_dep',portage_dep='$portage_dep',date_dep='$date_dep',adresse_arr='$adresse_arr',code_post_arr='$cp_arr',ville_arr='$ville_arr',habit_arr='$habit_arr',assenseur_arr='$assen_arr',stationnement_arr='$stat_arr',monte_meuble_arr='$monte_arr',portage_arr='$portage_arr',date_arr='$date_arr',volume='$volume',distance='$distance',prestation='$prestation',rqs='$remarque',id_admin_mod='$id_admin',passageFenetre_dep='$passageFenetre_dep',passageFenetre_arr='$passageFenetre_arr' where id_dem='$id_d'");

	

	

	if($req3)

	{echo "truee";}else

	{echo "false";}

  header('location: ../tables/liste_demande.php');

?>	<script type="text/javascript">

document.location.href="../tables/liste_demande.php";

</script>

