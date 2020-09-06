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
              <h4 class="mb-0">Modification utilisateur </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Utilisateur</a></li>
              <li class="breadcrumb-item active">Modification</li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body -->
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
          <h3 class="card-title">Utilisateur N° <?php echo $_GET['id_utilisateur'];?> </h3>
    <form id="form" action="inc/insert_modif_utilisateur.php" enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact" onSubmit="return verif()">
     <?php require_once '../connect.php';			
      $id=$_GET['id_utilisateur'];   
    $req=mysql_query("select * from utilisateur where id_utilisateur='$id' ");
    if($result=mysql_fetch_array($req))
    {				
    ?>
    <input name="id_utilisateur" value="<?php echo $result['id_utilisateur'];?>" type="hidden" class="form-control" >
        <!-- SELECT2 EXAMPLE -->
  



<div class="form-row">
<div  class="form-group col-md-1.5">


<label>Type *</label>

<select name="id_type" id="id_type"  class="form-control select2"  required >
  <?php

$req6=mysql_query("select * from masterParametreValeur where idMasterParametre=6");
       while($result6=mysql_fetch_array($req6)) 
       { 
        if ($result6['id'] == $result['id_type']) {
          echo"<option selected value='".$result6['id']."'>".$result6['valeur']." </option>";
            }
         else
         { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }

        }
        ?>
  </select>
</div>
<div class="form-group col-md-1.5">
  <label>Civilité *</label>

  <select name="civilite" class="form-control select2" style="width:100%;" required>
  <option  <?php if($result['civilite']=='Mr') {echo "selected";}?>>Mr</option>
  <option <?php if($result['civilite']=='Mme') {echo "selected";}?>>Mme</option>
  </select>

</div>
<div class="form-group col-md-3">

<label>Nom *</label>

<input name="nom"  required type="text" class="form-control" id="nom"   value="<?php echo $result['nom']; ?>">

</div>
<div  class="form-group col-md-3">


                  <label>Prénom *</label>

                  <input  name="prenom"  required type="text" class="form-control" id="prenom" value="<?php echo $result['prenom']; ?>">

                  </div>
                  <div  class="form-group col-md-3">


                  <label>Surnom</label>

                  <input  name="surnom"  type="text" class="form-control" id="surnom"  value="<?php echo $result['surnom']; ?>">

                  </div>
                  

    </div>
    <div class="form-row">
    <div class="form-group col-md-3">
<label>Poste</label>

<input name="poste"  type="text" class="form-control" id="poste"  value="<?php echo $result['poste']; ?>">

</div>
<div class="form-group col-md-3">
<label>N° téléphone</label>

<input name="telephone"  type="text" class="form-control" id="tel"  value="<?php echo $result['tel']; ?>">

</div>
<div class="form-group col-md-3">
<label>N° Mobile </label>

<input name="telMobile"  type="text" class="form-control" id="telMobile"  value="<?php echo $result['telMobile']; ?>">

</div>
<div class="form-group col-md-3">

<label>Adresse Email</label>

<input name="email"  type="email" class="form-control" id="email"  value="<?php echo $result['email']; ?>">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-3">
<label>Statut * </label>
  <select name="actif" id="actif" class="form-control select2" style="width:100%;">
    <option <?php if($result['actif']=='1') {echo "selected";}?> value="1">Actif</option>
    <option <?php if($result['actif']=='0') {echo "selected";}?>  value="0">Inactif</option>
    
  </select>

      </div>
      <div  class="form-group col-md-3">


                  <label>Login *</label>

                  <input  name="login"  type="text" class="form-control" id="login" value="<?php echo $result['login']; ?>" required>

                  </div>
                  <div  class="form-group col-md-3">
                  <label>Mot de passe *</label>

                  <input  name="password"  type="password" class="form-control" id="password"  value="<?php echo $result['password']; ?>" required>

                  </div>
                  <div  class="form-group col-md-3">
                  <label>Confirmer Mot de passe *</label>

                  <input  name="password2"  type="password" class="form-control" id="password2"  value="<?php echo $result['password']; ?>" required>

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
if(document.contact.password2.value!=document.contact.password.value)

{

alert("Veuillez vérifier votre saisie du mot de passe");

document.contact.password2.focus();
return false;

}
	
}
</script>

</body>
<?php
} 
else
{

header('location: index.php');

}?>