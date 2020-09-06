<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php require_once"inc/header.php"; ?>
<!--================================= header End -->

<!--================================= Main content -->
 
<!-- Left Sidebar End -->
<?php require_once"inc/menu.php"; ?>
<!--================================= Main content -->

<!--================================= wrapper -->
<div class="content-wrapper">
  <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0" name="nom_catt">Modification categorie  N° <?php echo $_GET['id_cat']; ?></h4>
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
<form id="form" action="inc/insert_modif_categorie.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" >
<?php
$id=$_GET['id_cat'];   
$req=mysql_query("select * from categorie where id_encaisseme='$id' ");
if($result=mysql_fetch_array($req))
{				
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
<div class="form-group col-md-3">  
       
				  <label>Nom Categorie*</label>
          <input   value="<?php

echo $result['Nomcategorie'];?>" name="nom_cat"  type="text" class="form-control" id="exampleInputEmail1"  >
              </div>
              
              


</div>
</section>
<div class="box box-default">

<div class="box-body">

<!-- /.box-header -->



</div>
</section>
<input name="id_cat" value="<?php echo $result['id_catego'];?>"  type="hidden" class="form-control" >
<section>
<div class="box box-default">



	
<div class="box-footer">

                <button type="reset" class="btn btn-default">Annuler</button>

                <button type="submit" class="btn btn-info pull-right">Valider</button>

</div>                  
</div>
                 
</div>
<br>
    <div   value="<?php echo $result['id_catego'];?>" name="id_cat"  type="text" class="form-control">  </div>
</form>
<?php 
}
?>


</div>
</div>
</div>
<?php require_once"inc/footer.php"; ?>
</body>
<script>


<?php
} 
else
{

header('location: index.php');

}?>