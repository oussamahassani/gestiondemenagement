<?php

session_start (); 

//============================================================+

// File name   : visite.php

// Last Update : 2019-05-04

// Description : Viste for TCPDF class

//               Full page background

//

// Author: Hela KHEDHIRA


//============================================================+



/**

 * Creates an example PDF TEST document using TCPDF

 * @package com.tecnick.tcpdf

 * @abstract TCPDF - Example: Full page background

 * @author Hela KHEDHIRA

 * @since 2019-05-04

 */



// Include the main TCPDF library (search for installation path).

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
$pdf->SetAuthor('Hela KHEDHIRA');
$pdf->SetTitle('Visite PDF');
$pdf->SetSubject('Superdem');
$pdf->SetKeywords('PDF, visite, demenagement');

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// remove default footer
$pdf->setPrintFooter(true);// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 24, PDF_MARGIN_RIGHT);
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
     $prestation=$result['prest'];
     if($result['passageFenetre_dep']=="1")
{
$passageFenetre_dep="oui";
}else
{
$passageFenetre_dep="non";
}
if($result['passageFenetre_arr']=="1")
{
$passageFenetre_arr="oui";
}else
{
$passageFenetre_arr="non";
}


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
     
if($result['duree_garde']==0)
{
$dureegarde="non";	 
}else
{
$dureegarde=$result['duree_garde']." Jours";
}

$volume=$result['volume'];


	 $idcom=$result['id_com'];

   $req1=mysql_query("select * from commercial where  id_commercial='$idcom'");

			

				if($result1=mysql_fetch_array($req1))

	     

			{	

  $commercial=$result1['prenom_com'].' '.$result1['nom_com'];

			}

// PAGE 1 - BIG background image
$pdf->AddPage();
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();
// Print a text
$style='<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
td {font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
td.cls_002{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_002{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
td.cls_006{font-family:Arial,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
th.cls_006{font-family:Arial,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
</style>
</head>
<body>';
$html = $style.'<div style="position:absolute;left:384.67px;top:70.46px;left:384.67px;top:78.46px;text-align:right" class="cls_006">Date : '.$date.'</div>
<div style="position:absolute;left:384.67px;top:78.46px;left:384.67px;top:78.46px;text-align:right" class="cls_005">VISITE N&deg; : PAR '.$id.'</div>
<div style="height:100px;"></div>

<table width="640" border="1" bordercolor="#333333" style="font-size:14;" cellpadding="0">
  <tr><td colspan="4" class="cls_006" style="Text-align: center;"><b>Infos Client</b></td> </tr>
  <tr><td colspan="2" class="cls_002">&nbsp;'.$result['civilite']." ".$result['nom']." ".$result['prenom'].'</td><td  colspan="2" class="cls_002">&nbsp;Id Client : '.$result['id_client'].'</td></tr>
  <tr><td colspan="2" class="cls_002">&nbsp;Email : '.$result['email'].'</td><td  colspan="2" class="cls_002">&nbsp;Télephone : '.$result['tel'].'</td></tr>
  <tr>

    <td colspan="2"><table width="320" border="1">

      <tr>

        <td colspan="2" class="cls_002"><div align="center">RDV</div></td>

        </tr>

      <tr>

        <td width="160" class="cls_002">&nbsp;Date</td>

        <td width="160" class="cls_002">&nbsp;'.$date.'</td>

      </tr>

      <tr>

        <td class="cls_002">&nbsp;Heure</td>

        <td class="cls_002">&nbsp;'.$result['heure_vis'].'</td>

      </tr>

    </table></td>

  <td colspan="2" class="cls_002">&nbsp;Commercial : '.$commercial.'</td></tr>
  
</table>


<br><br>

<table width="640" border="1" cellpadding="2"  >

  <tr>

    <th colspan="4" scope="col" class="cls_006" ><div align="center"><b>Infos Déménagement</b></div></th>

  </tr>

  <tr>

    <td colspan="2"><div align="center">Départ</div></td>

    <td colspan="2"><div align="center">Arrivee</div></td>

  </tr>

  <tr>

    <td width="150">&nbsp;Date de chargement</td>

    <td width="170">&nbsp;'.$datedep.'</td>

    <td width="150">&nbsp;Date de chargement</td>

    <td width="170">&nbsp;'.$datearr.'</td>

  </tr>

  <tr>

    <td>&nbsp;Adresse</td>

    <td>&nbsp;'.$result['adresse_dep'].'</td>

    <td>&nbsp;Adresse</td>

    <td>&nbsp;'.$result['adresse_arr'].'</td>

  </tr>

  <tr>

    <td>&nbsp;Étage</td>

    <td>&nbsp;'.$result['habit_dep'].'</td>

    <td>&nbsp;Étage</td>

    <td>&nbsp;'.$result['habit_arr'].'</td>

  </tr>

  <tr>

    <td>&nbsp;Portage</td>

    <td>&nbsp;'.$result['portage_dep'].'</td>

    <td>&nbsp;Portage</td>

    <td>&nbsp;'.$result['portage_arr'].'</td>

  </tr>

  <tr>

    <td>&nbsp;Passage par fenêtre</td>

    <td>&nbsp;'.$passageFenetre_dep.'</td>

    <td>&nbsp;Passage par fenêtre</td>

    <td>&nbsp;'.$passageFenetre_arr.'</td>

  </tr>

</table>
<br>
<table width="640" border="1" cellpadding="3">

  <tr>

    <th colspan="2" scope="col" width="290"><div align="center">Demande de stationnement</div></th>

    <th colspan="3" scope="col" width="350"><div align="center">Garde Meuble</div></th>

  </tr>

  <tr>

     <td width="145"><div align="center">Départ</div></td>

     <td width="145"><div align="center">Arrivée</div></td>

     <td width="120" align="center">&nbsp;Nbr Jours</td>

     <td width="120" align="center">&nbsp;Nbr Caisses</td>

    <td width="110" align="center">&nbsp;Autre détails</td>

  </tr>

  <tr>

    <td width="145"><div align="center">'.$stat_dep.'</div></td>

    <td width="145"><div align="center">'.$stat_arr.'</div></td>

    <td width="120" align="center">&nbsp;'.$dureegarde.'</td>

    <td width="120">&nbsp;</td>

    <td width="110">&nbsp;</td>

  </tr>

</table>



<table width="640" border="1" cellpadding="3">

  <tr>

    <th colspan="2" scope="col" width="290" align="center">Monte Meuble</th>

    <th colspan="4" scope="col" width="350" align="center">Véhicules</th>

  </tr>

  <tr>

    <td width="145"><div align="center">Départ</div></td>

    <td width="145"><div align="center">Arrivée</div></td>

    <td width="80" align="center">Type</td>

    <td width="80" align="center">Volume</td>

    <td width="80" align="center">Nbr</td>

    <td width="110">Remarque</td>

  </tr>

  <tr>

    <td><div align="center">'.$monte_dep.'</div></td>

    <td><div align="center">'.$monte_arr.'</div></td>

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



<table width="640" border="1"  cellpadding="3">

  <tr>

    <th colspan="6" scope="col" align="center"> <font size="12">Matériel</font></th>

  </tr>

  <tr>

    <td width="155"><div align="center">Type</div></td>

    <td width="50"><div align="center">Nbr</div></td>

    <td width="155"><div align="center"></div></td>

    <td width="50"><div align="center"></div></td>

    <td width="180"><div align="center"></div></td>

    <td width="50"><div align="center"></div></td>

  </tr>

  <tr>

    <td width="155">&nbsp;Cartons STD</td>

    <td>&nbsp;</td>

    <td>&nbsp;Penderies</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;Cartons Livres</td>

    <td>&nbsp;</td>

    <td>&nbsp;Housses GM</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;Cartons Vaisselles</td>

    <td>&nbsp;</td>

    <td>&nbsp;Housses PM</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;Cartons Verres</td>

    <td>&nbsp;</td>

    <td>&nbsp;Bulls</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;Cartons Bouteilles</td>

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

$html = $style.'<div style="position:absolute;left:384.67px;top:70.46px;left:384.67px;top:78.46px;text-align:right" class="cls_006">Inventaire Démenagement</div>
<br><br><br><br><table width="640" border="1" cellpadding="3">

  <tr>

    <th width="320" scope="col" bordercolor="#009900" >Volume : '.$volume.'</th>

    <th width="320" scope="col">Prestation : '.$prestation.'</th>

  </tr>

  <tr>

    <td colspan="2" height="110">Commentaire : </td>

  </tr>

</table>

<p></p>

<table width="640" border="1" cellpadding="10">

  <tr height="20">

    <th width="70" scope="col" align="center">Étage</th>

    <th width="100" scope="col" align="center">Pièce</th>

    <th width="50" scope="col" align="center">NB</th>

    <th width="195" scope="col" align="center">Meuble à dementer</th>

    <th width="225" scope="col" align="center"> Fragile</th>

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
<br>
<br>
<table>
<tr>
<td style="position:absolute;left:45.30px;top:629.23px" class="cls_002">Signature et cachet Commercial</td>
<td style="position:absolute;left:322.52px;top:629.23px" class="cls_002">Signature client</td>
</tr></table>
';

$pdf->SetMargins(PDF_MARGIN_LEFT, 24, PDF_MARGIN_RIGHT);
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();		

//$pdf->writeHTML($html, true, false, true, false, '');

$pdf->writeHTML($html, true, true, true, true, '');


// --- example with background set on page ---



// remove default header

//$pdf->setPrintHeader(false);



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

