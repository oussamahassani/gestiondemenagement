<?php
session_start ();
require_once"inc/footer.php";
require_once '../connect.php';
require_once"inc/header.php";
if (isset($_SESSION['id']) && isset($_SESSION['nom_com']))
{

	$idd	            			= $_POST['id_enc'];
	$type_prestation				= $_POST['id_type'];
	$id_devis         		  = $_POST['id_devi'];
	$date_1                 = $_POST['dat_cerat'];
	$userr_creat				  	= $_POST['id_user'];

  $Nomclienth				       = $_POST['Nomclienth'];
	$hth         		         = $_POST['hth'];
	$tvah   				         = $_POST['tvah'];
	$ttch					           = $_POST['ttch'];

	$montant            	     	= $_POST['montant'];
	$type_encaissement          = $_POST['Tencaissement'];
	$date_action                = $_POST['date_action'];
	$action                     = $_POST['action'];
    $totalttc                   = $_POST['ttch'];                 
   $req1="SELECT id_demande FROM devis where id_devis = $id_devis  ";
	 $requete1 = mysqli_query($con,$req1) or die( mysqli_error($con)) ;
	 $row1 = mysqli_fetch_assoc($requete1 );
			$id_demande =  $row1['id_demande'];
	 /*$req2="SELECT valeur FROM masterParametreValeur where id = $type_encaissement  ";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$row = mysql_fetch_assoc($requete2 );
    $type_encaissement =  $row['valeur'];

$req2="SELECT 	id FROM facturation ORDER BY id DESC LIMIT 1";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$c = mysql_num_rows($requete2);
	   if (mysql_num_rows($requete2))
	   {
	   	$row = mysql_fetch_assoc($requete2);
        $ab = $row['id'];
	   $ab+=1;
	   	}
	   else
	   {
	$ab=1;}
	 if (isset($action)!= "" && isset($date_1)!= ""  && isset($date_action)!= ""  && isset($type_encaissement)!= ""  && isset($montant)!= ""  && isset($userr_creat)!= "" )
	{

    $numfact = $idd.'-'.$ab ;
	$req21="insert into facturation (id,numero_Facture,date_action,datee_creat,montant,user,action,type_encaissement,id_encaisseme) values ('$ab','$numfact','$date_action','$date_1','$montant','$userr_creat','$action','$type_encaissement','$idd')";

$requete = mysql_query($req21) or die( mysql_error() ) ;
if($requete)
  {


	echo '<center><div form-row> <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
           	</div></div>';
			echo '</center>' ;

  }
  else
  {
    echo("L'insertion à échouée") ;
  }

	}
*/
?>

<?php ?>

<!--=================================
 header End-->

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
<?php require_once"inc/menu.php"; ?>


<!--=================================
 Main content -->
<script>
 var variable2= <?php echo json_encode($idd); ?>;
 var variable3= <?php echo json_encode($date_1); ?>;
 var variable4= <?php echo json_encode($tvah); ?>;
 var variable5= <?php echo json_encode($ttch); ?>;
console.log(variable2);
console.log("num encaissement" + variable3);
console.log(variable4);
console.log("ttc" + variable5);


</script>
 <!--=================================
wrapper -->

  <div class="content-wrapper">

  <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
            <!--  <h4 class="mb-0">Ajout encaissement </h4>-->
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


<!--=================================
 wrapper -->

<!-- <form  method="post" action="inc/add_encaissement.php"  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">-->
<form name="myForm" onsubmit="return validate()" method="post" action="inc/add_encaissement.php"  enctype="multipart/form-data">

<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">encaissement
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>

<div class="box-body">
       <?php

	   $req3 ="SELECT SUM(montant) as montant FROM facturation  where id_encaisseme = $idd";
	   $requete3 = mysql_query($req3) or die( mysql_error() ) ;
	   $row = mysql_fetch_assoc($requete3 );
        $reulta = $row['montant'];
		$rest = $ttch - $reulta ;
		
		?>

		  <section>
		   <fieldset>
		     <div class="form-row bginfo">


                <span  class="" style="margin-top: 1em; margin-left:4em;margin-right:1em">N  encaissement </span >
			     <input name="num_encaisement1" value="<?php echo $idd  ?>"  type="hidden" class="form-control" >
					<input type="text" value="<?php echo $idd ?>" size="05" name="num_encaisement" id="num_encaisement" disabled  />
	            <span class=" " style="margin-top: 1em;margin-left:1em;margin-right:1em;">Type de prestation</span>
				<input name="type_presentation1" value="<?php echo $type_prestation ?>"  type="hidden" class="form-control" >
	  				<input type="text" value="<?php echo $type_prestation?>" size="20" name="type_presentation" id="type_presentation" disabled />

						<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Date de creation</span>
							 <input name="date_creation1" value="<?php echo $date_1 ?>"  type="hidden" class="form-control" >
			 <input type="text" value="<?php echo $date_1 ?>" placeholder= "" size="15" name="date_creation" id="date_creation" disabled />
						<span class=" " style="margin-top: 1em;margin-left:1em;;margin-right:1em;">User</span>
			<input name="user1" value="<?php echo $userr_creat?>"  type="hidden" class="form-control" >
				<input type="text" value="<?php echo $userr_creat?>" size="08" name="user" id="user" disabled  />
 <br> <br>
		<div class="row" style="margin-left:10em;margin-top:1em">
		<span class=" " style="margin-top: 1em;margin-left:1em;margin-right:1em;"><a target="new" href="../pages/TCPDF-master/examples/creerPdfDevisSuperDem.php?id=<?php echo  $id_demande ?>&dev=<?php echo  $id_devis ?>"><?php echo 'Num devis :'. $id_devis ?></a></span>
		<span class=" " style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TTC</span>
			<input type="text" value="<?php echo $totalttc ?>" size="08" name="totalttc" id="totalttc" disabled />
		<span class=" " style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total encaisement</span>
		<input name="tot_encais1" value="<?php echo $reulta ?>"  type="hidden" class="form-control" >
    <input type="text" value="<?php echo $reulta ?>" placeholder= "" size="08" name="tot_encais"   disabled />
     <span  style="margin-top: 1em;margin-left:1em;;margin-right:1em;">Reste</span>
		<input name="rest1" value="<?php echo $rest  ?>"  type="hidden" class="form-control" >
		 <input type="text" value="<?php echo $rest  ?>" size="10" name="rest"    disabled />
       <input name="num_iddevis" value="<?php echo $id_devis ;?>"  type="hidden" class="form-control" >
      </div>
		   </div>
		     </br></br>

   <div class=" border border-success" >

			 			   	<p class="text-black p-3 mb-2 bg-light" style="text-align: center;"><strong>Rappel d&egrave;tails client</strong></p>

					    </br>   </br>

                   <div class="row justify-content-md-center">

                <span  style="margin-top: 1em; margin-left:1em; margin-right:1em">Nom client</span>
					<input type="text" value=" <?php echo $Nomclienth?>"  name="Nomclient" id="Nomclient"  class="col-sm-2" disabled  />


	<span style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total HT devis</span>
					<input type="text" value="<?php echo $hth?>"  name="THT" id="THT" class="col-sm-1"disabled   />
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TVA devis</span>
					<input type="text" value="<?php echo $tvah ?>"  name="TVA" id="TVA"  class="col-sm-1" disabled />
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TTC devis</span>
					<input type="text" value=" <?php echo $ttch ?>"  name="TTC" id="TTC"  class="col-sm-1" style="margin-right:1em;" disabled />


		   </br>
		   </div>
		      </br>   </br>   </br>
		   </div>

<div>
  <div class=" border border-success" >
		   	<p class="text-dark p-3 mb-2 bg-light" style="text-align: center;"><strong>Liste encaissement effectue </strong></p>
		  <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0" style="font-family:Poppins,sans-serif;
    font-size:0.95rem;">
                        <thead class="">
                           <tr>
                              <th width="7%">N facture</th>
                              <th width="12%">Date action</th>
                              <th width="15%">User </th>
                              <th width="10%">Montant</th>
							   <th width="20%">Type encaisement</th>
							   <th width="15%">Action</th>
							    <th width="15%">date creation</th>
                            <th width="10%"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           
                           $req=mysql_query("select * from facturation where id_encaisseme = $idd");
                           while($result=mysql_fetch_array($req)) {
                              // Check relance

                           ?>
                           <tr>
                              <td><?php echo $result['numero_Facture']; ?></td>
                              <td>
                                 <?php
								   $date_action=$result['date_action'];
	                                    $a=substr($date_action,0,4);
	                                   $m=substr($date_action,5,2);
		                             $j=substr($date_action,8,2);
	                                 $date_action=$j."-".$m."-".$a;
                                    echo  $date_action;

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
                                 <?php echo $result['datee_creat']; ?>



                              </td>
							   <td>

									 <a target="new" href="../pages/TCPDF-master/examples/facturePDF2.php?id=<?php echo $result['numero_Facture']; ?>&dev=<?php echo $id_devis; ?>&en=<?php echo $idd ; ?>">
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


		    <div class=" border border-success" >

			 			   	<p class="text-white p-3 mb-2 bg-dark" style="text-align: center;"><strong>Encaissement a saisir </strong></p>

					    </br>   </br>

                   <div class="form-row">

                <span class="col-sm-1" style="margin-top: 1em; margin-left:3em; margin-right:2em;">Action</span>
					<input type="text"  name="action" id="action"  class="col-sm-8" autocomplete="off" required="required"/>
 <div class="row" style="margin-left:3em">

	<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Date</span>
					<input type="date"   name="date_action" id="Date" min='1899-01-01' max='2000-13-13' class="sm-2" required="required"/>
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Type encaissement</span>
					<select  style="margin-top: 1em;" name="Tencaissement" id="Tencaissement" style="height:50px;" class=" select2 col" required="required"  >
 <option value = "-1" selected>S&eacute;l&eacute;ctionnez un Type</option>
  <?php $req5=mysql_query("select * from  masterParametreValeur where idMasterParametre = 12");
         while($result5=mysql_fetch_array($req5))
       { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }

				?>
</select>
			
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Montant</span>
					<input type="number"   name="montant" id="montant"  min="1" class="col-sm-2" style="margin-right:1em;" autocomplete="off" required="required"/>

 </div>

		   </br>
		   </div>
		      </br>
		   </div>
		    </br>
		    <button type="submit" id="b2" class="btn envoyer btn-info pull-right">valider facturation</button>

			 </fieldset>
			<section>

      </form>
<script>
 <!---->
        // Form validation code will come here.

 var variable5= <?php echo json_encode($rest); ?>;
console.log(variable5);
  $("#b2").click(function(){

         if( document.myForm.action.value == "" ) {
            alert( "STP saisire ton action!" );
            document.myForm.action.focus() ;
            return false;
         }
         if( document.myForm.montant.value == "" ||  document.myForm.montant.value  > variable5  ) {
            alert( "STP saisire votre montant!" );
            document.myForm.montant.focus() ;
            return false;
         }
         if( document.myForm.date_action.value == "" )
      //    ||  document.myForm.calc_vol > 30 ) 
              {
            alert( "stp saisire votre date"  );
            document.myForm.date_action.focus() ;
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
