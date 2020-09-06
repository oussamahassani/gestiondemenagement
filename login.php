<!DOCTYPE html>

<?php session_start (); 
if (strpos($_SERVER['HTTP_HOST'],'parisecodevis.superdemenagement.fr' ) !== false )
	{
      $_SESSION['id_client_B2B']	=141 ;
      $_SESSION['logo']='logo-pariseco.png';
      $_SESSION['titleClient']="Pari's Eco";
							
	}
	else 
	{
      $_SESSION['id_client_B2B']	=247 ;
      $_SESSION['logo']='logo-superdem.png';
      $_SESSION['titleClient']="SuperDem";
    }
?>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="BackOffice" />
<meta name="description" content="Devis" />
<meta name="author" content="Hela" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Login | <?php echo $_SESSION['titleClient']?></title>

<!-- Favicon -->
<link rel="shortcut icon" href="racine/images/<?php echo $_SESSION['logo']?>" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="racine/css/style.css" />
 
</head>

<body>

<div class="wrapper">

<section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-color: #282a39;" >
  <div class="container">
     <div class="row justify-content-center no-gutters vertical-align">
       <div class="col-lg-4 col-md-6 bg-white">
		<div class="login-fancy pb-40 clearfix">
        <span class="text-white mb-20" style="display:block; text-align: center;"><img src="racine/images/<?php echo $_SESSION['logo']?>" style="width:230px;" ></span>
        <h3 class="mb-30">Connexion</h3>
		<!---<form action="login.cfm" method="post" class="form-validate" id="frmSubmit">-->
        <?php
				if(isset($_GET['erreur']))
				{
                ?>
                 <div class="alert alert-danger">
						Accès réfusé
					  </div>
				
                      <?php
				}
				?>
         <form action="verif_user.php" method="post">
			<input type="hidden" name="GetLoginFormSubmit" value="1">
         	
                <div class="section-field mb-20">
                    <label class="mb-10" for="login">Login * </label>
                    <input id="login"  name="login"  class="web form-control" type="text" placeholder="" name="login"  data-rule-required="true" >
                </div>
                <div class="section-field mb-20">
                    <label class="mb-10" for="Password">Mot de passe * </label>
                    <input id="Password" name="password"  class="Password form-control" type="text" placeholder="" name="Password" data-rule-required="true" >
                </div>
           
           
            <button type="submit" class="button">S'identifier</button>
        
            
          	</div>
            

		   </form>
		
        </div>
      </div>
  </div>
</section>
  
</div>

<!-- jquery -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<!--<script src="plugins/iCheck/icheck.min.js"></script>-->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
</html>