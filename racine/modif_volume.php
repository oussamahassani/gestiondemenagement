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
              <h4 class="mb-0">Modification Volume  N° <?php echo $_GET['id_vol']; ?></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Volume</a></li>
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
<form id="form" action="inc/insert_modif_volume.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" >
<?php
$id=$_GET['id_vol'];   
$req=mysql_query("select * from volume where id_vol='$id' ");
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
       
				  <label>categorie</label>
         <select name="source" class="form-control select2" style="width: 100%;" disabled>
         <option  value="">
         <?php $req5=mysql_query("select * from  categorie");
         while($result5=mysql_fetch_array($req5)) 
       {  if ($result5['id_catego'] == $result['id_catego']) {
          
          echo '<option  value="'.$result5['id_catego'].'" selected="selected">'.$result5['Nomcategorie'].' </option>';
          }
          else
          {
          echo"<option value='".$result5['id_catego']."'>".$result5['Nomcategorie']." </option>";
          }
          }
        ?>
        </select>
              </div>
          <!--    <div class="form-group col-md-3">  
<label>ID Article</label>

<input name="Nom_vol"  class="form-control" type='text' required="required" value="<?php  echo  $result['id_vol'];?> "/>
                 -->
</div>
<div class="form-group col-md-3">  
<label>Nom Article</label>

<input name="Nom_vol"  class="form-control" type='text' required="required" value="<?php echo $result['nom_vol'];  ?>"/>
            
</div>

<div class="form-group col-md-3"><label for="exampleInputEmail1">Volume Article </label>

<input name="calc_vol"  value=" <?php echo$result['calc_vol'];?> " type="text" class="form-control" id="exampleInputEmail1" required="required">

</div></br>
<div class="form-group col-md-3">
<label>Image Article</label>

<input type="photo" name="photo" value=" <?php echo $result['image'] ; ?>" size="40">

</div>
             
<input name="id_vol" value="<?php echo $result['id_vol'];?>"  type="hidden" class="form-control" >
<input name="id_cat" value="<?php echo $result5['id_catego'];?>"  type="hidden" class="form-control" >
<input name="nom_cat" value="<?php echo $result5['Nomcategorie'];?>"  type="hidden" class="form-control" >
</div>
 
  <!-- /.form-group -->

   <div class="box-footer">

                <button type="reset" class="btn btn-default">Annuler</button>

                <button type="submit" class="btn btn-info pull-right">Valider</button>

</div>                  
      
</form>
<?php 
}
?>
</div></div></div>
<div class="form-row">
</div>
</div>
</div>

<?php require_once"inc/footer.php"; ?>
</body>
<?php
}
else
{

header('location: index.php');

}?>