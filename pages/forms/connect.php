<?php
//param�tres de la base de donn�es 
//serveur mysql
/*
$SERVER='localhost';
$USERNAME='root';
$PASSWORD='';
$BASENAME='pariseco';
*/
$SERVER='superdemsxbase1.mysql.db';
$USERNAME='superdemsxbase1';
$PASSWORD='ParisDemenagement2019';
$BASENAME='superdemsxbase1';

//connexion au serveur Mysql
mysql_connect($SERVER,$USERNAME,$PASSWORD).
//selection de la BD
mysql_select_db($BASENAME);
?>
