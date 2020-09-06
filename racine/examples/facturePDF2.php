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
$id=$_GET['id'] ;
$idd=$_GET['dev'] ;
$iden=$_GET['en'] ;
$req=mysql_query("select * from facturation,encaissement,demande,client,devis where facturation.id_encaisseme=encaissement.id_encaissement and  encaissement.id_devis=devis.id_devis and demande.id_dem=devis.id_demande and demande.id_client=client.id_client  and facturation.numero_Facture='$id' and  encaissement.id_encaissement='$iden' and devis.id_devis='$idd' ");
//$req=$mysqli->query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
//while($result=$req->fetch_assoc())
while($result=mysql_fetch_array($req))

{
$today=date("j-n-Y");
$total=$result['total_encai'];
$numDevis=$result['id_devis'];
$date_creation=$result['datee_creat'];
//$a=substr($date_creation,0,4);
//$m=substr($date_creation,5,2);
//$j=substr($date_creation,8,2);
//$date_creation=$j."/".$m."/".$a;
$userr=$result['userr_creat'];
$reste=$result['reste_encai'];
$action=$result['action'];
$montant=$result['montant'];
$TVA = ($montant*20)/100;
$TTC = $montant+$TVA ;

$title=' encaisement pour'.$result['civilite'].''.$result['nom'].'_'.$result['prenom'].'.pdf';


$nomclient=$result['civilite'].' '.$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['tel'];
$emailClient=$result['email'];

}
// PAGE 1 - BIG background image
$pdf->AddPage();
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/backgroundPage1.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();

$style='<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
span.cls_030{font-family:Times,serif;font-size:16.0px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: underline}
div.cls_030{font-family:Times,serif;font-size:16.0px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: none}
span.cls_005{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_005{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_006{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_006{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_007{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_007{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_009{font-family:Times,serif;font-size:16.0px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_009{font-family:Times,serif;font-size:16.0px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_010{font-family:Times,serif;font-size:16.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
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
span.cls_023{font-family:Times,serif;font-size:11.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
td.cls_023{font-family:Times,serif;font-size:11.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_026{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
td.cls_026{font-family:Times,serif;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
</style>
</head>
<body>';
$html =$style. '
<table><tr>
<td width="40px"></td>
<td>
<table style="position:absolute;top:15px;width:754px;height:852px">
<tr>
<td  class="cls_030"><span class="cls_030"><strong>Facture N° '.$id.'</strong></span><br></td>
<td  class="cls_005"><span class="cls_005"><b>Fait le :</b> '.$today.'</span></td>
</tr>
<tr>
<td  class="cls_030"><span class="cls_05">Etablie le :'.$date_creation.'</span><br></td>
<td  class="cls_005"><span class="cls_005"><b>Devis N° :</b> '.$idd.'</span></td>
</tr>

<tr>
<td  class="cls_006"><span class="cls_006"></span></td>
<td  class="cls_006"><span class="cls_006"><b>Nom :</b> '.$nomclient.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"></span></td>
<td class="cls_006"><span class="cls_006"><b>Prénom : </b>'.$prenomclient.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"></span></td>
<td class="cls_006"><span class="cls_006"><b>Tel : </b>'.$telclient.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"></span></td>
<td class="cls_006"><span class="cls_006"><b>Email: </b>'.$emailClient.'</span></td>
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
<table style="border-collapse: collapse; border: none;" width="600">
<tbody>
<tr>
<td style="width:65%;border: solid #D0CECE 3pt;text-align: center;">
Prestation
</td>
<td style="width:35%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
Prix HT
</td>
</tr>
<tr>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;text-align: center">
<br>
action : '.$action.'
<br>

</td>
<td style="text-align: center;border-top: none; border-left: none; border-bottom: solid #D0CECE 1.5pt; border-right: solid #D0CECE 1.5pt; padding: 0cm 5.4pt 0cm 5.4pt;"><br>'
.number_format($montant, 2, ",", "").' €


</td>
</tr>
<tr>
<td style="width:70%;text-align: center;">
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">Total HT
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">'.$montant.'
</td>
</tr>
<tr>
<td style="width:70%;text-align: center;">
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">TVA 20%
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">'.$TVA.'
</td>
</tr>
<tr>
<td style="width:70%;text-align: center;">
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">Total TTC
</td>
<td style="width:15%;border: solid #D0CECE 3pt;text-align: center;">'.$TTC.'
</td>
</tr>
</tbody>
</table>
';


$pdf->writeHTML($html, true, true, true, true, '');

$pdf->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT);
// PAGE 2 - BIG background image
//Close and output PDF document
$pdf->Output( $title, 'I');
