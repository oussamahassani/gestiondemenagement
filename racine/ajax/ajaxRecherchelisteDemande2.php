<?php
session_start (); 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	

	try {

	/*	$num_demande				= (!empty($num_demande)) ? " AND demande.id_dem = $num_demande": "";
		$type_Client 		    	= (!empty($type_Client)) ? " AND type.id = $type_Client": "";
		$volume 	         		= (!empty($volume)) ? " AND demande.volume <= $volume && demande.volume >= $volumemin" : "";
		$raison_social	            = (!empty($raison_social)) ? " AND client.raisonsociale = $raison_social": "";
		$clientt                    =(!empty($client))?  " AND (client.nom LIKE '%$client%' OR client.prenom LIKE '%$client%')" : "";
		$Email                      =(!empty($Email )) ? " AND client.email LIKE '%$Email%'": "";
		$source                     =(!empty($source )) ? " AND source.id_source =$source": "";
		$tel_client 				= (!empty($tel_client)) ? " AND (client.tel LIKE '%$tel_client%' OR client.telMobile LIKE '%$tel_client%')" : "";
		$Date_departA               =(!empty($Date_departd)) ? " AND demande.date_dep  <  '$Date_departd' " : "";
		$Date_depart 	            = (!empty($Date_depart)) ? " AND demande.date_dep  =  '$Date_depart' " : "";
		$Date_departd 	            = (!empty($Date_departd)) ? " AND demande.date_dep  >  '$Date_departd' " : "";
		$Date_creation_demande 		= (!empty($Date_creation_demande)) ? " AND Date(demande.date_creation) = '$Date_creation_demande '" : '';
     */
		



		require_once '../../db.php';
		?>

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
     $id_client_B2B=$_SESSION['id_client_B2B'];
	$num_demande 					= $_POST['num_demande'];
	$client 						= $_POST['client'];
	$type_Client         			= $_POST['type_Client'];
	$raison_social   				= $_POST['raison_social'];
	$tel_client 					= $_POST['tel_client'];
	$Email                  		= $_POST['Email'];
	$Date_depart            		= $_POST['Date_depart'];
	$Date_departd             		= $_POST['Date_departd'];
	$Cp_depart              		= $_POST['Cp_depart'];
	$Cp_arrive              		= $_POST['Cp_arrive'];
	$Date_departA             		= $_POST['Date_departA'];
	$volume                 		= $_POST['volume'];
	$Date_creation_demande 		    = $_POST['Date_creation_demande'];
	$source              		    = $_POST['source'];
	$volumemin              		= $_POST['volumemin'];
                           $req=mysqli_query($con,"
                              select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
                              INNER JOIN client  on demande.id_client=client.id_client  
							  INNER JOIN source on demande.id_source=source.id_source 
                              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
                              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
                              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
                              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
                              where  demande.conf=0   and id_client_B2B='$id_client_B2B' or demande.id_dem = $num_demande order by demande.id_dem DESC
                           ");
                           while($result=mysqli_fetch_array($req)) {
                              // Check relance
                              $query_relance = "
                                 SELECT 
                                    id 
                                 FROM RelanceDemande
                                 WHERE id_Demande = " . $result['id_dem']
                                 . " 
                                 ORDER BY id DESC LIMIT 1
                              ";
                              // echo $query_relance;
                              $query_relance2 = mysqli_query($con,$query_relance);
                              $result_relance = mysqli_fetch_array($query_relance2);
                              $id_relance     = $result_relance['id'];			
                           ?>		
										<tr>
											
												<td><?= $result['id_dem']; ?></td>
											<td><?=$result['civilite']." ".$result['nom']." ".$result['prenom'];?><br>
											Num mobile :<?= $result['telMobile']; ?><br>
											Num telepone : <?= $result['tel']; ?><br>
											Email:<?=$result['email'];?><br>
											typeclient:<?=$result['type_client'];?><br>
											Raison social :<?=$result['raisonsociale'];?> </td>
												
											<td> <?php $date_dep=$result['date_dep'];
                                    $a=substr($date_dep,0,4);
                                    $m=substr($date_dep,5,2);
                                    $j=substr($date_dep,8,2);
                                    if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                     echo 'Date  : '.$date_dep;?>
											<br>
											Adresse depart :<?=$result['adresse_arr']; ?><br>
											Code postale :<?=$result['code_postale_dep']; ?><br>
											<?php                               
                                    $date_creation=$result['date_creation'];
                                    $a=substr($date_creation,0,4);
                                    $m=substr($date_creation,5,2);
                                    $j=substr($date_creation,8,2);
                                    if ( $a == '00' ){$date_creation='';} else{$date_creation=$j."/".$m."/".$a;}
                                    echo 'Date creation : '.$date_creation;
			                               ?>
									          
											</td>
								           	<td><?php                                  
                                    $date_arr=$result['date_arr'];
                                    $a=substr($date_arr,0,4);
                                    $m=substr($date_arr,5,2);
                                    $j=substr($date_arr,8,2);
                                    if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                    echo 'Date : '.$date_arr;
			                               ?>
											 <br>
											Adresse  :<?=$result['adresse_arr']; ?><br>
											Code postale:<?=$result['code_post_arr']?> </td>	
											<td>  
                                             <?php 
                                  
                                    echo 'Volume : '.$result['volume'];
                                    echo '<br>';
                                    echo 'Type service : '.$result['typefacturation'];  
                                    echo '<br>';									
                                    echo 'source : '.$result['nom_source'];									
                                 ?>                     
                              </td>
							  <td>
                                 <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" id="sendSuperdem" href="confirm_demande.php?id_dem=<?php echo $result['id_dem']; ?>">Confirmer</a>
                                    <a class="dropdown-item" id="envoiParisEco" href="modif_demande.php?id_dem=<?php echo $result['id_dem']; ?>" >Modifier</a>
                                    <a class="dropdown-item" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_dem']; ?>)" >Supprimer</a>
                                    <?php if ($result['id_visite'] > 0) { ?>
                                    <a class="dropdown-item" id="envoiParisEco" href="modif_visite.php?id_visite=<?php echo $result['id_visite']; ?>" >Visite</a>
                                    <?php } else { ?>
                                    <a class="dropdown-item" id="envoiParisEco" href="ajout_visite.php?id_dem=<?php echo $result['id_dem']; ?>" >Visite</a>
                                    <?php 
                                    }
                                    if ((!empty($id_relance)) && $id_relance > 0) { 
                                    ?>
                                    <a class="dropdown-item" href="enreg_relanceDemande.php?relance=<?php echo $id_relance; ?>">Modifier la relance</a>
                                    <?php } else { ?>
                                    <a class="dropdown-item" id="relance_<?php echo $result['id_dem']; ?>" style='cursor: pointer;'>Cr&eacute;er une relance</a>
                                    <?php } ?>
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
	<?php
		
		mysqli_close($con);
	} catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
	
?>
	
		
	
	
