<div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
          
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
                      <th >N° </th>
                              <th width="25%">Image</th>
                              <th width="20%">Nom</th>
                              <th width="15%">Volume</th>
							   <th width="15%">Categorie</th>
                              <th></th>
              </thead>
              <tbody>
              <?php
              $nomarticle=$_POST['nom_art'];
              $nomcat=$_POST['source'];
            try {

		$nomcat				= (!empty($nomcat)) ? " AND volume.id_catego = $nomcat": "";
		$nomarticle 		= (!empty($nomarticle)) ? " AND nom_vol LIKE '%$nomarticle%'": "";
require_once '../../db.php';
$query_search = "select * from volume  where 1 $nomcat $nomarticle order by volume.id_vol";
$req = mysqli_query($con, $query_search);

if ($req) {
                           while($result=mysqli_fetch_array($req)) {
                              // Check relance
                       			
                           ?>
                           <tr>
                              <td><?php echo $result['id_vol']; ?></td>
                              <td>
                                 <?php 
                                    echo '<img src="'.$result['image'].'" alt="image volume" height="42" width="42">';
                                    
                                 ?> 
                              </td>
                              
                              <td>
                                 <?php  
                                    echo $result['nom_vol'];
                                    
                                 ?> 
                              </td>
                              <td>
                                 <?php 
                                  echo $result['calc_vol'];                        
						   ?>  
                               <td>
                                 <?php echo $result['category']; ?> 
                                                                                                                                                             
                              </td>						   
                              </td>
                              <td>
                                 <button type="button" class=" col text-center btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                 <div class="dropdown-menu">
                                 <a class="dropdown-item btn btn-warning" id="envoiParisEco" href="modif_volume.php?id_vol=<?php echo $result['id_vol']; ?>" >Modifier</a>
						   <a class="dropdown-item btn-danger" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_vol']; ?>)" >Supprimer</a>
                                                    
                           </div>              
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
	<?php
		
	mysqli_close($con);
		} 
		catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
	
?>