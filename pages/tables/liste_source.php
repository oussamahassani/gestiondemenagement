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
  <title>AdminLTE 2 | Simple Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
<script language="javascript">
function confirme(identifiant)
{
var confirmation=confirm("Voulez vous vraiment supprimer cette source?");
if(confirmation)
{
document.location.href="../forms/supprimer_source.php?source="+identifiant;
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
        Liste Sources
        <small>Site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">sources</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
          
            
            <!-- /.box-header -->
           
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sources</h3>
              <br>
<a href="../forms/source.php"><button type="button" class="btn bg-maroon btn-flat margin">Ajouter une source</button></a>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table  class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Couleur</th>
                  <th>Site</th>
                  <th></th>
                </tr>
                
                 <?php
                
				 require_once '../../connect.php';
						   
				 $req=mysql_query("select * from source order by id_source desc");
				 while($result=mysql_fetch_array($req))
	
	   		     
			{				
				
                ?>
                
                <tr>
                  <td>
                  <?php
                  echo $result['id_source'];
				  ?>
                  </td>
                  <td>
                  
                  <?php
                  echo $result['nom_source'];
				  ?>
                  </td>
                  <td>
                  
                  <?php
                  echo $result['site'];
				  ?>
                  </td>
                  <td><span  style="background-color:
                  <?php
                  echo $result['couleur'];
				  ?>; padding:2px; color:#FFF; border-color:#CCC; text-decoration: blink;">
                  <?php
                  echo $result['couleur'];
				  ?></span></td>
                  <td>
				  <a href="../forms/modif_source1.php?source=<?php echo $result['id_source']; ?>"><button type="button" class="btn bg-olive margin">Modifier</button></a>
                 <?php
				  echo("<a href=\"#\" class='HREF' onClick=\"confirme('".$result['id_source']."')\">");
				  ?>
                  <button type="button" class="btn bg-orange margin">Supprimer</button>
				  <?php
                  echo("</a>");
   
				  ?>  </td>
                </tr>
              <?php 
              
			}
			  ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   
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
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html><?php
} else
{
header('location: index.php');
}?>