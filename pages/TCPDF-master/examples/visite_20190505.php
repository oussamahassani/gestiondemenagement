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
<br><br>
<table width="640"  bordercolor="#333333">
  <tr>
    <th width="300"  align="center" ><br><br>&nbsp;<br><br><br>
	<br>SUPER DEM – 17 rue Louis Blanc – 75010 PARIS <br>– Tel: 06 22 22 82 82 – 01 43 60 42 34<br>
Email : info@demenagementpariseco.com <br>– SIRET : 51374116500015
	</th>
	<th width="340" bgcolor="#a89f01" style="color:#FFF;" align="center">
<font size="14" color="#FFFFFF" >Date : '.$date.'</font><br><br>
	<font size="14" color="#FFFFFF" ><b>VISITE N&deg; :PAR '.$id.'</b></font>
	</th>
    </tr>
	</table>
  <br><br>
  <table width="640" border="1" bordercolor="#333333" style="font-size:14;">
  <tr>
  <td >
  Date du R.D.V 
  </td>
  <td >
   
  '.$date.'
   
  </td>
  </tr>
  <tr >
        
       <td>Heure du  R.D.V </td>
       <td> 
  '.$result['heure_vis'].'
   </td>
  </tr>
   <tr>
  <td >
  Commercial 
  </td>
  <td >
  '.$commercial.'
  </td>
  </tr>
  
  <tr >
        
       <td>Nom du Client </td>
       <td>'.$result['civilite']." ".$result['nom']." ".$result['prenom'].'</td>
  </tr>
  <tr >
        
       <td>Tel du Client </td>
       <td>'.$result['tel'].'
   </td>
  </tr>
  <tr >
        
       <td>Mail du Client  </td>
       <td>'.$result['email'].'</td>
  </tr>
   <tr >
        
       <td>Adresse de Départ  </td>
       <td>
       '.$result['adresse_dep'].' '.$result['code_postale_dep'].' '.$result['ville_dep'].'
</td>
  </tr>
   <tr >
        
       <td>Etage + Code   </td>
       <td> 
      '.$result['habit_dep'].'
       </td>
  </tr>
   <tr >
        
       <td>Adresse d’Arrivée   </td>
       <td> '.$result['adresse_arr'].' '.$result['code_post_arr'].' '.$result['ville_arr'].'</td>
  </tr>
   <tr >
        
       <td>Etage + Code   </td>
       <td>'.$result['habit_arr'].' </td>
  </tr>
   <tr >
        
       <td>Volume Estimé  </td>
       <td>
       '. $result['volume'].'
       </td>
  </tr>
     <tr >
        
       <td>Date Envisagée   </td>
       <td>
       '.$date2.'
       </td>
  </tr>
     <tr >
        
       <td>Type de Prestation  </td>
       <td>
      '. $result['prestation'].'
       </td>
  </tr>
   <tr >
        
       <td>Durée de Mise en Garde-meuble  </td>
       <td>
       <?php 
  
   ?>
       </td>
  </tr>
   <tr >
        
       <td>Commentaires  </td>
       <td>
     '.$result['remarque_visite'].'
       </td>
  </tr>
   
  </table>
<table width="640">
<tr>
<td align="center">
<center>SUPER DEM – 17 rue Louis Blanc – 75010 PARIS – Tel: 06 22 22 82 82 – 01 43 60 42 34<br>
Email : info@demenagementpariseco.com – SIRET : 51374116500015</center>
</td>
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
