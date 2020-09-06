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
              <h4 class="mb-0">Ajout Volume </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Volume</a></li>
              <li class="breadcrumb-item active">Ajout</li>
            </ol>
          </div>
        </div>
    </div>

 <!-- main body -->
 <?php require_once '../connect.php';			 ?>
 <!--<form method="post" action="inc/add_volume.php"   name = "myForm" onsubmit = "return(validate());" enctype="multipart/form-data">
  <section>
<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations Aticle
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
          <div class="form-row" id="infogenerales">
		  <div class="form-group col-md-3">  
 <label>Categorie *</label>
 <select name="source" class="form-control select2" style="width: 100%;" required="required">
 <option value = "-1" selected>[choose yours]</option>
       <?php $req5=mysql_query("select * from  categorie");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_catego']."'>".$result5['Nomcategorie']." </option>"; }
     
				?> 
</select>
</div>
<!--<div class="form-group col-md-3">  
<label>ID Article</label>

<input name="id_vol"  class="form-control" type='text'  value="" required="required"/>
                 
</div>--><!--
<div class="form-group col-md-3">  
<label>Nom Article</label>

<input name="Nom_vol"  class="form-control" type='text'  required="required"/>
                 
</div>

<div class="form-group col-md-3"><label for="calc_vol">Volume Article </label>

<input name="calc_vol"  type="text" class="form-control" id="calc_vol" required="required">

</div></br>
<div class="form-group col-md-3">
<label>Image Article</label>

   <input type="file" name="file" size="40" required="required">

</div>
            <center>
            <div id="coord">
            
 
 
            <br>
            
 
           
            <br><br>
            
 
 
 
            </div>
			
			</div>
			<button type="submit" class="btn envoyer btn-info pull-right">Envoyer </button>
            
            <button type="clear" class="btn btn-danger  pull-left">Anuller</button>
                  <br><br>    <br><br>
		</center>
		</div>
		  </section>
		  </form>  
-->
<!--=================================
 wrapper -->
 
 <form  method="post" action="add_volume.php"  enctype="multipart/form-data" name = "myForm" onsubmit = "return(validate());">
  <section>
<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations Aticle
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
         
		 <div class="form-row" id="infogenerales">
		 
		  <div class="form-group col-md-3">  
 <label>Categorie *</label>
 <select name="source" class="form-control select2" style="width: 100%;" required="required">
 <option value = "-1" selected>[choose yours]</option>
  <?php $req5=mysql_query("select * from  categorie");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_catego']."'>".$result5['Nomcategorie']." </option>"; }
     
				?> 
</select>
</div>
<div class="form-group col-md-3">  
<label>Nom Article</label>

<input name="Nom_vol"  class="form-control" type='text'  required="required"/>
                 
</div>

<div class="form-group col-md-3"><label for="calc_vol">Volume Article </label>

<input name="calc_vol"  type="text" class="form-control" id="calc_vol" required="required" >

</div></br>
<div class="form-group col-md-3">


<label>Image Article</label>

   <input type="file" name="file" id="file" size="40"   required="required"><span id="file$"></span>

</div>
     </div>  
	   
	 </div>  
	   <table cellspacing = "2" cellpadding = "2" border = "1">
            
         
            
        
            
       
            
           
         
            
         </table>
		 <button type="submit" class="btn envoyer btn-info pull-right">Envoyer </button>
            
            <button type="clear" class="btn btn-danger  pull-left">Anuller</button>
                  <br><br>    <br><br>
	
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
 <?php require_once"inc/footer.php"; ?>



<?php
} 
else
{

header('location: index.php');

}?>