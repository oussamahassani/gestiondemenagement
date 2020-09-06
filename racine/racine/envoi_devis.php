     
<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php require_once "inc/header.php"; ?>
<!--=================================
 header End-->

<!--=================================
 Main content -->
 
 
<!-- Left Sidebar End -->
<?php require_once "inc/menu.php"; ?>
<?php require_once '../connect.php';
   $id_devis=$_GET['id_devis'];

              
             
              $req=mysql_query("select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
              INNER JOIN devis ON demande.id_dem=devis.id_demande 
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
			  where id_devis='$id_devis' ");
      
        
              while($result=mysql_fetch_array($req))
              {				
			  ?>
			
			 
			
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"> Devis N° SUP<?php echo $result['id_devis'];?>  <a href="" title =' <?php 
              
              
              $req2=mysql_query("select * from devis 
              INNER JOIN logService ON logService.id_devis=devis.id_devis 
              INNER JOIN utilisateur on utilisateur.id_utilisateur=logService.id_utilisateur where devis.id_devis='$id_devis' order by date_creation desc ");
      $result2=mysql_fetch_array($req2);
                    			
               echo 'Envoyé par : '.$result2['nom']. ' '.$result2['prenom'] . ', Le ';
               echo  $result2['date_creation'];
               
                   ?> 
                 
                 '>
                 <i class="text-info ti-info"></i></a></h4>
              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Devis</a></li>
              <li class="breadcrumb-item active">Envoi mail</li> 
             </ol>
          </div>
        </div>
    </div>
  
    <div class="row">   
      <div class="col-md-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">   
            <div class="main-content">
              <h5 class="card-title"><a id="h1_editor-markdown-01" class="anchor" href="#h1_editor-markdown-01" aria-hidden="true"><span class="octicon octicon-link"></span></a>Envoi mail</h5>
              <form id="form"  enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact"  onSubmit="envoyer(<?php echo $result['id_devis']; ?>,<?php echo $result['id_client']; ?>,<?php echo $result['id_dem']; ?>)" >
    
                        <div class="form-row">
                        <div class="form-group col-md-4">
  <input name="id_utilisateur"  type="hidden"  id="exampleInputEmail1"   value="<?php echo $_SESSION['id']; ?>">
          
<label for="exampleInputEmail1">From</label>
<input name="from_<?php echo $result['id_devis']; ?>"  class="form-control" id="exampleInputEmail1" placeholder="FROM"  value="contact@super-demenagement.com" required = "required" type="email" >
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">To</label>
<input name="to_<?php echo $result['id_devis']; ?>" class="form-control" id="exampleInputEmail1" placeholder="TO"  value="<?php echo $result['email']; ?>" required = "required" type="email" >
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">Cci</label>
<input name="cci_<?php echo $result['id_devis']; ?>"  class="form-control" id="exampleInputEmail1" placeholder="CCI"  value="contact@super-demenagement.com" type="email" >
              </div>
              
</div>
<div class="form-row">
<div class="form-group col-md-10">

<label for="exampleInputEmail1">Objet</label>
<input name="objet_<?php echo $result['id_devis']; ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="OBJET"  value="SUPERDEM : <?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];?> : Votre devis de déménagement">
</div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">Pièce jointe 
 </label>
 <a   class="dropdown-item" id="pdf" target="new" href="../pages/TCPDF-master/examples/example_051.php?id=<?php echo $result['id_dem']; ?>&dev=<?php echo $result['id_devis']; ?>"><img src="images/picto_pdf.png" width="40"></a>

</div>
</div>
<div class="form-row">
<div class="form-group" >
                    <label for="summernote">Message * :</label>
                 
                    <div id="summernote">Bonjour <?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];?>
<br />
<br />
 Suite au passage de .........   à votre domicile , nous vous prions de trouver ci-joint notre proposition de tarif pour votre projet de déménagement en formule <?php echo $result['prestation']?>.
 <br />Nous vous remercions vivement de nous avoir consultés et restons à votre disposition pour répondre à toutes questions concernant ce devis.
 <br />Vous en souhaitant bonne réception, nous vous prions de croire, ..... , en l''assurance de nos salutations distinguées.
 <br /></div>
</div>
</div>

<br />
<br />

            
<div class="box-footer">

<button type="submit" class="btn btn-info pull-right">Envoyer</button>


</div>

</form>
               
                  </div>
                </div>      </div> 
                </div>
              </div>
             
		
			  
			  <?php 

              

}
?>




<?php require_once"inc/footer.php"; ?>
<?php
} 
else
{

header('location: index.php');

}?>

<script>

  
function envoyer(identifiant,id_client,id_demande)
{

var confirmation=confirm("Etes-vous sûr(e) de vouloir envoyer ce devis?");
var id_utilisateur=document.getElementsByName('id_utilisateur')[0].value;
var from = document.getElementsByName('from_' + identifiant)[0].value;
var to = document.getElementsByName('to_' + identifiant)[0].value;
var cci = document.getElementsByName('cci_' + identifiant)[0].value;
var objet = document.getElementsByName('objet_' + identifiant)[0].value;
//var corps = document.getElementsByName('summernote')[0].innerHTML;
var corps = $("#summernote").summernote('code');

//alert(objet);
if(confirmation)
{

  $.ajax({
							type        : "POST",
							url         : "../pages/TCPDF-master/examples/generePdfDevis.php?dev="+identifiant +"&id="+id_demande,
							data        : "dev="+identifiant +"&id="+id_demande ,
              beforeSend  : function(){ },
              success   : function(response){
                
                $.ajax({
							type        : "POST",
							url         : "ajax/ajax_send_devis.php",
              data	: {  id_devis 			: identifiant
							, id_client 			: id_client
							, lienPdf 			: response
							, from 			: from
							, to 				: to
							, cci			: cci
              , objet 	: objet
              , corps : $("#summernote").summernote('code')
							, id_utilisateur 			: id_utilisateur
              }
              ,
              //'lienPdf='+response+'&id_devis='+identifiant +"&id_client="+ id_client +"&from="+ from+"&to="+ to+"&cci="+ cci+"&objet="+ objet +"&corps="+ corps +"&id_utilisateur="+id_utilisateur,
              beforeSend  : function(){ },
              success   : function(response){
              alert('Devis envoyé avec succès.');
              window.location.reload();
              	}
							,
							cache : false

						});
              	}
							,
							cache : false

						});
  
  
}

}


  </script>