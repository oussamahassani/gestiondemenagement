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
              <h4 class="mb-0">Ajout Volume </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Volume</a></li>
              <li class="breadcrumb-item active">Ajout</li>
            </ol>
          </div>
        </div>
    </div>
	 <?php require_once '../connect.php';			 ?>
        <form method="post" action="inc/add_volume.php" enctype="multipart/form-data">
  <section>
<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations Aticle
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>
<div class="box-body">
          <div class="form-row" id="infogenerales">
		  <div class="form-group col-md-3">  
 <label>Categorie *</label>
 <select name="source" class="form-control select2" style="width: 100%;" required="required">

       <?php $req5=mysql_query("select * from  categorie");
         while($result5=mysql_fetch_array($req5)) 
       { echo"<option value='".$result5['id_catego']."'>".$result5['Nomcategorie']." </option>"; }
     
				?> 
</select>
</div>
<div class="form-group col-md-3">  
<label>ID Article</label>

<input name="id_vol"  class="form-control" type='text'  value="" required="required"/>
                 
</div>
<div class="form-group col-md-3">  
<label>Nom Article</label>

<input name="Nom_vol"  class="form-control" type='text'   required="required"/>
                 
</div>

<div class="form-group col-md-3"><label for="calc_vol">Volume Article </label>

<input name="calc_vol"  type="text" class="form-control" id="calc_vol" required="required">

</div></br>
<div class="form-group col-md-3">
<label>Image Article</label>

   <input type="file" name="file" size="40" required="required">

</div>
            <center>
            <div id="coord">
            
 
 
            <br>
            
 
           
            <br><br>
            
 
 
 
            </div>
			
			</div>
			<button type="submit" class="btn envoyer btn-info pull-right">Envoyer </button>
            
            <button type="clear" class="btn btn-danger  pull-left">Anuller</button>
                  <br><br>    <br><br>
		</center>
		</div>
		  </section>
		  </form>  
<div class="box box-default">
		        <form method="post" action="inc/add_categorie.php" enctype="multipart/form-data">
				 <section>
				<div class="box box-default">
<div class="box-header with-border">
<h5 class="card-title">Informations categorie
  <div class="box-tools pull-right">
  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div></h5>
</div>

<div class="row">
</br></br></br>
</div>
<div  style =" margin: 40px;" class="box-body">
          <div class="form-row" id="infogenerales">
		  <div class="form-group">  
		  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                           <tr>
                              <th>NumÂ° </th>
                              <th width="20%">Nom</th>
                            <th></th>
                           </tr>
                        </thead>
                        <tbody>
  
  <?php
  

$req6=mysql_query("select * from categorie  ");
       while($result=mysql_fetch_array($req6)) 
       {  
                             echo'<tr> <td> '.$result['id_catego'].' </td>';
                             echo '<td>'.$result['Nomcategorie'].' </td>';
                                 
                                  echo' <td><a class="dropdown-item" id="envoiParisEco" href="#" onClick="supprimer('.$result['id_catego'].')" >Supprimer</a></td>';
                                                    
                                    
                                
                             }
        ?>
		</tr>
                   </tbody>
                     </table>   </div>  
 <label>Categorie *</label>
 <input name="id_vol"  class="form-control" type='text'  value="" required="required"/>
                 
            </div>
			
			</div>
			<button type="submit" class="btn envoyer btn-info ">Envoyer </button>
            
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