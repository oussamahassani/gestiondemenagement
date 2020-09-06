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
  <title>ParisECO | Visite</title>
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
 <script language="javascript">
function verif()
{		
		if(document.contact.date.value=="")
		{
		alert("veuillez entrer la date svp");
		document.contact.date.focus();
		return false;
		}
		
		if(document.contact.time.value=="")
		{
		alert("veuillez entrer l'heure svp");
		document.contact.time.focus();
		return false;
		}
		
		if(document.contact.commercial.value=="")
		{
		alert("veuillez choisir le commercial svp");
		document.contact.commercial.focus();
		return false;
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
    <!-- Logo --> <a href="l" class="logo">
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

	  Ajout Facture
        <small>new</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">facture</a></li>
        <li class="active">Ajout</li>
      </ol>
    </section>
     <?php
            if(isset($_GET['dem']))
			{
				$dev=$_GET['dev'];
			
			?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>Création facture reussite!</h4>
                Merci , Télecharger PDF <a target="new" href="../TCPDF-master/examples/facture.php?id=<?php echo $_GET['dem']; ?>&dev=<?php echo $dev; ?>"><img src="icono_pdf.png" width="50">.</a>
              </div>
              
              <?php
			  }else
			  {
				  
				  
                require_once '../../connect.php';
				  $id=$_GET['demande'];
				  $iddev=$_GET['dev'];
				  $req=mysql_query("select * from facture where id_dem='$id'");
				if($result1=mysql_fetch_array($req))
				{
					
					?>
					 <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>facture Déja crée !</h4>
                Merci , Télecharger PDF <a target="new" href="../TCPDF-master/examples/facture.php?id=<?php echo $id ; ?>&dev=<?php echo $idd ; ?>"><img src="icono_pdf.png" width="50">.</a>
              <br> Sinon vous pouvez la modifier par le formulaire ci dessous.</div>
					<?php
					
				}
				  
			  }
			  
			 
                require_once '../../connect.php';
				if(isset($_GET['demande']) )
				{
					
					$id=$_GET['demande'];
					$dev=$_GET['dev'];
					
				}else
				{
					$id=$_GET['dem'];
					$dev=$_GET['dev'];
				}
						  
				 $req=mysql_query("select * from demande,devis,client where demande.id_client=client.id_client and demande.id_dem=devis.id_demande and  devis.id_devis='$dev' ");
				if($result1=mysql_fetch_array($req))
	
	   		     
			{		
	   		     
			
			  
			  ?>
<form id="form" action="insert_facture.php" enctype="multipart/form-data" method="post" class="validateform" name="contact" onSubmit="return verif()">
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Facture</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
			   <?php
            if(isset($_GET['demande']))
			{
				
			
			?>
           <div class="form-group">

                  <input name="dem" type="hidden" value="<?php echo $_GET['demande']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Adresse">
                </div>
              
              <?php
			  }else
			  {
				
			
			?>
           <div class="form-group">

                  <input name="dem" type="hidden" value="<?php echo $_GET['dem']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Adresse">
                </div>
              
              <?php
			  }
			  ?>

			  
			  <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="date" type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
			  
			  	<div class="form-group">
                  <label for="exampleInputEmail1">Nom Client</label>
                  <input name="nom"  value="<?php
                  echo $result1['nom']." ".$result1['prenom'];
				  ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                  <input name="dev"  value="<?php
                  echo $_GET['dev'];
				  ?>"  type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                </div>
			  
			  
			 <div class="form-group">
                  <label for="exampleInputEmail1">Adresse client</label>
                  <input name="adresse"  value="<?php
                  echo $result1['adresse_dep'];
				  ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                </div>
				
				
				
				 <div class="form-group">
                  <label for="exampleInputEmail1">prestation</label>
                  <input name="prestation"  value="<?php
                  echo $result1['prest'];
				  ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                </div>
				
				<div class="form-group">
                  <label>Details</label>
                  <textarea name="details" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Montant HT</label>
                  <input name="ht"  value="<?php
                  echo $result1['Prix_ht'];
				  ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">TVA</label>
                  <input name="tva"  value="<?php $req2=mysql_query("select * from parametre");
				if($result2=mysql_fetch_array($req2))
					
					{
                  echo $result2['tva'];
					} 
				  ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone">
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Montant payé</label>
                  <input name="paye"  type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Montant Payée">
                </div>
				
					<div class="form-group">
                  <label for="exampleInputEmail1">reste à payer</label>
                  <input name="reste" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter reste à payer">
                </div>
			  
			     <div class="form-group">
                  <label>Montant Arrété en Lettre:</label>
                  <textarea name="arrete" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>             
                
               
				
				
				
				 
				
				<br>
				<div class="box-footer">
                <button type="submit" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn btn-info pull-right">Valider</button>
              </div>
			  
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
           
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         
        </div>
      </div>
      <!-- /.box -->





                    






				
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
           
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         
        </div>
      </div>
			<?php } ?>
	  
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
      <b>Version</b> 2.3.12
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
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
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
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
	
	//Date picker2
    $('#datepicker3').datepicker({
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
</html><?php
} else
{
header('location: index.php');
}?>