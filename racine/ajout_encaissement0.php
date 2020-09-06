<?php
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com']))

{
?>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php require_once"inc/header.php";
require_once"inc/footer.php"; ?>
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
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script>
				function getVille(val) {
					$.ajax({
					type: "POST",
					url: "ajax/get_Devis.php",
					data:'Devis='+val,
					success: function(data){
						$("#list-devis").html(data);
					}
					});
				}

                function selectCountry(val) {
                    $("#search-box").val(val);
                    $("#suggesstion-box").hide();
                }
            </script>
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
<?php
require_once("../db.php");
$query ="select * from  masterParametreValeur where idMasterParametre = 2";
$results = mysqli_query($con, $query) or die( mysqli_error($con)) ;
?>
<!--=================================
 wrapper -->

 <form  method="post" action="ajout_encaissement2.php"  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">

  <section>
<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">encaissement
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
         <fieldset>
            <div class="form-row">


<div class="form-row">
                    <span>type prestation:</span>
                    <br/>
                    <select name="prestation" id="liste-prestation" class="boxInput" onChange="getVille(this.value);">
                        <option value="">Sélectionnez un type</option>
						<?php
						foreach($results as $pays) {
						?>
							<option value="<?php echo $pays["id"]; ?>"><?php echo $pays["valeur"]; ?></option>
						<?php
						}
						?>
					</select>
                </div>





	<span class=" col md-1"></span>


<div class="row" style = "margin-right:4em;">
                    <label>N° devies</label>
                    <br/>
                    <select name="liste-devis" id="list-devis" class="boxInput">
                        <option value="">Sélectionnez num devis</option>
                    </select>
					                </div>
            </div>


		   </fieldset>

<br>


	 </div>
	<br><br>
		 <input type="submit" id="b1" name="b1" value="Créer encaissement" class="btn envoyer btn-info pull-right"/>



		</div>
		  </section>

      </form>

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
