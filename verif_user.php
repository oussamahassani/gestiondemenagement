<?php

	session_start (); 
	if (isset($_POST['login']) && isset($_POST['password']) || isset($_SESSION['login']) && isset($_SESSION['password']))  
	{

			if(isset($_POST['login']) && isset($_POST['password']))

			{$_SESSION['login'] = $_POST['login']; 

			$_SESSION['password'] = $_POST['password'];

			}

			// connection au serveur

			include("connect.php");

			

			// recuperation de donn�es des valeurs de champs 

			//login

			$LOGIN=$_SESSION["login"];

			///mot de passe 

			$PASSWORD=$_SESSION["password"];

			$PASSWORD=md5($PASSWORD);
?>
			// requete SQL
<script> 
 var variable1 = <?php echo json_encode($LOGIN);?>;
 var variable2= <?php echo json_encode($PASSWORD); ?>;


console.log(variable1);
console.log(variable2);




</script>
<?php
			$req1=mysql_query("select * from utilisateur where actif=1 AND login='$LOGIN' and password='$PASSWORD'"); 

			// on cherche si login et password correspondent � ceux  que dans la base de donn�es  
  
				if($result1=mysql_fetch_array($req1))

				{
					
						  $_SESSION['id']=$result1['id_utilisateur'];

						  $_SESSION['nom_com']=$result1['nom']." ".$result1['prenom'];
                          $_SESSION['id_type']=$result1['id_type'];
						  $_SESSION['photo']='';

						  require_once "admin1.php";



							  header('location: index.php');

							   ?>

                     <script type="text/javascript">

                         document.location.href="index.php";

                     </script>

											 <?php

					echo "vrai";

						

				}else

					echo "faux";

	header('location: login.php?erreur=1');

	?>

                                             <script type="text/javascript">

 document.location.href="login.php?erreur=1";

</script>-->

											 <?php

	}?>