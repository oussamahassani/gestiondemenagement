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
<?php require_once"inc/menu.php";?>

<!--=================================
 Main content -->

 <!--=================================
wrapper -->
<script language="javascript">
function deleteassociation(identifiant)

{

var confirmation=confirm("Êtes-vous sûr de vouloir supprimer ce paramètrage?");
if(confirmation)
{
document.location.href="inc/delete_associationTypeService.php?id="+identifiant;

}

}

function updateassociation(identifiant)
{
id_objet=document.getElementById("id_source_"+identifiant).value;

id_service =document.getElementById("id_service_"+identifiant).value;
type_service =document.getElementById("type_service_"+identifiant).value;
nbMaxEnvoiLead =document.getElementById("nbMaxEnvoiLead_"+identifiant).value;
delaiEnvoiEnMinutes =document.getElementById("delaiEnvoiEnMinutes_"+identifiant).value;

//document.contact.id_source_'.identifiant.
document.location.href="inc/update_associationTypeService.php?id="+identifiant+"&code_objet=Source&id_objet="+ id_objet+"&id_service="+id_service+"&type_service="+type_service+"&nbMaxEnvoiLead="+nbMaxEnvoiLead+"&delaiEnvoiEnMinutes="+delaiEnvoiEnMinutes;

}
</script>

  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"> Paramètrage services fournisseur </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active"> Paramètrage services </li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
           <h5 class="card-title">Paramètrage</h5>
          <!---<h5 class="card-title">
             <table width="100%"><tr width="100%"><td width="30%">Source</td><td  width="20%">Service</td><td width="20%">Type Service</td><td width="20%">Nb Max Envoi Lead</td> <td width="20%"></td> 
</tr></table></h5>  !--->
<div data-repeater-item>
              <form class="row mb-30">
              <div class="col-lg-2"><b>Source</b></div>
              <div class="col-lg-2"><b>Service</b></div>
              <div class="col-lg-2"><b>Type Service</b></div>
              <div class="col-lg-2"><b>Nb Max Envoi Lead</b></div>
              <div class="col-lg-2"><b>Délai d'envoi en Minutes</b></div>
              <div class="col-lg-2"></div>
</form>
</div>
         
            <div class="repeater">
              <div data-repeater-list="group-a">
              <?php   require_once '../connect.php';
              $req=mysql_query("SELECT id,id_objet, id_type, id_Service, nbMaxEnvoiLead,delaiEnvoiEnMinutes FROM `associationTypeService`  INNER JOIN source s on s.id_source=id_objet");
              while($result=mysql_fetch_array($req))
              {				
              ?>
              <div data-repeater-item >
                 <form class="row mb-30" name="contact">
                 <div class="col-lg-2">
                    <div class="box">
                    <select name="id_source_<?php echo $result['id']; ?>"  id="id_source_<?php echo $result['id']; ?>"  class="fancyselect" >
                    <?php
                    $req5=mysql_query("select * from source");
                      while($result5=mysql_fetch_array($req5)) 
                    {  if ($result5['id_source'] == $result['id_objet']) {
                      echo '<option  value="'.$result5['id_source'].'" selected="selected">'.$result5['nom_source'].' </option>';
                      }
                      else
                      {
                      echo"<option value='".$result5['id_source']."'>".$result5['nom_source']." </option>";
                      }
                      }
                    ?>
                    </select>
                    </div>
                   </div>
                   <div class="col-lg-2">
                   <div class="box">
                    <select requiered name="id_service_<?php echo $result['id']; ?>"  id="id_service_<?php echo $result['id']; ?>"  class="fancyselect" placeholder="Service"  style="width: 100%;">
                    <?php $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=5 ");
                      while($result6=mysql_fetch_array($req6)) 
                      {  if ($result6['id'] == $result['id_service']) {
                        echo '<option  value="'.$result6['id'].'" selected="selected">'.$result6['valeur'].' </option>';
                        }
                        else
                        {
                        echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>";
                        }
                        }
                        ?>
                    </select>
                      </div>
                   </div>

                   <div class="col-lg-2">
                   <div class="box">
                    <select requiered name="type_service_<?php echo $result['id']; ?>"  id="type_service_<?php echo $result['id']; ?>" class="fancyselect" placeholder="Type service"  style="width: 100%;">
                    <?php $req7=mysql_query("select * from masterParametreValeur where idMasterParametre=4");
                      while($result7=mysql_fetch_array($req7)) 
                      {  if ($result7['id'] == $result['id_type']) {
                        echo '<option  value="'.$result7['id'].'" selected="selected">'.$result7['valeur'].' </option>';
                        }
                        else
                        {
                        echo"<option value='".$result7['id']."'>".$result7['valeur']." </option>";
                        }
                        }
                        ?>
                    </select>
                      </div>
                   </div>
                   <div class="col-lg-2">
                   <input  requiered name="nbMaxEnvoiLead_<?php echo $result['id']; ?>" id="nbMaxEnvoiLead_<?php echo $result['id']; ?>" type="number" min="0" class="form-control" id="exampleInputEmail1" placeholder="Nb Max Envoi Lead" value="<?php echo $result['nbMaxEnvoiLead']; ?>">
                  </div>
                  <div class="col-lg-2">
                   <input requiered name="delaiEnvoiEnMinutes_<?php echo $result['id']; ?>" id="delaiEnvoiEnMinutes_<?php echo $result['id']; ?>"  type="number" min="30" class="form-control" id="exampleInputEmail1" placeholder="Délai d'envoi" value="<?php echo $result['delaiEnvoiEnMinutes']; ?>">
                  </div>
                  
                   
                   <div class="col-lg-2">
                   <a style="cursor: hand;"  href="##"   onclick="updateassociation(<?php echo $result['id']; ?>)" class="saveAssociation" class="btn btn-danger btn-block">
                   <i  class="fa fa-save"  style="font-size:45px;color:orange"></i>
				           </a>
				           <a style="cursor: hand;" data-repeater-delete href="##"   onclick="deleteassociation(<?php echo $result['id']; ?>)"   class="deleteAssociationTypeService" class="btn btn-outline-warning btn-lg" >
				           <i class="fa fa-trash-o" style="font-size:40px;color:brown; margin-right: 10px;"></i>
                   </a>
                   </div>
                </form>
              </div>
              <?php
              }
              ?>
            <div data-repeater-item>
              <form class=" row mb-30">
                  <div class="col-lg-2">
                    <div class="box">
                   
                    <select name="id_source_0"  id="id_source_0"  class="fancyselect"  >
                    <option value='' selected></option>
                    <?php 	
                    $req5=mysql_query("select * from source");
                      while($result5=mysql_fetch_array($req5)) 
                    { echo"<option value='".$result5['id_source']."'>".$result5['nom_source']." </option>"; }
                    ?>
                    </select>
                    </div>
                   </div>
                   <div class="col-lg-2">
                   <div class="box">
                     <select requiered name="id_service_0"  id="id_service_0"  class="fancyselect" placeholder="Service"  style="width: 100%;">
                     <option value='' selected></option>
                    
                      <?php  $req6=mysql_query("select * from masterParametreValeur where idMasterParametre=5 ");
                       while($result6=mysql_fetch_array($req6)) 
                      { echo"<option value='".$result6['id']."'>".$result6['valeur']." </option>"; }
                        ?>
                    </select>
                    </div>
                   </div>
                   <div class="col-lg-2">
                   <div class="box">
                     <select requiered name="type_service_0" id="type_service_0" class="fancyselect" placeholder="Type service"  style="width: 100%;">
                     <option value='' selected></option>
                     <?php $req7=mysql_query("select * from masterParametreValeur where idMasterParametre=4");
                      while($result7=mysql_fetch_array($req7)) 
                      { echo"<option value='".$result7['id']."'>".$result7['valeur']." </option>"; }
                        ?>
                    </select>
                    </div>
                   </div>
                   <div class="col-lg-2">
                   <input requiered name="nbMaxEnvoiLead_0" id="nbMaxEnvoiLead_0"  type="number" min="0" class="form-control"  placeholder="Nb Max Envoi Lead" value="">
                  </div>
                  <div class="col-lg-2">
                   <input name="delaiEnvoiEnMinutes_0"  id="delaiEnvoiEnMinutes_0"  type="number" min="30" class="form-control" id="exampleInputEmail1" placeholder="Délai d'envoi" value="<?php echo $result['delaiEnvoiEnMinutes']; ?>">
                  </div>
                  
                   
                   <div class="col-lg-2">
                   <a style="cursor: hand;"  href="##" onclick="updateassociation(0)" class="saveAssociation" class="btn btn-danger btn-block">
                   <i  class="fa fa-save"  style="font-size:45px;color:orange"></i>
				           </a>
				           <a style="cursor: hand;" data-repeater-delete href="##"  class="deleteAssociationTypeService" class="btn btn-outline-warning btn-lg" >
				           <i class="fa fa-trash-o" style="font-size:40px;color:brown; margin-right: 10px;"></i>
                   </a>
                   </div>
                </form>
              </div>
          </div>   
          <div class="row mt-20">
              <div class="col-12">
                <input class="button" data-repeater-create type="button" value="Nouvelle ligne"/>
              </div>
            </div>
        </div>
       </div>
    </div>
  </div> 

  </div>
  
  
  <?php require_once"inc/footer.php"; ?>
  
  <?php
} 
else
{

header('location: index.php');

}?>
  