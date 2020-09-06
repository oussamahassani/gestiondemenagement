<?php

	session_start (); 

	


			$LOGIN=superdem;

			///mot de passe 

			$PASSWORD=golf411klk0;

			$PASSWORD=md5($PASSWORD);

			

			


	header('location: index.php?erreur=1'.$PASSWORD );

?>