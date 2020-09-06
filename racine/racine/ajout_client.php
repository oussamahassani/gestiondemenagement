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
              <h4 class="mb-0">Ajout client </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Ajout client </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body -->
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
          <h3 class="card-title">Informations Client</h3>
    <form id="form" action="inc/add_client.php" enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact" onSubmit="return verif()">
     <?php require_once '../connect.php';			 ?>
     
         <div class="form-group row">
        
         <div class="col-sm-6">
         <div class="custom-control custom-radio custom-control-inline">
        
                                                        <input class="form-check-input" type="radio" name="isClientB2B" id="isClientB2B" value="1" checked>
                                                        <label class="form-check-label" for="clientB2B">
                                                           Client B2B
                                                        </label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          
                  <input class="form-check-input" type="radio" name="isClientB2B" id="isClientB2B" value="0" >
                                                        <label class="form-check-label" for="clientB2C">
                                                           Client B2C
                                                        </label>
          </div>
          </div>
          <div  class="form-inline col-md-6">
<div class="col-md-3"  id="libelleTypeClient" style="display:none">
<label>Type client</label>

</div>
<div class="col-md-2" id="contenuTypeClient" style="display:none">
  
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



<div id="clientB2C" style="display:none" >
<div id="clientParticulier" style="display:block">
<div class="form-row">
<div class="form-group col-md-1.5">
  <label>Civilité</label>

  <select name="civilite" class="form-control select2" style="width:100%;">

    <option selected="selected">Mr</option>

    <option>Mme</option>
  </select>

</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Nom</label>

<input name="nom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom">

</div>
<div  class="form-group col-md-2">


                  <label for="exampleInputEmail1">Prenom</label>

                  <input  name="prenom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Prenom">

                  </div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephone"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">

</div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">N° Mobile </label>

<input name="telMobile"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Tél Mobile">

</div>
<div class="form-group col-md-2.5">

<label for="exampleInputEmail1">Adresse Email</label>

<input name="email"  type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
</div>
</div>


</div>
<div id="clientProfessionnel" style="display:none">
<div class="form-row">
<div class="form-group col-md-4">
<label for="exampleInputEmail1">Raison sociale</label>
<input name="nomPro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Raison sociale">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephonePro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">
</div>
<div class="form-group col-md-3">

<label for="exampleInputEmail1">Adresse Email</label>

<input name="emailPro"   type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">

</div>
</div>
</div>
</div>

<div  id="clientB2B" style="display:block">
<div class="form-row">
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Raison sociale * </label>
<input name="raisonSocialeClientB2B"   type="text" class="form-control" id="exampleInputEmail1" placeholder="Raison sociale">

</div>
<div class="form-group col-md-3">

<label for="exampleInputEmail1">N° Siret</label>

<input name="Siret"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Siret">

</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">N° Téléphone</label>
<input name="telClientB2B"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Adresse Email *</label>

<input name="emailClientB2B"     type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">

</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Adresse </label>
<input name="adresse"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Adresse">
</div>
<div class="form-group col-md-3"><label for="exampleInputEmail1">Code postal </label>
<input name="codepostal"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Code Postal">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Ville </label>
<input name="ville" type="text"  class="form-control" id="exampleInputEmail1" placeholder="Ville">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Pays </label>
<input name="pays" type="text"  class="form-control" id="exampleInputEmail1" placeholder="Pays">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3" id="libelleTypeClient">
<label>Date activation convention *</label>
</div>
<div class="form-group col-md-3">
<div class='input-group date' id='datepicker-bottom-left'>
<span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                    <input name="date_activation"  class="form-control" type='text'/>
                 
               </div>
</div>
</div>




<h3 class="card-title">Informations Responsable</h3>
<div class="form-row">
<div class="form-group col-md-2">

  <label>Civilité</label>

  <select name="civiliteResponsable" class="form-control select2" style="width:100%;">

    <option selected="selected">Mr</option>

    <option>Mme</option>
  </select>

</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Nom</label>

<input name="nomResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom">
</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Prénom</label>
<input  name="prenomResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Prenom">
</div>
<div class="form-group col-md-3">

<label for="exampleInputEmail1">N° Téléphone Bureau</label>
<input name="telResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">
</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">N° Téléphone Mobile </label>
<input name="telMobileResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone Mobile">

</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="exampleInputEmail1">Profession</label>

<input name="professionResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Profession">

</div>
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Skype</label>

<input name="pseudoskypeResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Pseudo Skype">

</div>
<div class="form-group col-md-3">

<label for="exampleInputEmail1">Adresse Email </label>

<input name="emailResponsable"  type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">

</div>
</div>

<h3 class="card-title">Informations Cron Envoi Lead</h3>
<div class="form-row">

<div class="form-group col-md-2">
   <label>Nb Max Envoi (Jour) *</label>
   <input name="nbMaxEnvoiLead"  type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Nb Max Envoi">


</div>
<div class="form-group col-md-2">
  <label>Statut </label>
  <select name="cronActif" class="form-control select2" style="width:100%;">

    <option selected="selected" value="1">Actif</option>
    <option selected="selected"  value="0">Inactif</option>
    
  </select>

</div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">Volume Min</label>
<input name="volumeMin" type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Volume Min">
</div>
<div class="form-group col-md-6">
<label for="exampleInputEmail1">Codes postaux départ </label>
<input name="codesPostauxDepart"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Codes Postaux Départ">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-2">
<label>Solde *</label>
   <input name="solde"  type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="solde">

</div>
<div class="form-group col-md-2">
<!---<label>Reste </label>
<label> </label>!--->
</div>
<div class="form-group col-md-2">


                  <label for="exampleInputEmail1">Volume Max</label>
                  <input name="volumeMax" type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Volume Max">
</div>
<div class="form-group col-md-6">

<label for="exampleInputEmail1">Codes postaux arrivée </label>

<input name="codesPostauxArrivee"  type="text"  class="form-control" id="exampleInputEmail1" placeholder="Codes Postaux Arrivée">

</div>
</div>
</div>
<br>
<div class="box-footer">

<button type="reset" class="btn btn-default">Annuler</button>

<button type="submit" class="btn btn-info pull-right">Valider</button>

</div>
<br>
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

<script>
 document.contact.emailClientB2B.required = "required";
          document.contact.raisonSocialeClientB2B.required = "required";
          document.contact.date_activation.required = "required";
          document.contact.nbMaxEnvoiLead.required = "required";
          document.contact.solde.required = "required";
     
  $(function () {

 
     $('input[name="isClientB2B"]').change(function(e) {
        choice = this.value;
      
        if (choice =='1') {
          $('#clientB2C').hide();
          $('#clientB2B').show();
          $('#libelleTypeClient').hide();
          $('#contenuTypeClient').hide();
          document.contact.email.required = "";
          document.contact.prenom.required = "";
          document.contact.nom.required = "";
          //document.contact.telephone.required = "";
          document.contact.emailPro.required = "";
          document.contact.telephonePro.required = "";
          document.contact.nomPro.required = "";

          document.contact.emailClientB2B.required = "required";
          document.contact.raisonSocialeClientB2B.required = "required";
          document.contact.date_activation.required = "required";
          document.contact.nbMaxEnvoiLead.required = "required";
          document.contact.solde.required = "required";
          
          


        } else {
          $('#clientB2B').hide();
          $('#clientB2C').show();
          $('#libelleTypeClient').show();
          $('#contenuTypeClient').show();
          document.contact.email.required = "required";
          document.contact.prenom.required = "required";
          document.contact.nom.required = "required";
         // document.contact.telephone.required = "required";
          document.contact.emailPro.required = "";
          document.contact.telephonePro.required = "";
          document.contact.nomPro.required = "";

          document.contact.emailClientB2B.required = "";
          document.contact.raisonSocialeClientB2B.required = "";
          document.contact.date_activation.required = "";
          document.contact.nbMaxEnvoiLead.required = "";
          document.contact.solde.required = "";
        
        }
    });

    $('#isClientB2B').change(function()
    { 
      $(this).find("option:selected").each(function()
      {
     var optionValue = $(this).attr("value");
    // alert(optionValue);
     if (optionValue != 1)
      {
        $('#clientParticulier').hide();
        $('#clientProfessionnel').show();
        
      } 
     else 
      { 
        $('#clientParticulier').show();
        $('#clientProfessionnel').hide();
       
      }
      });


    });



    $('#typeClient').change(function()
    {      $(this).find("option:selected").each(function()
      {
     var optionValue = $(this).attr("value");
    // alert(optionValue);
     if (optionValue != 1)
      {
        $('#clientParticulier').hide();
        $('#clientProfessionnel').show();
        document.contact.email.required = "";
        document.contact.prenom.required = "";
        document.contact.nom.required = "";
       // document.contact.telephone.required = "";
        document.contact.emailPro.required = "required";
        document.contact.telephonePro.required = "required";
        document.contact.nomPro.required = "required";
      } 
     else 
      {$('#clientParticulier').show();
        $('#clientProfessionnel').hide();
        document.contact.email.required = "required";
        document.contact.prenom.required = "required";
        document.contact.nom.required = "required";
       // document.contact.telephone.required = "required";
        document.contact.emailPro.required = "";
        document.contact.telephonePro.required = "";
        document.contact.nomPro.required = "";
        }
      });


    });

    

  });
</script>

</body>


<script language="javascript">


function verif()

{
  if ($("input[type='radio'][name='isClientB2B']:checked").val()=="0")
  {
    if ($('#typeClient').val()=="1")
    {var email=document.contact.email.value;
     
    }
    else
    {var email=document.contact.emailPro.value; 
   
    } 
  }
  else
  { var email=document.contact.emailClientB2B.value;}  
 
  var retour="";
  if(email!="")
    $.ajax({
				url: "inc/verif_emailClient.php",
				dataType: "html",
				cache:false,
				async:false,
				data:{emailClient:email},
				success: function( data ) {
           retour=data;
        }
      });
  if (retour=="")
  {
  return true;
  }
  else
  { alert('Email présent dans la base. '+retour);
    if ($("input[type='radio'][name='isClientB2B']:checked").val()=="0")
    {
      if ($('#typeClient').val()=="1")
      {document.contact.email.focus();}
      else
      {document.contact.emailPro.focus();} 
    }
    else
    { document.contact.emailClientB2B.focus();}  
      
  return false;
  }


	
}

</script>
<?php
} 
else
{

header('location: index.php');

}?>