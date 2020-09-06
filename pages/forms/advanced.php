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

  <title>Paris ECO | Ajout Demande</title>

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

  <!-- Bootstrap time Picker -->

  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">

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



function change()

{

document.contact.periode_arr.value="";

}

function change2()

{

document.contact.periode_dep.value="";

}

function changeper()

{

document.contact.date_dep.value="";

}

function changeper2()

{

document.contact.date_arr.value="";

}





function verif()

{

	if(document.contact.source.value==-1)

		{

		alert("veuillez entrer la source svp");

		document.contact.source.focus();

		return false;

		}

		

    if ($('#typeClient').val()=="1")
    {
      if(document.contact.civilite.value==-1)

    {

    alert("veuillez choisir la civilte svp");

    document.contact.civilite.focus();

    return false;

    }

		if(document.contact.nom.value=="")

		{

		alert("veuillez entrer le nom du client svp");

		document.contact.nom.focus();

		return false;

		}

		

		if(document.contact.prenom.value=="")

		{

		alert("veuillez entrer le prenom du client svp");

		document.contact.prenom.focus();

		return false;

		}



		if(document.contact.telephone.value=="")

		{

		alert("veuillez entrer le telephone svp");

		document.contact.telephone.focus();

		return false;

		}



         if(document.contact.email.value=="")

		{

		alert("Veuillez entrer l'email");

		document.contact.email.focus();

		return false;

		}
  }
  else
  {


    if(document.contact.nomPro.value=="")
{

alert("Veuillez entrer la raison sociale");

document.contact.nomPro.focus();

return false;

}
    
    if(document.contact.telephonePro.value=="")

{

alert("Veuillez entrer le téléphone");

document.contact.telephonePro.focus();

return false;

}







     if(document.contact.emailPro.value=="")

{

alert("Veuillez entrer l'email");

document.contact.emailPro.focus();

return false;

}
  }

		 if(document.contact.date_etab.value=="")

		{

		alert("veuillez entrer la date ");

		document.contact.date_etab.focus();

		return false;

		}

		

		 if(document.contact.date_val.value=="")

		{

		alert("veuillez entrer la date ");

		document.contact.date_val.focus();

		return false;

		}

		

		 if(document.contact.adresse_dep.value=="")

		{

		alert("veuillez entrer l' adresse_dep ");

		document.contact.adresse_dep.focus();

		return false;

		}

		

		 if(document.contact.cp_dep.value=="")

		{

		alert("veuillez entrer l' code postale dep ");

		document.contact.cp_dep.focus();

		return false;

		}

		

		 if(document.contact.ville_dep.value=="")

		{

		alert("veuillez entrer la ville depart ");

		document.contact.ville_dep.focus();

		return false;

		}

		

		

		 if(document.contact.ville_dep.value=="")

		{

		alert("veuillez entrer la ville depart ");

		document.contact.ville_dep.focus();

		return false;

		}

		

		 if(document.contact.habit_dep.value=="")

		{

		alert("veuillez entrer l'habitation depart ");

		document.contact.habit_dep.focus();

		return false;

		}

		

		if(document.contact.date_dep.value=="")

		{

		alert("veuillez entrer la date depart ");

		document.contact.date_dep.focus();

		return false;

		}

		

		

		 if(document.contact.adresse_arr.value=="")

		{

		alert("veuillez entrer l' adresse_arr ");

		document.contact.adresse_arr.focus();

		return false;

		}

		

		 if(document.contact.cp_arr.value=="")

		{

		alert("veuillez entrer l' code postale Arr ");

		document.contact.cp_arr.focus();

		return false;

		}

		

		 if(document.contact.ville_arr.value=="")

		{

		alert("veuillez entrer la ville arrivée ");

		document.contact.ville_arr.focus();

		return false;

		}

		

		

		 if(document.contact.ville_arr.value=="")

		{

		alert("veuillez entrer la ville depart ");

		document.contact.ville_arr.focus();

		return false;

		}

		

		 if(document.contact.habit_arr.value=="")

		{

		alert("veuillez entrer l'habitation arrivee ");

		document.contact.habit_arr.focus();

		return false;

		}

		

		

		

		if(document.contact.volume.value=="")

		{

		alert("veuillez entrer le volume en m2");

		document.contact.volume.focus();

		return false;

		}

		

		if(document.contact.distance.value=="")

		{

		alert("veuillez entrer la distance en m2");

		document.contact.distance.focus();

		return false;

		}

		

		

		if(document.contact.prestation.value==-1)

		{

		alert("veuillez entrer la prestation ");

		document.contact.prestation.focus();

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

      <h1>



	  Ajout demande

      
      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i>Acceuil</a></li>

        <li><a href="#">Demandes</a></li>

        <li class="active">Ajout</li>

      </ol>

    </section>

    

    

    <form id="form" action="insert_demande.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" onSubmit="return verif()">

           

           

           

    <!-- Main content -->

    <section class="content">



      <!-- SELECT2 EXAMPLE -->
      <?php require_once '../../connect.php';			 ?>
      <div class="box box-default">

        <div class="box-header with-border">

          <h3 class="box-title">Informations générales</h3>



          <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         

          </div>

        </div>


        <!-- /.box-header -->

        <div class="box-body">
       <div class="row">

       <table><tr> <td class="col-md-3">
       <div class="form-group">

       
				  <label>Source</label>

                <select name="source" class="form-control select2" style="width: 100%;">

               <?php

       $req5=mysql_query("select * from source");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_source']."'>".$result5['nom_source']." </option>"; }
     
				?>

                  

                </select>

              </div>
              </td>
              <td class="col-md-3">
       <div class="form-group">

       
				  <label>Type de demande</label>

                <select name="typeDemande" class="form-control select2" style="width: 100%;">

               <?php

$req6=mysql_query("select * from masterParametreValeur where idMasterParametre=2 ");
       while($result6=mysql_fetch_array($req6)) 
       { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }
        ?>
     </select>

              </div>
              </td>
              <td class="col-md-3">
       <div class="form-group">
<label>Etablie le:</label>



<div class="input-group date">

  <div class="input-group-addon">

    <i class="fa fa-calendar"></i>

  </div>

  <input name="date_etab"  type="text" class="form-control pull-right" id="datepicker">

</div>
</div>
</td><td class="col-md-3">
<div class="form-group">


<label>Valable</label>
<div class="input-group date">

  <div class="input-group-addon">

    <i class="fa fa-calendar"></i>

  </div>

  <input name="date_val" type="text" class="form-control pull-right" id="datepicker2">

</div>
</div>
</td></tr></table>
      
          <!-- /.row -->

</div>
<!-- /.box-body -->
 <div class="box-footer"></div>
 </div>

      <!-- /.box -->
<!-- SELECT2 EXAMPLE -->

<div class="box box-default">

        <div class="box-header with-border">

          <h3 class="box-title">Infos Client</h3>



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
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="nouveauClient" value="option1" checked>
                                                        <label class="form-check-label" for="nouveauClient">
                                                           Nouveau client
                                                        </label>
                                                    </div>
</td> <td class="col-md-3">
<div class="form-group">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="ancienClient" value="option2">
                                                        <label class="form-check-label" for="ancienClient">
                                                           Ancien client
                                                        </label>
                                                    </div>
</td>
          <td class="col-md-1">

<div class="form-group">

  <label>Type</label>
  </div>
</td>
<td class="col-md-2">
          <div class="form-group">
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
<table>
<tr id="clientParticulier" style="display:block">
<td class="col-md-1">

<div class="form-group">

  <label>Civilité</label>

  <select name="civilite" class="form-control select2" style="width:100%;">

    <option selected="selected">Mr</option>

    <option>Mme</option>
  </select>

</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">Nom</label>

<input name="nom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom">

</div>
</td>
<td class="col-md-2">
<div class="form-group">

                  <label for="exampleInputEmail1">Prenom</label>

                  <input  name="prenom"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Prenom">

                </div>
</td>

<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephone"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">

</div>
</td>
<td class="col-md-2">
<div class="form-group">

<label for="exampleInputEmail1">N° Mobile</label>

<input  name="telMobile"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Mobile">

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email</label>

<input name="email"  type="text" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">

</div>
</td>
          </tr>
        
          <tr id="clientProfessionnel" style="display:none">

<td class="col-md-4">
<div class="form-group">

<label for="exampleInputEmail1">Raison sociale</label>

<input name="nomPro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Raison sociale">

</div>
</td>


<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">N° téléphone</label>

<input name="telephonePro"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Téléphone">

</div>
</td>
<td class="col-md-3">
<div class="form-group">

<label for="exampleInputEmail1">Adresse Email</label>

<input name="emailPro"  type="text" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">

</div>
</td>
          </tr></table>
          
          <!-- /.row -->

        </div>

        <!-- /.box-body -->

        <div class="box-footer">

         

        </div>

      </div>

	  
	   <!-- SELECT2 EXAMPLE -->

      <div class="box box-default">

        <div class="box-header with-border">

          <h3 class="box-title">
            <table><tr><td class="col-md-3">Informations Départ</td><td class="col-md-3">Informations Arrivée</td><td class="col-md-3">&nbsp;&nbsp;Informations Déménagement</td></tr></table></h3>



          <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div class="row">
          <table ><tr>
            <td class="col-md-3">

              <div class="form-group">
<label for="exampleInputEmail1">Adresse</label>

                  <input name="adresse_dep" type="text" class="form-control" id="exampleInputEmail1" placeholder="Adresse">

                </div>
	<div class="form-group">
  <table><tr> <td width="35%"><label for="exampleInputEmail1">Code postale</label></td> <td><label for="exampleInputEmail1">Ville</label></td></tr> 
               <tr><td>

                  <input name="cp_dep" type="text" class="form-control" id="exampleInputEmail1" placeholder="Code Postale">
</td>
<td> <input name="ville_dep" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ville">

</td>
</tr>
</table>
</div>

				

				<div class="form-group">
        <table width="100%"><tr> <td width="35%"><label for="exampleInputEmail1">Habitation</label></td> <td><label for="exampleInputEmail1">Portage</label></td></tr>
        <tr> <td><select name="habit_dep" class="form-control select2" style="width: 100%;">
                 <option selected="selected">RDC</option>

                  <option>RDC-1</option>

                  <option>RDC+1</option>

                  <option>RDC+2</option>

                  <option>RDC+3</option>

                  <option>Etage 1</option>

                  <option>Etage 2</option>

				  <option>Etage 3</option>

                  <option>Etage 4</option>

				  <option>Etage 5</option>

                  <option>Etage 6</option>

				  <option>Etage 7</option>

                  <option>Etage 8</option>

				  <option>Etage 9</option>

                  <option>Etage 10</option>

				  <option>Etage 11</option>

                  <option>Etage 12</option>

				  <option>Etage 13</option>

                  <option>Etage 14</option>

				  <option>Etage 15</option>

                  <option>Etage 16</option>

				  <option>Etage 17</option>

                  <option>Etage 18</option>

				  <option>Etage 19</option>

                  <option>Etage 20</option>

				  <option>Etage 21</option>

                  <option>Etage 22</option>

				  <option>Etage 23</option>

                  <option>Etage 24</option>

				  <option>Etage 25</option>

                  <option>Etage 26</option>

				  <option>Etage 27</option>

                  <option>Etage 28</option>

				  <option>Etage 29</option>

                  <option>Etage 30</option>

				  

                  

                </select></td>
                <td>  <input name="portage_dep" type="text" class="form-control" id="exampleInputEmail1" placeholder="Portage">

</td>
</tr></table>

                </div>

        </div>
        
        

				

				      <div class="form-group">
              <table><tr><td colspan="1" width="45%"><label>Date:</label></td><td colspan="2"> <label>Periode:</label></td></tr> 
         <tr><td colspan="1"><div class="input-group date">

<div class="input-group-addon">

  <i class="fa fa-calendar"></i>

</div>

<input name="date_dep"  type="text" class="form-control pull-right" id="datepicker3">

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

<label>

 Monte meuble <input name="monte_dep" type="checkbox" class="flat-red" >
 </label>
 <label>

  | Garde meuble <input name="garde_meuble_dep" type="checkbox" class="flat-red" >
 </label>
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

        
            <td class="col-md-3">

               <div class="form-group">

                 <div class="form-group">

                  <label for="exampleInputEmail1">Adresse</label>

                  <input name="adresse_arr" type="text" class="form-control" id="exampleInputEmail1" placeholder="Adresse">

                </div>

				

				<div class="form-group">

        <table><tr> <td width="35%"><label for="exampleInputEmail1">Code postale</label></td><td><label for="exampleInputEmail1">Ville</label></td></tr>
        <tr><td>
                  <input name="cp_arr" type="text" class="form-control" id="exampleInputEmail1" placeholder="Code Postale">
</td>
<td> <input name="ville_arr" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ville">
</td></tr>

</table>
        </div>

				
				

				<div class="form-group">

        <table width="100%"><tr> <td width="35%"><label for="exampleInputEmail1">Habitation</label></td><td><label for="exampleInputEmail1">Portage</label></td></tr>
        <tr><td><select name="habit_arr" class="form-control select2" style="width: 100%;">

                  <option selected="selected">RDC</option>

                  <option>RDC-1</option>

                   <option>RDC+1</option>

                  <option>RDC+2</option>

                  <option>RDC+3</option>

                  <option>Etage 1</option>

                  <option>Etage 2</option>

				  <option>Etage 3</option>

                  <option>Etage 4</option>

				  <option>Etage 5</option>

                  <option>Etage 6</option>

				  <option>Etage 7</option>

                  <option>Etage 8</option>

				  <option>Etage 9</option>

                  <option>Etage 10</option>

				  <option>Etage 11</option>

                  <option>Etage 12</option>

				  <option>Etage 13</option>

                  <option>Etage 14</option>

				  <option>Etage 15</option>

                  <option>Etage 16</option>

				  <option>Etage 17</option>

                  <option>Etage 18</option>

				  <option>Etage 19</option>

                  <option>Etage 20</option>

				  <option>Etage 21</option>

                  <option>Etage 22</option>

				  <option>Etage 23</option>

                  <option>Etage 24</option>

				  <option>Etage 25</option>

                  <option>Etage 26</option>

				  <option>Etage 27</option>

                  <option>Etage 28</option>

				  <option>Etage 29</option>

                  <option>Etage 30</option>

				  

                  

                </select>
</td>
<td> <input name="portage_arr" type="text" class="form-control" id="portage_arr" placeholder="Portage">
</td></tr>
</table>

                </div>

        </div>
        <div class="form-group"> 
         <table><tr><td colspan="1" width="45%"><label>Date:</label></td><td colspan="2"> <label>Periode:</label></td></tr> 
         <tr><td colspan="1"><div class="input-group date">

<div class="input-group-addon">

  <i class="fa fa-calendar"></i>

</div>

<input name="date_arr"  type="text" class="form-control pull-right" id="datepicker4">

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

                <label>

                  Monte meuble <input name="monte_arr" type="checkbox" class="flat-red" >
              </label>
              <label>

                  | Garde meuble <input name="garde_meuble_arr" type="checkbox" class="flat-red" >
                 </label>
                <label>
               Passage par fenêtre <input name="passageFenetre_arr" type="checkbox" class="flat-red" >
                </label>
                | 
                <label>
                Accès véhicule <input name="accesVehicule_arr" type="checkbox" class="flat-red" >
                </label>

              </div>



 </td>

            <td class="col-md-3">

              <div class="form-group">

               <div class="form-group">

                  <label for="exampleInputEmail1">Volume</label>

                  <input name="volume" type="text" class="form-control" id="exampleInputEmail1" placeholder="Volume">

                </div>

				

				<div class="form-group">

                  <label for="exampleInputEmail1">Distance</label>

                  <input name="distance" type="text" class="form-control" id="exampleInputEmail1" placeholder="Distance">

                </div>

				

              </div>

              <!-- /.form-group -->

              <div class="form-group">

                  <label for="exampleInputEmail1">Prestation</label>

                  

                <select name="prestation" class="form-control select2" style="width: 100%;">

                  <option selected="selected">Economique</option>

                  <option>ECO+ Meubles</option>

                  <option>ECO+ Fragiles</option>

                  <option>Standard</option>

                  <option>LUXE</option>

                  <option>Meuble Vides</option>

				</select>

                </div>

				

				 <div class="form-group">

                  <label>Remarques</label>

                  <textarea name="remarque" class="form-control" rows="3" placeholder="Remarque..."></textarea>

                </div>
               <br><br><br>




                </td>
            </tr>
</table>




    











				

              <!-- /.form-group -->

          <!-- /.row -->

        </div>

        <!-- /.box-body -->

                        

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

<!-- bootstrap time picker -->

<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>

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
    $('#typeClient').change(function()
    {      $(this).find("option:selected").each(function()
      {
     var optionValue = $(this).attr("value");
    // alert(optionValue);
     if (optionValue != 1)
      {
        $('#clientParticulier').hide();
        $('#clientProfessionnel').show();
      } 
     else 
      {$('#clientParticulier').show();
        $('#clientProfessionnel').hide();
        }
      });


    });

    //Initialize Select2 Elements

    $(".select2").select2();



    //Datemask dd/mm/yyyy

    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    //Datemask2 mm/dd/yyyy

    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

    //Money Euro

    $("[data-mask]").inputmask();



    //Date range picker with time picker

    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});

    //Date range as a button

    $('#daterange-btn').daterangepicker(

        {

          ranges: {

            'Today': [moment(), moment()],

            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],

            'Last 7 Days': [moment().subtract(6, 'days'), moment()],

            'Last 30 Days': [moment().subtract(29, 'days'), moment()],

            'This Month': [moment().startOf('month'), moment().endOf('month')],

            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

          },

          startDate: moment().subtract(29, 'days'),

          endDate: moment()

        },

        function (start, end) {

          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        }

    );



    //Date picker

    $('#datepicker').datepicker({

      autoclose: true

    });

	

	//Date picker2

    $('#datepicker2').datepicker({

      autoclose: true

    });

	

	//Date picker3

    $('#datepicker3').datepicker({

      autoclose: true

    });

	

	//Date picker4

	 $('#datepicker4').datepicker({

      autoclose: true

    });



    //iCheck for checkbox and radio inputs

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({

      checkboxClass: 'icheckbox_minimal-blue',

      radioClass: 'iradio_minimal-blue'

    });

    //Red color scheme for iCheck

    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({

      checkboxClass: 'icheckbox_minimal-red',

      radioClass: 'iradio_minimal-red'

    });

    //Flat red color scheme for iCheck

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({

      checkboxClass: 'icheckbox_flat-green',

      radioClass: 'iradio_flat-green'

    });



    //Colorpicker

    $(".my-colorpicker1").colorpicker();

    //color picker with addon

    $(".my-colorpicker2").colorpicker();



    //Timepicker

    $(".timepicker").timepicker({

      showInputs: false

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