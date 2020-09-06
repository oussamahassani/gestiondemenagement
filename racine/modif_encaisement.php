<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php require_once"inc/header.php"; ?>
<!--================================= header End -->
<style>
.inputa {
    
  margin-top: 0.5em;margin-left:4em;
  
}
.inputt {
  margin-left:1em;
  margin-top: 0.5em;
  font-weight: bold;
  color:blue;
}
.dataTables_filter{
      visibility:hidden;
}
</style>
<!--================================= Main content -->
 
<!-- Left Sidebar End -->
<?php require_once"inc/menu.php"; ?>
<!--================================= Main content -->

<!--================================= wrapper -->
<div class="content-wrapper">
  <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
       
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">categorie</a></li>
              <li class="breadcrumb-item active">Modification</li>
            </ol>
          </div>
		   
        </div>
  </div>
 <!-- main body -->
 <?php require_once '../connect.php';			 ?>
 
 <div class="row">   
 
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
	
          <div class="card-body">
<form id="form" action="inc/insert_modif_encaisement1.php" enctype="multipart/form-data" method="post" class="validateform" name="myForm" >
<!--$id=$_GET['id_vol'];-->
<?php
/*
$req=mysql_query("select * from categorie where id_catego=1 ");
if($result=mysql_fetch_array($req))
{		*/		
?>

	<?php
$id = $_GET['id_vol'];
$req=mysql_query("SELECT *,ts.valeur as type_presentation ,c.nom as nomc,encaissement.date_creation as datec  FROM encaissement  LEFT JOIN   devis ON encaissement.id_devis = devis.id_devis
	     LEFT JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN  client c on demande.id_client =c.id_client
         LEFT JOIN masterParametreValeur  ts ON demande.id_type =	ts.id
		 INNER JOIN  facturation  ON facturation.id = encaissement.id  where encaissement.id_encaissement = $id ");
if($result=mysql_fetch_array($req))
{
	 

	   $req3 ="SELECT SUM(montant) as montant FROM facturation  where id_encaisseme = $id";
	   $requete3 = mysql_query($req3) or die( mysql_error() ) ;
	   $row = mysql_fetch_assoc($requete3 );
        $reulta = $row['montant'];
		$rest = $result['Prix_ttc'] - $reulta ;
		
		
?>	
<section>

<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations Générales
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
  <div class="form-row" id="infogenerales">
<div class="">  
       
       <?php 
$id_devis=$result['id_devis'];
 $req1="SELECT id_demande FROM devis where id_devis = $id_devis  ";
	 $requete1 = mysql_query($req1) or die( mysql_error()) ;
	 $row1 = mysql_fetch_assoc($requete1 );
			$id_demande =  $row1['id_demande'];
?>  
		     <div class=" bg-light">
              
                <span class="inputa" >N° encaissement:</span> <span class="inputt" > <?php  echo $result['id_encaissement'];  ?> </span>      
					<input type="hidden" value="<?php echo $result['id_encaissement'];  ?>"size="5"  name="num_encaisement" id="num_encaisement"  style="margin-left:1em;"  />			

	<span class="inputa">Type de presentation:</span><span class="inputt" > <?php  echo $result['type_presentation'];  ?> </span> 
					<input type="hidden" value="<?php  echo $result['type_presentation']; ?>" size="10" name="type_presentation" id="type_presentation" style="margin-left:1em;"  />			
<span  class="inputa">Date de création:</span><span class="inputt" > <?php  echo $result['datec'];  ?> </span> 
					<input type="hidden" value="<?php  echo $result['datec'];?>" size="10" name="date_creation" id="date_creation"  class="inputa"  />			
<span  class="inputa" >User:</span><span class="inputt" > <?php  echo $_SESSION['nom_com'];  ?> </span>
					<input type="hidden" value="<?php echo $_SESSION['nom_com'];?>" size="20" name="user" id="user" class="inputa" class="inputa" />			
		 
<div class="row" style="margin-left:13em;margin-top:1em">
<input type="hidden" value="<?php echo $id_devis;?>" size="20" name="id_devis" id="id_devis" class="inputa" class="inputa" />
		<span class=" " style="margin-top: 0.5em;margin-left:1em;margin-right:1em;"><a target="new" href="../pages/TCPDF-master/examples/creerPdfDevisSuperDem.php?id=<?php echo  $id_demande ?>&dev=<?php echo $id_devis ?>"><?php echo 'N° devis :'. $id_devis ?></a></span>
<span  style="margin-top: 0.5em;margin-left:1em;">Total TTC:</span>  <span class="inputt" style="margin-top:0.5em;"> <?php  echo $result['Prix_ttc']; ?> </span>      
				   <input type="hidden" value="<?php  echo $result['Prix_ttc']; ?>" size="15" name="rest"  style="margin-left:1em;"  class="col-sm-2" />

<span class="inputa">Total encaisement:</span><span class="inputt" style="margin-top:0.5em;" ><?php echo $reulta ?> </span>
                   <input type="hidden" value="<?php echo $reulta ?> " placeholder= "" size="15" name="tot_encais"  style="margin-left:1em;"   />			
<span  class="inputa">Reste:</span><span class="inputt" style="margin-top:0.5em;"><?php echo $rest;  ?></span>
				   <input type="hidden" value="<?php echo $rest; ?>" size="15" name="rest"   class="col-sm-2 inputa" />
<br>
</div> <br>
		   </div>
		     <br> 
   <div class="" >			 
		
			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Rappel d&egrave;tails client</strong></p>
		   		  
					
				
                   <div class="form-row justify-content-md-center">   
	
                <span class="inputa">Nom client</span><span class="inputt" style="margin-top:0.5em;"> <?php  echo  $result['nomc'] ;  ?> </span>  
					<input type="hidden" value="<?php echo $result['nomc'] ;?>"  name="Nomclient" id="Nomclient"  class="col-sm-2" />			

		
	<span class="inputa">Total HT devis</span><span class="inputt" style="margin-top:0.5em;"> <?php  echo $result['Prix_ht'];  ?> </span>  
					<input type="hidden" value="<?php echo $result['Prix_ht']; ?> "  name="THT" id="THT" class="col-sm-1" />			
<span  class="inputa">Total TVA devis</span><span class="inputt" style="margin-top:0.5em;"> <?php  echo ( $result['Prix_ttc']-$result['Prix_ht']);  ?> </span>  
					<input type="hidden" value=" <?php echo ( $result['Prix_ttc']-$result['Prix_ht']);?>"  name="TVA" id="TVA"  class="col-sm-1" />			
<span  class="inputa">Total TTC devis</span><span class="inputt" style="margin-top:0.5em;"> <?php  echo $result['Prix_ttc'];  ?> </span>  
					<input type="hidden" value="<?php  echo $result['Prix_ttc'];?>"  name="TTC" id="TTC"  class="col-sm-1" style="margin-right:1em;"/>			

       
		   </br>
		   </div>
		      </br>   
		   </div>
		   <div class=" border border-success" >
		   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Liste encaissement effectué </strong></p>
		  <div id="resultatRecherche">
      <div class="row">   
         <div class="col-xl-12 mb-30">     
            <div class="card card-statistics h-100"> 
               <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead class="">
                           <tr>
                              <th width="">N° facture</th>
                              <th width="">Date action</th>
                              <th width="">User</th>
                              <th width="">Montant </th>
							  <th width="">Type encaissement </th>
							  <th width="">Action </th>
							  <th width="">Dte creation </th>
                             <th> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           
                           $req=mysql_query("select * from facturation where id_encaisseme = $id  ");
                           while($result1=mysql_fetch_array($req)) {
                              // Check relance
                       			
                           ?>
                           <tr>
                              
							
                                  <td><?php echo $result1['numero_Facture']; ?></td>
                             
                               <td> <?php $date_action=$result1['date_action'];
	                                    $a=substr($date_action,0,4);
	                                   $m=substr($date_action,5,2);
		                             $j=substr($date_action,8,2);
	                                 $date_action=$j."-".$m."-".$a;
							            echo  $date_action; ?>  </td>
                               <td> <?php echo $result1['user'];  ?>  </td>
							    <td><?php    echo $result1['montant'];   ?>   </td>
                              <td><?php  echo $result1['type_encaissement'];?> </td> 
                               <td>  <?php echo $result1['action'];?> </td>               
						    <td><?php echo $result1['datee_creat']; ?>  </td>
                                <td>	
                       <a target="new" href="../pages/TCPDF-master/examples/facturePDF2.php?id=<?php echo $result1['numero_Facture']; ?>&dev=<?php echo $result1['id_deviss']; ?>&en=<?php echo $result['id_encaissement']; ?>">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                              
                                 

                                                    
                           </div>              
                              </td>
							   <?php	} ?>
                           </tr>
                   </tbody>
                     </table>                               				 
                  </div>
               </div>  
			   <?php } ?>	
            </div>
         </div> 
      </div> 
   </div> 
		  </div>
		    <div class=" border border-success" >			 
		
			 			   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Encaissement a saisir </strong></p>
		   		  
					    </br>   </br>
				
                   <div class="form-row">   
	
                <span  style="margin-top: 1em; margin-left:3em; margin-right:3em;">Action</span>
					<input type="text"  style=" margin-left:2em;height:30px;"  name="action" id="action"  autocomplete="off"  class="col-sm-10"  />			
              
                   <div class="row" style="margin-top: 3em;margin-left:3em;">  
		
	<span  style="margin-left:1em;margin-right:0.5em;">Date</span>
					<input type="date"  data-date-format="DD-MMMM-YYYY"  name="date" id="Date" class="col" />			
<span  style="margin-left:1em;margin-right:0.5em;">Type encaissement</span>
					<select name="Tencaissement" class="col"  required="required">
 <option value = "-1" selected>S&eacute;l&eacute;ctionnez un Type</option>
  <?php $req5=mysql_query("select * from   masterParametreValeur where idMasterParametre = 12");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }
     
				?> 
     
				
</select>		
<span  style="margin-left:1em;margin-right:0.5em;">Montant</span>
					<input type="number" min="1"  name="montant" id="montant"   autocomplete="off" required="required"/>			
</div>
       
		   </br>
		   </div>
		        </br>
		   </div>

            
			 </section>
         
              </div>
              
              


</div>

<section>
<div class="box box-default">
	</br>
<div class="box-footer">
		    <button type="submit" id="b2" class="btn envoyer btn-info pull-right">valider encaissement</button>
              
             

</div>                  
</div>
                 
</div>
<br>
   
</form>
<?php 
/*
}*/
?>

<div class="form-row">
</div>
</div>
<br><br>
<?php require_once"inc/footer.php"; ?>
</div>
</div>

</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
			<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script>
 <!---->
 	var variable2= <?php echo json_encode($rest); ?>;	
	console.log(variable2);
        // Form validation code will come here.

  $("#b2").click(function(){

         if( document.myForm.action.value == "" ) {
            alert( "STP saisire ton action!" );
            document.myForm.action.focus() ;
            return false;
         }
         if( document.myForm.montant.value > variable2 ||  document.myForm.montant.value == "" )  {
            alert( "STP saisire un montant valide!" );
            document.myForm.montant.focus() ;
            return false;
         }
         if( document.myForm.date.value == "" ) {
      //    ||  document.myForm.calc_vol > 30 ) 
             
            alert( "stp saisire votre date " );
            document.myForm.date.focus() ;
            return false;
         }
         if( document.myForm.Tencaissement.value == "-1" ) {
            alert( "stp saisire votre type d'encaisement !" );
            return false;
         }
         return( true );
      
	  

     });
</script>
<script type = "text/javascript">
var today = new Date();
var dd = today.getDate() + 1;
var dd1 = today.getDate() - 4;
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
 if(dd1<10){
        dd1='0'+dd1
    } 
   
today = yyyy+'-'+mm+'-'+dd;
today1 = yyyy+'-'+mm+'-'+dd1;
document.getElementById("Date").setAttribute("max", today);
document.getElementById("Date").setAttribute("min", today1);
  

   //-->
</script>


<?php
} 
else
{

header('location: index.php');

}?>