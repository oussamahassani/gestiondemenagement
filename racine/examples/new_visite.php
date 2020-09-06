<?php
session_start (); 
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
						   
            if(isset($_GET['dem']))
			{
				$id=$_GET['dem'];
			}
			
			 $req=mysql_query("select * from visite,demande,client where  demande.id_client=client.id_client and visite.id_dem_vis=demande.id_dem and demande.id_dem='$id'");
			
				if($result=mysql_fetch_array($req))
	
	   		     
			{				
				
				$title='Visite_'.$result['nom'].'_'.$result['prenom'].'.pdf';
				  $date=$result['date_vis'];
	$a=substr($date,0,4);
	$m=substr($date,5,2);
	$j=substr($date,8,2);
	$date=$j."/".$m."/".$a;
	
	  $date2=$result['date_dep'];
	$a=substr($date2,0,4);
	$m=substr($date2,5,2);
	$j=substr($date2,8,2);
	$date2=$j."/".$m."/".$a;
	
	 $idcom=$result['id_com'];
   $req1=mysql_query("select * from commercial where  id_commercial='$idcom'");
			
				if($result1=mysql_fetch_array($req1))
	     
			{	
  $commercial=$result1['prenom_com'].' '.$result1['nom_com'];
			}
				$pdf->AddPage();
// Print a text
$html = '
<table width="650" border="1" bordercolor="#333333">
  <tr>
    <th width="300"  align="center" ><br><br>&nbsp;<img src="images/tcpdf_logo.jpg" width="169">
	<br>17 Rue Louis Blanc 75010 PARIS<br>  Tel:  06 22 22 82 82 - +33 1 43 60 42 34<br>
Email: info@demenagementpariseco.com - SIRET:51374116500015
	</th>

	<th width="350" bgcolor="#009900" style="color:#FFF;" align="center">
<font size="14" color="#FFFFFF" >Date; : '.$date.'</font><br><br>
	<font size="14" color="#FFFFFF" ><b>VISITE N&deg; :PAR '.$id.'</b></font>
	</th>
    </tr>
	</table>
  <br>


<table width="650" border="1" cellpadding="2">
  <tr>
    <th colspan="2" scope="col"><div align="center"><font size="20">Infos Client</font></div></th>
  </tr>
  <tr>
    <td width="350">Mr/Mme</td>
    <td width="300">ID Client:</td>
  </tr>
  <tr>
    <td>Email:</td>
    <td>Telephone:</td>
  </tr>
  <tr>
    <td><table width="350" border="2">
      <tr>
        <th colspan="2" scope="col"><div align="center">RDV</div></th>
        </tr>
      <tr>
        <td width="150">Date</td>
        <td width="200">&nbsp;</td>
      </tr>
      <tr>
        <td>Heure</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td> Commercial</td>
  </tr>
</table>
<br><br>
<table width="650" border="1" cellpadding="2">
  <tr>
    <th colspan="4" scope="col"><div align="center">Infos Déménagement</div></th>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Depart</div></td>
    <td colspan="2"><div align="center">Arrivee</div></td>
  </tr>
  <tr>
    <td width="150">Date de chargement</td>
    <td width="175">&nbsp;</td>
    <td width="150">Date de chargement</td>
    <td width="175">&nbsp;</td>
  </tr>
  <tr>
    <td>Adresse</td>
    <td>&nbsp;</td>
    <td>Adresse</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Etage</td>
    <td>&nbsp;</td>
    <td>Etage</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Portage</td>
    <td>&nbsp;</td>
    <td>Portage</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Passage par fenetre</td>
    <td>&nbsp;</td>
    <td>Passage par fenetre</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br>
<table width="650" border="1" cellpadding="3">
  <tr>
    <th colspan="2" scope="col" width="300"><div align="center">Demande de stationnement</div></th>
    <th colspan="3" scope="col" width="350"><div align="center">Garde Meuble</div></th>
  </tr>
  <tr>
     <td width="150"><div align="center">Depart</div></td>
     <td width="150"><div align="center">Arrivee</div></td>
     <td width="120">Nbr Jours</td>
     <td width="120">Nbr Caisses</td>
    <td width="110">Autre details</td>
  </tr>
  <tr>
    <td width="150"><div align="center">Oui /Non</div></td>
    <td width="150"><div align="center">Oui/ Non</div></td>
    <td width="120">&nbsp;</td>
    <td width="120">&nbsp;</td>
    <td width="110">&nbsp;</td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="680" border="1" cellpadding="3">
  <tr>
    <th colspan="2" scope="col" width="300">Monte Meuble</th>
    <th colspan="4" scope="col" width="350">Vehicules</th>
  </tr>
  <tr>
    <td width="150"><div align="center">Depart</div></td>
    <td width="150"><div align="center">Arrivee</div></td>
    <td width="90">Type</td>
    <td width="90">Volume</td>
    <td width="80">Nbr</td>
    <td width="90">remarque</td>
  </tr>
  <tr>
    <td><div align="center">Oui /Non</div></td>
    <td><div align="center">oui/Non</div></td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="49">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="650" border="1"  cellpadding="3">
  <tr>
    <th colspan="6" scope="col" align="center"> <font size="12">Materiel</font></th>
  </tr>
  <tr>
    <td width="160"><div align="center">Type</div></td>
    <td width="50"><div align="center">Nbr</div></td>
    <td width="160"><div align="center"></div></td>
    <td width="50"><div align="center"></div></td>
    <td width="180"><div align="center"></div></td>
    <td width="50"><div align="center"></div></td>
  </tr>
  <tr>
    <td width="160">Cartons STD</td>
    <td>&nbsp;</td>
    <td>Penderies</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Cartons Livres</td>
    <td>&nbsp;</td>
    <td>Housses GM</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Cartons Vaisselles</td>
    <td>&nbsp;</td>
    <td>Housses PM</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Cartons Verres</td>
    <td>&nbsp;</td>
    <td>Bulls</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Cartons Bouteilles</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


';

$pdf->writeHTML($html, true, false, true, false, '');


// add a page
$pdf->AddPage();

// Print a text
$html = '
<h2>Inventaire Démenagement</h2>
<br><table width="650" border="1" cellpadding="3">
  <tr>
    <th width="330" scope="col" bordercolor="#009900" >Volume: </th>
    <th width="320" scope="col">Prestation: </th>
  </tr>
  <tr>
    <td colspan="2" height="110">commentaire</td>
  </tr>
</table>
<p></p>
<table width="650" border="1" cellpadding="10">
  <tr height="20">
    <th width="71" scope="col">Etage</th>
    <th width="97" scope="col">Piece</th>
    <th width="48" scope="col">NB</th>
    <th width="175" scope="col">Meuble à dementer</th>
    <th width="237" scope="col">fragile</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

';
$pdf->writeHTML($html, true, false, true, false, '');

// --- example with background set on page ---

// remove default header
$pdf->setPrintHeader(false);



// add a page



// -- set new background ---



// Print a text



// ---------------------------------------------------------
}
//Close and output PDF document
$pdf->Output($title, 'I');

//============================================================+
// END OF FILE
//============================================================+
