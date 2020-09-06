<?php require_once"inc/header.php"; ?>
<!--=================================
 header End-->

<!--=================================
 Main content -->
 
 
<!-- Left Sidebar End -->
<?php require_once"inc/menu.php"; ?>
<!--=================================
 Main content -->

 <!--=================================
wrapper -->


  
<div class="content-wrapper">
 <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"> PDF de devis  </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active"> PDF de devis </li>
            </ol>
          </div>
        </div>
		   <!-- main body -->
		     <div class="row"> 
			 <div class="col-md-4">
<div class="text-left navbar-brand-wrapper">
    <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo-pariseco.png" style="width:210px;height:50px;"></a>
  </div>
 </div>
 	 <div class="col-md-4">
	 </div>
	 	 <div class="col-md-4">
	<strong> <?php  require_once '../../connect.php';	 					
$sql="SELECT * FROM devis where id_devis='$id_devis' ";
 						
$req= mysql_query($sql) ;	
$data= mysql_fetch_array($req);
	
$id_devis=$data['id_devis'];
$dateModification=$data['dateModification'];
$devis_valable_au=$data['devis_valable_au'];

?>
</strong>
<hr />
                    <br> <b>Devis N° Par : </b><?php echo $id_devist;?>
					<hr />
                    <br> <b> Date de création :</b><?php echo $dateModification;?> 
                    <br> <b> Date de validité </b>:<?php echo $devis_valable_au;?> 
             
</div>

</div>
  <div class="row"> 
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
  <strong>  <?php require_once '../../connect.php';
  $sql="SELECT * FROM client where id_client='$id_client' ";
 						
$req= mysql_query($sql) ;	
$data= mysql_fetch_array($req);
	
$civilite=$data['civilite'];
$nom=$data['nom'];
$prenom=$data['prenom'];
$tel=$data['tel'];
$email=$data['email'];


?>
<table align="center">
<hr />
 <tr><td > <h4 align="center" ><strong><b>Information Client</b></strong></h4></td></tr>
<tr> <td><b>Nom :</b><?php echo $nom;?> </td><td><b>Pr&eacute;nom: </b><?php echo $prenom;?> </td></tr>
  <tr><td><b>Civilit&eacute; :</b><?php echo $civilite;?> </td></tr>
 <tr> <td><b>T&eacute;l&eacute;phone :</b> <?php echo $tel;?></td><td><b>Email :</b><?php echo $email;?></td> </tr>

  </table>
  <hr />
  </div>
    <div class="col-md-2">
	</div>
  
  
  </div>
  

  <strong> <?php  require_once '../../connect.php';	
  $sql="SELECT * FROM client where id_client='$id_client' ";
 						
$req= mysql_query($sql) ;	
$data= mysql_fetch_array($req);
	
$civilite=$data['civilite'];
$nom=$data['nom'];
$prenom=$data['prenom'];
$tel=$data['tel'];
$email=$data['email'];


?>
<table >
 <tr> <h4 align="center"><strong><b>Information Client</b></strong></h4></tr>
  <tr><b>Civilit&eacute; :</b><?php echo $civilite;?> <b>Nom :</b><?php echo $nom;?> <b>Pr&eacute;nom: </b><?php echo $prenom;?> </tr>
 <tr> <b>T&eacute;l&eacute;phone :</b> <?php echo $tel;?> <b>Email :</b><?php echo $email;?> </tr>
  </table>
  
  </div>
    <div class="col-md-2">
	</div>
  
  
  </div>
  
  <div class="row"> 
  <?php  require_once '../../connect.php';	
  $sql="SELECT * FROM demande where id_dem='$id_dem' ";
 						
$req= mysql_query($sql) ;	
$data= mysql_fetch_array($req);
	
$date_dep=$data['date_dep'];
$adresse_dep=$data['adresse_dep'];
$ville_dep=$data['ville_dep'];
$code_postale_dep=$data['code_postale_dep'];
$habit_dep=$data['habit_dep'];
$assenceur_dep=$data['assenceur_dep'];
$portage_dep=$data['portage_dep'];
$monte_meuble_dep=$data['monte_meuble_dep'];
$garde_meuble_dep=$data['garde_meuble_dep'];
$date_arr=$data['date_arr'];
$adresse_arr=$data['adresse_arr'];
$ville_arr=$data['ville_arr'];
$code_post_arr=$data['code_post_arr'];
$habit_arr=$data['habit_arr'];
$assenseur_arr=$data['assenseur_arr'];
$portage_arr=$data['portage_arr'];
$monte_meuble_arr=$data['monte_meuble_arr'];
$garde_meuble_arr=$data['garde_meuble_arr'];
?>
  

 <table border="0" align="center" >
  <tr> <td ><h4 align="center"> <b>Inforamation sur votre demanagement</b> </h4><td></tr>
  <tr> <td><b>Pr&eacute;sentation :</b></td><td><b>Assurance:</b></td></tr> 
<tr> <td><b>Volume m: </b></td><td> <b>Distance Km :</b></td></tr>
</table>
<hr />
 <table border="3"  bordercolor="#CCCCCC" align="center">
<tr><td align="center"> <b>Information sur le chargement </b></td><td align="center"><b>Information sur la livraison </b></td></tr>
<tr><td><b>Date :</b><?php echo $date_dep;?></td><td><b>Date :</b><?php echo $date_arr;?></td></tr>
<tr><td><b>Adresse:</b><?php echo $adresse_dep;?></td><td><b>Adresse:</b><?php echo $adresse_arr;?></td></tr>
<tr><td><b>Ville :</b><?php echo $ville_dep;?></td><td><b>Ville :</b><?php echo $ville_arr;?></td></tr>
<tr><td><b>Code postal :</b><?php echo $code_postale_dep;?></td><td><b>Code postal :</b><?php echo $code_post_arr;?></td></tr>
<tr><td><b>Etage :</b><?php echo $habit_dep;?></td><td><b>Etage :</b><?php echo $habit_arr;?></td></tr>
<tr><td><b>Assenceur :</b><?php echo $assenceur_dep;?></td><td><b>Assenceur :</b><?php echo $assenseur_arr;?></td></tr>
<tr><td><b> Portage :</b><?php echo $portage_dep;?></td><td><b>Portage :</b><?php echo $portage_arr;?></td></tr>
<tr><td><b>Monte meuble :</b><?php echo $monte_meuble_dep;?></td><td><b> Monte meuble :</b> <?php echo $monte_meuble_arr;?></td></tr>
<tr><td><b>Mise en garde meuble :</b><?php echo $garde_meuble_dep;?></td><td><b>Mise en garde meuble :</b><?php echo $garde_meuble_arr;?></td></tr>
</table>

<hr />
<h5 align="center"> Commentaire </h5>
<hr />
<br / >
<br />
<br />
<br />
<hr />
<h5 align="center"> Adresse : 8 rue de la pointe 93130 Noisy Le Sec-Serie 51374116500015 </h5>
<h5 align="center">Email :contact@paris-eco-transport </h5> <h6 align="center"><b> T&eacute;l&eacute;phone :</b></h6>

<hr />
<h5 align="center"> <b>Nos Type De Pr&eacute;sentation</b></h5>
<table border="2" align="center">
<tr><td align="center"><b>T&acirc;ches</b></td><td><b>Economique</b></td><td><b>Eco+ Fragile</b></td><td><b>Eco+ D&eacute;montage</b></td><td><b>Standard</b></td><td><b>Luxe</b></td></tr>
<tr><td>L'emballage de vos cadres,tableaux,miroirs,lampes et lustres </td><td> </td><td align="center">+</td><td></td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>L'emballage de votre vaisselle,verrerie et autres objets fragiles</td><td></td><td align="center">+</td><td></td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>L'embalage de votre t&eacute;l&eacute;vision hi-et informatique</td><td></td><td align="center">+</td><td></td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>Le d&eacute;montage des meubles si n&eacute;cessaire </td><td></td><td></td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>L'embalage de vos v&ecirc;tements sur cintres en penderies portables</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>La mise sous housses de vos matelas et sommiers</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>La protection de votre mobilier sous housses ou couvertures</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>Le chargement et le calage de l'ensemble de vos meubles et objets </td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>Le transport en v&eacute;hicule capitonn&eacute;</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>La manutention au domicile de l'arriv&eacute;e</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>La mise en place de votre mobilier selon vos souhaits</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>Le transports de vos plantes (sans garantie de l'&eacute;tat &agrave; l'arriv&eacute;e)</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>Le d&eacute;ballage de votre vaisselle et objets fragiles </td><td></td><td align="center">+</td><td></td><td></td><td align="center">+</td></tr>
<tr><td>L'embalage de vos livres, magazines et autres BD</td><td></td><td></td><td></td><td></td><td align="center">+</td></tr>
<tr><td>L'embalage de vos bibelots non fragiles et articles divers </td><td></td><td></td><td></td><td></td><td align="center">+</td></tr>
<tr><td>Le remontage des meubles si n&eacute;cessaire  </td><td></td><td></td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
<tr><td>La mise &agrave; disposition de votre embalage: cartons, adh&eacute;sifs et papiers bulle</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td><td align="center">+</td></tr>
</table>

<h5 align="center"> Adresse : 8 rue de la pointe 93130 Noisy Le Sec-Serie 51374116500015 </h5>
<h5 align="center">Email :contact@paris-eco-transport </h5> <h6 align="center"><b> T&eacute;l&eacute;phone :</b></h6>


    </div> 
    </div> 
    </div> 
 <?php require_once"inc/footer.php"; ?>
 