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

  <title>ParisECO | liste demande</title>

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

function supprimer(identifiant)

{

var confirmation=confirm("Voulez vous vraiment supprimer cette demande?");

if(confirmation)

{

document.location.href="../forms/delete_demande.php?id_dem="+identifiant;

}

}

function confirmation(identifiant)

{

var confirmation=confirm("Voulez vous vraiment confirmer cette devis?");

if(confirmation)

{

document.location.href="../forms/confirm_devis.php?iddev="+identifiant;

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

        Data Tables

        <small>advanced tables</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Tables</a></li>

        <li class="active">Data tables</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box">

            

            <!-- /.box-header -->

           



          <div class="box">

            <div class="box-header">

              <h3 class="box-title">Liste Demandes</h3>

            </div>

            <!-- /.box-header -->

           <div class="box-body table-responsive no-padding">

              <table id="example1" class="table table-bordered table-striped">

                <thead>

                <tr>

                  <th>Id</th>

                  <th>Nom Client</th>

                   <th>CP Depart</th>

                  <th>CP Arrivée</th>

                  <th>Date</th>

                  <th>prestation</th>

                  <th>boutton</th>

                </tr>

                </thead> <tbody>

                <?php

                

				 require_once '../../connect.php';

						   

				 $req=mysql_query("select * from demande,client where id_source!=5 AND demande.id_client=client.id_client and demande.conf=0 order by demande.id_dem DESC");

				 while($result=mysql_fetch_array($req))

	

	   		     

			{				

				

                ?>

                

                

               

                <tr>

                  <td bgcolor="<?php

             echo $result['couleur'];

			 ?>"> 

             <?php

             echo 'PAR'.$result['id_dem'];
           

			 ?>     

			 <br><br><br><font size="1">Last UPDATE </font>

			 <br><font size="1">Admin:

             <?php

             $admin=$result['id_admin_mod'];

			 $reqad=mysql_query("select * from admin where id_admin='$admin'");

				 if($resultad=mysql_fetch_array($reqad))

				 {

					 echo $resultad['nom_admin'].' '.$resultad['prenom_admin'];

				 }				

             ?>

			 </font>

                  </td>

                  <td>

                  <?php

             echo $result['civilite']." ".$result['nom']." ".$result['prenom'];

			 ?> 

                  </td>

                   <td>

                  <?php

             echo $result['code_postale_dep'];

			 ?> 

                  </td>

                   <td>

                  <?php

             echo $result['code_post_arr'];

			 ?> 

                  </td>

                  <td>

            <?php

			$date_etab=$result['etablie_le'];

			$a=substr($date_etab,0,4);

			$m=substr($date_etab,5,2);

			$j=substr($date_etab,8,2);

			

             echo $j."/".$m."/".$a;

			 ?>

                  </td>

                  <td> 

                    <?php

             echo $result['prestation'];

			 ?> 

                  </td>

                  <td><?php 

				 echo "<a href=\"../forms/confirm_demande.php?id_dem=".$result['id_dem']."\" class='HREF'> ";

				 ?> 

                 <button type="button" class="btn btn-block btn-success btn-sm">Confirmer</button>

                 <?php 

				 echo "</a>";

				 ?> <?php 

				 echo "<a href=\"../forms/modif_demande.php?id_dem=".$result['id_dem']."\" class='HREF'> ";

				 ?> <button width="50" type="button" class="btn btn-block btn-default btn-sm">Modifier</button><?php 

				 echo "</a>";

				 ?> 

				

				 <?php

				  echo("<a href=\"#\" class='HREF' onClick=\"supprimer('".$result['id_dem']."')\">");

				  

				  ?>

				   <button type="button" class="btn btn-block btn-primary btn-sm">Supprimer</button>

				  <?php echo"</a>";

   

				  ?> 

                 

				   

				   <a href="../forms/visite.php?dem=<?php echo $result['id_dem']; ?>"><button type="button" class="btn btn-block btn-warning btn-sm">Visite</button>

				  </a></td>

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

<!-- SlimScroll -->

<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->

<script src="../../plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="../../dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="../../dist/js/demo.js"></script>

<!-- page script -->

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