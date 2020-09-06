<?php
session_start (); 
 require_once '../connect.php';	
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 

	$id 	            			= $_POST['num_encaisement'];
	$type_prestation				= $_POST['type_presentation'];
	$id_devis         		     	= $_POST['id_devi'];
	$date_creation   				= $_POST['id_dev'];
	$userr_creat					= $_POST['user'];

	$montant            	     	= $_POST['montant'];
	$type_encaissement              = $_POST['Tencaissement'];
	$date_action                    = $_POST['date_action'];
	$action                         = $_POST['action'];
	
	
	$req2="SELECT valeur FROM masterparametrevaleur where id = $type_encaissement  ";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$row = mysql_fetch_assoc($requete2 );
    $type_encaissement =  $row['valeur'];
	                                         
	
	 if (isset($action)!= "" && isset($date_action)!= ""  && isset($type_encaissement)!= ""  && isset($montant)!= ""  && isset($userr_creat)!= "" )
	{
		$ab =05;
    $numfact = $id.'*'.$ab ;
	$req21="insert into facturation (id,numero_Facture,date_action,date_creation_facture,montant,user,action,type_encaissement) values ('$id','$numfact','$date_action','$date_creation','$montant','$userr_creat','$action','$type_encaissement')";
	
$requete = mysql_query($req21) or die( mysql_error() ) ;
if($requete)
  {
    echo("L'insertion a été correctement effectuée");
	
	echo ' <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
        <a class="close" href="../racine/liste_volume.php">&times;</a>
           	</div>';
			echo '</div>' ;
	 
  }
  else
  {
    echo("L'insertion à échouée") ;
  }

	}
	
	
?>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php require_once"inc/header.php"; ?>
<!--=================================
 header End-->
<script> 
 var variable1 = <?php echo json_encode($numfact);?>;
 var variable2= <?php echo json_encode($date_action); ?>;
  var variable3= <?php echo json_encode($date_creation); ?>;

console.log(variable1);
console.log(variable2);
console.log(variable3);



</script>
<!--=================================
 Main content -->
 <style>
 label {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 18px;
    color: #333;
    height: 20px;
    width: 200px;
    margin-top: 10px;
    margin-left: 10px;
    text-align: right;
    margin-right:15px;
    float:left;
}
input {
    
    margin-top: 10px;
}
 </style>
 
<!-- Left Sidebar End -->



<!--=================================
 Main content -->

 <!--=================================
wrapper -->

  <div class="content-wrapper">

  <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Ajout encaissement </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">encaissement</a></li>
              <li class="breadcrumb-item active">Ajout</li>
            </ol>
          </div>
        </div>
    </div>

 <!-- main body -->
		 
<?php require_once"inc/menu.php"; ?>
<!--=================================
 wrapper -->
 
 <form  method="post" action="ajout_encaissement3"  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">
 <div class="box-body">
 
      
		     <div class=" bg-light">
              
                <span >N° encaissement*</span>
					<input type="text" value=""size="5"  name="num_encaisement" id="num_encaisement"  style="margin-left:1em;"  />			
	
	<span style="margin-top: 1em;margin-left:1em;">Type de presentation</span>
					<input type="text" value="" size="10" name="type_presentation" id="type_presentation" style="margin-left:1em;"  />			
<span  style="margin-top: 1em;margin-left:1em;">Date de création</span>
					<input type="text" value="" size="10" name="date_creation" id="date_creation"  style="margin-left:1em;"  />			
<span  style="margin-top: 1em;margin-left:1em;" >User</span>
					<input type="text" value="" size="20" name="user" id="user"  class="inputa" />			
		 
		   </div>
		     </br> 
   <div class=" bg-light" >			 
		
			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Rapelle detaille client </strong></p>
		   		  
					
				
                   <div class="">   
	
                <span  style="margin-top: 0.5em; margin-left:1em; margin-right:5px;">Nom client</span>
					<input type="text" value=""  name="Nomclient" id="Nomclient"  />			

		
	<span style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total HT devis</span>
					<input type="text" value=""  name="THT" id="THT"  />			
<span  style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total TVA devis</span>
					<input type="text" value=""  name="TVA" id="TVA"   />			
<span  style="margin-top: 0.5em;margin-left:1em;margin-right:1em;">Total TTC devis</span>
					<input type="text" value=""  name="TTC" id="TTC"  style="margin-right:1em;"/>			

       
		   </br>
		   </div>
		      </br>   
		   </div>
		   <div class=" border border-success" >
		   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Liste encaissement effectué </strong></p>
		  <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead class="table-dark">
                           <tr>
                              <th width="7%">N° facture</th>
                              <th width="10%">Date action</th>
                              <th width="8%">User </th>
                              <th width="10%">Montant</th>
							   <th width="10%">Type encaisement</th>
							   <th width="10%">Action</th>
							    <th width="15%">date creation</th>
                            
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $id_client_B2B=$_SESSION['id_client_B2B'];
                           $req=mysql_query("select * from facturation
");
                           while($result=mysql_fetch_array($req)) {
                              // Check relance
                       			
                           ?>
                           <tr>
                              <td><?php echo $result['numero_Facture']; ?></td>
                              <td>
                                 <?php 
                                    echo $result['date_action'];
                                    
                                 ?> 
                              </td>
                              
                              <td>
                                 <?php  
                                    echo $result['user'];
                                    
                                 ?> 
                              </td>
                              <td>
                                 <?php 
                                  echo $result['montant'];                        
						   ?>  
                               </td>
							    <td>	
                                 <?php echo $result['type_encaissement']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							    <td>	
                                 <?php echo $result['action']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							      <td>	
                                 <?php echo $result['date_creation_facture']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							   <td>	
                                  
                      <a target="new" href="../pages/TCPDF-master/examples/visite.php?dem=">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                              
                                 

                                                    
                           </div>              
                              </td>
							   <?php	} ?>
                           </tr>
                   </tbody>
                     </table>                               				 
                  </div>
               </div>   
			 
   </div> 
		  </div>
		    <div class=" border border-success" >			 
		
			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Encaissement a saisir </strong></p>
		   		  
					    </br>   </br>
				
                   <div class="form-row">   
	
                <span  style="margin-top: 1em; margin-left:3em; margin-right:3em;">Action</span>
					<input type="text"  style=" margin-left:2em;"  name="action" id="action"  class="col-sm-8" />			
              
		
	<span class="col-sm-2" style="margin-top: 3em;margin-left:1em;margin-right:1em;">Date</span>
					<input type="text" value=""  name="date" id="Date" class="col-sm-1 inputa" />			
<span  style="margin-top: 3em;margin-left:1em;margin-right:1em;">Type encaissement</span>
					<select name="Tencaissement" class="form-control select2 col-md-3 inputa"  required="required">
 <option value = "-1" selected>[choose yours]</option>
  <?php $req5=mysql_query("select * from  categorie");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_catego']."'>".$result5['Nomcategorie']." </option>"; }
     
				?> 
</select>		
<span  style="margin-top: 3em;margin-left:1em;margin-right:1em;">montant</span>
					<input type="text"   name="montant" id="montant"  class="col-sm-1 inputa" style="margin-right:1em;"/>			

       
		   </br>
		   </div>
		        </br>
		   </div>
		    <button type="submit" id="b2" class="btn envoyer btn-info pull-right">valider encaissement</button>
            
			 </fieldset>
          <input   value="<?php

echo $result['Nomcategorie'];?>" name="nom_cat"  type="text" class="form-control" id="exampleInputEmail1"  >
            
</form>
			</div>
              
              


</div>

<script type="text/javascript">
function rsfp_showProgress_11(page) {
if (page == 0) document.getElementById('progress').innerHTML = '<div><div class="uk-progress"><div class="uk-progress-bar" style="width: 25%"><em>Page <strong>1</strong> de 4</em></div></div></div>';if (page == 1) document.getElementById('progress').innerHTML = '<div><div class="uk-progress"><div class="uk-progress-bar" style="width: 50%"><em>Page <strong>2</strong> de 4</em></div></div></div>';if (page == 2) document.getElementById('progress').innerHTML = '<div><div class="uk-progress"><div class="uk-progress-bar" style="width: 75%"><em>Page <strong>3</strong> de 4</em></div></div></div>';if (page == 3) document.getElementById('progress').innerHTML = '<div><div class="uk-progress"><div class="uk-progress-bar" style="width: 100%"><em>Page <strong>4</strong> de 4</em></div></div></div>';
} 
</script>
 <script type="text/javascript">
   var nbclic=0  // Initialisation à 0 du nombre de clic
   function CompteClic() { // Fonction appelée par le bouton
      
	  console.log("waaw)");
   }
</script>
<script type = "text/javascript">

   <!--
        // Form validation code will come here.
      function validate() {
      
         if( document.myForm.Nom_vol.value == "" ) {
            alert( "STP saisire ton nom d'article!" );
            document.myForm.Nom_vol.focus() ;
            return false;
         }
         if( document.myForm.file.value == "" ) {
            alert( "Please provide your Email!" );
            document.myForm.file.focus() ;
            return false;
         }
         if( document.myForm.calc_vol.value == "" || isNaN( document.myForm.calc_vol.value ) ||
            document.myForm.calc_vol.value.length > 3 ) {
            
            alert( "stp saisire un nombre - de 4 valeur" );
            document.myForm.calc_vol.focus() ;
            return false;
         }
         if( document.myForm.source.value == "-1" ) {
            alert( "Please provide your categorie!" );
            return false;
         }
         return( true );
      }
	 
   //-->
</script>
 <?php require_once"inc/footer.php"; ?>



<?php
} 
else
{

header('location: index.php');

}?>