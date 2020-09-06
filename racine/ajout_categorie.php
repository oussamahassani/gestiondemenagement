<!DOCTYPE HTML>
<html>
 
    <head>
    <title>ajouter volume</title>
    <meta charset="UTF-8">
    <link href="style.css" type="text/css" rel="stylesheet"/>
    </head>
 
        <body>
		<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php require_once"inc/header.php"; ?>
<?php require_once"inc/menu.php"; ?>

  <div class="content-wrapper">
<div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Ajout categorie </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Categorie</a></li>
              <li class="breadcrumb-item active">Ajout</li>
            </ol>
          </div>
        </div>
    </div>
	 <?php require_once '../connect.php'; ?>
<div class="box box-default">
		        <form method="post" action="inc/add_catogerie.php" enctype="multipart/form-data">
				 <section>
				<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations categorie
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>

<div class="row">
</div>
<div  style =" margin: 40px;" class="box-body">
          <div class="form-row" id="infogenerales">
		  <div class="form-group">  
 <label>Categorie *</label>
 <input name="nom_cat"  class="form-control" type='text'  value="" required="required"/>
                 
            </div>
			
			</div>
		<br>	
			<button type="submit" class="btn envoyer btn-info  pull-right ">Envoyer </button>
            
            <button type="clear" class="btn btn-danger  pull-left">Anuller</button>
          
		</center>
		</div>
		  </section>
		  </div>
		 <?php require_once"inc/footer.php"; ?>
		 <script language="javascript">
function supprimer(identifiant) {
   var confirmation=confirm("Voulez vous vraiment supprimer cette catogerie?");

   if(confirmation) {
      document.location.href="inc/delete_categorie.php?id_cat="+identifiant;
   }
}
</script>
		<?php
} 
else
{

header('location: index.php');

}?>
    </body> 
</html>