
<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 

{ 
?>


<?php
require_once("../db.php");
$query ="select * from  masterparametrevaleur where idMasterParametre = 2";
$results = mysqli_query($con, $query) or die( mysqli_error($con)) ;
?>

<?php 
require_once"inc/header.php";
require_once"inc/footer.php";
 require_once"inc/menu.php";
 ?>
   
            <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script>
				function getVille(val) {
					$.ajax({
					type: "POST",
					url: "ajax/get_ville.php",
					data:'id_pays='+val,
					success: function(data){
						$("#list-ville").html(data);
					}
					});
				}

                function selectCountry(val) {
                    $("#search-box").val(val);
                    $("#suggesstion-box").hide();
                }
            </script>
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
<form  method="post" action="ajout_encaissement2.php"  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">
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
             
                <span  class=" col md-2" style="margin-top: 1em;">Type de prestation*</span>
				<input list="browsers" name="browser">
<datalist id="browsers">
 <option value = "-1" selected>[choose yours]
 <?php $req5=mysql_query("select * from  masterparametrevaleur where idMasterParametre = 9");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['valeur']."'>".$result5['valeur']; }
     
				?> 
</datalist>
</div>
		
                <div class="form-row">
                    <label>Pays:</label>
                    <br/>
                    <select name="pays" id="liste-pays" class="boxInput" onChange="getVille(this.value);">
                        <option value="">Sélectionnez le pays</option>
						<?php
						foreach($results as $pays) {
						?>
							<option value="<?php echo $pays["id"]; ?>"><?php echo $pays["valeur"]; ?></option>
						<?php
						}
						?>
					</select>
                </div>
           
       
                    <label>Ville:</label>
                    <br/>
                    <select name="ville" id="list-ville" class="boxInput">
                        <option value="">Sélectionnez la ville</option>
                    </select>
           
				</fieldset>
			</div>
			 </div>
			 </form>
			  </div>

  <?php
} 
else
{

header('location: index.php');

}?>