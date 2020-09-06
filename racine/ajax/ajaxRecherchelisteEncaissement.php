<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">

            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
			                 <th width="08%">N° facture</th>
                              <th width="08%">N° devis</th>
                              <th width="20%">Client</th>
                              <th width="12%">Montant</th>
							   <th width="15%">Type encaisement</th>
							   <th width="15%">Action</th>
              </thead>
              <tbody>
              <?php
			  require_once '../../db.php';
              $num_en=$_POST['num_en'];
              $datefact=$_POST['D_fact'];
			  $montant=$_POST['M_fact'];
              $sourcetype=$_POST['source'];
			  $num_dev=$_POST['num_dev'];
			  if ($sourcetype>0)
			  {
			  $req1="select valeur from  masterParametreValeur where id=$sourcetype";
			  $req11=mysqli_query($con,$req1) or die (mysqli_error($con));
			  $row1 = mysqli_fetch_assoc($req11);
			  $valeur =  $row1['valeur'];
                   }
            try {

		$num_en	        = (!empty($num_en)) ? " AND numero_Facture LIKE '%$num_en%'": "";
		$datefact 		= (!empty($datefact)) ? " AND datee_creat LIKE '%$datefact%'": "";
		$montant 		= (!empty($montant)) ? " AND montant LIKE '%$montant%'": "";
		$sourcetype     = (!empty($valeur)) ? " AND type_encaissement LIKE '%$valeur%'": "";
		$num_dev 		= (!empty($num_dev)) ? " AND 	id_deviss LIKE '%$num_dev%'": "";

$query_search = "SELECT *,ts.valeur as type_presentation ,c.nom as nomc  FROM  facturation LEFT JOIN   devis ON facturation.id_deviss = devis.id_devis
	     LEFT JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN  client c on demande.id_client =c.id_client 
         LEFT JOIN masterParametreValeur  ts ON demande.id_prestation =	ts.id
		 
         where 1 $num_en $datefact $montant $sourcetype $num_dev  order by facturation.id";
$req = mysqli_query($con, $query_search);

if ($req) {

	while($result=mysqli_fetch_array($req)) {
                              // Check relance

                           ?>
                           <tr>



                                  <td><?php echo $result['numero_Facture']; ?></td>

                               <td> <?php  echo $result['id_devis']; ?>  </td>
                               <td> <?php echo $result['user'];  ?>  </td>
							    <td><?php    echo $result['montant'];   ?>   </td>
                              <td><?php  echo $result['type_encaissement'];?> </td>
                               <td>  <?php echo $result['action'];?> </td>
						    <!--<td><?php /*echo $result['datee_creat'];*/ ?>  </td>-->
                                <td>
                    <button type="button" class=""  aria-haspopup="true" aria-expanded="false">
                                 <a class="btn btn-sm btn-success" id="modif" href="modif_encaisement.php?id_vol=<?php echo $result['id_encaisseme'];  ?>" >Modifier</a></button>
                              	<a href="envoi_facture1.php?id=<?php echo $result['numero_Facture']; ?>&dev=<?php echo $result['id_devis']; ?>">
                                <i class=" btn fa fa-envelope-square" style="font-size:25px;" ></i></a>
                                   <a target="new" href="../pages/TCPDF-master/examples/facturePDF2.php?id=<?php echo $result['numero_Facture']; ?>&dev=<?php echo $result['id_deviss']; ?>&en=<?php echo $result['id_encaisseme']; ?>">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                              


                      
                              </td>
<?php	} }?>
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

	mysqli_close($con);
		}
		catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}

?>
