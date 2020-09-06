<?php
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {

require_once"inc/header.php";
require_once"inc/menu.php";
require_once '../connect.php';
include "inc/mod_utilisateur.php";

$date_en_cours = date("Ymd-His");

$query_status_parameter = "
   SELECT id, valeur
   FROM `masterParametreValeur` mpv
   WHERE idMasterParametre = 11
";
$que_get_status_parameter     = mysql_query($query_status_parameter);
?>
<style type="text/css">
   .datepicker {
      width: 100% !important;
   }
   #statut_relance-error, #date_relance-error {
      margin-left: -97px;
   }
   .ui-datepicker table {
      z-index: 999 !important;
      opacity: 1 !important;
   }
   
   .dataTables_filter{
      visibility:hidden;
}
  

</style>
<link rel='stylesheet' href='css/default.css?v=<?php echo $date_en_cours; ?>' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<div class="content-wrapper">
   <div class="page-title">
      <div class="row">
         <div class="col-sm-6">
           <h4 class="mb-0">Liste encaissement  </h4>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
               <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
               <li class="breadcrumb-item active">Liste encaissement  </li>
            </ol>
         </div>
      </div>
   </div>
   <div class="row">
		<div class="col-md-12 mrg-35">
			<div class=" card mb-3">
				<form id="moteur" method="post">
					<div class="row" style="margin-top:2em;">
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>N° encaissement </label>
							<input type='text' id='num_en' name='num_en' class='form-control'>
						</div>
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Date Creation Facture </label>
							<input type='date' id='D_fact' name='D_fact' class='form-control'>
						</div>
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Montant Facture </label>
							<input type='number' min="1"  step="0.01" id='M_fact' name='M_fact' class='form-control'>
						</div>
						<div class="col-md-3" style=" margin-left: 30px;">
							<label for='statut_relance'>Type Encaissement</label>
							<!--<select name='statut_relance' id='statut_relance' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>

							</select>-->
							<select name='source' id='source' class='form-control' style="height:50px;">
								<option value=''>S&eacute;l&eacute;ctionnez un Type</option>
								<?php $req5=mysql_query("select * from  masterParametreValeur where idMasterParametre = 12");
                                     while($result5=mysql_fetch_array($req5))
                                { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }

				?>
							</select>
							</div>
							<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Num Devis</label>
							<input type='number' id='num_dev' name='num_dev' min="1" class='form-control'>
						</div>
							</div>
							
					<button type='button' class='btn btn-success btn-fl-left' id='btnRechercher' style='margin-top: 10px;margin-right:10px;margin-bottom:20px;;float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
				</form>
			</div>
		</div>
	</div>
   <div id="resultatRecherche">
      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
               <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead class="">
                           <tr>
                              <th width="08%">N° facture</th>
                              <th width="08%">N° devis</th>
                              <th width="20%">Client</th>
                              <th width="12%">Montant</th>
							   <th width="15%">Type encaisement</th>
							   <th width="15%">Action</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php

	   $req="SELECT *,ts.valeur as type_presentation ,c.nom as nomc  FROM  facturation LEFT JOIN   devis ON facturation.id_deviss = devis.id_devis
	     LEFT JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN  client c on demande.id_client =c.id_client 
         LEFT JOIN masterParametreValeur  ts ON demande.id_prestation =	ts.id";
		 
                           $req=mysql_query($req);
                           while($result=mysql_fetch_array($req)) {
                              // Check relance

                           ?>
                           <tr>
                              <td><?php echo $result['numero_Facture']; ?></td>

                               <td>   <?php  echo $result['id_deviss'];  ?>   </td>

                                <td> <?php   echo  $result['civilite'] .'  '. $result['nomc'].'  '.$result['prenom']; ?>  </td>
                                 <td> <?php  echo $result['montant'];  ?> </td>

                                <td><?php  echo $result['type_encaissement'];  ?>  </td>

                            <td>  <?php echo $result['action']; ?>  </td>
                              <td>

                               <button type="button" class=""  aria-haspopup="true" aria-expanded="false">
                                 <a class="btn btn-sm btn-success" id="modif" href="modif_encaisement.php?id_vol=<?php echo $result['id_encaisseme'];  ?>" >Modifier</a></button>
                              	<a href="envoi_facture1.php?id=<?php echo $result['numero_Facture']; ?>&dev=<?php echo $result['id_devis']; ?>">
                                <i class=" btn fa fa-envelope-square" style="font-size:25px;" ></i></a>
                                   <a target="new" href="../pages/TCPDF-master/examples/facturePDF2.php?id=<?php echo $result['numero_Facture']; ?>&dev=<?php echo $result['id_deviss']; ?>&en=<?php echo $result['id_encaisseme']; ?>">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                              
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

<?php
require_once"inc/footer.php";
?>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script language="javascript">
function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({

		   type: "POST",
		   url: "ajax/ajaxRecherchelisteEncaissement.php",
		   data: data,
        beforeSend : function(){
							$("#resultatRecherche").html('<img src="images/pre-loader/loader-01.svg" style="padding-top:50px; margin-left:45%;" alt="" border="0">');
						},
		   error : function(){alert(unescape('Erreur de chargement!')); return false; },
		   success : function(returnData){

				$("#resultatRecherche").html(returnData);
			}

     });


}

$("#btnRechercher").click(function(){
  loadresultatRecherche();
     });

    // loadresultatRecherche();




</script>
<?php

}
else {
   header('location: index.php');
}
?>
