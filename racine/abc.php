<?php
require_once"inc/footer.php";
require_once '../connect.php';
require_once"inc/header.php";





		$id=102;
		$id1=4;
	   	$today = date("d-m-Y") ;

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <div style="padding-top:2em;margin:auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
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

	<form id="fupForm" name="form1" method="post" action="">
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
<script>
 var variable3 = <?php echo json_encode($ab);?>;
 var variable4= <?php echo json_encode($c); ?>;


console.log("Cycle actuel : " + variable3);
console.log("Cycle actuel  c est : " +  variable4);
</script>
	   <?php
	   $req="SELECT *,ts.valeur as type_presentation ,c.nom as nomc  FROM devis  INNER JOIN  demande on demande.id_dem=devis.id_demande
         INNER JOIN client c on demande.id_client =c.id_client
         LEFT JOIN masterParametreValeur ts ON demande.id_type =ts.id
		  where  devis.id_devis = $id  ";
	$req = mysql_query($req) or die( mysql_error()) ;
while($result=mysql_fetch_array($req)) {
	$type=$result['type_presentation'];
	$nom=$result['nomc'];
	$prixttc=$result['Prix_ttc'];
	$prixht=$result['Prix_ht'];
	$montant_paye=$result['montant_paye'];
	$devis=$result['id_devis'];
	$tva  = $prixttc   / $prixht;
	$tva1= $tva - intval($tva);
}  // $tva1 = $tva1*100;
  // $var = explode (",", "202500,0987654321")
	?>

		  <section>
		   <fieldset>
		     <div class="form-row bginfo">
<input name="id_type" value="<?php echo  $type;?>"  type="hidden" class="form-control" >
<input name="id_devi" value="<?php echo $id;?>"  type="hidden" class="form-control" >
<input name="id_enc"  id="id_encc" value="<?php echo $ab;?>"  type="hidden" class="form-control" >
<input name="id_user" id="id_user"value="<?php   ?>"  type="hidden" class="form-control" >
<div class="row" style="margin-left:3em;">
                <span   style="margin-top: 1em;margin-right:1em;">N encaissement</span>

					<input  type="text" value="<?php echo $ab ?>" size="05" name="num_encaisement" id="num_encaisement"   required="required"/>


	<span  style="margin-top: 1em;margin-right:1em;margin-left:1em;">Type de presentation</span>
					<input disabled  type="text" value="<?php echo $type?>" size="20" name="type_presentation" id="type_presentation" required="required" />

<span  style="margin-top: 1em;margin-right:1em;margin-left:1em;">Date de creation</span>
                  <input type="texte" name = "calendrierr" size="15"  id="calendrierr" value="<?php echo date('d-m-Y'); ?>" disabled />
				  <input name="id_dev" value="<?php  echo date('d-m-Y');?>"  type="hidden" class="form-control" >

					<span class="" style="margin-top: 1em;margin-right:1em;margin-left:1em;">User </span>
						 <input disabled  type="text" value=" <?php echo $_SESSION['nom_com'] ?>" size="10" name="user" id="user" required="required"  />

            </div>
		   </div>

	</br>
   <div class=" border border-success" >

			 			   	<p class="text-white p-3 mb-2 bg-dark" style="text-align: center;"><strong>Rapelle detaille client </strong></p>

					    </br>   </br>

                   <div class="form-row">

                <span  style="margin-top: 1em; margin-left:1em; margin-right:5px;">Nom client</span>
					<input type="text" value=" <?php echo $nom ?>"  name="Nomclient" id="Nomclient"  class="col-sm-2" disabled />
                            <input name="Nomclienth" value="<?php echo  $nom?>"  type="hidden" class="form-control" >
	<span style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total HT devis</span>
					<input type="text" value="<?php echo $prixht?>"  name="THT" id="THT" class="col-sm-1"  disabled />
					<input name="hth" value="<?php echo $prixht;?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TVA devis</span>
					<input type="text" value="<?php echo $tva1?>"  name="TVA" id="TVA"  class="col-sm-1" disabled />
                    <input name="tvah" value="<?php echo $tva1;?>"  type="hidden" class="form-control" >
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Total TTC devis</span>
                         <input name="ttch" value="<?php echo $prixttc;?>"  type="hidden" class="form-control" >
					<input type="text" value=" <?php echo $prixttc;?>"  name="TTC" id="TTC"  class="col-sm-1" style="margin-right:1em;" disabled />


		   </br>
		   </div>
		      </br>   </br>   </br>
		   </div>
		    <div class=" border border-success" >

			 			   	<p class="text-white p-3 mb-2 bg-dark" style="text-align: center;"><strong>Encaissement a saisir </strong></p>

					    </br>   </br>

                   <div class="form-row">

                <span class="col-sm-3" style="margin-top: 1em; margin-left:3em; margin-right:2em;">Action</span>
					<input type="text" value=""  name="action" id="action"  class="col-sm-8" required="required" autocomplete="off"/>


	<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Date</span>
					<input type="date" value=""  name="date_action" id="date_action" class="col-sm-2" />
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">Type encaissement</span>
					<select  style="margin-top: 1em;" name="Tencaissement" id="Tencaissement" style="height:50px;" class=" select2 col-md-3"  required="required">
 <option value = "-1" selected>S&eacute;l&eacute;ctionnez un Type</option>
  <?php $req5=mysql_query("select * from  masterParametreValeur where idMasterParametre = 12");
         while($result5=mysql_fetch_array($req5))
       { echo"<option value='".$result5['id']."'>".$result5['valeur']." </option>"; }

				?>
</select>
<span  style="margin-top: 1em;margin-left:1em;margin-right:1em;">montant</span>
					<input type="text" value=""  name="montant" id="montant"  class="col-sm-2" style="margin-right:1em;" autocomplete="off" required="required"/>



		   </br>
		   </div>
		      </br>
		   </div>
			   </br>
		  

			 </fieldset>
			<section>

     
		  <button type="submit" id="butsave" class="btn envoyer btn-info pull-right">valider facturation</button>

	</form>
</div>

<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
	
		var action 			    = $("#action").val();
		var  num_encaisement    = $("#num_encaisement").val();
		var	date_creation	    = $("#calendrierr").val();
		var	date_action	        = $("#date_action").val();
		var	Tencaissement   	= $("#Tencaissement").val();
		var	montant             = $("#montant").val();
		var id_user             = $("#id_user").val();
		if(action!="" && date_creation!="" && montant!="" && Tencaissement!=""){
			$.ajax({
				type: "POST",
				url: "ajax/insererfacturation.php",
				data: {
					action 			   : action,
					num_encaisement    : num_encaisement,
					date_creation 	   :date_creation,
					date_action 	   :date_action,
					Tencaissement      : Tencaissement,
					montant            : montant,
					id_user            : 	id_user ,
								},				
				
				cache: false,
				
				success:  function (response) {
					
					 $('#success').html("Vos données seront sauvegardées");
						
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 						
					}
					
					
				});
			}
		
		else{
			alert('Please fill all the field !');
		}
		});
	});

</script>

  
<?php

?>
 