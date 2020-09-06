<?php
session_start ();

if (isset($_SESSION['id']) && isset($_SESSION['nom_com']))

{
?>

<!--================================= header End -->
<?php require_once"inc/header.php"; ?>
<!--================================= Main content -->
<style>
.dataTables_filter,.dataTables_length{
      visibility:hidden;
}
</style>
<!-- Left Sidebar End -->
<?php require_once"inc/menu.php"; ?>
<!--================================= Main content -->

<!--================================= wrapper -->
<div class="content-wrapper">
  <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
<h4 class="mb-0" name="nom_catt">Modification encaissement  N° <?php echo $_GET['id_vol'] ;?></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">encaissement</a></li>
              <li class="breadcrumb-item active">Modification</li>
            </ol>
          </div>

        </div>
  </div>
 <!-- main body -->
 <?php require_once '../connect.php';			 ?>
 <div class="row">
      <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
          <div class="card-body">
<form id="form" action="inc/insert_modif_encaisement.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" >

<?php
$id = $_GET['id_vol'];
$req=mysql_query("SELECT *,ts.valeur as type_presentation ,c.nom as nomc,encaissement.date_creation as datec  FROM encaissement  LEFT JOIN   devis ON encaissement.id_devis = devis.id_devis
	     LEFT JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN  client c on demande.id_client =c.id_client
         LEFT JOIN masterParametreValeur  ts ON demande.id_type =	ts.id
		 INNER JOIN  facturation  ON facturation.id = encaissement.id  where encaissement.id_encaissement = $id ");
if($result=mysql_fetch_array($req))
{
	 

	   $req3 ="SELECT SUM(montant) as montant FROM facturation  where id_encaisseme = $id";
	   $requete3 = mysql_query($req3) or die( mysql_error() ) ;
	   $row = mysql_fetch_assoc($requete3 );
        $reulta = $row['montant'];
		$rest = $result['Prix_ttc'] - $reulta ;
		
		
?>
<section>
<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations Générales
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">

          <div class="form-row" id="infogenerales">

<div class="">
   
	 <div class=" bg-light">
              <br>
                <span style="margin-top: 1em;margin-left:1em;" >N° encaissement*</span>
<input type="text" value="<?php echo $result['id_encaissement'];  ?>"size="5"  name="num_encaisement" id="num_encaisement"  style="margin-left:1em;" disabled />
	<input name="nom_encais" value="<?php echo $result['id_encaissement'];?>"  type="hidden" class="form-control" >
	<span style="margin-top: 1em;margin-left:1em;">Type de presentation</span>
					<input type="text" value="<?php  echo $result['type_presentation']; ?>" size="20" name="type_presentation" id="type_presentation" style="margin-left:1em;" disabled />
<span class=" " style="margin-top: 1em;margin-left:1em;">total encaisement</span>
                   <input type="text" value="<?php echo $reulta ?>" placeholder= "" size="20" name="tot_encais" disabled  />
<br>
<div class="row" style="margin-left:10em;margin-top:1em">
<?php 
$id_devis=$result['id_devis'];
 $req1="SELECT id_demande FROM devis where id_devis = $id_devis  ";
	 $requete1 = mysql_query($req1) or die( mysql_error()) ;
	 $row1 = mysql_fetch_assoc($requete1 );
			$id_demande =  $row1['id_demande'];
?>
		<span class=" " style="margin-top: 1em;margin-left:1em;margin-right:1em;"><a target="new" href="../pages/TCPDF-master/examples/creerPdfDevisSuperDem.php?id=<?php echo  $id_demande ?>&dev=<?php echo  $result['id_devis'] ?>"><?php echo 'Num devis :'. $id_devis ?></a></span>
<input name="id_devis" value="<?php echo $result['id_devis'];?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;">reste</span>
				   <input type="text" value="<?php echo $rest; ?>" size="10" name="rest"   class="col-sm-2" disabled />

<span  style="margin-top: 1em;margin-left:1em;">Date de création</span>
					<input type="text" value="<?php echo $result['datec'];?>" size="10" name="date_creation" id="date_creation"  style="margin-left:1em;" disabled  />
<input name="date_creation1" value="<?php  echo $result['datec'];?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;" >User</span>
					<input type="text" value="<?php echo $_SESSION['nom_com']; ?>" size="15" name="user" id="user"  class="inputa" disabled />	  </br>
 </br> <input name="nom_user" value="<?php echo $_SESSION['nom_com'];?>"  type="hidden" class="form-control" >
		  
		  </div>
                </br>
   <div class="" >

			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Rappel d&egrave;tails client</strong></p>



                   <div class="form-row justify-content-md-center">

                <span  style="margin-top: 0.5em; margin-left:1em; margin-right:5px;">Nom client</span>
					<input type="text" value="<?php echo $result['nomc'] ;?>"  name="Nomclient" id="Nomclient"  class="col-sm-2" disabled  />


	<span style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total HT devis</span>
					<input type="text" value="<?php echo $result['Prix_ht']; ?>"  name="THT" id="THT" class="col-sm-1" disabled  />
<span  style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total TVA devis</span>
					<input type="text" value="<?php echo ($result['Prix_ttc']- $result['Prix_ht']);?>"  name="TVA" id="TVA"  class="col-sm-1" disabled />
<span  style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total TTC devis</span>
					<input type="text" value="<?php  echo $result['Prix_ttc'];?>"  name="TTC" id="TTC"  class="col-sm-1" style="margin-right:1em;"disabled  />


		   </br>
		   </div>

		      </br>
		   </div>
		     <div class=" border border-success" >
		   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Liste encaissement effectué </strong></p>
		  <div id="resultatRecherche">
      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
               <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead class="">
                           <tr>
                              <th width="">N° facture</th>
                              <th width="">Date action</th>
                              <th width="">User</th>
                              <th width="">Montant </th>
							  <th width="">Type encaissement </th>
							  <th width="">Action </th>
							  <th width="">Date creation </th>
                             <th> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php

                           $req=mysql_query("select * from facturation where id_encaisseme = $id order by	numero_Facture ");
                           while($result1=mysql_fetch_array($req)) {
                              // Check relance

                           ?>
                           <tr>


                                  <td><?php echo $result1['numero_Facture']; ?></td>

                               <td> <?php 
							         $date_action=$result1['date_action'];
	                                    $a=substr($date_action,0,4);
	                                   $m=substr($date_action,5,2);
		                             $j=substr($date_action,8,2);
	                                 $date_action=$j."-".$m."-".$a;
                                    echo  $date_action;?>  </td>
                               <td> <?php echo $result1['user'];  ?>  </td>
							    <td><?php    echo $result1['montant'];   ?>   </td>
                              <td><?php  echo $result1['type_encaissement'];?> </td>
                               <td>  <?php echo $result1['action'];?> </td>
						      <td><?php echo $result1['datee_creat']; ?>  </td>
                                <td>
                      <a target="new" href="../pages/TCPDF-master/examples/facturePDF2.php?id=<?php echo $result1['numero_Facture']; ?>&dev=<?php echo $result['id_devis']; ?>&en=<?php echo $result['id_encaissement']; ?>">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>




                           </div>
                              </td>
							   <?php	} ?>
                           </tr>
                   </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
    <div class=" border border-warning" >

			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Encaissement a saisir </strong></p>

					    </br>   </br>
				<div class="form-row">

                <span  style="margin-top: 1em; margin-left:3em; margin-right:3em;">Action</span>
					<input type="text" value="<?php  ?>" style=" margin-left:2em;height:30px;"  autocomplete="off" name="action" id="action"  class="col-lg-10"   required="required"/>

<div class="row" style="margin-top:2em;margin-left:2em;">
	<span  style="margin-top:0.5em;margin-left:1em;margin-right:1em;">Date</span>
					<input type="date" value=""  name="date_action" id="Date"  required="required"/>
<span  style="margin-top:0.5em;margin-left:1em;margin-right:1em;">Type encaissement</span>
					<select name="Tencaissement" class=" select2" style="height:30px;width:150px;" required="required">
<?php $req5=mysql_query("select * from  masterParametreValeur where idMasterParametre = 12");
         while($result5=mysql_fetch_array($req5))
       { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }
     ?>
</select>
<span  style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Montant</span>
					<input type="number"   name="montant" id="montant"  class="col-sm-2"  autocomplete="off" style="margin-right:1em;" required="required" />


</div>
		   </div>
              	</br>  </br>
		   </div>




<?php
 /* end IF */
}
?>







</div>
</section>
<div class="box box-default">



<div class="box box-default">




<div class="box-footer">
</br>
               
                <button type="submit" class="btn btn-info pull-right">valider facturation</button>
				<button id="show_button " onclick="hideElement()">Check Availability</button>

</div>
</div>

</div>
<br></form></div>
<?php require_once"inc/footer.php"; ?>


<script>
 
    function hideElement() { 
            element = document.querySelector('.dataTables_filter'); 
            element.style.visibility = 'hidden'; 
        } 
</script>







<?php
}
else
{

header('location: index.php');

}?>
