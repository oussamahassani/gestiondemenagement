<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - mail() test</title>
</head>
<body>
<?php
require 'PHPMailer/PHPMailerAutoload.php';
function my_error_handler($error_no, $error_msg)
  {
	  echo "Opps, something went wrong:";
	  echo "Error number: [$error_no]";
	  echo "Error Description: [$error_msg]";
	  $headers = 'From:hassani20120@gmail.com';
	  mail('hassani20120@gmail.com', 'test error', $error_msg, $headers);
  }
  set_error_handler("my_error_handler");
    require_once '../db.php';
	$idfact=$_POST['idfact'];
   $id_devis=$_POST['identifiant'];
    $id_utilisateur=$_POST['id_utilisateur'];
		 $req2=mysqli_query($con,"select * from  utilisateur
 where id_utilisateur =$id_utilisateur ");
 $resulta=mysqli_fetch_assoc($req2);
	 //  $id_devis=5;
	$from=$_POST['from_'];
	//$from='hassani20120@gmail.com';
	$cci=$_POST['cci_'];
	//$cci='hassani20120@gmail.com';
   $to=$_POST['to_'];
 //   $to='hassani20120@gmail.com';
   $objet=$_POST['objet_'];
	//$objet='bonjour';
	$corps=$_POST['summernote'];
     // $corps = 'voila';
	
  $id_nom=$_POST['id_nom'];
  $lienPdf='../pages/TCPDF-master/examples/facture'.$id_nom.'.pdf';
 $pdfName     = "facture". $id_devis.".pdf";
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->Encoding = 'base64';
$mail->CharSet = 'UTF-8';
$mail->IsMAIL();
//$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "pro1.mail.ovh.net"; // set the SMTP server
$mail->Port       = 587 ;                    // set the SMTP port
//$mail->Username   = "yourname@yourdomain"; // SMTP account username
//$mail->Password   = "yourpassword"; 
//Set who the message is to be sent from
$mail->setFrom($from,'SUPERDEM');
//Set an alternative reply-to address
$mail->AddCC($cci, 'Sarra Hafsia');
$mail->AddCC('contact@super-demenagement.com', 'SUPERDEM');
//$mail->addReplyTo($cci,'Sarra Hafsia');
//$mail->addReplyTo('contact@super-demenagement.com', 'SUPERDEM');
//Set who the message is to be sent to
$mail->addAddress($to,$id_nom);
//Set the subject line
$mail->Subject = $objet;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$numtel=NULL;
$numte2=NULL;
if (!empty($resulta['tel']))
{
 $numtel=' <em><b>Numero de téléphone &nbsp;:</b><span style="color:#b38f00">&nbsp;    '.$resulta['tel'].'</span></em><br>';
}
if (!empty($resulta['telMobile']))
{
 $numte2=' <em><b>Mobile &nbsp; :</b><span style="color:#b38f00">&nbsp;    '.$resulta['telMobile'].'</span></em><br>';
}
$bonjour= '
<div style="display:flex; font-size:12px;">
  <div  style="text-align:center;">
     <em ><b> Cordialement </b></em>
	  <em ><b> '.$resulta['surnom'].'</b></em>
	 <br>
	   <a href="http://www.super-demenagement.com/"><img src="http://www.devis.superdemenagement.fr/racine/images/signature1.jpg" height="120" width="140" alt="signature"/></a>
   </div>
  <div style="margin-top:3em;">
  <em><span style="color:#b38f00;">SUPERDEM</span></em><br>
  '.$numtel.''.$numte2.'<em><b>Siége sociale:</b><span style="color:#b38f00;">17 rue louis Blanc 75010 Paris</span></em><br>
	<em><b>Email &nbsp;:</b><span style="color:#b38f00;">contact@super-demenagement.com</span></em><br>
	<em><b>Site web &nbsp;:</b> <span style="color:#b38f00;">www.super-demenagement.com</span></em>
  </div>
</div>
  
';
//Replace the plain text body with one created manually
 $mail->Body =$corps.$bonjour ;
//$mail->addReplyTo('contact@super-demenagement.com', 'SUPERDEM');
//$mail->AltBody = "This is a multi-part message in MIME format.\n--".$this->boundary."\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: base64\n\n".chunk_split(base64_encode($this->body))."\n";
//Attach an image file
 $mail->AltBody = 'This is a plain-text message body';
//$mail->msgHTML($corps);
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Attach an image file
$path=$lienPdf;
$mail->AddAttachment($path, $name=$pdfName, $encoding = 'base64', $type = 'application/pdf');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else
{
	 echo "Mail send: ";
	$req2=mysqli_query($con,"insert into logService(id_client,id_devis,id_service,id_utilisateur) values ('$id_utilisateur','$id_devis','16','$id_utilisateur')");
}
	

if (is_file($lienPdf))
  {
    unlink($lienPdf);
  }
?>

</body>

<script type="text/javascript">
 var variable2= <?php echo json_encode($idfact); ?>;
 var variable3= <?php echo json_encode($id_devis); ?>;
document.location.href="envoi_facture1.php?id="+variable2+ "&dev="+variable3;
	
	</script>
</html>
