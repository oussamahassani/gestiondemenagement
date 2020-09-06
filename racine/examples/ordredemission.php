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


$pdf->AddPage();


                
				require_once '../../../connect.php';
						$id=$_GET['id'] ;
						$idd=$_GET['dev'] ;  
				 $req=mysql_query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
				 while($result=mysql_fetch_array($req))
	
	   		     
			{				
				
				 $req2=mysql_query("select * from parametre");
				 $restva=mysql_fetch_array($req2);
				 $tva=$restva['tva'];
               $ht=$result['Prix_ht'];
			   $ttc=$result['Prix_ht']+(($result['Prix_ht']*100)/$result['Prix_ht']);
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
				$title='OM_'.$result['nom'].'_'.$result['prenom'].'.pdf';
				
				 $datearr=$result['date_arr'];
				$a=substr($datearr,0,4);
				$m=substr($datearr,5,2);
				$j=substr($datearr,8,2);
				$datearr=$j."/".$m."/".$a;
				$datedep=$result['date_dep'];
				$a=substr($datedep,0,4);
				$m=substr($datedep,5,2);
				$j=substr($datedep,8,2);
				$datedep=$j."/".$m."/".$a;
				
// Print a text
$html = '


<table width="640" border="0" >
  <tr>
    <th width="174" rowspan="3" ><br><br>&nbsp;</th>
	<th width="315" bgcolor="#aa8603" style="color:#FFF;" align="center">
	<font size="7" color="#FFFFFF" >NOM, ADRESSE ET N° SIREN OU N° D&acute;IDENTIFICATION INTRACOMMUNAUTAIRE DE L&acute;ENTREPRISE</font>
	</th>
    <th width="151" scope="col">

	</th></tr>
    
    <tr>
    
    <td align="center" rowspan="2"><br><br>SUPER DEM – 17 rue Louis Blanc – 75010 PARIS <br>– Tel: 06 22 22 82 82 – 01 43 60 42 34<br>
Email : info@demenagementpariseco.com <br>– SIRET : 51374116500015</td>
    <td align="center"><font size="7" color="#000"><br>exemplaire A constituant la souche à conserver par l&acute;entreprise pendant 2 ans</font></td>
    </tr>
	 <tr>
	 <td><br>
	 <b>CLIENT: '.$result['nom'].'</b><br>
	 <b>DEVIS N&deg;: DEM'.$result['id_dem'].'</b> 
	 </td></tr>
  
  
</table>
<table>
<tr>
<td align="center">
<font size="27"><b> Lettre de Voiture de demenagement</b></font>
<br><font size="10"> Document obligatoire par l&acute;arrêté du 9/11/1999 </font>
</td>
</tr>
</table>
<table width="640" border="1" bordercolor="#333333">
  <tr>

	<th  >
	<font size="10" color="#000000" >Nom du client :'.$result['civilite'].' '.$result['nom'].' '.$result['prenom'].' </font><br>
	<font size="10"  color="#000000" >Adresse : '.$result['adresse_dep'].' '.$result['code_postale_dep'].' '.$result['ville_dep'].'</font><br>
	<font size="10"  color="#000000" >Tel :  '.$result['tel'].'</font><br>
	</th>
    <th  scope="col">
<font size="10" color="#000000" >VOYAGE : </font><br>
	<font size="10"  color="#000000" >DISTANCE : '.$result['distance'].' Km</font><br>
	<font size="10"  color="#000000" >ENTREPRISE EXECUTANTE: Paris ECO </font>
	</th></tr>
    
    
  
  
</table>



<table width="640" border="1" bordercolor="#333333">
  <tr>
    <th width="100" rowspan="2" >&nbsp;</th>
	<th width="270" bgcolor="#af8a00" style="color:#FFF;" align="center">
	<font size="12" color="#FFFFFF" >CHARGEMENT</font>
	</th>
   <th width="270" bgcolor="#af8a00" style="color:#FFF;" align="center">
	<font size="12" color="#FFFFFF" >LIVRAISON</font>
	</th></tr>
    
    <tr>
    
    <td align="left"><br><br>Date: '.$datedep.'
	
	<br></td>
    <td align="left"><br><br>Date: '.$datearr.'
	
	<br></td>
    </tr>
	
	  <tr>
    
    <td align="center"><br><br>Adresse<br><br></td>
<td align="center"><font size="10" color="#000">'.$result['adresse_dep'].' '.$result['code_postale_dep'].' '.$result['ville_dep'].'</font></td>
	 <td align="center"><font size="10" color="#000">'.$result['adresse_arr'].' '.$result['code_post_arr'].' '.$result['ville_arr'].'</font></td>

    </tr>
	 <tr>
    
    <td align="center">

	
	
	Bâtiment Accés
	
	</td>
    <td >
		<table>
	<tr>
	<td>
	<b>Etage</b> : '.$result['habit_dep'].'<br>
	Ascenseur: '.$accen_dep.'<br>
	Portage: '.$result['portage_dep'].' m<br>
	Passage
	Par fenetre: 
	
	</td>
	<td>
	<b>Porte</b><br>
	Transbordement:  <br>
	Monte meuble: '.$monte_dep.' <br>
	</td>
	</tr>
	</table>
	</td>
	<td>
			<table>
	<tr>
	<td>
	<b>Etage</b> : '.$result['habit_arr'].'<br>
	Ascenseur: '.$accen_dep.'<br>
	Portage: '.$result['portage_arr'].' m<br>
	Passage: 
	Par fenetre: 
	
	</td>
	<td>
	<b>Porte</b><br>
	Transbordement:  <br>
	Monte meuble: '.$monte_arr.'<br>
	</td>
	</tr>
	</table>
	</td>
    </tr>
  <tr>
  
  <td colspan="3" width="640">
		  <table>
			<tr>
			<td>
			<b>MODE D&nbsp;EXECUTION <table><tr><td><img src="images/case.jpg"/ >Route</td><td> <img src="images/case.jpg"/ >Fer</td><td> <img src="images/case.jpg"/ >  Mer </td><td><img src="images/case.jpg"/ >   Air </td></tr></table></b><br>
			Volume prévu : '.$result['volume'].' m&sup3; &nbsp;&nbsp;&nbsp;&nbsp;        (ou poids évalué :  &nbsp;&nbsp;&nbsp;&nbsp;        Kg <br>
			Prestation : '.$result['prest'].'
			
			
			</td>
			<td><br>
			<br>
			<b><img src="images/case.jpg"/ ></b>après visite chez le client par  le<br>
			<img src="images/case.jpg"/ > suivant inventaire établi par le client le <br>
			</td>
			</tr>
			</table>
  </td>
  </tr>
  <tr>
  <td colspan="3">
  <table bordercolor="#000000" border="1">
  <tr>
  <td bgcolor="#af8a00" style="color:#fff" align="center">
  
  INSTRUCTIONS
  
  
  </td>
  <td bgcolor="#af8a00" style="color:#fff" align="center" >
  EXECUTION
  </td>
  </tr>
  <tr>
  <td>
  
  1&nbsp; | COMPOSITION DE L&acute;EQUIPE<br>
  Chef d&acute;équipe conducteur :............................................ <br>
  Déménageur conducteur : ............................................ <br>
  Déménageurs : .............................................................<br> .................................................................................<br>
  ..... .............................................................................<br>
  ......... .........................................................................<br>
   2&nbsp; | POIDS LOURDS <br>
  <table><tr><td> <img src="images/case.jpg"/ >Piano droit </td><td> <img src="images/case.jpg"/ >  Coffre Fort </td><td><img src="images/case.jpg"/ >  Piano à queue </td></tr></table><br>
  Autres :.........................................................................<br>
   3&nbsp; | VEHICULE(S) ..............................................<br>
   ......... .........................................................................<br>
    ......... .........................................................................<br>
	 ......... .........................................................................<br>  
    4&nbsp; | SOMME A ENCAISSER : <br>
	<br>
	
	&nbsp; 5&nbsp; | AUTRES INSTRUCTIONS <br><br><br><br><br>Le&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; le chef d&acute;exploitation
	
	
  </td>
  <td>
  1&nbsp; | DOCUMENT DE SUIVI CONTRADICTOIRE <br>
  Date et heure d&acute;arrivée au lieu de chargement :<br>
  Le .......................... A ........... H .............<br>
  Date et heure de départ du véhicule chargé :<br>
  Le .......................... A ........... H ............. <br>
  <b>Nom du conducteur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Nom du client </b><br>
  Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Signature
  <br>
  <hr>

  Date et heure d&acute;arrivée au lieu de  livraison :<br>
  Le .......................... A ........... H .............<br>
  Date et heure de départ du véhicule déchargé :<br>
  Le .......................... A ........... H ............. <br>
  <b>Nom du conducteur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Nom du client </b><br>
  Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Signature
  <br>
  <hr>
    1&nbsp; | COMPTE RENDU D&acute;EXECUTION ET OBSERVATIONS DIVERSES <br>
	<br><br><br><br>Le&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Le chef d&acute;équipe

  </td>
  </tr>
  </table>
  
  </td>
  </tr>
  
  
</table>



';

			
$pdf->writeHTML($html, true, false, true, false, '');



// --- example with background set on page ---

// remove default header

// -- set new background ---



// ---------------------------------------------------------
}
//Close and output PDF document
$pdf->Output($title, 'I');

//============================================================+
// END OF FILE
//============================================================+
