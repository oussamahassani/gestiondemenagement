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
$req=mysql_query("select * from encaissement,demande,client,devis where  encaissement.id_devis=devis.id_devis and demande.id_dem=devis.id_demande and demande.id_client=client.id_client and encaissement.id_encaissement='$id' and devis.id_devis='$idd' ");
//$req=$mysqli->query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
//while($result=$req->fetch_assoc())
while($result=mysql_fetch_array($req))

{
$today=date("j-n-Y");
$total=$result['total_encai'];
$numDevis=$result['id_devis'];
$date_creation=$result['date_creation'];
$a=substr($date_creation,0,4);
$m=substr($date_creation,5,2);
$j=substr($date_creation,8,2);
$date_creation=$j."/".$m."/".$a;
$userr=$result['userr_creat'];
$reste=$result['reste_encai'];


$title=' encaisement pour'.$result['civilite'].''.$result['nom'].'_'.$result['prenom'].'.pdf';


$nomclient=$result['civilite'].' '.$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['tel'];
$emailClient=$result['email'];
//$prestation=$result['prest'];
$type_prestation=$result['type_prestation'];
$volume=$result['volume'];
$distance=$result['distance'];
$adresse_dep=$result['adresse_dep'];
$code_postale_dep=$result['code_postale_dep'];
$ville_dep=$result['ville_dep'];
$habit_dep=$result['habit_dep'];
$portage_dep=$result['portage_dep'];
$adresse_arr=$result['adresse_arr'];
$code_postale_arr=$result['code_post_arr'];
$ville_arr=$result['ville_arr'];
$habit_arr=$result['habit_arr'];
$portage_arr=$result['portage_arr'];
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
<td  class="cls_030"><span class="cls_030"></span><br></td>
<td  class="cls_005"><span class="cls_005"><b>Fait le :</b> '.$today.'</span></td>
</tr>
<tr>
<td  class="cls_030"><span class="cls_030">Informations client :</span><br></td>
<td  class="cls_005"><span class="cls_005"><b>Devis N° :</b> '.$idd.'</span></td>
</tr>

<tr>
<td  class="cls_006"><span class="cls_006"><b>Nom : </b>'.$nomclient.'</span></td>
<td  class="cls_006"><span class="cls_006"><b>Encaisement  N:</b> '.$id.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Prénom : </b>'.$prenomclient.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Tel : </b>'.$telclient.'</span></td>

</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Courriel : </b>'.$emailClient.'</span></td>
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
<td style="width:50%;border: solid #D0CECE 3pt;text-align: center;">
detaille Encaisement
</td>
<td style="width:50%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
Totale Encaisement
</td>
</tr>
<tr>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<br>
<span class="cls_006">- type_prestation : '.$type_prestation.' </span>
<br>
<span class="cls_006">- date creation: '.$date_creation.'</span>
<br>
<span class="cls_006">nom actionneur : '.$userr.'</span>
<br>
<span class="cls_006">reste encaisement : '.$reste.' € </span>
<br>

</td>
<td style="text-align: center;border-top: none; border-left: none; border-bottom: solid #D0CECE 1.5pt; border-right: solid #D0CECE 1.5pt; padding: 0cm 5.4pt 0cm 5.4pt;"><br>'
.number_format($total, 2, ",", "").' €


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
