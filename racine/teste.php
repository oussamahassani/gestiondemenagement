<select name="source_devies" class="form-control select2 col-md-3"  required="required">
 <option value = "-1" selected>[choose yours]</option>
  <?php 
  require_once '../connect.php';
  require_once"inc/header.php";
  require_once"inc/footer.php"; 
  $req5= "SELECT *  FROM devis  LEFT JOIN  demande ON demande.id_dem = devis.id_demande where demande.id_type=4 AND devis.id_statut=46 AND NOT EXISTS(SELECT id_devis FROM encaissement
		    WHERE devis.id_devis = encaissement.id_devis) "; 
	   
  
  
  
 
			$requete2 = mysql_query($req5) or die( mysql_error()) ;
         while($result5=mysql_fetch_array($requete2)) 
       { echo"<option value='".$result5['id_devis']."'>".$result5['id_devis']." </option>"; }
     
				?> 
</select>