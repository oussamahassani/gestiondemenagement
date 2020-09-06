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
              <h4 class="mb-0">Liste clients </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Client Liste </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
    <div class="card card-statistics mb-30">
                                <div class="card-body">
                                <h5 class="card-title">Critères de recherche</h5>
                                <form name="moteur" action="" method="POST" class="form-validate form-horizontal" id="moteur">
                                  <div class="form-row">
                                            <div class="col col-md-2" >
                                            <!--<label for="inputState" >Nom / Raison sociale</label>!-->
                                               <input type="text" class="form-control" name="nomClient" placeholder="Nom/Raison sociale" >
                                            </div>
                                            <div class="form-group col-md-1.5">
                                               <!-- <label for="inputState">Type client</label>!-->
                                                <select id="inputState"  name="clientB2B"  class="form-control" placeholder="Type client">
                                                <option value="-1" selected>Type client</option>
                                                 <option value="1">B2B</option>
                                                 <option value="0">B2C</option>
                                                </select>
                                            </div>
                                            <div class="col col-md-1.5" > 
                                            <!--<label for="inputState" >Nb max envoie</label>!-->
                                                <input type="number" class="form-control" placeholder="Nb max envoie" name="nbMaxEnvoiLead" >
                                            </div>
                                            <div class="form-group col-md-1.5">
                                                <!--<label for="inputState">Statut cron</label>!-->
                                                <select id="inputState" name="cronActif"  class="form-control" placeholder="Statut cron">
                                                <option value="-1" selected>Statut cron</option>
                                                 <option value="1">Actif</option>
                                                 <option value="0">Inactif</option>
                                                </select>
                                            </div>

                                        <div class="form-group col-md-1.5">
                                       <!-- <label for="inputState">Codes postaux départ</label>!-->
                                        <input name="codesPostauxDepart" type="text" class="form-control" placeholder="Codes postaux départ" >
                                        </div>
                                        <div class="form-group col-md-1.5">
                                       <!-- <label for="inputState">Codes postaux arrivée</label>!-->
                                        <input name="codesPostauxArrivee" type="text" class="form-control" placeholder="Codes postaux arrivée" >
                                        </div>
                                        <div class="form-group col-md-1.5">
                                         <!-- <label for="inputState">Volume Min</label>!-->
                                        <input name="volumeMin"  type="number" min="0" class="form-control" placeholder="Volume Min" >
                                        </div>
                                        <div class="form-group col-md-1.5">
                                         <!-- <label for="inputState">Volume Max</label>!-->
                                        <input name="volumeMax" type="number" min="0" class="form-control" placeholder="Volume Max" >
                                        </div>
                                        <div class="form-group col-md-1">
                                        <a class="button medium" id="btnRechercher" style="text-align:left;" href="#">Rechercher</a>
                                        </div>
                                        </div>
                                       </Form>
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
                      <th>ID</th>
                      <th>Client B2B</th>
                      <th>Informations générales</th>
                      <th>Contact</th>
                      <th>Informations Client B2B</th>
                      <th>Informations Cron</th>
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
require_once '../connect.php';
$req=mysql_query("select *,m.valeur AS typeClient from client INNER JOIN masterParametreValeur m ON m.id=type_client
order by id_client desc");
while($result=mysql_fetch_array($req))
{				
?>
                  <tr>
                      <td><?php echo $result['id_client'];?></td>
                      <td><?php
                    if ($result['clientB2B']=='1') 
                    {   echo 'Oui';
                    }
                    else
                    {
                      echo 'Non';}
                    ?></td>
                      <td> <?php
                  if ($result['type_client']!='1') 
                  {   echo $result['raisonsociale'];
                  }
                  else
                  {

                  echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                  }
				          ?></td>
                      <td><?php
                  if ($result['clientB2B']=='1') 
                  { 
                    echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                    echo '<br>';echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile']." - Email : ".$result['email'];
                    echo '<br>';
                    echo 'Profession : '.$result['profession']." - Pseudoskype : ".$result['pseudoskype'];
                  }
                  else
                  {
                  echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                  echo '<br>';
                  echo 'Email : '.$result['email'];
                  }
				          ?></td>
                      <td> <?php
                  if ($result['clientB2B']=='1') 
                  {echo 'Pays : '.$result['pays']." - Ville : ".$result['ville']." - Code postal : ".$result['codepostal'];
                    echo '<br>';
                    echo 'Adresse : '.$$result['adresse']. ' - Siret : '.$result['siret'];
                    echo '<br>';
                    echo 'Email : '.$result['emailClientB2B'];
                  }
                  else
                  {echo '----';
                  }
				          ?></td>
                      <td><?php
                  if ($result['clientB2B']=='1') 
                   

                  { $cronActif = $result['cronActif'];
                    if ($cronActif =='1')
                    $cronActif ='Actif';
                    else
                    $cronActif ='Inactif';
                    echo 'Statut cron : '.$cronActif. ' - Nb Max Envoi Lead : '.$result['nbMaxEnvoiLead'];
                    echo '<br>';
                    echo 'Codes postaux départ : '.$result['codesPostauxDepart']." - Codes postaux arrivée : ".$result['codesPostauxArrivee'];
                    echo '<br>';
                    echo 'Volume min : '.$$result['volumeMin']. ' - Volume max : '.$result['volumeMax'];
                  }
                  else
                  {echo '----';
                  }
                  ?></td>
                  <td>
                  
                   
                   
                 <a href="modif_client.php?id_client=<?php echo $result['id_client']; ?>"><i  class="fa fa-pencil"></i></a>
<br>
<?php
 $req2=mysql_query("select * from demande  WHERE id_client=".$result['id_client']."
 order by id_client desc");
 
 if ($result1=mysql_fetch_array($req2))
 {
   echo("");
 }
 else{
 /* echo "select * from demande  WHERE id_client=".$result['id_client']."
  order by id_client desc";
echo("<a href=\"#\" class='HREF' onClick=\"confirme('".$result['id_client']."')\">");
*/
?>
  <a href="#"  onClick="confirme('<?php echo $result['id_client']; ?>')">
    <i  class="fa fa-trash-o text-danger"></i></a>


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