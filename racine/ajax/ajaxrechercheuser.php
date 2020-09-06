<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
              $nom=$_POST['Nom'];
              $Surnom=$_POST['Surnom'];
			  $telphone=$_POST['M_fact'];
              $Mobile=$_POST['Mobile'];
			  $Statut=$_POST['source'];
            try {

		$nom				= (!empty($nom)) ? " AND nom LIKE '%$nom%'": "";
		$Surnom 		= (!empty($Surnom)) ? " AND surnom LIKE '%$Surnom%'": "";
		$telphone		= (!empty($telphone)) ? " AND tel = $telphone": "";
		$Mobile			= (!empty($Mobile)) ? " AND telMobile = $Mobile": "";
		$Statut 		= ($Statut!=-1) ? " AND actif = $Statut": "";
		?>
		<script>

 var variable2= <?php echo json_encode($Statut); ?>;

 var variable1= <?php echo json_encode($Mobile); ?>;
console.log("source" + variable1);
console.log("source" + variable2);



</script>
<?php
require_once '../../db.php';
$req=mysqli_query($con,"select *,m.valeur AS typeUtilisateur from utilisateur INNER JOIN masterParametreValeur m ON m.id=id_type where 1 $nom $Surnom $telphone $Mobile	$Statut
order by id_utilisateur asc");

if ($req) {
	
	
?>

<div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
          
                       <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
                      <th>Id</th>
                      <th>Type</th>
                      <th>Utilisateur</th>
                      <th>Statut</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Poste</th>
                      <th></th>
                    </tr>
              </thead>
			  <?php while($result=mysqli_fetch_array($req)) {
				  ?>
              <tbody>
             
                  <tr>
                      <td><?php echo $result['id_utilisateur'];?></td>
                      <td><?php
                   echo $result['typeUtilisateur']; 
                    ?></td>
                     <td><?php
                  echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                  ?></td>
                   <td><?php $Actif = $result['actif'];
                    if ($Actif =='1')
                    $Actif ='Actif';
                    else
                    $Actif ='Inactif';
                    echo $Actif;
                   
                  ?></td>
                      <td> <?php    echo $result['email'];?></td>
                      <td> <?php    echo 'Tel : '.$result['tel']." <br> Tel mobile : ".$result['telMobile'];?></td>
                      <td> <?php    echo $result['poste'];?></td>
                  <td>
                  <?php
 if ($_SESSION['id_type']!="17")
 {
   echo("");
 }
 else{
?>
                  <a href="modif_utilisateur.php?id_utilisateur=<?php echo $result['id_utilisateur']; ?>"><i  class="fa fa-pencil"></i></a>


 <!---<br> <a href="#"  onClick="confirme('<?php echo $result['id_utilisateur']; ?>')">
    <i  class="fa fa-trash-o text-danger"></i></a> !--->
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
	<?php
}
	mysqli_close($con);
		} 
		catch (exception $e) {
		echo $e->getMessage() , "\n";
		echo $e->getLine();
	}
}
?>