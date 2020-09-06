<?php
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com']))
{
?>
<?php require_once"inc/header.php"; ?>
<!--=================================
 header End-->

<!--=================================
 Main content -->

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
  <style>
 label {
   
	font-family: 'Poppins', sans-serif
    font-size: 0.95rem;
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
                    <label>Type prestation:</label>
                    <select name="prestation" id="liste-prestation" class="boxInput" onChange="getVille(this.value);" required>
                        <option value="-1">Sélectionnez un type</option>
						<?php
						foreach($results as $pays) {
						?>
							<option value="<?php echo $pays["id"]; ?>"><?php echo $pays["valeur"]; ?></option>
						<?php
						}
						?>
					</select>
                </div>





	<span class=" col md-2"></span>


<div class="row" style = "margin-right:20em;">
                    <label>N° devies</label>
                    <br/>
                    <select name="liste-devis" id="list-devis" class="boxInput" required style="width:150px;">
                        <option value="">Sélectionnez num devis</option>
                    </select>
					                </div>
            </div>

     <br><br>
  <button type="submit" class="btn envoyer btn-info pull-right">Créer encaissement</button>
       <br><br>
       </fieldset>
	  <br>
	 </div>





		</div>
		  </section>

      </form>
<script type = "text/javascript">
<!--
        // Form validation code will come here.
      function validate() {

         if( document.myForm.prestation.value == "-1" ) {
            alert( "STP saisire ton nom d'article!" );
            document.myForm.prestation.focus() ;
            return false;
         }
         if( document.myForm.liste-devis.value == "" ) {
            alert( "Please provide your Email!" );
            document.myForm.liste-devis.focus() ;
            return false;
         }


         if( document.myForm.liste-devis.value < 3   ) {
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
