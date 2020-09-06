<?php
//param�tres de la base de donn�es 
//serveur mysql

$SERVER='localhost';
$USERNAME='root';
$PASSWORD='';
$BASENAME='superdemsxbase1';

/*
$SERVER='superdemsxbase1.mysql.db';
$USERNAME='superdemsxbase1';
$PASSWORD='Assistline2020';
$BASENAME='superdemsxbase1';
*/
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $BASENAME);
/*try {
	if ($con) echo "ok";
	else echo "Erreur connexion";
} catch (exception $e) {
	echo $e->getMessage();
}*/
?>
