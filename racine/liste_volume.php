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
   .dropdown-item
{
  background-color: #00f0f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,100,100,1.2);
  padding: 12px 16px;

}
</style>
<link rel='stylesheet' href='css/default.css?v=<?php echo $date_en_cours; ?>' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<div class="content-wrapper">
   <div class="page-title">
      <div class="row">
         <div class="col-sm-6">
           <h4 class="mb-0">Liste article </h4>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
               <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
               <li class="breadcrumb-item active">Liste article </li>
            </ol>
         </div>
      </div>
   </div>   
   <div class="row">
		<div class="col-md-12 mrg-35">
			<div class=" card text-white  mb-3">
				<form id="moteur" method="post">
					<div class="row">
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Nom article</label>
							<input type='text' id='nom_art' name='nom_art' class='form-control' autocomplete="off">
						</div> 
						<div class="col-md-3">
							<label for='statut_relance'>Catégorie</label>
							<!--<select name='statut_relance' id='statut_relance' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
								
							</select>-->
							<select name='source' id='source' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un Catégorie</option>
								<?php
							                     $req6=mysql_query("select * from categorie  ");
										 while($result=mysql_fetch_array($req6)) 
                                                {  
											echo "<option value=" . $result['id_catego'] . ">". utf8_encode($result['Nomcategorie']) . "</option>";
										}
							
																	
								?>
							</select>
							</div>
							</div>					
					<button type='button' class='btn btn-success btn-fl-left' id='btnRechercher' style='margin-bottom: 10px;margin-right:10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
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
                        <thead>
                           <tr>
                              <th >N° </th>
                              <th width="25%">Image</th>
                              <th width="20%">Nom</th>
                              <th width="15%">Volume</th>
							   <th width="15%">Categorie</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $id_client_B2B=$_SESSION['id_client_B2B'];
                           $req=mysql_query("select * from volume order by volume.id_vol");
                           while($result=mysql_fetch_array($req)) {
                              // Check relance
                       			
                           ?>
                           <tr>
                              <td><?php echo $result['id_vol']; ?></td>
                              <td>
                                 <?php 
                                    echo '<img src="'.$result['image'].'" alt="image volume" height="42" width="42">';
                                    
                                 ?> 
                              </td>
                              
                              <td>
                                 <?php  
                                    echo $result['nom_vol'];
                                    
                                 ?> 
                              </td>
                              <td>
                                 <?php 
                                  echo $result['calc_vol'];                        
						   ?>  
                               <td>
                                 <?php echo $result['category']; ?> 
                                                                                                                                                             
                              </td>						   
                              </td>
                              <td>
                                 <button type="button" class=" col text-center btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                 <div class="dropdown-menu">
                                 <a class="dropdown-item btn btn-warning" id="envoiParisEco" href="modif_volume.php?id_vol=<?php echo $result['id_vol']; ?>" >Modifier</a>
						   <a class="dropdown-item btn-danger" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_vol']; ?>)" >Supprimer</a>
                                                    
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
  
<?php 
require_once"inc/footer.php";
?>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script language="javascript">
function supprimer(identifiant) {
   var confirmation=confirm("Voulez vous vraiment supprimer cette demande?");

   if(confirmation) {
      document.location.href="inc/delete_volume.php?id_dem="+identifiant;
   }
}




function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/ajaxRecherchelistevolume.php",
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