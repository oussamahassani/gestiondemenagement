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
              $nomClient=$_POST['nomClient'];
              $clientB2B=$_POST['clientB2B'];
              $nbMaxEnvoiLead=$_POST['nbMaxEnvoiLead'];
              $cronActif=$_POST['cronActif'];
              $codesPostauxDepart=$_POST['codesPostauxDepart'];
              $codesPostauxArrivee=$_POST['codesPostauxArrivee'];
              $volumeMin=$_POST['volumeMin'];
              $volumeMax=$_POST['volumeMax'];
require_once '../../connect.php';
$req=mysql_query("select *,m.valeur AS typeClient from client INNER JOIN masterParametreValeur m ON m.id=type_client
WHERE 
((clientB2B=$clientB2B AND $clientB2B!= -1) OR ( $clientB2B= -1 ) ) AND 
((cronActif=$cronActif AND $cronActif!= -1) OR ( $cronActif= -1 ) ) AND
((nbMaxEnvoiLead='$nbMaxEnvoiLead' AND '$nbMaxEnvoiLead'!='') OR ( '$nbMaxEnvoiLead'= '' ) ) AND
((codesPostauxDepart LIKE '%$codesPostauxDepart%' AND '$codesPostauxDepart'!='') OR ( '$codesPostauxDepart'= '' ) ) AND
((codesPostauxArrivee LIKE '%$codesPostauxArrivee%' AND '$codesPostauxArrivee'!='') OR ( '$codesPostauxArrivee'= '' ) ) AND
((volumeMin='$volumeMin' AND '$volumeMin'!='') OR ( '$volumeMin'= '' ) ) AND
((volumeMax='$volumeMax' AND '$volumeMax'!='') OR ( '$volumeMax'= '' ) ) AND
( (raisonsociale LIKE '%$nomClient%' AND '$nomClient'!='')
OR (nom LIKE '%$nomClient%' AND '$nomClient'!='') 
OR (prenom LIKE '%$nomClient%' AND '$nomClient'!='') 
OR  '$nomClient'= '' 
)
order by id_client asc");

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
                  <a href="modif_client.php?id_client=<?php echo $result['id_client']; ?>"><i   class="fa fa-pencil"></i></a>
                  <?php
 $req2=mysql_query("select * from demande  WHERE id_client=".$result['id_client']."
 order by id_client desc");
 
 if ($result1=mysql_fetch_array($req2))
 {
   echo("");
 }
 else{
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