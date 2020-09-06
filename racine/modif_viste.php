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
              <h4 class="mb-0">Modification viste </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Modification viste </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body -->
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
          <h3 class="card-title">Informations Viste</h3>
    <form id="form" action="inc/update_visite.php" enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact" onSubmit="return verif()">
     <?php require_once '../connect.php';			
       
      $id_visite=$_GET['id_visite'];

    $req=mysql_query("select * from visite where id_visite='$id_visite'");
    if($result=mysql_fetch_array($req))
    {				
    ?>
    
    <input name="id_visite" value="<?php echo $result['id_visite'];?>" type="hidden" class="form-control" >
        <!-- SELECT2 EXAMPLE -->
    
     
         <div class="form-group row">
        
         <div class="col-sm-6">
         <div class="custom-control custom-radio custom-control-inline">
        
         <input class="form-check-input" type="radio" name="isClientB2B" 
                                                        value="1"
                                                         <?php if($result['clientB2B']=="1") {echo "checked";}?> >
                                                        <label class="form-check-label" for="clientB2B">
                                                           Client B2B
                                                        </label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
          
          <input class="form-check-input" type="radio" name="isClientB2B"  value="0"
                                                        <?php if($result['clientB2B']=="0") {echo "checked";}?>  >
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




<div >
<div class="form-row">
<div class="form-group col-md-2">
  <label>Date</label>

  <div class="input-group-addon">

<i class="fa fa-calendar"></i>

</div>

<input name="date" value="<?php 

$date=$result['date_vis'];

$a=substr($date,0,4);

$m=substr($date,5,2);

$j=substr($date,8,2);

$date=$j."/".$m."/".$a;

echo $date; ?>" type="text" class="form-control pull-right" id="datepicker">


</div>
<div class="form-group col-md-2">

<label for="exampleInputEmail1">Heure</label>

<div class="input-group">

<input name="time" value="<?php echo $result['heure_vis']?>" type="text" class="form-control timepicker">



<div class="input-group-addon">

  <i class="fa fa-clock-o"></i>

</div>

</div>
</div>




</div>

</div>

<?php  }		?>
      
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
  var idclient=document.contact.id_client.value;
 
  if(email!="")
    $.ajax({
				url: "verif_emailClient.php",
				dataType: "html",
				cache:false,
				async:false,
				data:{emailClient:email,id_client:idclient},
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
$(function () {
     function LoadBlocClient (clientB2B) {
      if (clientB2B =='1') {
          $('#clientB2C').hide();
          $('#clientB2B').show();
          $('#libelleTypeClient').hide();
          $('#contenuTypeClient').hide();
          document.contact.email.required = "";
          document.contact.prenom.required = "";
          document.contact.nom.required = "";
         // document.contact.telephone.required = "";
          document.contact.emailPro.required = "";
          document.contact.telephonePro.required = "";
          document.contact.nomPro.required = "";

          document.contact.emailClientB2B.required = "required";
          document.contact.raisonSocialeClientB2B.required = "required";
          document.contact.date_activation.required = "required";
          document.contact.nbMaxEnvoiLead.required = "required";
         
        } else {
          $('#clientB2B').hide();
          $('#clientB2C').show();
          $('#libelleTypeClient').show();
          $('#contenuTypeClient').show();
          document.contact.email.required = "required";
          document.contact.prenom.required = "required";
          document.contact.nom.required = "required";
          //document.contact.telephone.required = "required";
          document.contact.emailPro.required = "";
          document.contact.telephonePro.required = "";
          document.contact.nomPro.required = "";

          document.contact.emailClientB2B.required = "";
          document.contact.raisonSocialeClientB2B.required = "";
          document.contact.date_activation.required = "";
          document.contact.nbMaxEnvoiLead.required = "";
        
        }
    }    
    
    $('input[name="isClientB2B"]').change(function(e) {
        choice = this.value;
        LoadBlocClient(choice);
      
        
    });

    LoadBlocClient(document.contact.isClientB2B.value);

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
        document.contact.telephone.required = "";
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
        //document.contact.telephone.required = "required";
        document.contact.emailPro.required = "";
        document.contact.telephonePro.required = "";
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