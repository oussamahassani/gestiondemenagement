     
<head>
<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<?php require_once '../../connect.php';
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
			
			 
			 <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                    <div class="modal-body">
                        <h6>Envoi Mail</h6>
                        <div class="form-row">
                        <div class="form-group col-md-4">

<label for="exampleInputEmail1">From</label>
<input name="from_<?php echo $result['id_devis']; ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="FROM"  value="contact@super-demenagement.com ">
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">To</label>
<input name="to_<?php echo $result['id_devis']; ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="TO"  value="<?php echo $result['email']; ?>">
              </div>
              <div class="form-group col-md-4">

<label for="exampleInputEmail1">Cci</label>
<input name="cci_<?php echo $result['id_devis']; ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="CCI"  value="contact@super-demenagement.com ">
              </div>
              
</div>
<div class="form-row">
                        <div class="form-group col-md-12">

<label for="exampleInputEmail1">Objet</label>
<input name="objet_<?php echo $result['id_devis']; ?>"  type="text" class="form-control" id="exampleInputEmail1" placeholder="OBJET"  value="SUPERDEM : <?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];?> : Votre devis de déménagement">
</div>
</div>
<div id="summernote">
<p>Bonjour <?php echo $result['civilite']." ".$result['nom']." ".$result['prenom'];?>
              </p><p></p>
              <p>Suite au passage de Madame <NOM DU COMMERCIALE> à votre domicile , nous vous prions de trouver ci-joint notre proposition de tarif pour votre projet de déménagement en formule <?php echo $result['prestation']?>.
              </p><p>Nous vous remercions vivement de nous avoir consultés et restons à votre disposition pour répondre à toutes questions concernant ce devis.
              </p><p>Vous en souhaitant bonne réception, nous vous prions de croire, <?php echo $result['civilite']?> , en l'assurance de nos salutations distinguées.
               </p></div>
                    
                    
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                 
                    <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" href="#" onClick="envoyer(<?php echo $result['id_devis']; ?>,<?php echo $result['id_client']; ?>)">Envoyer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                  </div>
                </div>
              </div>
             
		
			  
			  <?php 

              

}
?>
<script src="js/sumernote.js?v=1"></script>
