	<?php	

	session_start (); 

	require_once '../../connect.php';

	$id_admin=$_SESSION['id'];

	
	$date=$_POST['date_vis'];

	$a=substr($date,6,4);

	$m=substr($date,3,2);

	$j=substr($date,0,2);

	$date=$a."-".$m."-".$j;



	$heure=$_POST['time'];	

	$commercial=$_POST['commercial'];

	$dem=$_POST['dem'];
	$id_visite=$_POST['id_visite'];
	
	$id_statut_vis=$_POST['id_statut_vis'];

	$remarque=$_POST['remarque'];

	

$req=mysql_query("select * from visite where id_dem_vis='$dem'");

if($result1=mysql_fetch_array($req))

				{
    $req2=mysql_query("
	UPDATE visite SET date_vis='$date',heure_vis='$heure',id_com='$commercial',remarque_visite='$remarque',id_admin_vis='$id_admin',id_statut_vis='$id_statut_vis'

	where id_visite='$id_visite' ");
}else{

	$req2=mysql_query("insert into visite(id_dem_vis,date_vis,heure_vis,id_com,remarque_visite,id_admin_vis,id_statut_vis)

	values ('$dem','$date','$heure','$commercial','$remarque','$id_admin','$id_statut_vis')");

				}

	

	
?>

<script type="text/javascript">
document.location.href="../../racine/liste_visite.php";
</script>	
