<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php 
  require_once"inc/header.php";
  include "inc/mod_utilisateur.php";
  $date_en_cours = date("Ymd-His");
?>
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
<?php require_once '../connect.php';
     $id_client_B2B=$_SESSION['id_client_B2B'];
     $confirm=$_GET['confirm'];
     if ($confirm != '0'  &&  $confirm!= '1')
     {$confirm = 0;
      $id_statut= 46 ;
      }
     $annule=$_GET['annule'];
     if (($annule != '0')  && ($annule!='1'))
     {$annule = 0;
     
     }
     $titre ='';
     if (($confirm == 0) &&  ($annule == 1)) 
     {$titre ='Annulés';}
     if (($confirm == 1) &&  ($annule == 0)) 
     {$titre ='Confirmés';}

     ?>
  <link rel='stylesheet' href='css/default.css?v=1.1' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
  <style type="text/css">
    .page-item.active .page-link {
        background-color: #84ba3f !important;
          border-color: #84ba3f !important;
    }
    /*.col-md-3 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 25%;
        flex: 0 0 24%;
    }*/
    .datepicker {
      width: 100% !important;
    }
    .card-body {
      font-size: 0.87rem !important;
      padding: 0;
    }
    .table th {
        vertical-align: middle;
    }
    .table th, .table td {
        vertical-align: middle;
        padding: .30rem;
    }
    thead th {
        background-color: #FFA500;
    }
    .table {
      border-collapse: separate !important;
    }
    .table tbody tr:nth-child(even) {
      background-color: #7CFC00;
    }
    .table tbody tr:nth-child(odd) {
      background-color: #B0E0E6;
    }
  </style>
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Liste des relances</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
            <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
            <li class="breadcrumb-item active">Liste Relances</li>
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
             <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
                      <th>N° </th>
                      <th width="18%">Informations client</th>
                      <th width="18%">Informations départ</th>
                      <th width="18%">Informations arrivée</th>
                      <th width="18%">Informations demande</th>
                      <th width="18%">Informations devis</th>
                      
                      <th></th>
                    </tr>
              </thead>
              <tbody>
             
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
      

  
<?php 
require_once"inc/footer.php";
require_once "inc/mod_utilisateur.php";
require_once "inc/mod_statutParametre.php";

$que_user_logged      = mysql_query($query_user_logged);
$result_user_logged     = mysql_fetch_array($que_user_logged);

$que_get_status_parameter   = mysql_query($query_get_status_parameter);
?>
<div class="modal fade" id="modalRelance" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="display:inline-table; width: 1000px; margin-left: -50%;">
            <div class="modal-header">
               <h5 class="modal-title">Ajout d'une relance</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" style="text-align:center; background-color: #000;">
               <div class="table-responsive">
                  <form id='frmRelanceDevis' method='POST'>
                     <table class='table table-border table-striped'>
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Heure</th>
                              <th>Responsable</th>
                              <th>Statut</th>
                              <th>Commentaire</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>
                                 <input type='text' name='date_relance' id='date_relance' class='form-control datepicker' autocomplete="off" data-rule-required="true" placeholder='Date de la relance' data-msg-required="Date de relance obligatoire" />
                              </td>
                              <td>
                                 <input type='text' name='heure_relance' id='heure_relance' class='form-control' autocomplete="off" value='' placeholder='Heure de la relance' />
                              </td>
                              <td>
                                 <label for='responsable_relance'><?php echo  ucfirst($result_user_logged['nom']) ;?></label>
                                 <input type='hidden' name='responsable_relance' id='responsable_relance' class='form-control' value="<?php echo  $result_user_logged['id_utilisateur'];?>" />
                              </td>
                              <td>
                                <!-- <select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off"> -->
                                 <select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off" data-rule-required="true" data-msg-required="Statut obligatoire">
                                 <option value=''>S&eacute;l&eacute;ctionnez un statut</option>
                                 <?php
                                 while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
                                    echo "<option value=" . $result_status_parameter['id'] . ">". utf8_encode($result_status_parameter['statut']) . "</option>";
                                 }
                                 ?>
                                </select>
                              </td>
                              <td>
                                 <textarea name='commentaire_relance' id='commentaire_relance' class='form-control' autocomplete="off" value='' placeholder='Commentaire sur la relance'></textarea>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <input type='hidden' id='valueIdDevis' name='valueIdDevis' value=''>
                  </form>                
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" id='validRelance'>Valider</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src='js/list_devis.js?v=<?php echo date('Y-m-d His'); ?>'></script>
<script language="javascript">
<?php
} 
else
{

header('location: ../login.php');

}?>