<?php
//============================================================+
// File name   : example_051.php
// Begin       : 2009-04-16
// Last Update : 2013-05-14
//
// Description : Example 051 for TCPDF class
//               Full page background
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
		$img_file = K_PATH_IMAGES.'image_demo2.jpg';
		$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Amine ben Amara');
$pdf->SetTitle('Fichier PDF');
$pdf->SetSubject('PARIS ECO');
$pdf->SetKeywords('PDF, demenagement');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page

$hhh="05/05/1988";




				require_once '../../../connect.php';
						$id=$_GET['id'] ;
						$idd=$_GET['dev'];
				 $req=mysql_query("select * from demande,client,facture where facture.id_dem=demande.id_dem  and demande.id_client=client.id_client and demande.id_dem='$id'");
				 while($result=mysql_fetch_array($req))


			{

				$tva=$result['tva'];
               $ht=$result['montant_ht'];
			   $ttc=$result['montant_ht']+(($result['montant_ht']*$tva)/100);
			   $ptva=$ttc-$ht;
			   $reste=$ttc-$result['montant_paye'];
			   if($result['assenceur_dep']=="1")
			   {
			    $accen_dep="oui";
			   }else
			   {
			    $accen_dep="non";
				}
				 if($result['assenseur_arr']=="1")
			   {
			    $accen_arr="oui";
			   }else
			   {
			    $accen_arr="non";
				}
                 if($result['stationnement_dep']=="1")
			   {
			    $stat_dep="oui";
			   }else
			   {
			    $stat_dep="non";
				}
				if($result['stationnement_arr']=="1")
			   {
			    $stat_arr="oui";
			   }else
			   {
			    $stat_arr="non";
				}
				 if($result['monte_meuble_dep']=="1")
			   {
			    $monte_dep="oui";
			   }else
			   {
			    $monte_dep="non";
				}
				 if($result['monte_meuble_arr']=="1")
			   {
			    $monte_arr="oui";
			   }else
			   {
			    $monte_arr="non";
				}
				$title='Facture_'.$result['nom'].'_'.$result['prenom'].'.pdf';
				  $date=$result['date'];
	$a=substr($date,0,4);
	$m=substr($date,5,2);
	$j=substr($date,8,2);
	$date=$j."/".$m."/".$a;
				$pdf->AddPage();
// Print a text
$html = '
<br><br><br>
<table width="640" >
  <tr>
    <th width="300" rowspan="2" align="center" ><br><br><br><br>SUPER DEM – 17 rue Louis Blanc – 75010 PARIS <br>– Tel: 06 22 22 82 82 – 01 43 60 42 34<br>
Email : info@demenagementpariseco.com <br>– SIRET : 51374116500015
	</th>
	<th width="340" bgcolor="#af8a00" style="color:#FFF;" align="center">
<font size="14" color="#FFFFFF" >Date; : '.$date.'</font><br><br>
	<font size="14" color="#FFFFFF" ><b>FACTURE N&deg; : '.$id.'</b></font>
	</th>
    </tr>

    <tr>
       <td align="center"><font size="15" color="#000">
	   <br><b>CLIENT :</b>'.$result['civilite'].' '.$result['nom'].' '.$result['prenom'].'
	   </font>
	   <font size="10" color="#000">
	   <br>Adresse :'.$result['adresse_dep'].'
	   </font>
	   </td>
    </tr>
	</table>
	<br>
	<br>
	<table width="640" border="1" bordercolor="#333333">
  <tr>
    <th width="200"  align="center" bgcolor="#af8a00" style="color:#FFF;" >
	<font size="15" >Details</font>
	</th>
	 <th width="260"  align="center" bgcolor="#af8a00" style="color:#FFF;" >
	 <font size="15">Prestation</font>
	</th>
	<th width="180"  align="center" bgcolor="#af8a00" style="color:#FFF;" >
	<font size="15" >Prix</font>
	</th>

    </tr>

    <tr>
       <td align="left" height="400">
	   <br><br>
	   <font size="11" color="#000">
	   '.$result['details'].'</font>
	   </td>
	   <td align="left">
	   <br><br><font size="11" color="#000">
	    '.$result['presta'].' </font>
	   </td>
	   <td align="center">
	   <br><br><font size="11" color="#000">
	    '.number_format($ttc, 2, ",", "").'</font>
	   </td>
    </tr>
	<tr>
       <td align="left" >
	   <br><br>
	   <font size="11" color="#000">
	   TVA: '.$tva.' <br> Montant TVA : <b>'.number_format($ptva, 2, ",", "").'</b></font>
	   </td>
	   <td align="left">
	   <br><br><font size="11" color="#000">
	    MONTANT HT:'.number_format($ht, 2, ",", "").' </font>
	   </td>
	   <td align="center" bgcolor="#a88400" >
	   <br><br><font size="11" color="#fff">
	    <b>Montant TTC: '.number_format($ttc, 2, ",", "").'</b></font>
	   </td>
    </tr>

	</table>
	<br><br>
	Arrte la presente facture à la somme de : '.$result['arrete'].'<br><br>
	<table bordercolor="#999999" border="1" width="100%">
	<tr>
	<td style=" margin:25px;" bgcolor="#CCCCCC"><br><br>
	&nbsp;Montant payé: '.number_format($result['montant_paye'], 2, ",", "").'
	<br></td>
	<td style=" margin:25px;" bgcolor="#CCCCCC">
	<br><br>&nbsp;Montant payé: '.number_format($reste, 2, ",", "").'
	</td>
    </tr>
	</table>

<br>
<br>
<br>
<br>
<br>

<br>17 Rue Louis Blanc 75010 PARIS<br>  Tel: 06 22 22 82 82 - +33 1 43 60 42 34<br>
Email: info@demenagementpariseco.com - SIRET:51374116500015

';


$pdf->writeHTML($html, true, false, true, false, '');



// --- example with background set on page ---

// remove default header
$pdf->setPrintHeader(false);

// add a page



// -- set new background ---



// Print a text


$title="bonjour";
// ---------------------------------------------------------
}
//Close and output PDF document
$pdf->Output($title, 'I');

//============================================================+
// END OF FILE
//============================================================+
