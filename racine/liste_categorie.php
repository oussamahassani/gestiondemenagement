
		<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {

require_once"inc/header.php";
require_once"inc/menu.php";
require_once '../connect.php';
include "inc/mod_utilisateur.php";


?>
<style>
.centree{
margin-left:auto;
margin-right:auto;
}

.dropdown-item
{
  background-color: #00f0f9;
  min-width: 200px;
  box-shadow: 0px 8px 16px 0px rgba(0,100,100,1.2);
  padding: 12px 16px;

}
</style>
  <div class="content-wrapper">
<div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Liste Categorie </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Categorie</a></li>
              <li class="breadcrumb-item active">Liste</li>
            </ol>
          </div>
        </div>
    </div>
	<div id="resultatRecherche">
      <div class="row">   
         <div class="col-xl-12 mb-30">     
            <div class="card card-statistics h-100"> 
               <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
				
                     <table  id="datatable" class="table table-striped table-bordered p-0 centree">
                        <thead class="table-dark">
                           <tr>
                             <th width="25%">Num categorie </th>
                              <th width="50%">Nom</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
        <?php
  

$req6=mysql_query("select * from categorie  ");
       while($result=mysql_fetch_array($req6)) 
       {  
                             echo'<tr> <td> '.$result['id_catego'].' </td>';
                             echo '<td>'.$result['Nomcategorie'].' </td>';
                                 
                                  echo' <td><button type="button" class="col text-center btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
								    <div class="dropdown-menu" >
									 <a class="dropdown-item  btn btn-warning" id="sendSuperdem" href="modif_categorie.php?id_cat='.$result['id_catego'].'">Modifier</a>
								  <a class="dropdown-item  btn-danger" id="envoiParisEco" href="#" onClick="supprimer('.$result['id_catego'].')" >Supprimer</a></td>
                                      </div>'  ;           
                                    
                                
                             }
        ?>
</tr>
                   </tbody>
                     </table>  
				
                  
     
                    </div>
                </div>
            </div>
	    </div>
    </div>	   

		 <?php require_once"inc/footer.php"; ?>
		 <script language="javascript">
function supprimer(identifiant) {
   var confirmation=confirm("Voulez vous vraiment supprimer cette catogerie?");

   if(confirmation) {
      document.location.href="inc/delete_categorie.php?id_cat="+identifiant;
   }
}
</script>
		<?php
} 
else
{

header('location: index.php');

}?>
