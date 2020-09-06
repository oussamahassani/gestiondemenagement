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
$req=mysql_query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
//$req=$mysqli->query("select * from demande,client,devis where demande.id_dem=devis.id_demande and demande.id_client=client.id_client and demande.id_dem='$id' and devis.id_devis='$idd' ");
//while($result=$req->fetch_assoc())
while($result=mysql_fetch_array($req))

{
//$req2=$mysqli->query("select * from parametre");
$reqs=mysql_query("select * from masterParametreValeur where id='".$result['prest']."'");
$prestationrq=mysql_fetch_array($reqs);
$prestation=$prestationrq['valeur'];

$req2=mysql_query("select * from parametre");
$restva=mysql_fetch_array($req2);
$numDevis=$result['id_devis'];
$valable_le=$result['devis_valable_au'];
$a=substr($valable_le,0,4);
$m=substr($valable_le,5,2);
$j=substr($valable_le,8,2);
$valable_le=$j."/".$m."/".$a;
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
if($result['cave_dep']=="1")
{
$cave_dep="oui";
}else
{
$cave_dep="non";
}

if($result['cave_arr']=="1")
{
$cave_arr="oui";
}else
{
$cave_arr="non";
}

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


if($result['garde_meuble_dep']=="1")
{
$garde_meuble_dep="oui";
}else
{
$garde_meuble_dep="non";
}

if($result['garde_meuble_arr']=="1")
{
$garde_meuble_arr="oui";
}else
{
$garde_meuble_arr="non";
}

if($result['accesVehicule_dep']=="1")
{
$accesVehicule_dep="oui";
}else
{
$accesVehicule_dep="non";
}

if($result['accesVehicule_arr']=="1")
{
$accesVehicule_arr="oui";
}else
{
$accesVehicule_arr="non";
}

$title='Devis_'.$result['nom'].'_'.$result['prenom'].'.pdf';

$date=$result['devis_etabli_le'];
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
$nomclient=$result['civilite'].' '.$result['nom'];
$prenomclient =$result['prenom'];
$telclient=$result['tel'];
$emailClient=$result['email'];
//$prestation=$result['prest'];
$plafond=$result['assurance'];
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

if($result['duree_garde']==0)
{
$dureegarde="non";	 
}else
{
$dureegarde=$result['duree_garde']." Jours";
}
$remarque=nl2br($result['rqs']);
// add a page

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
<td  class="cls_030"><span class="cls_030">Informations client :</span><br></td>
<td  class="cls_005"><span class="cls_005"><b>Devis N° :</b> SUP'.$numDevis.'</span></td>
</tr>

<tr>
<td  class="cls_006"><span class="cls_006"><b>Nom : </b>'.$nomclient.'</span></td>
<td  class="cls_006"><span class="cls_006"><b>Etablie le :</b> '.$date.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Prénom : </b>'.$prenomclient.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Tel : </b>'.$telclient.'</span></td>
<td class="cls_006"><span class="cls_006"><b>Valable jusqu&acute;au : </b>'.$valable_le.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Courriel : </b>'.$emailClient.'</span></td>
</tr>
<tr>
<td class="cls_007"><span class="cls_007"><b>PRESTATION : </b>'.$prestation.'</span></td>
</tr>
<tr><td></td></tr>


<tr>
<td class="cls_030"><span class="cls_030">Informations déménagement :</span><br></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Date de déménagement : </b>'. $datedep.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Date de livraison : </b>' .$datearr.'</span></td>
</tr>
<tr>
<td  class="cls_006"><span class="cls_006"><b>Volume à déménager : </b>'.$volume.'</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Distance : </b>'.$distance.' Km</span></td>
</tr>
<tr>
<td class="cls_006"><span class="cls_006"><b>Plafond de l&acute;assurance :</span> '.$plafond.' €</span></td>
</tr>
<tr><td style="height:24px;" class="cls_009"></td>
<td></td></tr>
</table>
</td>
</tr>
</table>

<table style="border-collapse: collapse; border: none;" width="658">
<tbody>
<tr>
<td style="width:50%;background-color: gray; border: solid #D0CECE 3pt;height: 20.0pt;text-align: center;">
<table style=" border-collapse: collapse; border: none;">
<tbody>
<tr>
<td style="height:20.0pt;">
<p style="text-align: center;"><span style="color: white;">D&Eacute;PART</span></p>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width:50%; background-color: #EDEDED;border: solid #D0CECE 3pt;height: 20.0pt;text-align: center;">
<table style="border-collapse: collapse; border: none;width:100%;">
<tbody>
<tr>
<td style="height:20.0pt;">
<p style="text-align: center;"><span style="color: black;">ARRIV&Eacute;E</span></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<span class="cls_006"><br><b>- Adresse : </b>'.$adresse_dep.' '.$code_postale_dep.' '.$ville_dep.'</span>
<span class="cls_006"><br><b>- Étage : </b>'.$habit_dep.'</span>
<span class="cls_006"><br><b>- Ascenseur : </b>'.$accen_dep.'</span>
<span class="cls_006"><br><b>- Cave : </b>'.$cave_dep.'</span>
<span class="cls_006"><br><b>- Monte meuble : </b>'.$monte_dep.'</span>
<span class="cls_006"><br><b>- Portage : </b>'.$portage_dep.'</span>
<span class="cls_006"><br><b>- Accès véhicule : </b>'.$accesVehicule_dep.'</span>
<span class="cls_006"><br><b>- Garde meubles : </b>'.$garde_meuble_dep.'</span>
<span class="cls_006"><br><b>- Passage par fenêtre : </b>'.$passageFenetre_dep.'</span>
</td>
<td style="border-top: none; border-left: none; border-bottom: solid #D0CECE 1.5pt;
 border-right: solid #D0CECE 1.5pt; padding: 0cm 5.4pt 0cm 5.4pt;">
 <span class="cls_006"><br><b>- Adresse : </b>'.$adresse_arr.' '.$code_postale_arr.' '.$ville_arr.'</span>
 <span class="cls_006"><br><b>- Étage : </b>'.$habit_arr.'</span>
 <span class="cls_006"><br><b>- Ascenseur : </b>'.$accen_arr.'</span>
 <span class="cls_006"><br><b>- Cave : </b>'.$cave_arr.'</span>
 <span class="cls_006"><br><b>- Monte meuble : </b>'.$monte_arr.'</span>
 <span class="cls_006"><br><b>- Portage : </b>'.$portage_arr.'</span>
 <span class="cls_006"><br><b>- Accès véhicule : </b>'.$accesVehicule_arr.'</span>
 <span class="cls_006"><br><b>- Garde meubles : </b>'.$garde_meuble_arr.'</span>
 <span class="cls_006"><br><b>- Passage par fenêtre : </b>'.$passageFenetre_arr.'</span>
</td>
</tr>
</tbody>
</table>

<br>
<br>
<br>

<table style="border-collapse: collapse; border: none;" width="658">
<tbody>
<tr>
<td style="width:50%;border: solid #D0CECE 3pt;text-align: center;">
Proposition
</td>
<td style="width:50%;border: solid #D0CECE 3pt;padding: 0cm 5.4pt 0cm 5.4pt;text-align: center;">
Montant TTC
</td>
</tr>
<tr>
<td style="border: solid #D0CECE 1.5pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<br>
<span class="cls_006">- Montant déménagement (Prix HT) :  </span>'.number_format($ht, 2, ",", "").' €
<br>
<span class="cls_006">- TVA : </span>'.$tva.'% 
<span class="cls_006">montant TVA : </span>'.number_format($ptva, 2, ",", "").' €
<br>
<span class="cls_006">- Montant d&acute;avance 30% : </span>'.number_format($apayer, 2, ",", "").' €
</td>
<td style="text-align: center;border-top: none; border-left: none; border-bottom: solid #D0CECE 1.5pt; border-right: solid #D0CECE 1.5pt; padding: 0cm 5.4pt 0cm 5.4pt;"><br>'
.number_format($ttc, 2, ",", "").' €


</td>
</tr>
</tbody>
</table>
';


$pdf->writeHTML($html, true, true, true, true, '');

$pdf->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT);
// PAGE 2 - BIG background image
$pdf->AddPage();
$pdf->setPrintFooter(true);
$bMargin = $pdf->getBreakMargin();
//$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
//$pdf->setPageMark();
$htmp2='
<br>
<br>
<br><br>
<br>
<br><span class="cls_010" style="position:absolute;left:50%;text-align:center;margin-left:-297px;top:1000px;" >Remarques</span>
<br><br><br>'.$remarque.'';


$pdf->writeHTML($htmp2, true, true, true, true, '');
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
// PAGE 3 - SET Header image
$pdf->AddPage();
$pdf->setPrintFooter(true);
//$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
//$pdf->setPageMark();
$htmp3=$style. '<div style="position:absolute;left:384.67px;top:78.46px" class="cls_005"><span class="cls_005" style="left:384.67px;top:78.46px;text-align:right">NOS TYPES DE PRESTATIONS</span></div>
<div style="height:100px;"></div>
<div style="height:100px;"></div>
<table>
<tr><td style="position:absolute;left:42.84px;top:157.06px" class="cls_019"><span class="cls_019"><br>FORMULE ECONOMIQUE</span></td></tr>
<tr><td style="position:absolute;left:42.12px;top:172.78px" class="cls_020"><span class="cls_020">L&acute;emballage de vos vêtements sur cintres en penderies portables La mise sous housses de vos
matelas et sommiers
<br>La protection de votre mobilier sous housses ou couvertures
<br>Le chargement et le calage de l&acute;ensemble de vos meubles et objets Le transport en véhicule capitonné
<br>La manutention au domicile de l&acute;arrivée
<br>La remise en place de votre mobilier selon vos souhaits
<br>Le transport de vos plantes (sans garantie de l&acute;état à l&acute;arrivée)</span>
</td></tr>
</table>
<table>
<tr><td style="position:absolute;left:42.00px;top:262.21px" class="cls_019">
<span class="cls_019"><br>FORMULE ECONOMIQUE PLUS</span></td></tr>
<tr><td  style="position:absolute;left:42.00px;top:274.33px" class="cls_020">
<span class="cls_020">L&acute;emballage de votre télévision hi- et informatique Le démontage des meubles si nécessaire
<br>L&acute;emballage de vos vêtements sur cintres en penderies portables La mise sous housses de vos matelas et sommiers
<br>La protection de votre mobilier sous housses ou couvertures
<br>Le chargement et le calage de l&acute;ensemble de vos meubles et objets Le transport en véhicule capitonné
<br>La manutention au domicile de l&acute;arrivée
<br>La remise en place de votre mobilier selon vos souhaits
<br>Le transport de vos plantes (sans garantie de l&acute;état à l&acute;arrivée)</span>
</td></tr>
<table>
<tr><td  style="position:absolute;left:42.00px;top:381.01px" class="cls_019"><span class="cls_019"><br>FORMULE STANDARD</span></td></tr>
<tr><td style="position:absolute;left:42.00px;top:393.01px" class="cls_020">
<span class="cls_020">L&acute;emballage de vos cadres, tableaux, miroirs, lampes et lustres L&acute;emballage de votre
<br>vaisselle, verrerie et autres objets fragiles Le démontage des meubles si nécessaire
<br>L&acute;emballage de votre télévision hi- et informatique
<br>L&acute;emballage de vos vêtements sur cintres en penderies portables La mise sous housses de
<br>vos matelas et sommiers
<br>La protection de votre mobilier sous housses ou couvertures
<br>Le chargement et le calage de l&acute;ensemble de vos meubles et objets Le transport en véhicule
vcapitonné
<br>La manutention au domicile de l&acute;arrivée
<br>La remise en place de votre mobilier selon vos souhaits Le remontage des
<br>meubles si nécessaire
<br>Le déballage de votre vaisselle et objets fragiles
<br>La mise à disposition de votre emballage (cartons, adhésifs et papier bulle) Le transport de vos plantes (sans
<br>garantie de l&acute;état à l&acute;arrivée)</span>
</td></tr></table>
<table>
<tr><td style="position:absolute;left:42.00px;top:551.43px" class="cls_019">
<span class="cls_019"><br>FORMULE LUXE</span></td></tr>
<tr><td style="position:absolute;left:42.00px;top:563.55px" class="cls_020">
<span class="cls_020">L&acute;emballage de votre petit linge, effets personnels, vos vêtements pliés et linge de maison L&acute;emballage de vos livres,
magazines et autres BD
<br>L&acute;emballage de vos bibelots non fragiles et articles divers L&acute;emballage de vos cadres,
<br>tableaux, miroirs, lampes et lustres L&acute;emballage de votre vaisselle, verrerie et autres
<br>objets fragiles Le démontage des meubles si nécessaire
<br>L&acute;emballage de votre télévision hi- et informatique
<br>L&acute;emballage de vos vêtements sur cintres en penderies portables La mise sous housses de
<br>vos matelas et sommiers
<br>La protection de votre mobilier sous housses ou couvertures
<br>Le chargement et le calage de l&acute;ensemble de vos meubles et objets Le transport en véhicule capitonné
<br>La manutention au domicile de l&acute;arrivée
<br>La remise en place de votre mobilier selon vos souhaits Le remontage des
<br>meubles si nécessaire
<br>Le déballage de votre vaisselle et objets fragiles
<br>La mise à disposition de votre emballage (cartons, adhésifs et papier bulle) Le transport de vos plantes (sans garantie de l&acute;état à l&acute;arrivée)
</span></td>
</tr></table>
</div>
';


$html4=$style. '<table>
<tr><td style="position:absolute;left:367.03px;top:64.64px;text-align:right" class="cls_023"><span class="cls_023">Additif au devis N° : ………………………...</span></td></tr>
<tr><td style="position:absolute;left:367.03px;top:77.24px;text-align:right" class="cls_023"><span class="cls_023">Client : ……………………………………….</span></td></tr>
</table>
<table>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td style="position:absolute;left:43.56px;top:142.30px" class="cls_010"><span class="cls_010">DÉCLARATION DE VALEUR</span></td>
<td></td></tr>
</table>
<br>
<br>
<table>

<tr><td style="position:absolute;left:45.36px;top:182.98px" class="cls_020"><span class="cls_020">Vous confiez le déménagement de votre mobilier à un déménagement
<br>professionnel.
<br>L&acute;entreprise de déménagement sera responsable des dommages éventuels
<br>pouvant survenir au mobilier confié dans les conditions fixées à l&acute;article
<br>13 des conditions générales de vente, l&acute;indemnisation pour pertes et
<br>avaries est limitée à la valeur totale du mobilier, et pour chaque objet ou
<br>élément de mobilier non listé, à 230,00 €</span>
</td>
<td><span class="cls_020">Dans certains cas, la responsabilité de l&acute;entreprise peut ne pas être retenue
<br>(accident ou incendie non responsable, vol avec agression, et d&acute;une manière
<br>générale, les cas de force majeur).
<br>Vous pouvez alors estimer que la garantie de responsabilité contractuelle de
<br>l&acute;entreprise est insuffisante et opter pour la souscription d&acute;une assurance
<br>dommage (article 4 des conditions générales de vente), dont les conditions
<br>sont tenues à votre disposition sur demande.</span>
</td></tr>
</table>
<table>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td style="position:absolute;left:42.00px;top:268.33px" class="cls_006"><span class="cls_006">1/ VALEUR TOTALE DU MOBILIER</span></td></tr>
<tr><td style="position:absolute;left:42.00px;top:296.29px" class="cls_002">
<span class="cls_002">Indiquez en lettres et en chiffres, la valeur totale du mobilier, y compris les objets
<br>ou éléments de mobilier désignés individuellement en 2/ :
</span>
</td>
</tr>
<tr><td></td></tr>
<tr>
<td><span class="cls_002">…&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(en lettres)</span></td>
</tr>
<tr><td></td></tr>
<tr>
<td><span class="cls_002">…&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;€</span></td>
</tr>
<tr><td></td></tr>

<tr><td style="position:absolute;left:42.00px;top:389.17px" class="cls_006"><span class="cls_006">2/ VALEURS INDIVIDUELLES</span></td></tr>
<tr><td style="position:absolute;left:42.00px;top:414.97px" class="cls_002"><span class="cls_002">Vous avez choisi la garantie de responsabilité contractuelle : Indiquez et valorisez les objets ou éléments de mobilier dont la valeur
<br>individuelle est supérieure à l&acute;indemnisation maximale par objet ou élément de mobilier.
<br>Vous avez opté pour l&acute;assurance dommage : vous pouvez également lister et valoriser les objets ou éléments de mobilier de votre choix.
</span></td></tr>
<tr><td><br></td><td></td></tr>
</table>
<table>
<tr>
<td style="position:absolute;left:96.02px;top:464.07px" class="cls_026"><span class="cls_026">DÉSIGNATION</span></td>
<td style="width:100px;"></td>
<td style="position:absolute;left:225.53px;top:464.07px;width:100px;" class="cls_026"><span class="cls_026">VALEUR EN €</span></td>
<td style="position:absolute;left:351.79px;top:464.07px" class="cls_026"><span class="cls_026">&nbsp;&nbsp;DÉSIGNATION</span></td>
<td style="position:absolute;left:485.02px;top:464.07px" class="cls_026"><span class="cls_026">VALEUR EN €</span></td>
</tr>
<tr>
<td style="position:absolute;left:46.08px;top:492.87px" class="cls_002"><span class="cls_002"><br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br></span></td>
<td></td><td style="position:absolute;left:221.45px;top:492.87px" class="cls_002"><span class="cls_002"><br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br></span></td>
<td style="position:absolute;left:299.83px;top:492.87px;text-align:left" class="cls_002"><span class="cls_002"><br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br></span></td>
<td style="position:absolute;left:479.62px;top:492.87px" class="cls_002"><span class="cls_002"><br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br>…<br></span></td>
</tr><tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td>
<td style="position:absolute;left:452.50px;top:622.86px" class="cls_002"><span class="cls_002">TOTAL :</span></td>
<td style="position:absolute;left:555.34px;top:622.86px" class="cls_002"><span class="cls_002">€</span></td>
</tr>
</table>

<table>
<tr>
<td style="position:absolute;left:35.64px;top:634.62px" class="cls_002"><span class="cls_002"><br><br>MODE DE GARANTIE CHOISI :</span></td></tr>
<tr><td style="position:absolute;left:45.60px;top:646.26px" class="cls_002"><span class="cls_002">&nbsp;&nbsp;GARANTIE DE RESPONSABILITÉ CONTRACTUELLE
<br>&nbsp;&nbsp;&nbsp;ASSURANCE DOMMAGE
<br>Cette déclaration de valeur est à retenir comme base de calcul du coût de mode de garantie choisi figurant au devis.
<br>M &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;déclare que les valeurs énoncées ci-dessus sont sincères et réelles.
<br>Fait à …&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;le
<br>Pour l&acute;acceptation des conditions générales de vente, se reporter au dos.</span></td></tr>
<tr>
<td style="position:absolute;left:319.27px;top:727.74px;text-align:right" class="cls_026"><span class="cls_026">SIGNATURE DU CLIENT :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
</tr>
</table>
</body>
</html>
';
$pdf->writeHTML($htmp3, false, false, false, false, '');

// PAGE 4
$pdf->AddPage();
//$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background4.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
//$pdf->setPageMark();
$pdf->lastPage();
$pdf->writeHTML($html4, true, true, true, true, '');

$html5=$style. '<div style="position:absolute;left:384.67px;top:78.46px" class="cls_005"><span class="cls_005" style="left:384.67px;top:78.46px;text-align:right">
CONDITIONS GENERALES DE VENTE DU CONTRAT DE DEMENAGEMENT</span></div>
<table>
<tr><td style="position:absolute;left:91.36px;top:182.98px" class="cls_020"><span class="cls_020" style="height:100px;text-align:center;"><br>Les présentes conditions générales de vente et les conditions particulières négociées entre l’entreprise et le client déterminent les droits et
<br>obligations de chacun d’eux. Elles s’appliquent de plein droit et de convention expresse entre les parties (article 1134 du Code Civil), aux
<br>opérations de déménagement, objet du présent contrat.</span>
<br>
</td></tr></table>
<table>

<tr><td style="position:absolute;left:45.36px;top:182.98px" class="cls_020"><span class="cls_020"><b>I. DISPOSITIONS GENERALES</b>
<br>Les présentes conditions générales et les conditions particulières
<br>négociées entre l’entreprise et le client déterminent les droits et
<br>obligations des parties.
<br>Elles s’appliquent de plein droit aux opérations objet des
<br>présentes.
<br><b>Article 1 – Information sur les conditions de réalisation du
<br>déménagement</b>
<br>Le client doit fournir toutes informations dont il a connaissance
<br>permettant la réalisation matérielle du déménagement, tant au lieu
<br>de chargement que de livraison (conditions d’accès pourle
<br>personnel et le véhicule, possibilités de stationnement, travaux en cours
<br>et toutes autres particularités).
<br>Le client est préalablement informé des suppléments chiffrés qu’il sera
<br>amené à supporter en cas d’absence d’informations ou
<br>d’inexactitude de celles-ci (cf. article 7).
<br>Le client doit également signaler les objets dont le transport est assujetti
<br>à une réglementation spéciale (vins, alcools, armes, etc.), les formalités
<br>administratives éventuelles étant à sa charge.
<br>Un devis gratuit décrivant les caractéristiques de l’opération
<br>projetée est fourni par l’entreprise au client.
<br>Pour réaliser le déménagement, l’entreprise a besoin d’un accès pour un
<br>véhicule de type "poids lourds" (L.12m. x l.2.5m. x h.4m.), sauf
<br>stipulation contraire portée au devis. L’évaluation du volume de biens à
<br>déménager étant réalisée par le client, sans visite de
<br>l’entreprise, et le véhicule de déménagement pouvant être affecté à
<br>plusieurs déménagements, l’entreprise ne saurait être engagée que sur
<br>le volume notifié par le client sur le devis.
<br><b>Article 2 – Prise d’effets du contrat – Résiliation</b>
<br>Le présent contrat de déménagement est réputé conclu et
<br>prendre effet entre l’entreprise et le client, au jour où les dates des
<br>prestations sont définitivement arrêtées entre les parties. Toutes les
<br>sommes payées d’avance par le client sont versées à titre d’arrhes. Hors
<br>cas de rétractation du client dans les
<br>conditions fixées à l’article 3 ci-dessous, chaque contractant peut donc
<br>revenir sur ses engagements résultant du présent contrat, le client en
<br>perdant les arrhes versées, l’entreprise en les restituant au double au
<br>client.
<br><b>Article 3 – Contrat conclu à distance ou hors établissement</b>
<br>3.1 Droit de rétractation – Exercice et conséquences
<br>Dans tous les cas où le présent contrat aura été conclu à distance ou
<br>hors établissement, le client bénéficiera d’un délai de 14 jours à
<br>compter de la conclusion des présentes pour exercer son droit de
<br>rétractation, sans avoir à motiver sa décision.
<br>Ledit droit de rétractation peut être exercé, au choix du client,
<br>soit par l’envoi, à l’entreprise, du formulaire de rétractation
<br>transmis par l’entreprise, soit par l’envoi, à l’entreprise, de toute
<br>autre notification et exprimant sa volonté non ambigüe de se
<br>rétracter. Les frais d’envoi de la notification sont à la charge du client.
<br>En cas de litige, le client devra prouver qu’il a bien exercé son droit de
<br>rétractation dans les délais et conditions précisées aux articles L 121-21
<br>et suivants du Code de la Consommation.
<br>Au plus tard dans les 14 jours suivant la réception de la notification de
<br>rétractation adressée par le client, l’entreprise remboursera au client
<br>les sommes déjà versées et ce, selon le
<br>même mode de paiement que celui utilisé par le client pour payer
<br>l’entreprise, sauf accord express du client sur un autre mode de
<br>règlement.
<br>L’exercice de son droit de rétractation par le client met fin à
<br>l’obligation des parties d’exécuter le présent contrat ainsi que
<br>l’ensemble des éventuels contrats accessoires.
<br>3.2 Renonciation au droit de rétractation
<br>Si le client souhaite que les prestations de déménagement soient</span>
</td>
<td><span class="cls_020">intégralement exécutées avant la fin du délai de rétractation
<br>stipulé à l’article 3.1, il devra en faire la demande expresseà
<br>l’entreprise par tout moyen permettant de conserver sa demande sur un
<br>support durable (papier, numérique...). Ladite demande devra
<br>impérativement contenir la renonciation expresse du client à son droit
<br>de rétractation.
<br><b>Article 4 – Assurance dommage</b>
<br>L’entreprise souscrit automatiquement pour le compte du client
<br>une garantie dommage destinée à garantir le mobilier contre
<br>certains risques pour lesquels elle n’assume légalement aucune
<br>responsabilité (couverture du patrimoine jusqu’à 80 000 € et 10
<br>000 € par objet et/ou ensemble d’objets valorisés à la déclaration
<br>de valeur).
<br>Au-delà de ces plafonds, le client peut étendre la couverture de
<br>l’assurance dommage moyennant le paiement d’une surprime, d’un
<br>montant HT correspondant à 0.5% de la différence entre la
<br>valeur déclarée et le plafond de couverture ci-dessus mentionné.
<br><b>Article 5 – Délais d’exécution indéterminés</b>
<br>Si, à la demande du client, il n’est pas fixé de date ou de période formelle
<br>d’exécution, le client peut adresser une mise en demeure par lettre
<br>recommandée à l’entreprise, au cas où celle-ci n’a pas entrepris le
<br>transport dans un délai normalement prévisible.
<br>A compter de cette mise en demeure, l’entreprise dispose d’un délai
<br>de dix jours pour exécuter l’opération convenue.
<br>A défaut d’exécution dans un délai de dix jours, sauf cas de force
<br>majeure, le contrat est considéré comme résilié par l’entreprise, et
<br>cette dernière s’engage donc à restituer au client les sommes déjà
<br>versées par lui, conformément à l’article 2 ci-dessus.
<br><b>Article 6 – Voyages organisés</b>
<br>Afin que le client bénéficie d’une tarification avantageuse,
<br>l’entreprise réalise les déménagements en voyage organisé. Les
<br>voyages organisés concernent plusieurs déménagements au sein d’un
<br>même voyage routier, aussi, ils nécessitent une harmonisation des
<br>dates de chargement et de livraison entre les clients participant au
<br>même voyage routier. Ces dates sont donc
<br>laissées à l’initiative de l’entreprise, dans la limite toutefois d’une
<br>journée de décalage par rapport aux dates fixées d’un commun accord.
<br><b>II. PRIX ET MODALITES DE REGLEMENT</b><br>
<br><b>Article 7 – Prix</b>
<br>Les prestations sont facturées au client au prix convenu au
<br>présent devis. Sauf mention contraire, les prix s’entendent HT. Ils seront
<br>augmentés de la TVA au taux en vigueur au jour de la facturation.
<br>Les prix fixés sont fermes et définitifs. Ils ne peuvent subir d’évolutions
<br>qu’en cas de modification expresse des termesdu présent devis.
<br>En pareil cas, l’entreprise fera ses meilleurs efforts pour informer au plus
<br>tôt le client des modifications des tarifs initialement convenus. En cas de
<br>volume supplémentaire de biens parrapport au volume porté au devis
<br>par le client, et sous réserve des possibilités matérielles de prise en
<br>charge au sein du voyage organisé, le cubage supplémentaire sera facturé
<br>au prorata du contrat initial.
<br>La mise à disposition d’un monte-meubles, non prévue lors de la
<br>réalisation du devis initial, sera facturée au client au tarif de 300 € HT par
<br>demi-journée.
<br>Le client est informé que toute demande de prestations
<br>supplémentaires fera l’objet d’une facturation supplémentaire, selon devis
<br>soumis à son acceptation par l’entreprise.
<br><b>Article 8 – Durée de validité des offres de prix</b>
<br>En l’absence de fixation, dans le présent devis, de la date
<br>d’exécution des prestations de déménagement, les tarifs fixés aux
<br>présentes demeureront en vigueur pendant une durée de 1 mois à
<br>compter de la date à laquelle le devis a été établi.
<br><b>Article 9 – Modalités de règlement</b></span>
</td></tr>
</table>';
// PAGE 5

$pdf->SetMargins(PDF_MARGIN_LEFT, 36 , PDF_MARGIN_RIGHT);
$pdf->AddPage();
//$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->lastPage();
$pdf->writeHTML($html5, true, true, true, true, '');

$html6=$style. '<div style="position:absolute;left:384.67px;top:78.46px;height:1px;" class="cls_005">
<span class="cls_005" style="left:384.67px;top:78.46px;text-align:right"></div>
<table>
<tr><td style="position:absolute;left:45.36px;top:182.98px" class="cls_020"><span class="cls_020"><br><br>Sauf autrement spécifié entre les parties, les prestations de
<br>l’entreprise seront payées par le client de la façon suivante : 30% du
<br>montant total des prestations, versés à titre d’arrhes au jour de la
<br>conclusion du présent contrat. Le solde, réglé par le client sur remise de
<br>la facture, à la fin des prestations de déménagement.
<br>Le règlement en sera selon les moyens convenus entre les parties lors de
<br>la commande.
<br>La simple remise d’effets de paiement par le client (chèques...) ne sera
<br>jamais considérée comme valant règlement du prix. Seul leur
<br>encaissement effectif par l’entreprise sera considéré comme valant
<br>complet paiement du prix.
<br><b>Article 10 – Retards de paiement – Pénalités de retard</b>
<br>En cas de non-paiement comme en cas de retard de paiement,
<br>l’entreprise appliquera des pénalités de retard à un taux égal à 3 fois le
<br>taux de l’intérêt légal. Ces pénalités seront exigibles par
<br>l’entreprise par lettre RAR.
<br>En cas de procédure de recouvrement, tous les frais encourus
<br>seront en outre supportés par le client.
<br><b>III. REALISATION DES PRESTATIONS</b>
<br><br><b>Article 11 – Conditions des prestations – Exclusions</b>
<br>Les prestations sont convenues avec le client préalablement à chaque
<br>opération et précisément définies dans le devis.
<br>L’entreprise, ou tout tiers qu’elle se substituerait, n’assume pas la prise
<br>en charge des personnes, des animaux, des végétaux, des matières
<br>dangereuses, infectes, explosives ou inflammables, des bijoux, monnaies,
<br>métaux précieux ou valeurs.
<br>Toute exception à cette règle doit être l’objet d’un accord écrit entre
<br>l’entreprise et le client avant le début de la réalisation. Article 12 –
<br>Réalisation par une tierce personne
<br>L’entreprise agissant en qualité de commissionnaire de transport, le
<br>client est informé que les prestations objet du présent contrat sont
<br>confiées par l’entreprise, sous son entière responsabilité, à un tiers
<br>dénommé ‘entreprise exécutante’.
<br>Au plus tard 48 heures avant la date de début des prestations
<br>convenue entre les parties, l’entreprise communiquera au client
<br>l’identité de l’entreprise exécutante. Le client pourra alorsrefuser
<br>l’intervention de cette entreprise. En pareil cas, les sommes qu’il a
<br>versées lui sont intégralement restituées.
<br><b>Article 13 – Présence obligatoire du client</b>
<br>Le client ou son mandataire doit être présent tant au chargement qu’à
<br>la livraison. Au chargement, il doit vérifier, avant le départ du véhicule,
<br>qu’aucun objet n’a été oublié dans les locaux et dépendances où se
<br>trouvait le mobilier. A la livraison, il doit
<br>vérifier avant le départ définitif du véhicule, qu’aucun objet n’y a
<br>été oublié.
<br>Le représentant de l’entreprise est en droit d’exiger du client la
<br>constatation par écrit de toute détérioration antérieure au
<br>déménagement.
<br><b>IV. RESPONSABILITE DE L’ENTREPRISE</b>
<br><br>Article 14 – Responsabilité pour retard
<br>Sauf cas de force majeure et en cas de préjudice subi par le client,
<br>une indemnité lui est due par l’entreprise en cas de retard dans
<br>l’exécution des prestations contractuellement convenues. Cette
<br>indemnité est calculée en fonction du préjudice réellement subi et
<br>démontré par le client.
<br><b>Article 15 – Responsabilité pour pertes et avaries</b>
<br>L’entreprise est responsable des meubles et objets qui lui sont
<br>confiés, sauf cas de force majeure, vice propre de la chose ou faute
<br>du client.
<br>Elle décline toute responsabilité en ce qui concerne les opérations qui
<br>ne seraient pas exécutées par ses préposés ou ses intermédiaires
<br>substitués.
<br>Lorsque l’entreprise n’effectue pas l’emballage, le contenu des colis
<br>emballés par le client ne peut constituer un dommage prévisible
<br>sauf inventaire précis (article 1150 du Code Civil).</span>
</td>
<td><span class="cls_020"><br>
<br><b>Article 16 – Indemnisation pour pertes et avaries </b>
<br>Suivant la nature des dommages, les pertes et avaries donnent lieu à
<br>réparation, remplacement ou indemnité compensatrice.
<br>L’indemnisation intervient dans la limite du préjudice matériel
<br>prouvé et des conditions particulières négociées entre
<br>l’entreprise et le client.
<br>Ces conditions particulières fixent, sous peine de nullité de plein droit du
<br>contrat, le montant de l’indemnisation maximum pour la totalité du
<br>mobilier et pour chaque objet ou élément de mobilier. Elles peuvent
<br>également fixer l’indemnisation maximum des objets figurant sur une
<br>liste valorisée. Le client est informé des coûts en résultant.
<br><b>Article 17 – Prescription</b>
<br>Les actions en justice pour avarie, perte ou retard auxquelles peut donner
<br>lieu le contrat de déménagement doivent être intentées dans l’année qui
<br>suit la livraison du mobilier, conformément à
<br>l’article L 133-6 du Code de Commerce.
<br><b>V. LIVRAISON DU MOBILIER ET FORMALITES EN CAS DE
DOMMAGE</b>
<br>
<br><b>Article 18 – Livraison du mobilier à domicile - Formalités en cas de
<br>dommage</b>
<br>A la réception du mobilier, le client doit vérifier labonne
<br>exécution du contrat, l’état de son mobilier et endonner
<br>décharge dès la livraison terminée à l’aide de la lettre de voiture remise
<br>par l’entreprise.
<br>Il doit notamment en cas de perte ou d’avarie et pour sauvegarder ses
<br>droits et moyens de preuve, émettre, dès livraison et mise en place du
<br>mobilier, en présence des
<br>représentants de l’entreprise, des réserves écrites précises et détaillées
<br>sur le bulletin de livraison (exemplaire D) de la lettre de voiture, sous la
<br>rubrique prévue à cet effet.
<br>Conformément à l’article L 121-95 du Code de la Consommation,
<br>en cas d’absence de réserve à la livraison comme en cas de
<br>réserves contestées par les représentants de l’entreprise sur la lettre
<br>de voiture, le client doit, en cas de perte ou d’avaries, adresser à
<br>l’entreprise une protestation motivée sur l’état du
<br>mobilier réceptionné ou son caractère incomplet par lettre RAR. Le client
<br>doit alors apporter la preuve que les pertes ou avaries mentionnées sont
<br>le fait de l’entreprise. Ces formalités doivent être accomplies dans les 10
<br>jours calendaires qui suivent la réception des biens par le client. A défaut,
<br>le client est privé du droit d’agir contre l’entreprise.
<br>A défaut de chocs apparents, la responsabilité de l’entreprise ne
<br>saurait être engagée pour des vices de fonctionnement sur des appareils
<br>électriques ou électroniques, sauf pour le client à
<br>prouver la responsabilité de l’entreprise.
<br>Dans tous les cas, l’absence de réserves écrites, précises et
<br>détaillées à la livraison implique une présomption de livraison
<br>conforme.
<br><b>Article 19 – Livraison du mobilier au garde meubles à la
<br>demande du client</b>
<br>La livraison en garde meubles est assimilée à une livraison à
<br>domicile et met fin au contrat de déménagement.
<br>Les frais d’entrée en garde meubles sont distincts et facturés au
<br>client par le garde-meubles qui assume la garde du mobilier.
<br><b>Article 20 – Dépôt nécessaire par suite d’empêchement à la
livraison</b>
<br>En cas d’absence du client aux adresses de livraison indiquées par lui, ou
<br>d’impossibilité matérielle n’étant pas le fait de l’entreprise, le mobilier
<br>est placé d’office dans un garde meubles, à la diligence de l’entreprise et
<br>aux frais du client.
<br>Par tout moyen approprié, l’entreprise rend compte au client de cette
<br>opération de dépôt, qui met fin au contrat de déménagement
<br><br>
<br>Lu et approuvé par le client</span></td></tr></table>';

$pdf->SetMargins(PDF_MARGIN_LEFT, 34  , PDF_MARGIN_RIGHT);
$pdf->AddPage();
//$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = 'images/background3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->lastPage();
$pdf->writeHTML($html6, true, true, true, true, '');


//Close and output PDF document
$iterator = new DirectoryIterator(dirname(__FILE__));

$pdf->Output( $iterator->getPath().'/'.$title, 'F');


echo $iterator->getPath().'/'.$title;

