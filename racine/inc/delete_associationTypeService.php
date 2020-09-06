<?php
$id=$_GET['id'];
require_once '../../connect.php';
$req1=mysql_query("DELETE FROM associationTypeService where id='$id'");
?>
<script type="text/javascript">

document.location.href="../parametrage.php";

</script>
