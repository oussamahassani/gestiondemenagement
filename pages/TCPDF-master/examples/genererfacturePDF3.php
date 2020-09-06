<?php
session_start ();
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {


       public function Footer() {
        $this->SetFont('Helvetica', 'I', 8);
        $footer_text = 'SUPER DEM - 17 rue Louis Blanc - 75010 PARIS - Tel: 06 22 22 82 82 - 01 43 60 42 34';
        $txt = 'Email : <A HREF="mailto:contact@super-demenagement.com">contact@super-demenagement.com</A> - SIRET : 80091039000015</span>' ;
        $this->writeHTMLCell(120, 50, 50, 282, $footer_text, 0, 0, 0, true, 'C', true);
        $this->writeHTMLCell(120, 50, 50, 289, $txt, 0, 0, 0, true, 'C', true);

                               }

}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('DEVIS SUPER DEM');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// remove default footer
$pdf->setPrintFooter(true);// set margins
$pdf->SetMargins(10, 56, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaksf
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


include("../../../connect.php");

$idd=$_GET['id'] ;


	 $req3 ="SELECT SUM(montant) as montant FROM facturation  where id_deviss = $idd";
	   $requete3 = mysql_query($req3) or die( mysql_error() ) ;
	   $row = mysql_fetch_assoc($requete3 );
        $reulta = $row['montant'];


$req=mysql_query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client  and devis.id_devis='$idd' ");
//$req=$mysqli->query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
//while($result=$req->fetch_assoc())
while($result=mysql_fetch_array($req))

{
$today=date("j-n-Y");
$total=$result['total_encai'];
$numDevis=$result['id_devis'];
$totall=$result['Prix_ttc'];
$rest = $result['Prix_ttc'] - $reulta ;
//$a=substr($date_creation,0,4);
//$m=substr($date_creation,5,2);
//$j=substr($date_creation,8,2);
//$date_creation=$j."/".$m."/".$a;

$title='encaisement'.$result['nom'].'.pdf';


$nomclient=$result['civilite'].' '.$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['tel'];
$emailClient=$result['email'];

}

$req=mysql_query("select id_encaisseme from facturation where id_deviss = $idd");
$row11 = mysql_fetch_assoc($req);
  $id_encaisseme=$row11['id_encaisseme'];
 function fetch_data($idd)  
 {  //$idd=102;
      $output = '';  
      $connect = mysqli_connect("superdemsxbase1.mysql.db", "superdemsxbase1", "ParisDemenagement2019", "superdemsxbase1");  
      $sql = "SELECT * FROM facturation where id_deviss = $idd";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {     
                                       $date_action=$row['date_action'];
	                                    $a=substr($date_action,0,4);
	                                   $m=substr($date_action,5,2);
		                             $j=substr($date_action,8,2);
	                                 $date_action=$j."-".$m."-".$a;
                                
      $output .= '<tr>  
                          <td style="text-align: center">'.$row["numero_Facture"].'</td>  
                          <td style="text-align: center">'.$date_action.'</td>  
                          <td style="text-align: center">'.$row["action"].'</td>  
                          <td style="text-align: center">'.number_format($row["montant"], 2, ",", "").'</td>  
                       
                     </tr>  
                          ';  
      }  
      return $output;  
 } 
 
// PAGE 1 - BIG background image
$pdf->AddPage();
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background6.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();

$style='<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
span.cls_030{font-family:Times,serif;font-size:18.0px;color:rgb(0,0,0);font-weight:normal;font-style:bold;text-decoration: none}
div.cls_030{font-family:Times,serif;font-size:18.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_005{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_005{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_006{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_006{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_007{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_007{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_009{font-family:Times,serif;font-size:12.0px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_009{font-family:Times,serif;font-size:16.0px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_010{font-family:Times,serif;font-size:26.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_010{font-family:Times,serif;font-size:16.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_015{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_015{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_002{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_002{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_029{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,255);font-weight:normal;font-style:normal;text-decoration: underline}
td.cls_029{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,255);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_019{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
td.cls_019{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
span.cls_020{font-family:Times,serif;font-size:9.6px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
td.cls_020{font-family:Times,serif;font-size:9.6px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_023{font-family:Times,serif;font-size:16.1px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: underline}
td.cls_023{font-family:Times,serif;font-size:11.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_026{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
th.cls_026{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
</style>
</head>
<body>';
$html =$style. '
<table><tr>
<td width="40px"></td>
<td>
<table style="position:absolute;top:15px;width:754px;height:852px">
<tr>
<td  class="cls_030"><span class="cls_010"></span><br></td>
<td  class="cls_005"><span class="cls_010"><strong>Encaissement N° '.$id_encaisseme.'</strong></span></td>
</tr>
<tr>
<td  class="cls_030"><span class="cls_023">Informations client :</span><br></td>
<td  class="cls_005"><span class="cls_006"><b>Fait le </b>: '.$today.'</span></td>
</tr>
<tr>
<td  class="cls_006"><span class="cls_006"><b>Nom :</b> '.$nomclient.'</span></td>
<td  class="cls_006"><span class="cls_006"><b>Devis N° :</b>'.$idd.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Prénom : </b>'.$prenomclient.'</span></td>
<td class="cls_006"><span class="cls_006"></span></td>

</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Tel : </b>'.$telclient.'</span></td>
<td class="cls_006"><span class="cls_006"></span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Email: </b>'.$emailClient.'</span></td>
<td class="cls_006"><span class="cls_006"></span></td>
</tr>
<tr>
<td  class="cls_006"><span class="cls_006"></span></td>
<td  class="cls_006"><span class="cls_006"></span></td>

</tr>
<tr><td></td></tr>



<tr><td style="height:24px;" class="cls_009"></td>
<td></td></tr>
</table>
</td>
</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>';
/*
<table style="border-collapse: collapse; border: none;" width="600">
<tbody>
<tr>
<td style="width:15%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
<span class="cls_030"><b>N° Facture</b></span>
</td>
<td style="width:25%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
<span class="cls_030"><b>Date</b></span>
</td>
<td style="width:40%;border: solid #D0CECE 3pt;text-align: center;">
<span class="cls_030"><b>Prestation</b></span>
</td>
<td style="width:20%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
<span class="cls_030"><b>Montant</b></span>
</td>
</tr>
<tr>';




$html2=$html.'<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;text-align: center">
<br>
 <span class="cls_006">'.$numero_Facture.'</span>
<br>

</td>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;text-align: center">
<br>
 <span class="cls_006">'.$date_action.'</span>
<br>

</td>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;text-align: center">
<br>
 <span class="cls_006">'.$action.'</span>
<br>

</td>
<td style="text-align: center;border-top: none; border-left: none; border-bottom: solid #D0CECE 1.5pt; border-right: solid #D0CECE 1.5pt; padding: 0cm 5.4pt 0cm 5.4pt;"><br>
 <span class="cls_006">'.number_format($montant, 2, ",", "").'</span>



</td>'</tr>;
 <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
 // style="font-family:Times,serif;font-size:14"
*/
$content .= '  
    
      <table border="1" cellspacing="0" cellpadding="5" style="font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none" >
           <tr>  
                <th width="15%" style="text-align: center" classe="cls_026"><b>N° Facture </b></th>  
                <th width="25%" style="text-align: center" classe="cls_026"><b>Date</b> </th>  
                <th width="45%" style="text-align: center" ><b>Prestation</b></th>  
                <th width="15%" style="text-align: center"  ><b>Montant</b></th>  
               
           </tr>  
      ';  
      $content .= fetch_data($idd);  
      $content .= '</table>'; 
$html3=$content.'

<table style="border: none;font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none;">
<tbody>
<tr>
<td style="width:40%;text-align: center;">
</td>
<td style="width:45%;border: 1px solid black;text-align: center;"> Rappel Total devis
</td>
<td style="width:15%;border: 1px solid black;text-align: center;">'.number_format($totall, 2, ",", "").'
</td>
</tr>
<tr>
<td style="width:40%;text-align: center;">
</td>
<td style="width:45%;border: 1px solid black;text-align: center;"><span class="cls_006">Total encaissements effectués</span>
</td>
<td style="width:15%;border: 1px solid black;text-align: center;"><span class="cls_006">'.number_format($reulta, 2, ",", "").'</span>
</td>
</tr>
<tr>
<td style="width:40%;text-align: center;">
</td>
<td style="width:45%;border: 1px solid black;text-align: center;"><span class="cls_006">Reste à payer </span>
</td>
<td style="width:15%;border: 1px solid black;text-align: center;"><span class="cls_006">'.number_format($rest, 2, ",", "").'</span>
</td>
</tr>
</tbody>
</table>
';


 $pdf->WriteHTML($html);
 $pdf->writeHTML($html3);  

	  ob_end_clean();

$pdf->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT);
// PAGE 2 - BIG background image
//Close and output PDF document
$iterator = new DirectoryIterator(dirname(__FILE__));

$pdf->Output( $iterator->getPath().'/'.$title, 'F');


echo $iterator->getPath().'/'.$title;
