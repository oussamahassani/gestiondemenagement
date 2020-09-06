
<?php
include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php");
$host="ssl0.ovh.net";
     $mail = new PHPMailer();

   // $body             = file_get_contents('test_message.html');
    //$body             = eregi_replace("[\]",'',$body);
	$body: "bonjour";

    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host   = "mail.yourdomain.com"; // SMTP server
    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "hassani20120@gmail.com";  // GMAIL username
    $mail->Password   = "ou_2s_ma1989";            // GMAIL password

    $mail->SetFrom('hassani20120@gmail.com', 'First Last');

    $mail->AddReplyTo("hassani20120@gmail.com","First Last");

    $mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($body);
	 $address = "hassani20120@gmail.com";
    $mail->AddAddress($address, "John Doe");

    $mail->AddAttachment("PHPMailer/composer.json");      // attachment
   // $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }
    ?>