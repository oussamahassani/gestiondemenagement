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
              <h4 class="mb-0">Ajout visite </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Ajout visite
                      </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body -->
    <?php require_once '../connect.php'; ?>
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
          <h3 class="card-title">Visite - Demande N° 
              <a href="modif_demande.php?id_dem=<?php echo $_GET['id_dem']; ?>">
              <?php echo $_GET['id_dem']; ?>
                      </a></h3>

    <form id="form" action="inc/insert_modif_visite.php" enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact" onSubmit="return verif()">
    
    <input name="dem" type="hidden" value="<?php echo $_GET['id_dem']; ?>" >

        
        <!-- SELECT2 EXAMPLE -->
    

<div class="form-row">

<div class="form-group col-md-2">
<label>Date  *</label>
<div class='input-group date' id='datepicker-bottom-left'>
<span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
               <input required name="date_vis"  class="form-control" type='text' value=""/>
                 
               </div>
</div>

<div class="bootstrap-timepicker col-md-2">

                <div class="form-group">

                  <label>Heure *</label>
                  <div class="input-group">

                    <input name="time" required value="" type="text" class="form-control timepicker">
                    <div class="input-group-addon">

                      <i class="fa fa-clock-o"></i>

                    </div>

                  </div>

                  <!-- /.input group -->

                </div>
</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Statut *</label>
<select name="id_statut_vis" id="id_statut_vis"  class="form-control select2" required> 
<option  value="">
       <?php $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=7");
       while($result6=mysql_fetch_array($req6)) 
       { 
        echo"<option  value='".$result6['id']."'>".$result6['valeur']." </option>"; 
      }
        ?>
  </select>
</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Commercial *</label>
<select name="commercial" id="commercial"  class="form-control select2" required> 
<option  value="">
<?php

$req7=mysql_query("select * FROM utilisateur WHERE id_type=18");
       while($result7=mysql_fetch_array($req7)) 
       {
      echo"<option value='".$result7['id_utilisateur']."'>".$result7['nom'].' '.$result7['prenom']." </option>";
        }
        ?>
  </select>
</div>
<div class="form-group col-md-4">

<label>Remarques</label>

<textarea name="remarque" class="form-control" rows="1" ></textarea>

</div>
</div>


<br>
<div class="box-footer">

<button type="reset" class="btn btn-default">Annuler</button>

<button type="submit" class="btn btn-info pull-right">Valider</button>

</div>

</div>




<div class="form-row">
</div>

</form>
</div>
</div>
</div>

<!--=================================
 wrapper -->
  
 <?php require_once"inc/footer.php"; ?>

</body>


<script language="javascript">
/*$(function () {
 

//Timepicker

$(".timepicker").timepicker({

defaultTime: 'current',

disableFocus: false,

isOpen: false,

minuteStep: 10,

modalBackdrop: false,

secondStep: 15,

showSeconds: false,

showInputs: false,

showMeridian: false



});
  });*/

</script>


<?php
} 
else
{

header('location: index.php');

}?>