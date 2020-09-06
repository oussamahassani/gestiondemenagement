<?php	
  function my_error_handler($error_no, $error_msg)
  {
	  echo "Opps, something went wrong:";
	  echo "Error number: [$error_no]";
	  echo "Error Description: [$error_msg]";
	  $headers = 'From:hassani20120@gmail.com';
	  mail('hassani20120@gmail.com', 'test error', $error_msg, $headers);
  }
  set_error_handler("my_error_handler");
    require_once '../../db.php';
    $id_devis=$_POST['id_devis'];
	$from=$_POST['from'];
	$cci=$_POST['cci'];
    $to=$_POST['to'];
	$objet=$_POST['objet'];
	$corps=$_POST['corps'];
	$lienPdf="DevisDegorgue.pdf";
	
$id_utilisateur=$_POST['id_utilisateur'];
// envoie d'un mail avec une pièce jointe

// Destinataires. 
$destinataires = $to; 

// Objet. 
$objet = $objet; 


// Entêtes supplémentaires. 
$entêtes  = ""; 
// -> origine du message 
 $eol = PHP_EOL;
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$entêtes       = "From: $from$eol" . "CC: $cci$eol" .
"BCC: hassani20120@gmail".
"MIME-Version: 1.0$eol" .
"Content-Type: multipart/mixed;$eol" .
" boundary=\"$mime_boundary\"";
// Message. 
$message  = ""; 
// -> première partie du message (texte proprement dit) 
//    -> entête de la partie 
$message .= "--$mime_boundary$eol\r\n"; 
$message .= "Content-Type: text/plain; "; 
$message .= "charset=iso-8859-1\r\n "; 
$message .= "Content-Transfer-Encoding: 8bit\r\n"; 
$message .= "\r\n";   // ligne vide 
$message.= $corps . $eol;
//    -> données de la partie 
$message .= "Voir la pièce jointe.\r\n"; 
$message .= "\r\n";   // ligne vide 
// prepare attachement 
$file = fopen($pdfLocation, 'rb');
$data = fread($file, filesize($pdfLocation));
fclose($file);
$pdf = chunk_split(base64_encode($data));
// -> deuxième partie du message (pièce-jointe) 
//    -> entête de la partie 
$message .= "--$mime_boundary$eol\r\n"; 
$message .= "Content-Type: application/octet-stream; "; 
$message .= " name=\"$pdfName\"$eol"; 
$message .= "Content-Transfer-Encoding: base64$eol$eol".
$pdf . $eol ."--$mime_boundary--"; 
$message .= "Content-Disposition: attachment;$eol "; 
$message .= "\"$pdfName\"$eol"; 
$message .= "\r\n";             // ligne vide 

// Envoi. 
$bEnvoie = mail($destinataires,$objet,$message,$entêtes); 

////Envoi de mail
/*
$from        = $from; //address message is sent from
$subject = '=?UTF-8?B?'.base64_encode($objet).'?='; //email subject
$body        = $corps; //email body
$pdfLocation = $lienPdf; //file location
$pdfName     = "facture". $id_devis.".pdf"; //pdf file name recipient will get
$filetype    = "application/pdf"; //type
//create headers and mime boundry
$eol = PHP_EOL;
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers       = "From: $from$eol" . "CC: $cci$eol" .
"BCC: hassani20120@gmail".
"MIME-Version: 1.0$eol" .
"Content-Type: multipart/mixed;$eol" .
" boundary=\"$mime_boundary\"";
//add html message body
$message = "--$mime_boundary$eol" .
"Content-Type: text/html; charset=\"UTF-8\"$eol" .
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
*/
if($bEnvoie) {
echo "Mail avec le facturation envoyÃ©";
}
else {
echo "There was an error sending the mail.";
}


if (is_file($lienPdf))
  {
    unlink($lienPdf);
  }
		
?>


