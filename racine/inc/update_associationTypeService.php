<?php
$id=$_GET['id'];
$id_objet=$_GET['id_objet'];
$id_service=$_GET['id_service'];
$type_service=$_GET['type_service'];
$nbMaxEnvoiLead =$_GET['nbMaxEnvoiLead'];
$delaiEnvoiEnMinutes=$_GET['delaiEnvoiEnMinutes'];

require_once '../../connect.php';
if ($id == 0) {
   // echo "INSERT INTO associationTypeService (code_objet,id_objet,id_service,id_type,nbMaxEnvoiLead,delaiEnvoiEnMinutes) Values ('Source','$id_objet','$id_service','$type_service','$nbMaxEnvoiLead','$delaiEnvoiEnMinutes')";
    $req1=mysql_query("INSERT INTO associationTypeService (code_objet,id_objet,id_service,id_type,nbMaxEnvoiLead,delaiEnvoiEnMinutes) Values ('Source','$id_objet','$id_service','$type_service','$nbMaxEnvoiLead','$delaiEnvoiEnMinutes')");

}
else
{//echo "UPDATE associationTypeService SET id_objet='$id_objet',id_service='$id_service',id_type='$type_service',nbMaxEnvoiLead='$nbMaxEnvoiLead',delaiEnvoiEnMinutes='$delaiEnvoiEnMinutes' where id='$id'";
$req1=mysql_query("UPDATE associationTypeService SET id_objet='$id_objet',id_service='$id_service',id_type='$type_service',nbMaxEnvoiLead='$nbMaxEnvoiLead',delaiEnvoiEnMinutes='$delaiEnvoiEnMinutes' where id='$id'");
}

?>
<script type="text/javascript">

document.location.href="../parametrage.php";

</script>
