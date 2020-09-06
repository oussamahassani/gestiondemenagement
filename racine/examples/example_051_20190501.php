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
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 051');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->AddPage();
// set font
$pdf->SetFont('helvetica', '', 10);

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
			   $ttc=$result['Prix_ht']+(($result['Prix_ht']*$tva)/100);
			   $ptva=($result['Prix_ht']*$tva)/100;
			   $apayer=($ttc*30)/100;
			   $reste=$ttc-$apayer;
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
                $title='Devis_'.$result['nom'].'_'.$result['prenom'].'.pdf';
				
				$date=$result['etablie_le'];
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
				
               if($result['duree_garde']==0)
			   {
				 $dureegarde="non";	 
			   }else
			   {
			     $dureegarde=$result['duree_garde']." Jours";
			   }
			   $remarque=nl2br($result['rqs']);
	
// add a page


// Print a text
$html = '<table width="640" border="0">
  <tr>
    <th width="450" scope="col" ></th>
	<th width="190" scope="col"   bgcolor="#7a7a7a" style="color:#FFF;">
	<br>
	<h2>&nbsp;&nbsp;Devis N°: PAR'.$result['id_dem'].' </h2>---------------------------------------------<br>
	&nbsp;&nbsp;<b>Etablie Le: '.$date.'</b><br>
	&nbsp;&nbsp;<b>Valable Jusqu&acute;au: '.$result['valable_le'].'</b>  <br>
	
	</th>
  </tr>
  
</table>
<br><br>
<table width="640" border="0">
  <tr>
    <th width="640" scope="col"   bgcolor="#7a7a7a" style="color:#FFF;" align="center"><h3>Client</h3></th>
	
  </tr>
  <tr>
    <td >
	<br>
	<br>
    Nom: '.$result['civilite'].' '.$result['nom'].' <br>
    Prenom: '.$result['prenom'].'<br>
    Tel: '.$result['tel'].'<br>
    Courriel: '.$result['email'].'<br>
    <b>PRESTATION: '.$result['prest'].'</b><br>
    </td>
  </tr>
</table>

<table width="640" border="0">
  <tr>
    <th width="640" scope="col"   bgcolor="#7a7a7a" style="color:#FFF;" align="center"><h3>INFOS Déménagement</h3></th>
	
  </tr>
  <tr>
    <td >
	<br>
	<br>
    <b>Date de Démenagement:</b> '.$datedep.' <br>
    <b>Date de Livraison:</b> '.$datearr.' <br>
    <b>Volume à demenager:</b>  '.$result['volume'].'m&sup3;<br>
    <b>Distance:</b> '.$result['distance'].'Km <br>
    <b>Plafond de l&nbsp;assurance:</b>  '.$result['assurance'].'€<br>
    
    </td>
  </tr>
</table>

<table width="640" border="0">
  <tr>
    <th width="320" scope="col" bgcolor="#c6aa1d" style="color:#FFF;" align="center"><h3>DEPART</h3></th>
	<th width="320" scope="col"   bgcolor="#a38801" style="color:#FFF;" align="center"><h3>ARRIVEE</h3></th>
	
  </tr>
  <tr>
    <td   bgcolor="#7a7a7a" >
	<br>
	<br>
    <b>Adresse:</b>  '.$result['adresse_dep'].' '.$result['code_postale_dep'].' '.$result['ville_dep'].'<br>
    <b>Etage:</b> '.$result['habit_dep'].' <br>
    <b>Ascenceur:</b> '.$accen_dep.'<br>
    <b>Monte meuble:</b> '.$accen_arr.'<br>
    <b>Portage:</b> '.$result['portage_dep'].'<br>
	
	<b>&nbsp;&nbsp;Accés vehicule:</b> oui <br>
      <b>Garde Meubles:</b> '.$dureegarde.'<br>
    </td>
	<td >
	<br>
	<br>
     <b>Adresse:</b> '.$result['adresse_arr'].' '.$result['code_post_arr'].' '.$result['ville_arr'].' <br>
    <b>Etage:</b> '.$result['habit_arr'].'<br>
    <b>Ascenceur:</b> '.$accen_arr.'<br>
    <b>Monte meuble:</b> '.$monte_arr.'<br>
    <b>Portage:</b> '.$result['portage_arr'].'<br>
	<b>&nbsp;&nbsp;Accés vehicule:</b> oui <br>
	 
    
    </td>
  </tr>
</table>
<br><br><br>
<table width="640" border="0">
  <tr>
    <th width="640" colspan="2" scope="col"   bgcolor="#7a7a7a" style="color:#FFF;" align="center"><h3>Proposition</h3></th>
	
  </tr>
  <tr>
    <td  width="500">
	<br>
	<br>
    <b>Montant déménagement (Prix HT)
 :</b> '.number_format($ht, 2, ",", "").' €<br>
    <b>TVA:</b> '.$tva.'% | montant TVA: '.number_format($ptva, 2, ",", "").' €<br>
    <b>Montant d&acute;avance 30%:</b> '.number_format($apayer, 2, ",", "").' € <br>
   
    </td>
	<td  bgcolor="#cc7600" style="color:#fff;" width="140" align="center">
	
	<br><br>Montant TTC
     <h2>'.number_format($ttc, 2, ",", "").' €</h2> <br>
   
    
    </td>
  </tr>
</table>
<br><br>
<br><br><br><br><br><br><br>

<table width="640">
<tr>
<td align="center">
<center>SUPER DEM – 17 rue Louis Blanc – 75010 PARIS – Tel: 06 22 22 82 82 – 01 43 60 42 34<br>
Email : info@demenagementpariseco.com – SIRET : 51374116500015</center>
</td>
</tr>
</table>
';

			}
$pdf->writeHTML($html, true, false, true, false, '');


// add a page
$pdf->AddPage();

// Print a text
$html = '
<br><br><br><br><br><br>

<table width="640" border="1" border-color="Black">
  <tr>
    <th width="640" colspan="2" scope="col"   bgcolor="#7a7a7a" style="color:#FFF;" align="center"><h3>Remarques</h3></th>
	
  </tr>
  <tr>
    <td  width="640" height="700" style="overflow-wrap: break-word;word-break: break-all;">
	 
	'.$remarque.'

   
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

$pdf->AddPage();

// Print a text
$html = '
<br><br><br><br>
<p size="-3">
<b>FORMULE ECONOMIQUE</b><br>
L ’emballage de vos vêtements sur cintres en penderies portables La mise sous housses de vos
matelas et sommiers<br>
La protection de votre mobilier sous housses ou couvertures<br>
Le chargement et le calage de l’ensemble de vos meubles et objets Le transport en véhicule<br>
capitonné
La manutention au domicile de l’arrivée<br>
La remise en place de votre mobilier selon vos souhaits<br>
Le transport de vos plantes (sans garantie de l’état à l’arrivée)<br><br>
<b>FORMULE ECONOMIQUE PLUS</b><br>
L’emballage de votre télévision hi- et informatique Le démontage des
meubles si nécessaire<br>
L ’emballage de vos vêtements sur cintres en penderies portables La mise sous housses de vos
matelas et sommiers<br>
La protection de votre mobilier sous housses ou couvertures<br>
Le chargement et le calage de l’ensemble de vos meubles et objets Le transport en véhicule
capitonné<br>
La manutention au domicile de l’arrivée<br>
La remise en place de votre mobilier selon vos souhaits<br>
Le transport de vos plantes (sans garantie de l’état à l’arrivée)<br><br>
<b>FORMULE STANDARD</b><br>
L’emballage de vos cadres, tableaux, miroirs, lampes et lustres L’emballage de votre<br>
vaisselle, verrerie et autres objets fragiles Le démontage des meubles si nécessaire<br>
L’emballage de votre télévision hi- et informatique<br>
L’emballage de vos vêtements sur cintres en penderies portables La mise sous housses de
vos matelas et sommiers<br>
La protection de votre mobilier sous housses ou couvertures<br>
Le chargement et le calage de l’ensemble de vos meubles et objets Le transport en véhicule
capitonné<br>
La manutention au domicile de l’arrivée<br>
La remise en place de votre mobilier selon vos souhaits Le remontage des
meubles si nécessaire<br>
Le déballage de votre vaisselle et objets fragiles<br>
La mise à disposition de votre emballage (cartons, adhésifs et papier bulle) Le transport de vos plantes (sans<br>
garantie de l’état à l’arrivée)<br><br>
<b>FORMULE LUXE<br></b>
L’emballage de votre petit linge, effets personnels, vos vêtements pliés et linge de maison L’emballage de vos livres,
magazines et autres BD<br>
L’emballage de vos bibelots non fragiles et articles divers L’emballage de vos cadres,
tableaux, miroirs, lampes et lustres L’emballage de votre vaisselle, verrerie et autres
objets fragiles Le démontage des meubles si nécessaire<br>
L’emballage de votre télévision hi- et informatique<br>
L’emballage de vos vêtements sur cintres en penderies portables La mise sous housses de
vos matelas et sommiers<br>
La protection de votre mobilier sous housses ou couvertures<br>
Le chargement et le calage de l’ensemble de vos meubles et objets Le transport en véhicule
capitonné<br>
La manutention au domicile de l’arrivée<br>
La remise en place de votre mobilier selon vos souhaits Le remontage des
meubles si nécessaire<br>
Le déballage de votre vaisselle et objets fragiles<br>
La mise à disposition de votre emballage (cartons, adhésifs et papier bulle) Le transport de vos plantes (sans garantie de l’état à l’arrivée)<br>

</p>

';
$pdf->writeHTML($html, true, false, true, false, '');

// --- example with background set on page ---

// remove default header
$pdf->setPrintHeader(false);

// add a page
$pdf->AddPage();


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'image_demo2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// Print a text
$html = '
<table width="640">
<tr><td width="320"></td>
<td width="150">
ADDITIF 
</td><td width="170">CLIENT</td></tr>
<tr><td width="320"></td>
<td>
Au Devis N°..................
</td><td> M.........................</td></tr>
</table>
<br><br>
<p size="-3">
<h1>DECLARATION DE VALEUR</h1><br>
<table width="640" border="0" >
  
  <tr >
    <td  width="315"  style="overflow-wrap: break-word;word-break: break-all;padding-left:20px;">
	 
	Vous confiez le déménagement de votre mobilier à un déménagement
professionnel.
L’entreprise de déménagement sera responsable des dommages éventuels
pouvant survenir au mobilier confié dans les conditions fixées à l’article
13 des conditions générales de vente, l’indemnisation pour pertes et
avaries est limitée à la valeur totale du mobilier, et pour chaque objet ou
élément de mobilier non listé, à 230,00 €

   
    </td>
<td width="10"> </td>	
	<td width="315">
	Dans certains cas, la responsabilité de l’entreprise peut ne pas être retenue
(accident ou incendie non responsable, vol avec agression, et d’une manière
générale, les cas de force majeur).
Vous pouvez alors estimer que la garantie de responsabilité contractuelle de
l’entreprise est insuffisante et opter pour la souscription d’une assurance
dommage (article 4 des conditions générales de vente), dont les conditions
sont tenues à votre disposition sur demande.
	</td>
	  </tr>
</table><BR>
<b>1/ VALEUR TOTALE DU MOBILIER</b><br>
Indiquez en lettres et en chiffres, la valeur totale du mobilier, y compris les objets<br>
ou éléments de mobilier désignés individuellement en 2/ :<br>
....................................................................................................................(en lettres)<br>
.................................................€<br><BR>
<b>2/ VALEURS INDIVIDUELLES</b><br>
Vous avez choisi la garantie de responsabilité contractuelle : Indiquez et valorisez les objets ou éléments de mobilier dont la valeur
individuelle est supérieure à l’indemnisation maximale par objet ou élément de mobilier.<BR>
Vous avez opté pour l’assurance dommage : vous pouvez également lister et valoriser les objets ou éléments de mobilier de votre choix.
<BR><BR>
<table width="640" border="1" border-color="Black">
  
  <tr>
    <td  width="250"  style="overflow-wrap: break-word;word-break: break-all;">
	 
DÉSIGNATION
   
    </td>
	<td width="70">
	VALEUR EN €
	</td>
	<td width="250">
	DÉSIGNATION
	</td>
	<td width="70">
	VALEUR EN €
	</td>
	  </tr>
	  
	   <tr>
    <td  width="250"  style="overflow-wrap: break-word;word-break: break-all;">
	 
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
   
    </td>
	<td width="70">
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
	</td>
	<td width="250">
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
............................................................<BR>
	</td>
	<td width="70">
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
............<BR>
	</td>
	  </tr>
</table>
<span align="right">TOTAL :..........................€</span><br><br>

<b>MODE DE GARANTIE CHOISI :</b><BR>
‪-GARANTIE DE RESPONSABILITÉ CONTRACTUELLE<br>
‪-ASSURANCE DOMMAGE<br><br>
Cette déclaration de valeur est à retenir comme base de calcul du coût de mode de garantie choisi figurant au devis.<br>
M.....................................................déclare que les valeurs énoncées ci-dessus sont sincères et réelles.<br>
Fait à .............................................................. le.....................................<br>
Pour l’acceptation des conditions générales de vente, se reporter au dos.<br><br>
<span align="right">SIGNATURE DU CLIENT</span><br><br>

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

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output( $title, 'I');

//============================================================+
// END OF FILE
//============================================================+
