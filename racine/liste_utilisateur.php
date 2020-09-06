<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
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
              <h4 class="mb-0">Liste utilisateur </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Utilisateur</a></li>
              <li class="breadcrumb-item active">Liste </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
  <div class="row">
		<div class="col-md-12 mrg-35">
			<div class=" card mb-3">
				<form id="moteur" method="post">
					<div class="row" style="margin-top:2em;">
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Nom </label>
							<input type='text' id='Nom' name='Nom' class='form-control'>
						</div>
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Surnom </label>
							<input type='text' id='Surnom' name='Surnom' class='form-control'>
						</div>
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Téléphone  </label>
							<input type='number' min="1"   id='M_fact' name='M_fact' class='form-control'>
						</div>
						<div class="col-sm-3" style=" margin-left: 30px;">
							<label for='num_demande'>Mobile </label>
							<input type='number' min="1"   id='Mobile' name='Mobile' class='form-control'>
						</div>
						<div class="col-md-3" style=" margin-left: 30px;">
							<label for='statut_relance'>Statut </label>
							<!--<select name='statut_relance' id='statut_relance' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>

							</select>-->
							<select name='source' id='source' class='form-control' style="height:50px;">
								<option value='-1'>S&eacute;l&eacute;ctionnez un statut</option>
								<option value='1'>Actif</option>
								<option value='0'>Inactif</option>
							</select>
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
              <thead>
              <tr>
                      <th>Id</th>
                      <th>Type</th>
                      <th>Utilisateur</th>
                      <th>Statut</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Poste</th>
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
require_once '../connect.php';
$req=mysql_query("select *,m.valeur AS typeUtilisateur from utilisateur INNER JOIN masterParametreValeur m ON m.id=id_type 
order by id_utilisateur asc");
while($result=mysql_fetch_array($req))
{				
?>
                  <tr>
                      <td><?php echo $result['id_utilisateur'];?></td>
                      <td><?php
                   echo $result['typeUtilisateur']; 
                    ?></td>
                     <td><?php
                  echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                  ?></td>
                   <td><?php $Actif = $result['actif'];
                    if ($Actif =='1')
                    $Actif ='Actif';
                    else
                    $Actif ='Inactif';
                    echo $Actif;
                   
                  ?></td>
                      <td> <?php    echo $result['email'];?></td>
                      <td> <?php    echo 'Tel : '.$result['tel']." <br> Tel mobile : ".$result['telMobile'];?></td>
                      <td> <?php    echo $result['poste'];?></td>
                  <td>
                  <?php
 if ($_SESSION['id_type']!="17")
 {
   echo("");
 }
 else{
?>
                  <a href="modif_utilisateur.php?id_utilisateur=<?php echo $result['id_utilisateur']; ?>"><i  class="fa fa-pencil"></i></a>


 <!---<br> <a href="#"  onClick="confirme('<?php echo $result['id_utilisateur']; ?>')">
    <i  class="fa fa-trash-o text-danger"></i></a> !--->
<?php


}
?> 
</td>
                  </tr>
                  <?php 

              

}
?>
             
</tbody>
           </table>
          
            </div>
          </div>   
        </div>
    </div> 
    </div> 
    </div> 

 <!--=================================
 wrapper -->
      

  
 <?php require_once"inc/footer.php"; ?>
 <script>
   function confirme(identifiant)

{

var confirmation=confirm("Voulez vous vraiment supprimer ce client?");

if(confirmation)
{

document.location.href="inc/delete_client.php?id_client="+identifiant;

}

}

  function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/ajaxrechercheuser.php",
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
else
{

header('location: index.php');

}?>