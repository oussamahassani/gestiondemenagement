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
<?php require_once '../connect.php';
     $id_client_B2B=$_SESSION['id_client_B2B'];
     $confirm=$_GET['confirm'];
     if ($confirm != '0'  &&  $confirm!= '1')
     {$confirm = 0;}
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
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">

              <h4 class="mb-0">Liste Devis <?php echo $titre;  ?> </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Liste Devis </li>
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
                      <th width="20%">Informations client</th>
                      <th width="18%">Informations départ</th>
                      <th width="18%">Informations arrivée</th>
                      <th width="15%">Autre</th>
                      <th width="18%">Informations devis</th>
                      
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
              
             
              $req=mysql_query("select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
              INNER JOIN devis ON demande.id_dem=devis.id_demande 
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
              where id_client_B2B='$id_client_B2B' 
              and devis.confirm=$confirm and devis.annule=$annule  order by demande.id_dem DESC");
              while($result=mysql_fetch_array($req))
              {				
              ?>
                  <tr>
                      <td><?php echo $result['id_dem']; ?>
                      
              </td>
                      <td><?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                                echo '<br>';
                                echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                                echo '<br>';
                                echo /*'Email : '.*/ $result['email'];
                          ?> 
                      </td>
                      <td><?php  echo 'Adresse : '.$result['adresse_dep'];
                                 echo ' - '.$result['code_postale_dep']." - ".$result['ville_dep'];
                                 echo '<br>';
                                 
                                 $date_dep=$result['date_dep'];$a=substr($date_dep,0,4);$m=substr($date_dep,5,2);$j=substr($date_dep,8,2);
                                 if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                 echo 'Date : '.$date_dep;
                          ?> 
                           <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_dep'];?> '>
                           <i class="text-info ti-info"></i>...</a>
                      </td>
                      <td>
                        <?php  echo 'Adresse : '.$result['adresse_arr'];
                                 echo ' - '.$result['code_post_arr']." - ".$result['ville_arr'];
                                 echo '<br>';
                                 $date_arr=$result['date_arr'];$a=substr($date_arr,0,4);$m=substr($date_arr,5,2);$j=substr($date_arr,8,2);
                                 if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                 echo 'Date : '.$date_arr;
                          ?> 
                          <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_arr'];?> '>
                           <i class="text-info ti-info"></i>...</a>
                          </td>
                        
                      <td><?php $date_etab=$result['etablie_le'];	$a=substr($date_etab,0,4);	$m=substr($date_etab,5,2);$j=substr($date_etab,8,2);
            echo 'Date : '.$j."/".$m."/".$a;
            echo '<br>';
            echo 'Volume : '.$result['volume'];
                                 echo '<br>';
                                 echo 'Type service : '.$result['typefacturation'];
                              
                          ?> 
                     
                      </td>
                      <td><?php
                          echo 'Prestation : '.$result['prestation'];
            echo '<br>';
            echo 'Prix : '.$result['Prix_ht'];
                                 echo '<br>';
                                 echo 'Assurance : '.$result['assurance'];
                              
                          ?> 
                     
                      </td>
                      <td>
                    
<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" id="modifDevis" href="../pages/forms/modif_devis.php?dev=<?php echo $result['id_devis']; ?>&retour=2" >Modifier</a>
                      <a class="dropdown-item" id="ajoutdevis" href="../pages/forms/confirm_demande.php?id_dem=<?php echo $result['id_dem']; ?>" >Ajouter devis</a>
                      <?php   if (($result['confirm'] == 0) && ($result['annule'] == 0))
                      { ?>
                <a class="dropdown-item" id="envoiParisEco" href="#" onClick="confirmer(<?php echo $result['id_devis']; ?>)" >Confirmer</a>
                <?php   } ?>
                 <a class="dropdown-item" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_devis']; ?>,<?php echo $confirm; ?>,<?php echo $annule; ?>)" >Supprimer</a>
                 
                 <div class="dropdown-divider"></div>
                 <a   class="dropdown-item" id="pdf" target="new" href="../pages/TCPDF-master/examples/example_051.php?id=<?php echo $result['id_dem']; ?>&dev=<?php echo $result['id_devis']; ?>">PDF</a></li>

                 <?php   if (($result['confirm'] == 1) && ($result['annule'] == 0))
                      { ?>
                <a class="dropdown-item" id="visite" href="../pages/forms/visite.php?id_dem=<?php echo $result['id_dem']; ?>" >Visite</a>
                <a class="dropdown-item" id="relance" href="../pages/forms/relance.php?dem=<?php echo $result['id_dem']; ?>">Relance</a>
             <?php   } ?>
             <div class="dropdown-divider"></div>
             <div id="demo-modal-target">
             <a class="dropdown-item" id="EnvoiMail" href="#"  onclick="loadDynamicContentModal(<?php echo $result['id_devis']; ?>)"  tabindex="-1" role="dialog" aria-hidden="true">
               </div>
               <div class="modal bd-example-modal-lg" id="sendMail<?php echo $result['id_devis']; ?>"></div>
               <!--- <div class="modal fade bd-example-modal-lg" id="sendMail<?php echo $result['id_devis']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
               </div>
            data-toggle="modal" data-target="#sendMail" !---> Envoi mail</a>
               
          
              </div>
              <!-- Modal   -->
               
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
 <script language="javascript">

function supprimer(identifiant, confirme, annule)

{

var confirmation=confirm("Etes-vous sûr(e) de vouloir supprimer ce devis?");

if(confirmation)

{

document.location.href="inc/delete_devis.php?id_devis="+identifiant+'&confirm='+confirme+'&annule='+annule;

}

}

function confirmer(identifiant)
{

var confirmation=confirm("Etes-vous sûr(e) de vouloir confirmer ce devis?");

if(confirmation)
{
document.location.href="inc/confirm_devis.php?id_devis="+identifiant;
}

}


function envoyer(identifiant,id_client)
{

var confirmation=confirm("Etes-vous sûr(e) de vouloir envoyer ce devis?");

var from = document.getElementsByName('from_' + identifiant)[0].value;
var to = document.getElementsByName('to_' + identifiant)[0].value;
var cci = document.getElementsByName('cci_' + identifiant)[0].value;
var objet = document.getElementsByName('objet_' + identifiant)[0].value;
var corps = document.getElementsByName('summernote_' + identifiant)[0].innerHTML;

alert(corps);
if(confirmation)
{

  $.ajax({
							type        : "POST",
							url         : "ajax/ajax_send_devis.php",
							data        : "id_devis="+identifiant +"&id_client="+ id_client +"&from="+ from+"&to="+ to+"&cci="+ cci+"&objet="+ objet +"&corps="+ corps ,
              beforeSend  : function(){ },
              success   : function(response){
              alert('Devis envoyé avec succès.');
              $('#sendMail'+identifiant).modal('hide');
              	}
							,
							cache : false

						});
}

}


function loadDynamicContentModal(id_devis){
	var options = {
			modal: true,
			height:500,
			width:700
		};

	//$('#demo-modal').html("modal_send_devis.php?id_devis="+id_devis);
  $('#sendMail'+id_devis).load("ajax/modal_send_devis.php?id_devis="+id_devis).dialog(options).dialog('open');
}
</script>
<?php
} 
else
{

header('location: index.php');

}?>