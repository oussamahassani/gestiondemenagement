<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8"><title>Document sans nom</title>

</head>

<body>
<?php
$date="05/02/2017 - 02/08/2017";
$date2=substr($date,0,10);
echo $date2;
$date3=substr($date,13,10);
$a=substr($date2,6,4);
echo"<br>".$a;
$m=substr($date2,3,2);
echo"<br>".$m;
$j=substr($date2,0,2);
echo"<br>".$j;

echo "<br>".$j."-".$m."-".$a;

echo"<br>".$date3;
?>


</body>
</html>