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
              <h4 class="mb-0">Liste Demandes API</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Liste Demandes API</li>
            </ol>
          </div>
        </div>
    </div>
    <?php require_once '../connect.php';?>
    <!-- main body --> 
    <!---<div class="card card-statistics mb-30">
                                <div class="card-body">
                                <h5 class="card-title">Critères de recherche</h5>
                                <form name="moteur" action="" method="POST" class="form-validate form-horizontal" id="moteur">
                                  <div class="form-row">
                                            <div class="col col-md-2" >
                                            <input type="text" class="form-control" name="numDemande" placeholder="N° demande" >
                                            </div>
                                            <div class="form-group col-md-1.5">
                                            <select id="inputState"   name="source" class="form-control select2">
                                            <option value="-1" selected>Source</option>
                                            <?php
                                            
                                               /*$req5=mysql_query("select * from source");
                                            while($result5=mysql_fetch_array($req5)) 
                                            {  echo"<option value='".$result5['id_source']."'>".$result5['nom_source']." </option>"; }
                                            */?>
                                            </select>
                                            </div>
                                            <div class="form-group col-md-1.5">
                                            <select name="typeDemande" class="form-control select2" >
                                            <option value="-1" selected>Type demande</option>
                                            <?php /* $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=2");
                                            while($result6=mysql_fetch_array($req6)) 
                                            {echo"<option  value='".$result6['id']."'>".$result6['valeur']." </option>"; }*/?>
                                            </select>
              
                                            </div>

                                        <div class="form-group col-md-1">
                                        <a class="button medium" id="btnRechercher" style="text-align:left;" href="#">Rechercher</a>
                                        </div>
                                        </div>
                                       </Form>
                                      </div>
</div>!-->
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
                      <th width="20%">Informations départ</th>
                      <th width="20%">Informations arrivée</th>
                      <th width="20%">Autre</th>
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
              
              $id_source=$_GET['id_source'];
              $req=mysql_query("select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
              where demande.conf=0  and id_source='$id_source' order by demande.id_dem DESC");
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
                      <td>
                      <?php  echo 'Envoi bloqué'
                          ?> 
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                      <div class="dropdown-menu">
                <a class="dropdown-item" id="sendSuperdem" href="#">Envoi Superdem</a>
                <a class="dropdown-item" id="sendSuperdem" href="#">Envoi Pari's Eco</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"  onClick="confirmeBloquer('<?php echo $result['id_demande']; ?>','<?php echo $id_source; ?>')" >Bloquer l'envoi</a>
              </div>
              
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
function confirmeBloquer(identifiant,id_source)
{
var confirmation=confirm("Etes-vous sûr(e) de vouloir bloquer l'envoi de fiche?");
if(confirmation)
{
document.location.href="inc/bloquer_demande.php?id_demande="+identifiant+"&id_source="+id_source;
}
}
  function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/ajax_Liste_Client.php",
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