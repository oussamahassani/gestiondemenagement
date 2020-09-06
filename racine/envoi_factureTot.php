     
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
   $id_devis=$_GET['dev'];

     $requete3 = mysql_query("SELECT * FROM facturation where id_deviss =$id_devis")  or die( mysql_error() ) ;
	   $result201=mysql_fetch_array($requete3);
            
			  
			
              $req=mysql_query("SELECT *,ts.valeur as type_presentation ,c.nom as nomc  FROM devis  INNER JOIN  demande on demande.id_dem=devis.id_demande
         LEFT JOIN client c on demande.id_client =c.id_client
         LEFT JOIN masterParametreValeur ts ON demande.id_type =ts.id
		  where  devis.id_devis = $id_devis ");
		
      
        
              while($result=mysql_fetch_array($req))
              {				
			  ?>
			
			 
	
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"> Facture Total <?php echo $id_Fact ;?>  <a href="" title =' <?php 
              
              
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
              <li class="breadcrumb-item"><a href="#" class="default-color"></a></li>
              <li class="breadcrumb-item active">Envoi mail</li> 
             </ol>
          </div>
        </div>
    </div>
  <?php
                
                 $identifiant=$result['id_devis'];
				 $encassement=$result201['id_encaisseme'];
               
  ?>
  
    <div class="row">   
      <div class="col-md-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">   
            <div class="main-content">
              <h5 class="card-title"><a id="h1_editor-markdown-01" class="anchor" href="#h1_editor-markdown-01" aria-hidden="true"><span class="octicon octicon-link"></span></a>Envoi mail</h5>
              <form id="form"  enctype="multipart/form-data" method="post"   class="form-horizontal" name="contact"  action="mail_TOT.php" >
    
                        <div class="form-row">
                        <div class="form-group col-md-4">
  <input name="id_utilisateur"  type="hidden"  id="id_utilisateur"   value="<?php echo $_SESSION['id']; ?>">
			  <input name="identifiant" type="hidden"  id="identifiant"   value="<?php echo $identifiant ;?>">
            <input name="id_nom" type="hidden"  id="id_nom"   value="<?php echo $result['nom'] ;?>">
<label for="exampleInputEmail1">From</label>
<input name="from_"  class="form-control" id="from_" placeholder="FROM"  value="contact@super-demenagement.com" required = "required" type="email" >
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">To</label>
<input name="to_" class="form-control" id="to_" placeholder="TO"  value="<?php echo $result['email']; ?>" required = "required" type="email" >
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">Cci</label>
<input name="cci_"  class="form-control" id="cci_" placeholder="CCI"  value="sarrahafsia.91@gmail.com" type="email" >
              </div>
              
</div>
<div class="form-row">
<div class="form-group col-md-10">

<label for="exampleInputEmail1">Objet</label>
<input name="objet_"  type="text" class="form-control" id="exampleInputEmail1" placeholder="OBJET"  value="SUPERDEM : <?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];?> : Facture N°( <?php echo $encassement ?>)">
</div>
<div class="form-group col-md-2">
<label for="exampleInputEmail1">Pièce jointe 
 </label>
			  <a target="_blank"   class="dropdown-item" id="pdf" href="../pages/TCPDF-master/examples/facturePDF3.php?id=<?php echo $id_devis; ?>"><img src="images/picto_pdf.png" width="40"></a>

</div>
</div>
<div class="form-row">
<div class="form-group" >
                    <label for="summernote">Message * :</label>
                 <textarea name="summernote" id="summernote"></textarea>
                  </div>
</div>
</div>

<br />
<br />

            
<div class="box-footer">

<button type="submit" id="envoiyer" class="btn btn-info pull-right" onclick="envoyer(<?php echo $identifiant; ?>)">Envoyer</button>


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

 var variable2= <?php echo json_encode($result201); ?>;

console.log(variable2);


//var confirmation=confirm("Etes-vous sûr(e) de vouloir envoyer cette facturation?");  
var id_utilisateur=document.getElementsByName('id_utilisateur')[0].value;
 var id_nom = document.getElementsByName('id_nom')[0].value;

var corps = $("#summernote").summernote('code');
 console.log(id_nom + id_utilisateur + corps  );
 $('form').submit(function (e) {
    var form = this;
    e.preventDefault();
    setTimeout(function () {
        form.submit();
    }, 2000); // in milliseconds
    
    $("<p>Delay...</p>").appendTo("body");
});
</script> 
<script>

  //$("#envoiyer").click(function(){
   //envoyer(identifiant);
 //  });
function envoyer(identifiant)
{

var confirmation=confirm("Etes-vous sûr(e) de vouloir envoyer cette facturation?");  

var id_utilisateur=document.getElementsByName('id_utilisateur')[0].value;
var from = document.getElementsByName('from_')[0].value;
var to = document.getElementsByName('to_')[0].value;
var cci = document.getElementsByName('cci_')[0].value;
var objet = document.getElementsByName('objet_')[0].value;
var id_nom = document.getElementsByName('id_nom')[0].value;
var corps = $("#summernote").summernote('code');
if(confirmation)
{
if ( objet!="" && id_utilisateur!="" && to!=""){
  $.ajax({
	                     type        : "POST",
			        	url         : "../pages/TCPDF-master/examples/genererfacturePDF3.php?id="+identifiant,
			
				data        : "id="+identifiant,
			beforeSend  : function(){ },
              success   : function(response){
                
             /*   $.ajax({
							type        : "POST",
							url         : "ajax/ajax_send_facture.php",
              data	: {  id_devis 			: identifiant,
					       // lienPdf 		: response,
							 from 			: from,
							  to			: to,
							  cci			: cci,
                              objet 	    : objet,
                              corps         : corps,
							  id_utilisateur : id_utilisateur,
							  id_nom          : id_nom
              },
              
           beforeSend  : function(){},
            success   : function(response){
          
             
          	}
						
						});*/
           alert('facturation generer avec succès.');

              	}
						

						});
  
}
else{
			alert('merci remplire tout les champs avant!');
		}
}

}


  </script>