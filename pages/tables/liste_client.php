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

  <title>Liste | Clients</title>

  <!-- Tell the browser to be responsive to screen width -->

  
  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->

  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->

  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


<script language="javascript">

function confirme(identifiant)

{

var confirmation=confirm("Voulez vous vraiment supprimer ce client?");

if(confirmation)
{

document.location.href="../forms/supprimer_client.php?id_client="+identifiant;

}

}



</script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

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

        Liste Clients

        <small>clients</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Acceuil </a></li>

        <li><a href="#">Clients</a></li>

        <li class="active">Liste</li>

      </ol>

    </section>



    <!-- Main content -->

    
    <section class="content">

      <div class="row">

        <div class="col-xs-12">


            <!-- /.box-header -->

           
      
      <!-- /.row -->

          <div class="box">

            <div class="box-header">

              <h3 class="box-title">Client</h3>

              <br><!-- <a href="../forms/client.php"><button type="button" class="btn bg-maroon btn-flat margin">Ajouter un client</button></a>-->
            
              <!-- /.box-header -->
              <!-- /.box-header -->
            </div>
           <div class="table-responsive no-padding">

              <table id="example1" class="table table-bordered table-striped">

                <thead>
              <tr>

                  <th width="5%">ID</th>
                  <th width="10%">Client B2B</th>
                  <th>Informations générales</th>
                  <th>Contact</th>
                  <th>Informations Client B2B</th>
                  <th>Informations Cron</th>
                  <th width="10%"></th>

                </tr>

                
                </thead> <tbody>
<?php

                

				 require_once '../../connect.php';

						   

         $req=mysql_query("select *,m.valeur AS typeClient from client INNER JOIN masterParametreValeur m ON m.id=type_client
          order by id_client desc");
         

				 while($result=mysql_fetch_array($req))

	

	   		     

			{				

				

                ?>

                

                <tr>

                  <td>

                  <?php

                  echo $result['id_client'];

				  ?>

                  </td>

                  <td>

                    <?php
                    if ($result['clientB2B']=='1') 
                    {   echo 'Oui';
                    }
                    else
                    {
                      echo 'Non';}
                    ?>
                    </td>
                  <td>

                  <?php
                  if ($result['type_client']!='1') 
                  {   echo $result['raisonsociale'];
                  }
                  else
                  {

                  echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                  }
				          ?>
                  </td>

                  <td>
                  <?php
                  if ($result['clientB2B']=='1') 
                  { 
                    echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                    echo '<br>';echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile']." - Email : ".$result['email'];
                    echo '<br>';
                    echo 'Profession : '.$result['profession']." - Pseudoskype : ".$result['pseudoskype'];
                  }
                  else
                  {
                  echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                  echo '<br>';
                  echo 'Email : '.$result['email'];
                  }
				          ?>

                  </td>

                  <td>
                  <?php
                  if ($result['clientB2B']=='1') 
                  {echo 'Pays : '.$result['pays']." - Ville : ".$result['ville']." - Code postal : ".$result['codepostal'];
                    echo '<br>';
                    echo 'Adresse : '.$$result['adresse']. ' - Siret : '.$result['siret'];
                    echo '<br>';
                    echo 'Email : '.$result['emailClientB2B'];
                  }
                  else
                  {echo '----';
                  }
				          ?>

                  </td>
                  <td>
                  <?php
                  if ($result['clientB2B']=='1') 
                   

                  { $cronActif = $result['cronActif'];
                    if ($cronActif =='1')
                    $cronActif ='Actif';
                    else
                    $cronActif ='Inactif';
                    echo 'Statut cron : '.$cronActif. ' - Nb Max Envoi Lead : '.$result['nbMaxEnvoiLead'];
                    echo '<br>';
                    echo 'Codes postaux départ : '.$result['codesPostauxDepart']." - Codes postaux arrivée : ".$result['codesPostauxArrivee'];
                    echo '<br>';
                    echo 'Volume min : '.$$result['volumeMin']. ' - Volume max : '.$result['volumeMax'];
                  }
                  else
                  {echo '----';
                  }
				          ?>

                  </td>
                   

                 

                  <td>

                 <a href="../forms/modif_client.php?id_client=<?php echo $result['id_client']; ?>"><button type="button" class="btn bg-olive margin">Modifier</button></a>

                 <?php
                  $req2=mysql_query("select * from demande  WHERE id_client=".$result['id_client']."
                  order by id_client desc");
                  if ($result1=mysql_fetch_array($req2))
                  {
                    echo("");
                  }
                  else{
				  echo("<a href=\"#\" class='HREF' onClick=\"confirme('".$result['id_client']."')\">");
        
				  ?>

                  <button type="button" class="btn bg-orange margin">Supprimer</button>

				  <?php

                  echo("</a>");

   
                }
				  ?> 

                

                </td>

                </tr>

              <?php 

              

			}

			?>

                </tbody>

                </tfoot>

              </table>

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

  </div>


  <!-- /.content-wrapper -->
  <footer class="main-footer">

<div class="pull-right hidden-xs">

  <b>Version</b> 2.3.12

</div>

<strong>Copyright &copy; 2017 

</footer>



  <!-- Control Sidebar -->



  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->

<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->

<script src="../../bootstrap/js/bootstrap.min.js"></script>

<!-- DataTables -->

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll 

<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>-->

<!-- FastClick -->

<script src="../../plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="../../dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="../../dist/js/demo.js"></script>

<script>

  $(function () {

    $("#example1").DataTable(

	{

      "paging": true,

      "lengthChange": false,

      "searching": true,

      "ordering": false,

      "info": false,

      "autoWidth": false

    }

	);

  $('#example2').DataTable({

"paging": true,

"lengthChange": false,

"searching": false,

"ordering": true,

"info": false,

"autoWidth": false

});


  });

</script>

</body>

</html><?php

} else

{

header('location: index.php');

}?>