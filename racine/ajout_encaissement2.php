
<?php
require_once"inc/footer.php";
require_once '../connect.php';
session_start ();
require_once"inc/header.php";
if (isset($_SESSION['id']) && isset($_SESSION['nom_com']))
{
		$id=$_POST['liste-devis'];
		$id1=$_POST['prestation'];
	   	$today = date("d-m-Y") ;
		 $req1="SELECT id_demande FROM devis where id_devis = $id  ";
		 $requete1 = mysql_query($req1) or die( mysql_error()) ;
	 $row1 = mysql_fetch_assoc($requete1 );
	 	 $id_demande =  $row1['id_demande'];
       // $id=79;
		//$id1=4;
?>

<?php ?>
<script>

 var variable2= <?php echo json_encode($id); ?>;
  var variable1= <?php echo json_encode($id1); ?>;
  var variable3= <?php echo json_encode($today); ?>;

console.log(variable2);
console.log("date de jour" + variable3 + variable1 );



</script>
<!--=================================
 header End-->

<!--=================================
 Main content -->
 <style>

input {

    margin-top: 10px;
}
 </style>

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
         <!--     <h4 class="mb-0">Ajout encaissement </h4>-->
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

 <!--<form  method="post" action=""  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">-->

<form id="fupForm" name="form1" method="post" action="ajout_encaissement21.php">

<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">encaissement
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>

<div class="box-body">
       <?php
	   $req2="SELECT id_encaissement FROM encaissement  ORDER BY id_encaissement DESC LIMIT 1";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$c = mysql_num_rows($requete2);
	   if (mysql_num_rows($requete2))
	   {
	   	$row = mysql_fetch_assoc($requete2);
        $ab = $row['id_encaissement'];

	   $ab+=1;

	   }
	   else
	   {
	$ab=1;}
	  ?>

	   <?php
	   $req="SELECT *,ts.valeur as type_presentation ,c.nom as nomc  FROM devis  INNER JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN client c on demande.id_client =c.id_client
         LEFT JOIN masterParametreValeur ts ON demande.id_type =ts.id
		  where  devis.id_devis = $id and  demande.id_type=$id1 ";
	$req = mysql_query($req) or die( mysql_error()) ;
while($result=mysql_fetch_array($req)) {
	$type=$result['type_presentation'];
	$nom=$result['nomc'];
	$prixttc=$result['Prix_ttc'];
	$prixht=$result['Prix_ht'];
	$montant_paye=$result['montant_paye'];
	$devis=$result['id_devis'];
	
	$tva  = $prixttc   - $prixht;
	$tva1= $tva - intval($tva);
}  // $tva1 = $tva1*100;
  // $var = explode (",", "202500,0987654321")
	?>
<script>
 var variable4 = <?php echo json_encode($ab);?>;
 var variable3= <?php echo json_encode($type); ?>;
 var variable5= <?php echo json_encode($nom); ?>;

console.log("type : " + variable3);
console.log("Cycle actuel  encaisment est : " +  variable4);
console.log("nom client  est : " +  variable5);
</script>
		  <section>
		   <fieldset>
		     <div class="form-row bginfo">
<input name="id_type" id="id_type" value="<?php echo  $type;?>"  type="hidden" class="form-control" >
<input name="id_devi" id="id_devi" value="<?php echo $id;?>"  type="hidden" class="form-control" >
<input name="id_enc"  id="id_enc" value="<?php echo $ab;?>"  type="hidden" class="form-control" >
<input name="id_user" id="id_user"value="<?php  echo $_SESSION['nom_com'];?>"  type="hidden" class="form-control" >
<div class="row" style="margin-left:1em;">
                <span   style="margin-top: 1em;margin-right:1em;">N&ordm; enc</span>

					 <input disabled  type="text" value="<?php echo $ab ?>" size="3" name="num_encaisement" id="num_encaisement"   required="required"/>

 <span   style="margin-top: 1em;margin-right:1em;margin-left:1em;">N&ordm; devis</span>

<span class=" " style="margin-top: 1em;margin-left:0.2em;margin-right:0.5em;"><a target="new" href="../pages/TCPDF-master/examples/creerPdfDevisSuperDem.php?id=<?php echo  $id_demande; ?>&dev=<?php echo $id; ?>"><?php echo $id ?></a></span>

	<span  style="margin-top: 1em;margin-right:1em;margin-left:1em;">Type de presentation</span>
					<input disabled  type="text" value="<?php echo $type?>" size="20" name="type_presentation" id="type_presentation" required="required" />

<span  style="margin-top: 1em;margin-right:1em;margin-left:1em;">Date de creation</span>
                  <input type="texte" name = "date_creation" size="10"  id="calendrierr" value="<?php echo date('d-m-Y'); ?>" disabled />
				  <input name="dat_cerat" id ="dat_cerat" value="<?php  echo date('d-m-Y');?>"  type="hidden" class="form-control" >

					<span class="" style="margin-top: 1em;margin-right:1em;margin-left:1em;">User: </span>
						 <input disabled  type="text" value=" <?php echo $_SESSION['nom_com'] ?>" size="10" name="user" id="user" required="required"  />

            </div>
		   </div>

	</br>
   <div class=" border border-success" >

			 			   	<p class="text-white p-3 mb-2 bg-dark" style="text-align: center;"><strong>Rappel d&egrave;tails client</strong></p>

					    </br>   </br>

                   <div class="row justify-content-md-center">

                <span  style="margin-top: 1em; margin-left:1em; margin-right:1em;">Nom client</span>
					<input type="text" value=" <?php echo $nom ?>"  name="Nomclient" id="Nomclient"  class="col-sm-2" disabled />
                            <input name="Nomclienth" value="<?php echo  $nom?>"  type="hidden" class="form-control" >
	<span style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total HT devis</span>
					<input type="text" value="<?php echo $prixht?>"  name="THT" id="THT" class="col-sm-1"  disabled />
					<input name="hth" value="<?php echo $prixht;?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TVA devis</span>
					<input type="text" value="<?php echo $tva?>"  name="TVA" id="TVA"  class="col-sm-1" disabled />
                    <input name="tvah" value="<?php echo $tva;?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TTC devis</span>
                         <input name="ttch" id="ttch" value="<?php echo $prixttc;?>"  type="hidden" class="form-control" >
					<input type="text" value=" <?php echo $prixttc;?>"  name="TTC" id="TTC"  class="col-sm-1" style="margin-right:1em;" disabled />


		   </br>
		   </div>
		      </br>   </br>   </br>
		   </div>
		    <div class=" border border-success" >

			 			   	<p class="text-white p-3 mb-2 bg-dark" style="text-align: center;"><strong>Facture a saisir </strong></p>

					    </br>   </br>

                   <div class="form-row">

                <span class="col-sm-3" style="margin-top: 1em; margin-left:3em; margin-right:2em;">Action</span>
					<input type="text" value=""  name="action" id="action"  class="col-sm-8" required="required" autocomplete="off"/>


	<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Date</span>
					<input type="date" value=""  name="date_action" min='1899-01-01' max='2000-13-13' id="Date" class="col-sm-2" required="required"/>
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Type encaissement</span>
					<select  style="margin-top: 1em;" name="Tencaissement" id="Tencaissement" style="height:50px;" class=" select2 col-md-3" required="required" >
 <option value = "-1" selected>S&eacute;l&eacute;ctionnez un Type</option>
  <?php $req5=mysql_query("select * from  masterParametreValeur where idMasterParametre = 12");
         while($result5=mysql_fetch_array($req5))
       { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }

				?>
</select>
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Montant</span>
					<input type="number" value=""  name="montant" id="montant"  class="col-sm-2" style="margin-right:1em;" autocomplete="off" required="required"/>



		   </br>
		   </div>
		      </br>
		   </div>
			   </br>
		    <button type="submit" id="btnRechercher" class="btn envoyer btn-info pull-right">Valider facturation</button>

			 </fieldset>
			<section>

      </form>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
			<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<script>
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
$('form').submit(function (e) {
    var form = this;
    e.preventDefault();
    setTimeout(function () {
        form.submit();
    }, 1000); // in milliseconds
    
    $("<p>Delay...</p>").appendTo("body");
});

function loadresultatRecherche() {
  //alert("Image is loaded");
   //alert("Image is loaded");
	var action 			   = $("#action").val();
	var  id_enc            = $("#id_enc").val();
	var id_devi            =$("#id_devi").val();
	var  dat_cerat         = $("#dat_cerat").val();
	var	date_action	       = $("#Date").val();
	var	Tencaissement   	= $("#Tencaissement").val();
	var	montant             = $("#montant").val();
	var id_user             = $("#id_user").val();
	var id_type             = $("#id_type").val();
	var ttch                 =$("#ttch").val();
    //alert(data);



console.log("date_creation : " + dat_cerat );
console.log("date_action : " +  date_action);
	if (action!="" && date_action!="" && montant!="" && Tencaissement!=""){
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/insererfacturation.php",
		   data: {
	 					action 		     	   : action,
	 					id_enc             : id_enc,
	 					dat_cerat 	   :dat_cerat,
	 					date_action	 	     :date_action,
	 					Tencaissement      : Tencaissement,
	 					montant            : montant,
	 					id_user            : 	id_user ,
						id_devi             :  id_devi,
						id_type             : id_type,
	 					ttch                : ttch,
							},
        beforeSend : function(){ 
							$("#resultatRecherche").html('<img src="images/pre-loader/loader-01.svg" style="padding-top:50px; margin-left:45%;" alt="" border="0">'); 
						},
		   error : function(){alert(unescape('Erreur de chargement!')); return false; },
		   success : function(response){
			    
				
					$('#success').html("Vos données seront sauvegardées");

					 $('#fupForm').find('input:text').val('');
					 $("#success").show();
					 $('#success').html('Data added successfully !');
			}
	
     });
 
}
	else{
			alert('remplire tout les champs!');
		}
}

$("#btnRechercher").click(function(){
  loadresultatRecherche();
     });


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




<?php
}
else
{

header('location: index.php');

}?>
