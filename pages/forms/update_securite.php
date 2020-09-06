	<?php	
	session_start (); 
	include("connect.php");	
	
	$pass1=md5($_POST['pass1']);
	$login=$_POST['login'];
     $id=$_SESSION['id'];
	
	  $req=mysql_query("UPDATE admin SET login='$login',password='$pass1'
	
	where id_admin='$id'");  
	
	if($req)
	{echo "truee";}else
	{echo "false";}
   header('location: compte.php?a=1');
?>	<script type="text/javascript">
document.location.href="compte.php?a=1";
</script>
