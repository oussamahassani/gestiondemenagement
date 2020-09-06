<?php
session_start();
session_unset();
session_destroy();
header('location: index.php');

?>
<script type="text/javascript">
document.location.href="index.php";
</script>