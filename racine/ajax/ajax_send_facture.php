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
	 //   $id_devis=5;
	$from=$_POST['from'];
	//$from='hassani20120@gmail.com';
	$cci=$_POST['cci'];
	//$cci='hassani20120@gmail.com';
    $to=$_POST['to'];
	// $to='hassani20120@gmail.com';
   $objet=$_POST['objet'];
	//$objet='bonjour';
	$corps=$_POST['corps'];
    //   $corps = 'voila';
   $id_nom=$_POST['id_nom'];
	$lienPdf='../../pages/TCPDF-master/examples/facture'.$id_nom.'.pdf';
//$id_utilisateur=$_POST['id_utilisateur'];

////Envoi de mail

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
//Send the email;
$total = 0;
while($total < 1.5) {
$start = date_getMicroTime();
function date_getMicroTime() {
list($usec, $sec) = explode(' ', microtime());
return ((float) $usec + (float) $sec);
}
for($i = 0 ; $i < 999999 ; $i++) 1;
{
$success = mail($to, $subject, $message, $headers);
$total = round(date_getMicroTime() - $start, 3);
}
if (!$success) {
    $errorMessage = error_get_last()['message'];
	echo $errorMessage;
}
else {
echo "mail envoiyee.";
}

//$req2=mysql_query("insert into logService(id_client,id_devis,id_service,id_utilisateur) values ('$id_client','$id_devis','16','$id_utilisateur')");
	

if (is_file($lienPdf))
  {
    unlink($lienPdf);
  }
		
?>


