<?php	
    require_once '../../connect.php';	

	$id_client=$_POST['id_client'];
    $id_devis=$_POST['id_devis'];
	$from=$_POST['from'];
	$cci=$_POST['cci'];
	$to=$_POST['to'];
	$objet=$_POST['objet'];
	$corps=$_POST['corps'];
	$lienPdf=$_POST['lienPdf'];
	
$id_utilisateur=$_POST['id_utilisateur'];

////Envoi de mail





// encode sender, recipient and subject
$s       = '=?UTF-8?B?'.base64_encode('Anna Müller').'?=';
$r       = '=?UTF-8?B?'.base64_encode('Ben Höffer').'?=';
$subject = '=?UTF-8?B?'.base64_encode('From Müller to Höffer').'?=';
 
// append e-mail addresses
$s      .= 'khedira.hela@gmail.com';
$r      .= 'khedira.hela@gmail.com';
 
// create header
$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$header .= 'To: ' . $r. "\r\n";
$header .= 'From: ' . $s. "\r\n";
  
// write HTML message
$msg     = '<html><head><title>From Müller to Höffer</title></head>';
$msg    .= '<body><p>Message</p></body></html>';
 
// send mail
mail($r, $subject, $msg, $header);


//$to          = "khedira.hela@gmail.com"; //addresses to email pdf to
$from        = "contact@super-demenagement.com "; //address message is sent from
$subject     = $objet; //email subject
$body        = $corps; //email body
$pdfLocation = $lienPdf; //file location
$pdfName     = "devis_SUP". $id_devis.".pdf"; //pdf file name recipient will get
$filetype    = "application/pdf"; //type
//create headers and mime boundry
$eol = PHP_EOL;
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers       = "From: $from$eol" . "CC: $cci$eol" .
"BCC: khedira.hela@gmail.com;sarrahafsia.91@gmail.com".
"MIME-Version: 1.0$eol" .
"Content-Type: multipart/mixed;$eol" .
" boundary=\"$mime_boundary\"";
//add html message body
$message = "--$mime_boundary$eol" .
"Content-Type: text/html; charset=\"iso-8859-1\"$eol" .
"Content-Transfer-Encoding: 7bit$eol$eol" .
$body . $eol;
//fetch pdf
$file = fopen($pdfLocation, 'rb');
$data = fread($file, filesize($pdfLocation));
fclose($file);
$pdf = chunk_split(base64_encode($data));
//attach pdf to email
$message .= "--$mime_boundary$eol" .
"Content-Type: $filetype;$eol" .
" name=\"$pdfName\"$eol" .
"Content-Disposition: attachment;$eol" .
" filename=\"$pdfName\"$eol" .
"Content-Transfer-Encoding: base64$eol$eol" .
$pdf . $eol .
"--$mime_boundary--";
//Send the email
if(mail($to, $subject, $message, $headers)) {
echo "Mail avec le devis envoyé";
}
else {
echo "There was an error sending the mail.";
}



$req2=mysql_query("insert into logService(id_client,id_devis,id_service,id_utilisateur) values ('$id_client','$id_devis','16','$id_utilisateur')");
	

if (is_file($lienPdf))
  {
    unlink($lienPdf);
  }
		
?>
<!--<script type="text/javascript">
	document.location.href="../../cron/send_lead_immediat.php?id_dem=<?php echo $idDemande;?>";
	
	</script>!-->



