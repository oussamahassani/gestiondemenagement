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
              <h4 class="mb-0">Ajout demande </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Demandes</a></li>
              <li class="breadcrumb-item active">Ajout</li>
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
          <form id="form" action="inc/add_demande.php" enctype="multipart/form-data" method="post" class="validateform" name="contact">
         
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
 <label>Source *</label>
 <select name="source" class="form-control select2" style="width: 100%;" required="required">
 <option value=''> </option>
       <?php $req5=mysql_query("select * from source");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_source']."'>".$result5['nom_source']." </option>"; }
     
				?> 
</select>
</div>
<div class="form-group col-md-3">    
 <label>Type de demande *</label>
<select name="typeDemande" class="form-control select2" style="width: 100%;">
<option value=''> </option>
       <?php $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=2 ");
       while($result6=mysql_fetch_array($req6)) 
       { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }
        ?>
</select>
</div>
<div class="form-group col-md-3">  
<label>Demande établie le *</label>

<div class='input-group date display-years'>
<span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                    <input name="date_etab"  class="form-control" type='text' required="required" value="<?php $date = date("d/m/Y"); echo $date;?>"/>
                 
               </div>
</div>

</div>
</section>


<!-- /.box-body -->
 <section>

 <div class="box box-default">

<div class="box-header with-border">
<h5 class="card-title">Informations Client
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
<div class="form-row" id="infoClient">
  
  <div class="form-inline col-md-2" > 
  <div class="col-md-2">
  <label>Type</label>
  </div>
  <div class="col-md-2" >
  <select name="typeClient" id="typeClient"  class="form-control select2"  >
  <?php

$req6=mysql_query("select * from masterParametreValeur where idMasterParametre=1 ");
       while($result6=mysql_fetch_array($req6)) 
       { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }
        ?>
  </select>

</div>
</div>
</div>
<div class="form-row" id="clientParticulier">
<div class="form-group col-md-1.5">  
<label>Civilité *</label>

  <select name="civilite" class="form-control select2" style="width:100%;">
  <option value=""></option>
  <option>Mr</option>

    <option>Mme</option>
  </select>

</div>
<div class="form-group col-md-2"><label for="exampleInputEmail1">Nom *</label>

<input name="nom"  type="text" class="form-control" id="exampleInputEmail1" required="required">

</div>
<div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Prenom *</label>

                  <input  name="prenom"  type="text" class="form-control" id="exampleInputEmail1" required="required">

                </div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephone"  type="text" class="form-control" id="exampleInputEmail1" >

</div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">N° Mobile</label>

<input  name="telMobile"  type="text" class="form-control" id="exampleInputEmail1">

</div>
<div class="form-group col-md-2.5">
<label for="exampleInputEmail1">Adresse Email *</label>

<input name="email"   type="email" class="form-control" id="exampleInputEmail1" required="required">

</div>
</div>

<div class="form-row" id="clientProfessionnel" style="display:none">
<div class="form-group col-md-4">  
<label for="exampleInputEmail1">Raison sociale *</label>

<input name="nomPro"  type="text" class="form-control" id="exampleInputEmail1" >

</div>
<div class="form-group col-md-3">  
<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephonePro"  type="text" class="form-control" id="exampleInputEmail1" >

</div>
<div class="form-group col-md-3"> 
<label for="exampleInputEmail1">Adresse Email *</label>

<input name="emailPro"  type="text" type="email" class="form-control" id="exampleInputEmail1" >

</div>
</div>
</div>
</section>

<section>
<div class="box box-default">

<div class="box-header with-border">
<h5 class="card-title">Informations Déménagement
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
<div class="form-row" id='infoDemenagement'>
          <table>
          <tr>
          <td width="2%"></td>
         <td width="35%">
         <h5 class="card-title">Départ</h5>
<div class="form-group" > 
<label for="exampleInputEmail1">Adresse *</label>
<input name="adresse_dep" type="text" class="form-control" id="exampleInputEmail1"  required="required">

                </div>
	<div class="form-group">
  <table><tr> <td width="35%"><label for="exampleInputEmail1">Code postale *</label></td> <td><label for="exampleInputEmail1">Ville *</label></td></tr> 
               <tr><td>

                  <input name="cp_dep" type="text" class="form-control" id="exampleInputEmail1"  required="required">
</td>
<td> <input name="ville_dep" type="text" class="form-control" id="exampleInputEmail1"  required="required">

</td>
</tr>
</table>
</div>
<div class="form-group">
        <table width="100%"><tr> <td width="35%"><label for="exampleInputEmail1">Étage *</label></td> <td><label for="exampleInputEmail1">Portage</label></td></tr>
        <tr> <td><select name="habit_dep"  class="form-control select2"  style="width: 100%;" required="required">
        <option value='' selected="selected"> </option>
       <?php $req7=mysql_query("select * from masterParametreValeur where idMasterParametre=8 AND affiche=1 ");
       while($result7=mysql_fetch_array($req7)) 
       { echo"<option value='".$result7['valeur']."'>".$result7['valeur']." </option>"; }
        $counter=1;
        while ( $counter <= 30 ) {
        echo"<option value='".$counter."'>".$counter." </option>";
        echo $counter;
        $counter = $counter + 1;
      }
        ?>

                </select></td>
                <td>  <input name="portage_dep" type="text" class="form-control" id="exampleInputEmail1">

</td>
</tr></table>

                </div>

        </div>
        
        

				

				      <div class="form-group">
              <table><tr><td colspan="1" width="45%"><label>Date *</label></td><td colspan="2"> <label>Periode</label></td></tr> 
         <tr><td colspan="1"><div class='input-group date display-years'>
<span class="input-group-addon">
<i class="fa fa-calendar"></i>
</span>
<input name="date_dep"  type="text" class="form-control pull-right" required="required">

</div></td><td colspan="2"><div class="input-group">
<input name="periode_dep"  value=""  type="text" class="form-control pull-right" id="reservation">

</div>
</td></tr>  </table>  
 </div>

				
 <div class="form-group">

<label>

  Assenceurs <input name="assen_dep" type="checkbox" class="flat-red" checked>

</label>

<label>

  | Stationnement <input name="stat_dep" type="checkbox" class="flat-red">

</label>
<label>

  | Cave <input name="cave_dep" type="checkbox" class="flat-red">

</label>
<br>

<label>

 Monte meuble <input name="monte_dep" type="checkbox" class="flat-red" >
 </label>
 <label>

  | Garde meuble <input name="garde_meuble_dep" type="checkbox" class="flat-red" >
 </label>
 <br>
<label>
Passage par fenêtre <input name="passageFenetre_dep" type="checkbox" class="flat-red" >
</label>
| 
<label>
Accès véhicule <input name="accesVehicule_dep" type="checkbox" class="flat-red" >
</label>
</div>
              <!-- /.form-group -->

              

              <!-- /.form-group -->

</td>
        
          <!-- /.row -->
          <td width="2%">
 </td>
        
            <td width="36%">
            <h5 class="card-title">Arrivée</h5>
            <div class="form-group">

                  <label for="exampleInputEmail1">Adresse *</label>

                  <input name="adresse_arr" type="text" class="form-control" id="exampleInputEmail1"  required="required">

                </div>

				

				<div class="form-group">

        <table><tr> <td width="35%"><label for="exampleInputEmail1">Code postale *</label></td><td><label for="exampleInputEmail1">Ville *</label></td></tr>
        <tr><td>
                  <input name="cp_arr" type="text" class="form-control" id="exampleInputEmail1"  required="required">
</td>
<td> <input name="ville_arr" type="text" class="form-control" id="exampleInputEmail1"  required="required">
</td></tr>

</table>
        </div>

				
				

				<div class="form-group">

        <table width="100%"><tr> <td width="35%"><label for="exampleInputEmail1">Étage *</label></td><td><label for="exampleInputEmail1">Portage</label></td></tr>
        <tr><td>
        <select name="habit_arr" class="form-control select2" style="width: 100%;" required="required">
        <option value='' selected="selected"> </option>
       <?php $req7=mysql_query("select * from masterParametreValeur where idMasterParametre=8 AND affiche=1 ");
       while($result7=mysql_fetch_array($req7)) 
       { echo"<option value='".$result7['valeur']."'>".$result7['valeur']." </option>"; }
        $counter=1;
        while ( $counter <= 30 ) {
        echo"<option value='".$counter."'>".$counter." </option>";
        echo $counter;
        $counter = $counter + 1;
       }
       ?>
        </select>
</td>
<td> <input name="portage_arr" type="text" class="form-control" id="portage_arr" >
</td></tr>
</table>

                </div>

        </div>
        <div class="form-group"> 
         <table><tr><td colspan="1" width="45%"><label>Date *</label></td><td colspan="2"> <label>Période</label></td></tr> 
         <tr><td colspan="1"><div class="input-group date display-years">

<span class="input-group-addon">
  <i class="fa fa-calendar"></i>
</span>

<input name="date_arr"  type="text" class="form-control pull-right" >

</div></td><td colspan="2"><div class="input-group">
<input name="periode_arr"  value=""  type="text" class="form-control pull-right" id="reservation2">

</div>
</td></tr>  </table>    	

</div>
<div class="form-group">

                <label>

                  Assenceurs <input name="assen_arr" type="checkbox" class="flat-red" checked>

                </label>

                <label>

                  | Stationnement <input name="stat_arr" type="checkbox" class="flat-red">

                </label>
                <label>

                  | Cave <input name="cave_arr" type="checkbox" class="flat-red">

                </label>
                 <br>
                <label>

                  Monte meuble <input name="monte_arr" type="checkbox" class="flat-red" >
              </label>
              <label>

                  | Garde meuble <input name="garde_meuble_arr" type="checkbox" class="flat-red" >
                 </label>
                 <br>
                <label>
               Passage par fenêtre <input name="passageFenetre_arr" type="checkbox" class="flat-red" >
                </label>
                | 
                <label>
                Accès véhicule <input name="accesVehicule_arr" type="checkbox" class="flat-red" >
                </label>

              </div>



 </td>
 <td width="2%">
 </td>
 <td width="24%">
 <h5 class="card-title">Déménagement</h5>
              <div class="form-group">

               <div class="form-group">

                  <label for="exampleInputEmail1">Volume *</label>

                  <input name="volume" type="number" class="form-control" id="exampleInputEmail1"  required="required">

                </div>

				

				<div class="form-group">

                  <label for="exampleInputEmail1">Distance *</label>

                  <input name="distance" type="number" class="form-control" id="exampleInputEmail1" required="required">

                </div>

				

              </div>

              <!-- /.form-group -->

              <div class="form-group">

                  <label for="exampleInputEmail1">Prestation *</label>
                  <select name="prestation" class="form-control select2" style="width: 100%;" required="required">
                  <option  value="">
                  <?php $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=9");
                while($result6=mysql_fetch_array($req6)) 
                { 
                  if ($result6['id'] == $result['id_prestation']) {
                  echo '<option  value="'.$result['id_prestation'].'" selected="selected">'.$result6['valeur'].' </option>';
                  }
                  else
                  {echo"<option  value='".$result6['id']."'>".$result6['valeur']." </option>"; }
                }
                  ?>
                </select>

                </div>

				

				 <div class="form-group">

                  <label>Remarques</label>

                  <textarea name="remarque" class="form-control" rows="4" ></textarea>

                </div>
               <br><br><br>




                </td>
                <td width="2%">
 </td>
            </tr>
</table>
</div> </div>
</div>
				

              <!-- /.form-group -->

          <!-- /.row -->

          <div class="box-footer">

<button type="reset" class="btn btn-default">Annuler</button>

<button type="submit" class="btn btn-info pull-right">Valider</button>

</div>
</div>

        <!-- /.box-body -->
</div>

</form>   

  



<div class="form-row">
</div>
</div>
</div>


<!--=================================
 wrapper -->
  
 <?php require_once"inc/footer.php"; ?>

 </body>
<script>
 
     
  $(function () {
    $('#typeClient').change(function()
    {      $(this).find("option:selected").each(function()
      {
     var optionValue = $(this).attr("value");
     if (optionValue != 1)
      {
        $('#clientParticulier').hide();
        $('#clientProfessionnel').show();
          document.contact.email.required = "";
          document.contact.prenom.required = "";
          document.contact.nom.required = "";
          document.contact.emailPro.required = "required";
          document.contact.nomPro.required = "required";
      } 
     else 
      {$('#clientParticulier').show();
        $('#clientProfessionnel').hide();
        document.contact.email.required = "required";
          document.contact.prenom.required = "required";
          document.contact.nom.required = "required";
          document.contact.emailPro.required = "";
          document.contact.nomPro.required = "";
        }
      });


    });

    




    

  });

  

</script>

<?php
} 
else
{

header('location: index.php');

}?>