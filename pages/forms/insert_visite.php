	<?php	
	session_start (); 
	include("connect.php");	
	
	$id_admin=$_SESSION['id'];
	$date=$_POST['date'];
	$a=substr($date,6,4);
	$m=substr($date,3,2);
	$j=substr($date,0,2);
	$date=$a."-".$m."-".$j;

	$heure=$_POST['time'];	
	$commercial=$_POST['commercial'];
	$dem=$_POST['dem'];
	$remarque=$_POST['remarque'];
	
	 $req=mysql_query("select * from visite where id_dem_vis='$dem'");
				if($result1=mysql_fetch_array($req))
				{
					$req2=mysql_query("
	UPDATE visite SET date_vis='$date',heure_vis='$heure',id_com='$commercial',remarque_visite='$remarque',id_admin_vis='$id_admin'
	where id_dem_vis='$dem' ");
	
					
				}else{
	$req2=mysql_query("insert into visite(id_dem_vis,date_vis,heure_vis,id_com,remarque_visite,id_admin_vis)
	values ('$dem','$date','$heure','$commercial','$remarque','$id_admin')");
				}
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
 header('location: visite.php?a=1&demande='.$dem);
?>	<script type="text/javascript">
document.location.href="visite.php?demande=<?php echo $dem; ?>";
</script>
