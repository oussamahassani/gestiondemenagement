<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$num_demande 					= $_POST['num_demande'];
	$nomclient						= $_POST['nomclient'];
	$type_Client         			= $_POST['type_Client'];
	$raison_social   				= $_POST['raison_social'];
	$tel_client 					= $_POST['tel_client'];
	$Email                  		= $_POST['Email'];
	$Date_depart            		= $_POST['Date_depart'];
	$Date_departd             		= $_POST['Date_departd'];
	$Date_departA             		= $_POST['Date_departA'];
	$volume                 		= $_POST['volume'];
	$cp_arrive                 		= $_POST['cp_arrive'];
	$cp_depart                 		= $_POST['cp_depart'];
	$Date_creation_demande 		    = $_POST['date_creation_demande'];
	$source              		    = $_POST['source'];
	$volumemin              		= $_POST['volumemin'];
	

	try {

		$num_demande				= (!empty($num_demande)) ? " AND demande.id_dem = $num_demande": "";
		$type_Client 		    	= (!empty($type_Client)) ? " AND type.id = $type_Client": "";
		$volume 	         		= (!empty($volume)) ? " AND demande.volume <= $volume && demande.volume >= $volumemin" : "";
	    $Email                      =(!empty($Email )) ? " AND client.email LIKE '%$Email%'": "";
		$nomclient                  =(!empty($nomclient)) ? " AND (client.prenom LIKE '%$nomclient%'  OR client.nom LIKE '%$nomclient%'  )": "";
		$raison_social              =(!empty($raison_social  )) ? " AND client.raisonsociale LIKE '$raison_social'": "";
		$source                     =(!empty($source )) ? " AND source.id_source =$source": "";
		$tel_client 				= (!empty($tel_client)) ? " AND (client.tel LIKE '%$tel_client%' OR client.telMobile LIKE '%$tel_client%')" : "";
		$Date_depart 	            = (!empty($Date_depart)) ? " AND demande.date_dep  = '$Date_depart' " : "";
		$Date_departd 	            = (!empty($Date_departd)) ? " AND demande.date_dep  > '$Date_departd' " : "";
		$Date_departA 	            = (!empty($Date_departA)) ? " AND demande.date_dep  < '$Date_departA' " : "";
		$Date_creation_demande 		= (!empty($Date_creation_demande)) ? " AND Date(demande.date_creation) = '$Date_creation_demande '" : '';
     	$cp_arrive                  =(!empty($cp_arrive))  ? " AND demande.code_post_arr LIKE '%$cp_arrive%'": "";  
        $cp_depart                  =(!empty($cp_depart))  ? " AND demande.code_postale_dep LIKE '%$cp_depart%'": "";  


		require_once '../../db.php';

		$query_search = "

			 select * ,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
                              INNER JOIN client  on demande.id_client=client.id_client
							  INNER JOIN source on demande.id_source=source.id_source 
                              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
                              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
                              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
                              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
							  LEFT JOIN  masterParametreValeur type ON type.id = client.type_client
                              where 1 $num_demande $type_Client $source $nomclient $Date_departd $Date_departA  $volume $raison_social $Email $tel_client $Date_depart $Date_creation_demande $cp_arrive $cp_depart   	
                          order by demande.id_dem DESC ";
                              
		
		// echo $query_search;
		$req = mysqli_query($con, $query_search);
		if ($req) {
		?>
		<div id="resultatRecherche">
			<div class="row">
				<div class="col-xl-12 mb-30">
					<div class="card card-statistics h-100">
						<div class="card-body">
							<div class="table-responsive" id="resultatRecherche">
								<!-- <table id="datatable" class='table table-border table-striped p-0'> -->
								<table id="datatable" class="table table-striped table-bordered p-0">
									<thead>
										<tr>
											<th >N°</th>
											<th width="20px" height="10px" border align="left">Informaion client</th>
											<th width="20%">Informations départ</th>
											<th width="20%">Informaion arriver</th>
											<th width="20%">Autre</th>
										</tr>
									</thead>
									<tbody>
									<?php
									while($result=mysqli_fetch_array($req)) {
									?>
										<tr>
											<form id='frm_list_relance_id' method='POST'>
											 
                                  
                              
											<td><?= $result['id_dem']; ?></td>
										    <td><?=$result['civilite']." ".$result['nom']." ".$result['prenom'];?><br>
											Tel :<?= $result['tel']."- Tel mobile ".$result['telMobile']; ?><br>
											Email:<?=$result['email'];?><br>
																							
											<td>Adresse : <?=$result['adresse_dep'];?>
											-<?=$result['code_postale_dep']." - ".$result['nom']; ?><br>
											<?php 
											$date_dep=$result['date_dep'];
                                            $a=substr($date_dep,0,4);
                                            $m=substr($date_dep,5,2);
                                            $j=substr($date_dep,8,2);
                                           if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                           echo 'Date : '.$date_dep;
									?>
			                               
									          
											</td>
								           	<td>Adresse  :<?=$result['adresse_arr'];?>
											- <?=$result['code_post_arr']." - ".$result['ville_arr'];?><br>
											<?php $date_arr=$result['date_arr'];
                                          $a=substr($date_arr,0,4);
                                          $m=substr($date_arr,5,2);
                                          $j=substr($date_arr,8,2);
                                          if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                          echo 'Date : '.$date_arr;?> 
										  <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_arr'];?> '>
                                    <i class="text-info ti-info"></i>...
                                 </a></td>	
											<td>  
                                             <?php 
                                  
                                   $date_etab=$result['etablie_le'];
                                    $a=substr($date_etab,0,4);
                                    $m=substr($date_etab,5,2);
                                    $j=substr($date_etab,8,2);
                                    echo 'Date : '.$j."/".$m."/".$a;
                                    echo '<br>';
                                    echo 'Volume : '.$result['volume'];
                                    echo '<br>';
                                    echo 'Type service : '.$result['typefacturation'];       						
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
											</form>
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
		}
		mysqli_close($con);
	} catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
	
?>
	
		
	
	
