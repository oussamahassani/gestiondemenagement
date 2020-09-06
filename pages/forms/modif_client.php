<?php

session_start (); 



if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 

{ 



?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Paris ECO | Ajout Fiche client</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->

  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- daterange picker -->

  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">

  <!-- bootstrap datepicker -->

  <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="../../plugins/datepicker/datepicker33.css">

  <!-- iCheck for checkboxes and radio inputs -->

  <link rel="stylesheet" href="../../plugins/iCheck/all.css">

  <!-- Bootstrap Color Picker -->

  <link rel="stylesheet" href="../../plugins/colorpicker/bootstrap-colorpicker.min.css">

  <!-- Select2 -->

  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

   <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <link href="dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="dist/css/bootstrap-colorpicker-plus.css" rel="stylesheet">

    <style type="text/css">

        .color-fill-icon{display:inline-block;width:16px;height:16px;border:1px solid #000;background-color:#fff;margin: 2px;}

        .dropdown-color-fill-icon{position:relative;float:left;margin-left:0;margin-right: 0}

		.well .markup{

			background: #fff;

			color: #777;

			position: relative;

			padding: 45px 15px 15px;

			margin: 15px 0 0 0;

			background-color: #fff;

			border-radius: 0 0 4px 4px;

			box-shadow: none;

		}



		.well .markup::after{

			content: "Example";

			position: absolute;

			top: 15px;

			left: 15px;

			font-size: 12px;

			font-weight: bold;

			color: #bbb;

			text-transform: uppercase;

			letter-spacing: 1px;

		}

    </style>
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

</script>


</head>

<body class="hold-transition skin-yellow sidebar-mini">

<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>D</b>EM</span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>Super</b>DEM</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </a>



      

    </nav>

  </header>

  <!-- Left side column. contains the logo and sidebar -->

  <?php

 

require_once"../../menu.php";



  ?>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>Modif client</h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i>Acceuil</a></li>

        <li><a href="#">Client</a></li>

        <li class="active">Ajout</li>

      </ol>

    </section>

  <form id="form" action="insert_modif_client.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" onSubmit="return verif()">
  <!-- Main content -->
    <section class="content">

    <?php
    require_once '../../connect.php';
    $id=$_GET['id_client'];   
    $req=mysql_query("select * from client where id_client='$id' ");
    if($result=mysql_fetch_array($req))
    {				
    ?>
    
    <input name="id_client" value="<?php echo $result['id_client'];?>" type="hidden" class="form-control" >
        <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <div class="box-header with-border">

          <h3 class="box-title">Informations Client</h3>
             <div class="box-tools pull-right">

            <button  type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div class="row">
          <table><tr>
          <td class="col-md-3">
<div class="form-group">
                                                        <input class="form-check-input" type="radio" name="isClientB2B" 
                                                        value="1"
                                                         <?php if($result['clientB2B']=="1") {echo "checked";}?> >
                                                        <label class="form-check-label" for="clientB2B">
                                                           Client B2B
                                                        </label>
                                                    </div>
</td>
<td class="col-md-3">
          <div class="form-group">
                                                        <input class="form-check-input" type="radio" name="isClientB2B"  value="0"
                                                        <?php if($result['clientB2B']=="0") {echo "checked";}?>  >
                                                        <label class="form-check-label" for="clientB2C">
                                                           Client B2C
                                                        </label>
                                                    </div>
</td> 
<td class="col-md-2" >

<div class="form-group" id="libelleTypeClient" style="display:none">

  <label>Type client</label>
  </div>

</td>
<td class="col-md-2">
          <div class="form-group"  id="contenuTypeClient" style="display:none">
  <select name="typeClient" id="typeClient"  class="form-control select2"  >
  <?php

$req6=mysql_query("select * from masterParametreValeur where idMasterParametre=1 ");
       while($result6=mysql_fetch_array($req6)) 
       { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }
        ?>
  </select>

</div>
</td>
<td></td><td></td>
</tr>
</table>
<table id="clientB2C" style="display:none" >
<tr id="clientParticulier" style="display:block">
<td class="col-md-1">

<div class="form-group">

  <label>Civilité</label>

  <select name="civilite" class="form-control select2" style="width:100%;">
  <option  <?php if($result['civilite']=='Mr') {echo "selected";}?>>Mr</option>
  <option <?php if($result['civilite']=='Mme') {echo "selected";}?>>Mme</option>
  </select>

</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">Nom</label>

<input name="nom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom" value="<?php echo $result['nom']; ?>">

</div>
</td>
<td class="col-md-2">
<div class="form-group">

                  <label for="exampleInputEmail1">Prenom</label>

                  <input  name="prenom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Prenom" value="<?php echo $result['prenom']; ?>">

                </div>
</td>

<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephone"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $result['tel']; ?>" >

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email</label>
<input name="email"  type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $result['email']; ?>">
</div>
</td>
</tr>
        
<tr id="clientProfessionnel" style="display:none">

<td class="col-md-4">
<div class="form-group">

<label for="exampleInputEmail1">Raison sociale</label>
<input name="nomPro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Raison sociale" value="<?php echo $result['raisonsociale']; ?>">
</div>
</td>


<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephonePro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $result['telephone']; ?>">

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email</label>

<input name="emailPro"   type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $result['email']; ?>">

</div>
</td>
          </tr>
     </table>
<table  id="clientB2B" style="display:block">

<tr>
<td class="col-md-3" colspan="2">
<div class="form-group">
<label for="exampleInputEmail1">Raison sociale * </label>
<input name="raisonSocialeClientB2B"   type="text" class="form-control" id="exampleInputEmail1" placeholder="Raison sociale" value="<?php echo $result['raisonsociale']; ?>">
</div>
</td>


<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">N° Siret</label>

<input name="Siret"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Siret" value="<?php echo $result['siret']; ?>">

</div>
</td>
<td class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">N° Téléphone</label>
<input name="telClientB2B"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $result['telClientB2B']; ?>" >

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email *</label>

<input name="emailClientB2B"     type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $result['emailClientB2B']; ?>">

</div>
</td>
</tr>
<tr>
<td class="col-md-3" colspan="2">
<div class="form-group">
<label for="exampleInputEmail1">Adresse </label>
<input name="adresse"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Adresse" value="<?php echo $result['adresse']; ?>">
</div>
</td>
<td class="col-md-2">
<div class="form-group"><label for="exampleInputEmail1">Code postal </label>
<input name="codepostal"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Code Postal" value="<?php echo $result['codepostal']; ?>">
</div>
</td>
<td class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">Ville </label>
<input name="ville" type="text"  class="form-control" id="exampleInputEmail1" placeholder="Ville" value="<?php echo $result['ville']; ?>">
</div>
</td>
<td class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">Pays </label>
<input name="pays" type="text"  class="form-control" id="exampleInputEmail1" placeholder="Pays" value="<?php echo $result['pays']; ?>">
</div>
</td>
</tr> 
<tr><td>
</td>
<td>

</td>
</tr>

<tr>
<td class="col-md-3" colspan="2">
<div class="form-group" id="libelleTypeClient">

  <label>Date activation convention *</label>
  </div>
</td>
<td class="col-md-2" colspan="1">
<div class="input-group date">
  <div class="input-group-addon">
  <i class="fa fa-calendar"></i>
  </div>
  <input name="date_activation"   type="text" class="form-control pull-right" id="datepicker" value="<?php

$date=$result['date_activation'];

$a=substr($date,0,4);

$m=substr($date,5,2);

$j=substr($date,8,2);

$date=$j."/".$m."/".$a;

echo $date;

?>">
</div>
</td>
</tr>
<tr>
<td><br></td>
</tr>

<tr>
<td class="col-md-3"  colspan="2">

<div class="form-group">

  <label>Informations Responsable</label>
</div>
</td>
<td></td>
</tr>
<tr>
<td class="col-md-1">

<div class="form-group">

  <label>Civilité</label>

  <select name="civiliteResponsable" class="form-control select2" style="width:100%;">

    <option  <?php if($result['civilite']=='Mr') {echo "selected";}?> >Mr</option>
    <option <?php if($result['civilite']=='Mme') {echo "selected";}?>>Mme</option>
  </select>

</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">Nom</label>

<input name="nomResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom" value="<?php echo $result['nom']; ?>">

</div>
</td>
<td class="col-md-2">
<div class="form-group">
<label for="exampleInputEmail1">Prénom</label>
<input  name="prenomResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Prenom" value="<?php echo $result['prenom']; ?>">
</div>
</td>

<td class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">N° Téléphone Bureau</label>
<input name="telResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $result['tel']; ?>">

</div>
</td>
<td class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">N° Téléphone Mobile </label>
<input name="telMobileResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone" value="<?php echo $result['telMobile']; ?>">

</div>
</td>
</tr>
<tr>

<td class="col-md-5" colspan="3">
<div class="form-group">

<label for="exampleInputEmail1">Profession</label>

<input name="professionResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Profession" value="<?php echo $result['profession']; ?>">

</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">Skype</label>

<input name="pseudoskypeResponsable"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Pseudo Skype" value="<?php echo $result['pseudoskype']; ?>">

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email </label>

<input name="emailResponsable"  type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $result['email']; ?>">

</div>
</td>
          </tr>
        
<tr>

<td class="col-md-3"  colspan="2">

<div class="form-group">

<label>Informations Cron Envoi Lead</label>
</div>
</td>
<td></td>
</tr>
<tr>
<td class="col-md-1">

<div class="form-group">

  <label>Statut  </label>
  <select name="cronActif" class="form-control select2" style="width:100%;">
    <option <?php if($result['cronActif']=='1') {echo "selected";}?> value="1">Actif</option>
    <option <?php if($result['cronActif']=='0') {echo "selected";}?>  value="0">Inactif</option>
    
  </select>

</div>
</td>
<td class="col-md-2">
<div class="form-group">
   <label>Nb Max Envoi Lead *</label>
   <input name="nbMaxEnvoiLead"  type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Nb Max Envoi Lead" value="<?php echo $result['nbMaxEnvoiLead']; ?>">


</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">Volume Min</label>
<input name="volumeMin" type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Volume Min" value="<?php echo $result['volumeMin']; ?>">


</div>
</td>

<td class="col-md-6"  colspan="2">
<div class="form-group">

<label for="exampleInputEmail1">Codes postaux départ </label>

<input name="codesPostauxDepart"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Codes Postaux Départ" value="<?php echo $result['codesPostauxDepart']; ?>"> 

</div>
</td>

</tr>
<tr>
<td></td>
<td></td>
<td class="col-md-2">
<div class="form-group">

                  <label for="exampleInputEmail1">Volume Max</label>
                  <input name="volumeMax" type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Volume Max" value="<?php echo $result['volumeMax']; ?>">


                </div>
</td>
<td class="col-md-6" colspan="2">
<div class="form-group">

<label for="exampleInputEmail1">Codes postaux arrivée </label>

<input name="codesPostauxArrivee"  type="text"  class="form-control" id="exampleInputEmail1" placeholder="Codes Postaux Arrivée" value="<?php echo $result['codesPostauxArrivee']; ?>">

</div>
</td>
</tr>

</table>
          
          <!-- /.row -->

        </div>
       <!-- /.box-body -->
       <!-- SELECT2 EXAMPLE -->
       <?php

      

}				



      ?>
      

<div class="box-footer">

<button type="reset" class="btn btn-default">Annuler</button>

<button type="submit" class="btn btn-info pull-right">Valider</button>

</div>

      </div>

	  

	  

	  </form>

	 

              <!-- /.form group -->



              <!-- Date and time range -->

              

          <!-- /.box -->



          <!-- iCheck -->

          

              <!-- Minimal style -->



              <!-- checkbox -->

              



              <!-- Minimal red style -->



              <!-- checkbox -->

              



              <!-- radio -->

             



              <!-- Minimal red style -->



              <!-- checkbox -->

              



              <!-- radio -->

              

            

          <!-- /.box -->

        </div>

        <!-- /.col (right) -->

      </div>

      <!-- /.row -->



    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

  <footer class="main-footer">

    <div class="pull-right hidden-xs">

   

    </div>

    <strong>Copyright &copy; 2017 

  </footer>



 

  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->

 <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script src="dist/js/bootstrap-colorpicker.min.js"></script>

    <script src="dist/js/bootstrap-colorpicker-plus.js"></script>

    

<!-- jQuery 2.2.3 -->

<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->

<script src="../../bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 -->

<script src="../../plugins/select2/select2.full.min.js"></script>

<!-- InputMask -->

<script src="../../plugins/input-mask/jquery.inputmask.js"></script>

<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>

<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- date-range-picker -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<!-- bootstrap datepicker -->

<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="../../plugins/datepicker/bootstrap-datepicker2.js"></script>

<!-- bootstrap color picker -->

<script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>


<!-- SlimScroll 1.3.0 -->

<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- iCheck 1.0.1 -->

<script src="../../plugins/iCheck/icheck.min.js"></script>

<!-- FastClick -->

<script src="../../plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="../../dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="../../dist/js/demo.js"></script>

<!-- Page script -->

<script>
     
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
          document.contact.telephone.required = "";
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
          document.contact.telephone.required = "required";
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
        document.contact.telephone.required = "required";
        document.contact.emailPro.required = "";
        document.contact.telephonePro.required = "";
        document.contact.nomPro.required = "";
        }
      });


    });

    //Initialize Select2 Elements

    $(".select2").select2();

    //Date picker

    $('#datepicker').datepicker({

      autoclose: true

    });

  });
</script>

</body>

</html>

<?php

} else

{

header('location: index.php');

}?>